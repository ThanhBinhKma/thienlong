<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Firefox\FirefoxDriver;
use Facebook\WebDriver\Firefox\FirefoxProfile;
use Facebook\WebDriver\WebDriverExpectedCondition;
use GuzzleHttp\Client;
use DB;
use App\Http\Requests\CreateAccountRequest;
class AccountController extends Controller
{
  const TAKE =15;
  const ORDERBY = 'desc';

  public function index(Request $request)
  {
  	$status =  $request->status;
    try {
      $conditions = Account::select('id','account_name','status','social');
      if(isset($status)){
        $conditions = $conditions->where('status', '=', $status);
      }
      if ( $request->has('keyword') ) {
        $valSearch = $request->query('keyword');
        $conditions->where(function ($query) use ($valSearch) {
          $query->where('account_name', 'like', '%' . $valSearch. '%');
        });
      }
      $conditions->orderBy('id', self::ORDERBY);
      $account = $conditions->paginate( self::TAKE );
      return view('admin.account.index', compact('account'));
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }

  }

  public function create()
  {
  	return view('admin.account.create');
  }

  public function store(CreateAccountRequest $request)
  {
  	try{
  		
  		$client = new \GuzzleHttp\Client();
    		//Thiet lap selenium
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
				//Kiem tra tai khoan thuoc mang xa hoi nao
        if($request->social == 1){
        	$driver->get('https://vi-vn.facebook.com/');
        	sleep(5);
        	$driver->findElement(WebDriverBy::id("email"))->sendKeys($request->account_name);
        	sleep(2);
        	$driver->findElement(WebDriverBy::id('pass'))->sendKeys($request->password);
        	sleep(2);
        	$dt = $driver->findElement((WebDriverBy::cssSelector('#loginbutton > input[type="submit"]')))->click();
        	sleep(2);
        	if(count($driver->findElements((WebDriverBy::cssSelector('button#loginbutton')))) == 0){
        		$list = $driver->manage()->getCookies();
            foreach ($list as $cookie) {
              $tmp = $cookie['name'].':'.$cookie['value'];
              $name_file = 'facebook'.time().'.txt';
              file_put_contents(public_path().'/cookie/'.$name_file, $tmp.PHP_EOL, FILE_APPEND | LOCK_EX);
            }
          	$account = new Account();
						$account->account_name = $request->account_name;
			  		$account->password = $request->password;
			  		$account->social = $request->social;
			  		$account->cookie = 'cookie/'.$name_file;
			  		$account->status = $request->status;
			  		$account->save();
            $driver->close();
            
			  		return redirect()->route('system_admin.account.index')->with('create_account','Done');	
        	}else{
						return back()->with('error_account','Tên tài khoản hoặc mật khẩu không chính xác!');
        	}
        }else{
        	$driver->get('https://twitter.com/?lang=en');
        	sleep(3);
        	$driver->findElement(WebDriverBy::className('js-signin-email'))->sendKeys($request->account_name);
        	sleep(3);
        	$driver->findElement((WebDriverBy::name('session[password]')))->sendKeys($request->password);
        	sleep(3);
        	$driver->findElement((WebDriverBy::className('EdgeButton--medium')))->click();
        	sleep(2);
        	if(count($driver->findElements((WebDriverBy::cssSelector('form.js-signin  button.submit ')))) == 0){
            $lists = $driver->manage()->getCookies();
           	foreach ($lists as $cookies) {
            	$tmps = $cookies['name'].':'.$cookies['value'];
            	$name_file = 'twiter'.time().'.txt';
            	file_put_contents(public_path().'/cookie/'.$name_file, $tmps.PHP_EOL, FILE_APPEND | LOCK_EX);
           	}
		         	$account = new Account();
							$account->account_name = $request->account_name;
				  		$account->password = $request->password;
				  		$account->social = $request->social;
				  		$account->cookie = 'cookie/'.$name_file;
				  		$account->status = $request->status;
				  		$account->save();
              $driver->close();
         
				  		return redirect()->route('system_admin.account.index')->with('create_account','Done');
          }else{
          	return back()->with('error_account','Tên tài khoản hoặc mật khẩu không chính xác!');
          }
        }
  	}catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }

  public function edit(Request $request)
  {
    try{
      $id = $request->id;
      $account = Account::select('id','account_name','social','password','status')->where('id',$id)->first();
      return view('admin.account.edit',compact('account'));
    }catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }

  public function update(Request $request)
  {
    try{
      $id = $request->id;
      $account = Account::where('id', $request->id)->first();
      $account->password = $request->password;
      $account->status = $request->status;
      $account->social = $request->social;
      $account->save();
      DB::commit();
      return redirect()->route( 'system_admin.account.edit' , ['id'=>$id] )->with([ 'status_update' => 'Cập nhật danh mục thành công!']);
    }catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    } 
  }

    public function destroy(Request $request)
  {
    try {
      $account = Account::where('id', $request->id)->first();
      if ( $account->status == Account::PUBLISHED ) {
        $account->status = Account::PENDING;
        $account->save();
        return response()->json(array('status' => true, 'html'=>'Thành công')); 
      } else {
        return response()->json(array('msg'=>'Danh mục chưa tồn tại hoặc chưa được kích hoạt')); 
      }
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
  /*
  |--------------------------------------------------------------------------
  | Category Destroy All
  |--------------------------------------------------------------------------
  */
  public function destroyAll(Request $request)
  {
    try {
      $ids = $request->id;
      $arr_id = explode( ',',$ids );
      $account = Account::whereIn('id', $arr_id)->select('id','status')->get();
      foreach ($account as $accounts) {
        $accounts->status = Account::PENDING;
        $accounts->save();
      }
      return response()->json(array('status' => true, 'msg'=>'Thành công')); 
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
  /*
  |--------------------------------------------------------------------------
  | Category Restore All
  |--------------------------------------------------------------------------
  */
  public function restore(Request $request)
  {
    try {
      $ids = $request->id;
      $arr_id = explode( ',',$ids );
      $account = Account::whereIn('id', $arr_id)->select('id','status')->get();
      foreach ($account as $accounts) {
        $accounts->status = Account::PUBLISHED;
        $accounts->save();
      }
      return response()->json(array('status' => true, 'msg'=>'Thành công')); 
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
}
