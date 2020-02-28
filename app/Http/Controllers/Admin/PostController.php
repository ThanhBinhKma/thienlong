<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Firefox\FirefoxDriver;
use Facebook\WebDriver\Firefox\FirefoxProfile;
use Facebook\WebDriver\WebDriverExpectedCondition;
use GuzzleHttp\Client;
use DB;
use App\Models\Post;
use Carbon;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.index');
    }

    public function listAccount(Request $request)
    {
        $id = $request->id; 
        $account  = Account::where('social',$id)->where('status',1)->get();

        $result = '';
       foreach ($account as $value) {
        $result .= "<option value='$value->id' id='option_account_$id'>$value->account_name</option>"; 
       }
        echo $result;
    }

    public function checkPost(Request $request)
    {
        $id_social = $request->social;
        $id_ac = $request->account;
        if($id_social == 2){
            return $this->post_twiter($request,$id_ac);
        }
        else if($id_social == 1){
            return $this->post_facebook($request,$id_ac);
        }
    }
    public function post_twiter($page = 1)
    {   
        try{
        $account  =Account::where('social',2)->get();       
        $cre = Carbon\Carbon::now();
        $created_at = $cre->toDateTimeString();  
        $host = 'http://localhost:4444/wd/hub';
        $caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();
        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)';
        $profile->setPreference('general.useragent.override', $userAgentChange);
        
        $capss = DesiredCapabilities::firefox();
        $capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('get','http://api.tovicorp.com/listAppImage?page='.$page.'&size=10');
        $apis = json_decode($response->getBody()->getContents(),1);
        $dem = 0;
        $count = count($apis['data']);
        $ckt = array();
        foreach ($apis['data'] as $key => $value) {
            $ckt[$key] = $key;
        }
        foreach ($apis['data'] as $keys => $values) {
            $ckt[$keys] = $values['id'];
        }
        
        $check_post = Post::select('post.post_id','post.account_id')->whereIn('post.post_id',$ckt);
        $check_post = $check_post->join('account','post.account_id','=','account.id');
        $check_post = $check_post->where('account.social',2)->get();
        $count_check_post = count($check_post);
        if($count_check_post > 0)
        {
            $page = $page + 1;
            $driver->close();
            $this->post_twiter($page);
        }else if($count_check_post==0){

            // kiểm tra xem có tài khoản nào ko
            if(count($account) > 0){
                foreach($account as $ac){
                    // Kiểm tra api có data ko
                    if($count > 0){
                        for($i = 0 ; $i< $count ;$i++ ){
                            if($dem ==10){
                                break;
                            }else{
                                //Check bài viết đã đăng lên mạng xã hội đó chưa

                                
                                   
                                    //Get Suggest google with api title
                                    $tt =  str_replace(array( '\'' , '"', ',','-','?','&',';', '<', '>' ), '', $apis['data'][$i]['title']);
                                   $tag = $this->getTagGoogle($tt);
                                
                                    // Add Cookie
                                    $driver->get('https://twitter.com/?lang=en');
                                                                    
                                    // Kiểm tra cookie còn dùng được ko
                                    if(count($driver->findElements(WebDriverBy::cssSelector("input.EdgeButton:nth-child(3)"))) == 0){
                                        

                                        $tag = str_limit($tag,70);
                                        $des = (strip_tags(str_limit($apis['data'][$i]['description']),210)).$tag;
                                        $driver->get('https://twitter.com/?lang=en');      
                                        sleep(2);

                                        $driver->findElement((WebDriverBy::cssSelector('div[id="tweet-box-home-timeline"]')))->sendKeys($des);
                                        sleep(3);
                                        if(count($driver->findElements(WebDriverBy::cssSelector('#react-root > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1)'))) >0 ){
                                            $driver->findElement(WebDriverBy::cssSelector('#react-root > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1)'))->click();   
                                        }
                                        if(count($driver->findElements(WebDriverBy::cssSelector('div#typeaheadDropdownWrapped-0')))){
                                            $driver->findElement((WebDriverBy::xpath('/html/body/div/div/div/div[1]/div/div[2]/div[2]/div[1]/div')))->click();
                                            sleep(2);        
                                        }
                                        sleep(3);
                                        $driver->findElement((WebDriverBy::xpath('/html/body/div[2]/div[2]/div/div[2]/div[2]/div/form/div[3]/div[2]/button')))->click();
                                        sleep(4);
                                        $url = $driver->findElement(WebDriverBy::xpath('/html/body/div[2]/div[2]/div/div[2]/div[4]/div[2]/ol[1]/li[1]/div/div[2]/div[1]/small/a'))->getAttribute("href");
                                        $post = new Post();
                                        $post->account_id = $ac->id;
                                        $post->created_at = $created_at;
                                        $post->content = $des;
                                        $post->url = $url;
                                        $post->post_id = $apis['data'][$i]['id'];
                                        $post->status = 1;
                                        $post->save();
                                        $dem++;  
                                    }else{
                                        $driver->findElement((WebDriverBy::cssSelector('form input[name="session[username_or_email]"]')))->sendKeys($ac->account_name);
                                        sleep(3);
                                        $driver->findElement((WebDriverBy::name('session[password]')))->sendKeys($ac->password);
                                        sleep(3);
                                        $driver->findElement((WebDriverBy::className('EdgeButton--medium')))->click();
                                        sleep(5);
                                        if(count($driver->findElements(WebDriverBy::cssSelector("input.EdgeButton:nth-child(3)"))) == 0){    
                                                                     
                                     
                                            $tag = str_limit($tag,70);
                                            $des = (strip_tags(str_limit($apis['data'][$i]['description']),210)).$tag;
                                            $driver->get('https://twitter.com/?lang=en');      
                                            sleep(2);
                                            $driver->findElement((WebDriverBy::cssSelector('div[id="tweet-box-home-timeline"]')))->sendKeys($des);
                                            sleep(3);
                                            if(count($driver->findElements(WebDriverBy::cssSelector('#react-root > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1)'))) >0 ){
                                                $driver->findElement(WebDriverBy::cssSelector('#react-root > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1)'))->click();   
                                            }
                                            if(count($driver->findElements(WebDriverBy::cssSelector('div#typeaheadDropdownWrapped-0')))){
                                                $driver->findElement((WebDriverBy::xpath('/html/body/div/div/div/div[1]/div/div[2]/div[2]/div[1]/div')))->click();
                                                sleep(2);        
                                            }
                                            sleep(3);
                                            $driver->findElement((WebDriverBy::xpath('/html/body/div[2]/div[2]/div/div[2]/div[2]/div/form/div[3]/div[2]/button')))->click();
                                            sleep(4);
                                            $url = $driver->findElement(WebDriverBy::xpath('/html/body/div[2]/div[2]/div/div[2]/div[4]/div[2]/ol[1]/li[1]/div/div[2]/div[1]/small/a'))->getAttribute("href");
                                            $post = new Post();
                                            $post->account_id = $ac->id;
                                            $post->created_at = $created_at;
                                            $post->content = $des;
                                            $post->url = $url;
                                            $post->post_id = $apis['data'][$i]['id'];
                                            $post->status = 1;
                                            $post->save();
                                            $dem++; 
                                        }
                                     
                                }
                            }
                        }
                    }
                    $driver->close();
                }
            }
        }
    }catch(\Exception $e){
          return $this->renderJsonResponse( $e->getMessage() );
        }
    }

    public function post_facebook($page = 1)
    {
        try{
            $account=Account::where('social',1)->where('status',1)->get();
            $cre = Carbon\Carbon::now();
            $created_at = $cre->toDateTimeString();
            $host = 'http://localhost:4444/wd/hub';
            $caps = DesiredCapabilities::chrome();
            $prefs = array();
            $options = new ChromeOptions();
            $prefs['profile.default_content_setting_values.notifications'] = 2;
            $caps->setCapability(ChromeOptions::CAPABILITY, $options);
            $profile = new FirefoxProfile();
            $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ';
            $profile->setPreference('general.useragent.override', $userAgentChange);        
            $capss = DesiredCapabilities::firefox();
            $capss->setCapability(FirefoxDriver::PROFILE, $profile);
            $driver = RemoteWebDriver::create($host, $capss);
            $client = new \GuzzleHttp\Client();
            $response = $client->request('get','http://api.tovicorp.com/listAppImage?page='.$page.'&size=10');
            $api = json_decode($response->getBody()->getContents(),1);     
            $dem = 0;
            $count = count($api['data']);
            $ckt = array();

            foreach ($api['data'] as $key => $value) {
                $ckt[$key] = $key;
            }
            foreach ($api['data'] as $keys => $values) {
                $ckt[$keys] = $values['id'];
            }
            $check_post = Post::select('post.post_id','post.account_id')->whereIn('post.post_id',$ckt);
            $check_post = $check_post->join('account','post.account_id','=','account.id');
            $check_post = $check_post->where('account.social',1)->get();
            $count_check_post = count($check_post);
            if($count_check_post > 0)
            {
                $page = $page + 1;
                $driver->close();   
                $this->post_facebook($page);
            }else if($count_check_post==0){
                if(count($account) > 0){
                    foreach($account as  $ac){
                        for($i = 0 ; $i <= $count; $i++){
                            if($dem === 10){
                                break;
                            }else{                                          
                                $tt =  str_replace(array( '\'' , '"', ',','-','?','&',';', '<', '>' ), '', $api['data'][$i]['title']);             
                                $driver->get('https://vi-vn.facebook.com/');                                  
                                $tag = $this->getTagGoogle($tt);
                               
                                sleep(2);        
                                if(count($driver->findElements((WebDriverBy::cssSelector('#loginbutton > input[type="submit"]')))) == 0){
                                    $des = str_limit(strip_tags($api['data'][$i]['description']),400).' '.$tag;
                                    $driver->findElement((WebDriverBy::name('xhpc_message')))->sendKeys($des);
                                    sleep(5);
                                    $post  = new Post();
                                    $post->content = $des;
                                    $post->created_at = $created_at;
                                    $post->account_id = $ac->id;
                                    $post->post_id = $api['data'][$i]['id'];
                                    $driver->wait(10, 1000)->until(
                                      WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector("div#feedx_sprouts_container button.selected"))
                                    );
                                    if(count($driver->findElements(WebDriverBy::cssSelector("div#feedx_sprouts_container button.selected"))) == 0){
                                        $post->status = 0;                                
                                        $post->save();
                                        $dem++;
                                    }else{
                                        $elements  = $driver->findElement(WebDriverBy::cssSelector("div#feedx_sprouts_container button.selected"))->click();
                                        sleep(5);
                                        $a = $driver->findElement((WebDriverBy::cssSelector("div#pagelet_bluebar div#blueBarDOMInspector div#bluebarRoot a[title='Trang cá nhân']")))->getAttribute("href");
                                        $driver->get($a);
                                        $b = $driver->findElement((WebDriverBy::cssSelector("div#timeline_tab_content div#timeline_story_column div[data-testid='story-subtitle'] a")))->getAttribute("href");
                                        $post->url = $b;
                                        $post->status = 1;
                                        
                                        $post->save();
                                        $dem++;
                                    } 
                                }else{                           
                                    $driver->findElement(WebDriverBy::id("email"))->sendKeys($ac->account_name);
                                    sleep(2);
                                    $driver->findElement(WebDriverBy::id('pass'))->sendKeys($ac->password);
                                    sleep(2);
                                    $dt = $driver->findElement((WebDriverBy::cssSelector('#loginbutton > input[type="submit"]')))->click();
                                    sleep(2);
                                    $des = str_limit(strip_tags($api['data'][$i]['description']),400).' '.$tag;
                                    $dem++;
                                    $driver->findElement((WebDriverBy::name('xhpc_message')))->sendKeys($des);
                                    sleep(5);

                                    $post  = new Post();
                                    $post->content = $des;
                                    $post->created_at = $created_at;
                                    $post->account_id = $ac->id;
                                    $post->post_id = $api['data'][$i]['id'];
                                    $driver->wait(10, 1000)->until(
                                      WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector("div#feedx_sprouts_container button.selected"))
                                    );
                              
                                    if(count($driver->findElements(WebDriverBy::cssSelector("div#feedx_sprouts_container button.selected"))) == 0){
                                        $post->status = 0;
                                        $post->save();
                                    }else{
                                        $elements  = $driver->findElement(WebDriverBy::cssSelector("div#feedx_sprouts_container button.selected"))->click();
                                        sleep(5);
                                        $a = $driver->findElement((WebDriverBy::cssSelector("div#pagelet_bluebar div#blueBarDOMInspector div#bluebarRoot a[title='Trang cá nhân']")))->getAttribute("href");
                                        $driver->get($a);
                                        $b = $driver->findElement((WebDriverBy::cssSelector("div#timeline_tab_content div#timeline_story_column div[data-testid='story-subtitle'] a")))->getAttribute("href");
                                        $post->url = $b;
                                        $post->status = 1;
                                        $post->save();
                                        $dem++;
                                    }
                                }    
                            }
                        }
                    }
                    $driver->close();
                }
            }
        }catch(\Exception $e){
          return $this->renderJsonResponse( $e->getMessage() );
        }          
        
    }

    public function getTagGoogle($ti)
    {    

        $ti = $ti.' '.'apk';
        $host = 'http://localhost:4444/wd/hub';
        $caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();
        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 5 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19';
        $profile->setPreference('general.useragent.override', $userAgentChange);        
        $capss = DesiredCapabilities::firefox();
        $capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
        $ac = Account::where('social',2)->where('status',1)->first();

        $driver->get('https://www.google.com'); 
        sleep(2);
         
        $driver->findElement(WebDriverBy::xpath('/html/body/div[3]/div[2]/div[2]/div[1]/form/div[2]/div[1]/div[1]/div/div[1]/input'))->sendKeys($ti);
        sleep(3);

        if(count($driver->findElements(WebDriverBy::xpath('/html/body/div[3]/div[2]/div[2]/div[1]/form/div[2]/div[1]/div[2]/ul/li[2]/div[2]/div[1]/span')))>0){
            $text  = $driver->findElement(WebDriverBy::xpath('/html/body/div[3]/div[2]/div[2]/div[1]/form/div[2]/div[1]/div[2]/ul/li[2]/div[2]/div[1]/span'))->getText();
        }else{
            $driver->findElement(WebDriverBy::xpath('/html/body/div[3]/div[2]/div[2]/div[1]/form/div[2]/div[1]/div[1]/button[2]'))->click();
            if(count($driver->findElements(WebDriverBy::xpath('(//div[@class="s75CSd"])[1]'))) > 0){
                $text = $driver->findElement(WebDriverBy::xpath('(//div[@class="s75CSd"])[1]'))->getText();
            }else{
                $text = $ti;
            }
        }
        
        
        $text = str_replace(' ','',$text);
        $text = '#'.$text;
        
        $tag  = $this->getTagTwitter($text);
        return $tag;
        $driver->close();

    }


    public function getTagTwitter($text)
    {
        $host = 'http://localhost:4444/wd/hub';
        $caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();
        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';
        $profile->setPreference('general.useragent.override', $userAgentChange);        
        $capss = DesiredCapabilities::firefox();
        $capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
        $ac = Account::where('social',2)->where('status',1)->first();
        $driver->get('https://twitter.com/?lang=en');
        $driver->findElement((WebDriverBy::className('js-signin-email')))->sendKeys($ac->account_name);
        sleep(3);
        $driver->findElement((WebDriverBy::name('session[password]')))->sendKeys($ac->password);
        sleep(3);
        $driver->findElement((WebDriverBy::className('EdgeButton--medium')))->click();
        if(count($driver->findElements(WebDriverBy::cssSelector("input.EdgeButton:nth-child(3)"))) == 0){
            $ttt = '';
            $driver->get('https://twitter.com/?lang=en');
            sleep(3);
            $driver->findElement(WebDriverBy::cssSelector('form[role="search"] input[placeholder="Search Twitter"]'))->sendKeys($text.' min_retweets:"10"');
            sleep(5);
            $driver->findElement(WebDriverBy::cssSelector('form[aria-label="Search Twitter"] div#typeaheadDropdown-1 span'))->click();
            sleep(3);
            $count_result = count($driver->findElements(WebDriverBy::xpath('/html/body/div/div/div/div/main/div/div/div/div[1]/div/div[2]/div/div/section/div/div/div/div[1]/div/article/div/div[2]/div[2]/div[2]/span[@class="r-18u37iz"]')));
            sleep(3);

            if($count_result == 0){
                $driver->get('https://twitter.com/?lang=en');
                sleep(3);
                $driver->findElement(WebDriverBy::cssSelector('form[role="search"] input[placeholder="Search Twitter"]'))->sendKeys($text);
                sleep(3);
                $driver->findElement(WebDriverBy::cssSelector('form[aria-label="Search Twitter"] div#typeaheadDropdown-1 span'))->click();
                sleep(3);
                $count_results = count($driver->findElements(WebDriverBy::xpath('/html/body/div/div/div/div/main/div/div/div/div[1]/div/div[2]/div/div/section/div/div/div/div[1]/div/article/div/div[2]/div[2]/div[2]/span[@class="r-18u37iz"]')));
                $tag = '';
                for($k = 1 ; $k<=$count_results ; $k++){
                    $tag =$tag.' '.($driver->findElement(WebDriverBy::xpath('(//span[@class="r-18u37iz"])['.$k.']'))->getText());
                }
            }else{
                $tag = '';
                for($k = 1 ; $k<=$count_result ; $k++){
                    $tag =$tag.' '.($driver->findElement(WebDriverBy::xpath('(//span[@class="r-18u37iz"])['.$k.']'))->getText());
                }
            }
            
        }
        $tag = explode(' ', $tag);

        if(count($tag) > 0){
            foreach($tag as $tg){
                $tg = str_replace('apk','', $tg);
            }
        }
        $tag = implode(' ',$tag);
        $tag = $tag.' '.$text.' '.'#apk';
       
        return $tag;
        $driver->close();
       
        
    }
    public function updateSatisticalFb()
    {
        try{       
            $account = Post::select('post.url','post.account_id')->where('post.status',1);        
            $account = $account->join('account','post.account_id','=','account.id');
            $account = $account->select('post.url','post.id as id_post')->where('account.social',1)->get();
            $cre = Carbon\Carbon::now();
            $created_at = $cre->toDateTimeString();
            $host = 'http://localhost:4444/wd/hub';
            $caps = DesiredCapabilities::chrome();
            $prefs = array();
            $options = new ChromeOptions();
            $prefs['profile.default_content_setting_values.notifications'] = 2;
            $caps->setCapability(ChromeOptions::CAPABILITY, $options);
            $profile = new FirefoxProfile();
            $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ';
            $profile->setPreference('general.useragent.override', $userAgentChange);        
            $capss = DesiredCapabilities::firefox();
            $capss->setCapability(FirefoxDriver::PROFILE, $profile);
            $driver = RemoteWebDriver::create($host, $capss);
            foreach ($account as $key => $value) {
                $driver->get($value->url);
                sleep(5);
                $ac = Post::where('id',$value->id_post)->first();        
                $driver->findElement(WebDriverBy::cssSelector('a#expanding_cta_close_button'))->click();      
                if(count($driver->findElements(WebDriverBy::xpath('/html/body/div[1]/div[3]/div[1]/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div/div/div/div/div[1]/div/div[2]/div[2]/form/div/div[2]/div[1]/div/div[1]/a/span[1]/span/span'))) > 0){
                    $like = $driver->findElement(WebDriverBy::xpath('/html/body/div[1]/div[3]/div[1]/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div/div/div/div/div[1]/div/div[2]/div[2]/form/div/div[2]/div[1]/div/div[1]/a/span[1]/span/span'))->getText();
                    $ac->like = $like ;
                }
                if(count($driver->findElements(WebDriverBy::xpath('/html/body/div[1]/div[3]/div[1]/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div/div/div/div/div[1]/div/div[2]/div[2]/form/div/div[2]/div[1]/div/div[3]/span[1]/a'))) > 0){
                    $comment =$driver->findElement(WebDriverBy::xpath('/html/body/div[1]/div[3]/div[1]/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div/div/div/div/div[1]/div/div[2]/div[2]/form/div/div[2]/div[1]/div/div[3]/span[1]/a'))->getText();
                    $comment = explode(' ', $comment);                    
                    $ac->comment = $comment[0];
                }
                if(count($driver->findElements(WebDriverBy::xpath('/html/body/div[1]/div[3]/div[1]/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div/div/div/div/div[1]/div/div[2]/div[2]/form/div/div[2]/div[1]/div/div[3]/span[2]/a'))) > 0){
                 
                    $share =$driver->findElement(WebDriverBy::xpath('/html/body/div[1]/div[3]/div[1]/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div/div/div/div/div[1]/div/div[2]/div[2]/form/div/div[2]/div[1]/div/div[3]/span[2]/a'))->getText();
                    $share = explode(' ', $share);
                    $ac->share = $share[0];
                }  
                $ac->save();
            }
            $driver->close();
        }catch(\Exception $e){
          return $this->renderJsonResponse( $e->getMessage() );
        }
    }

    public function updateSatisticalTwitter()
    {
        try{
            $account = Post::select('post.url','post.account_id')->where('post.status',1)->whereNotNull('url');
            $account = $account->join('account','post.account_id','=','account.id');
            $account = $account->select('post.url','post.id as id_post')->where('account.social',2)->get();
            $cre = Carbon\Carbon::now();
            $created_at = $cre->toDateTimeString();
            $host = 'http://localhost:4444/wd/hub';
            $caps = DesiredCapabilities::chrome();
            $prefs = array();
            $options = new ChromeOptions();
            $prefs['profile.default_content_setting_values.notifications'] = 2;
            $caps->setCapability(ChromeOptions::CAPABILITY, $options);
            $profile = new FirefoxProfile();
            $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ';
            $profile->setPreference('general.useragent.override', $userAgentChange);        
            $capss = DesiredCapabilities::firefox();
            $capss->setCapability(FirefoxDriver::PROFILE, $profile);
            $driver = RemoteWebDriver::create($host, $capss);
            foreach ($account as $key => $value) {
                $driver->get($value->url);
                sleep(2);
                $ac = Post::where('id',$value->id_post)->first();
              
                if(count($driver->findElements(WebDriverBy::cssSelector('div.stream-item-footer div.ProfileTweet-action--reply span.ProfileTweet-actionCountForPresentation'))) > 0){
                    $comment = $driver->findElement(WebDriverBy::cssSelector('div.stream-item-footer div.ProfileTweet-action--reply span.ProfileTweet-actionCountForPresentation'))->getText();               
                    if(empty($comment) == false){
                       $ac->comment = $comment;        
                    }
                }
                if(count($driver->findElements(WebDriverBy::cssSelector('div.stream-item-footer div[aria-label="Tweet actions"] div.ProfileTweet-action--retweet button.ProfileTweet-actionButton span.ProfileTweet-actionCount span.ProfileTweet-actionCountForPresentation'))) > 0){
                    $reweet = $driver->findElement(WebDriverBy::cssSelector('div.stream-item-footer div[aria-label="Tweet actions"] div.ProfileTweet-action--retweet button.ProfileTweet-actionButton span.ProfileTweet-actionCount span.ProfileTweet-actionCountForPresentation'))->getText();
                    if(empty($reweet) == false){
                         $ac->retweet = $reweet;
                    }                  
                }
                if(count($driver->findElements(WebDriverBy::xpath('/html/body/div[30]/div[2]/div[3]/div/div/div[1]/div[1]/div/div[4]/div[2]/div[3]/button[1]/span/span'))) > 0){
                    $like = $driver->findElement(WebDriverBy::xpath('/html/body/div[30]/div[2]/div[3]/div/div/div[1]/div[1]/div/div[4]/div[2]/div[3]/button[1]/span/span'))->getText();                  
                    if(empty($like) == false){
                        $ac->like = $like;
                    }                                
                }                 
                $ac->save();  
            }   
            $driver->close();
        }catch(\Exception $e){
          return $this->renderJsonResponse( $e->getMessage() );
        }
    }

    public function get()
    {
        $text = '#apk';
        $host = 'http://localhost:4444/wd/hub';
        $caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();
        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';
        $profile->setPreference('general.useragent.override', $userAgentChange);        
        $capss = DesiredCapabilities::firefox();
        $capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
        
        $driver->get('https://twitter.com/?lang=en');
        $driver->findElement((WebDriverBy::className('js-signin-email')))->sendKeys('apkvi.com@gmail.com');
        sleep(3);
        $driver->findElement((WebDriverBy::name('session[password]')))->sendKeys('apkvi12#');
        sleep(3);
        $driver->findElement((WebDriverBy::className('EdgeButton--medium')))->click();
        if(count($driver->findElements(WebDriverBy::cssSelector("input.EdgeButton:nth-child(3)"))) == 0){
            $ttt = '';
            $driver->get('https://twitter.com/?lang=en');
            sleep(3);
            $driver->findElement(WebDriverBy::cssSelector('form[role="search"] input[placeholder="Search Twitter"]'))->sendKeys($text.' min_retweets:"10"');
            sleep(5);
            $driver->findElement(WebDriverBy::cssSelector('form[aria-label="Search Twitter"] div#typeaheadDropdown-1 span'))->click();
            sleep(3);
            $count_result = count($driver->findElements(WebDriverBy::xpath('/html/body/div/div/div/div/main/div/div/div/div[1]/div/div[2]/div/div/section/div/div/div/div[1]/div/article/div/div[2]/div[2]/div[2]/span[@class="r-18u37iz"]')));
            sleep(3);

            if($count_result == 0){
                $driver->get('https://twitter.com/?lang=en');
                sleep(3);
                $driver->findElement(WebDriverBy::cssSelector('form[role="search"] input[placeholder="Search Twitter"]'))->sendKeys($text);
                sleep(3);
                $driver->findElement(WebDriverBy::cssSelector('form[aria-label="Search Twitter"] div#typeaheadDropdown-1 span'))->click();
                sleep(3);
                $count_results = count($driver->findElements(WebDriverBy::xpath('/html/body/div/div/div/div/main/div/div/div/div[1]/div/div[2]/div/div/section/div/div/div/div[1]/div/article/div/div[2]/div[2]/div[2]/span[@class="r-18u37iz"]')));
                $tag = '';
                for($k = 1 ; $k<=$count_results ; $k++){
                    $tag =$tag.' '.($driver->findElement(WebDriverBy::xpath('(//span[@class="r-18u37iz"])['.$k.']'))->getText());
                }
            }else{
                $tag = '';
                for($k = 1 ; $k<=$count_result ; $k++){
                    $tag =$tag.' '.($driver->findElement(WebDriverBy::xpath('(//span[@class="r-18u37iz"])['.$k.']'))->getText());
                }
            }
            
        }
        $tag = $tag.' '.'#apk';

        dd($tag);
    }

    public function DeleteTwitter()
    {
        $text = '#apk';
        $host = 'http://localhost:4444/wd/hub';
        $caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();
        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';
        $profile->setPreference('general.useragent.override', $userAgentChange);        
        $capss = DesiredCapabilities::firefox();
        $capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
        
        $driver->get('https://twitter.com/?lang=en');
        sleep(3);
        $driver->findElement((WebDriverBy::className('js-signin-email')))->sendKeys('apkvi.com@gmail.com');
        sleep(3);
        $driver->findElement((WebDriverBy::name('session[password]')))->sendKeys('apkvi12#');
        sleep(3);
        $driver->findElement((WebDriverBy::className('EdgeButton--medium')))->click();
        sleep(5);

        for($i = 0 ; $i<1000;$i++){
            $driver->get('https://twitter.com/apktovi');
           sleep(4);
            $driver->findElement((WebDriverBy::xpath('/html/body/div/div/div/div/main/div/div/div/div[1]/div/div[2]/div/div/div[2]/section/div/div/div/div[1]/div/article/div/div[2]/div[2]/div[1]/div[1]/a/time')))->click();
            $driver->findElement((WebDriverBy::cssSelector("div.css-1dbjc4n div.css-1dbjc4n div.r-1mi0q7o div.r-1777fci div.r-1joea0r")))->click();
            $driver->findElement(WebDriverBy::xpath('/html/body/div/div/div/div[1]/div/div/div[2]/div[3]/div/div/div/div[1]'))->click();
            $driver->findElement(WebDriverBy::cssSelector('div.r-14lw9ot div.r-13qz1uu div[data-testid="confirmationSheetConfirm"]'))->click();
        }
        
    }
   
}
