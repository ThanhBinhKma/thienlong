<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brands;
use App\Models\Price;
use App\Models\Order;
use App\Models\Images;
use DB;
use Illuminate\Support\Facades\Auth;
use Purifier;
class HomeController extends Controller
{
   public function index(Request $request)
   {

       return view('front_end.index');
   }
    public function search(Request $request)
    {
        $product = Product::select('id','name','price','sale','qty','avatar');
        // dd($request->all());
        $product_sales = Product::select('name','avatar','sale','price','qty','sale')->orderBy('sale','asc')->take(5)->get();
        $brand = Brands::all();
        $price = Price::all();
        if($request->search_name){
            $sr_name = $request->search_name;
            $product = $product->where('name','like','%'.$sr_name.'%');
        }
        if($request->name_price){
            $name_price = $request->name_price;
            $product = $product->where('price_id',$name_price);
        }
        if($request->name_brand){
            $name_brands = $request->name_brand;
            $product = $product->where('brand_id',$name_brands);
        }else{
            $name_brands = [];
        }
        $pr = $product->get();
        $product =$product->orderBy('created_at','asc')->paginate(6);
        return view('pages.search',compact('product','product_sales','brand','price','name_brands','pr'));
    }
    public function detail($id)
    {
        try{
            $pr = Product::find($id);
            $image = Images::where('product_id',$id)->get();
            $product_sales = Product::select('id','name','avatar','sale','price','qty')->orderBy('sale','asc')->take(5)->get();
            
            return view('pages.single',compact('pr','image','product_sales'));
        }catch (\Exception $e) {
          return $this->renderJsonResponse( $e->getMessage() );
        }
    }
    public function saveImage(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $uploadPath = 'uploads';
        $image->move(public_path($uploadPath),time().$imageName);
        $data = '/'.$uploadPath.'/'.time().$imageName;
        return $data;
    }
    public function deleteImage(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path().'/uploads/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        if(isset($request->cruise_id) && $request->cruise_id){
          $image = Image::where([['link', '/uploads/'.$filename],['cruise_id',$request->cruise_id]])->delete();
        }
        if(isset($request->cruise_room_id) && $request->cruise_room_id){
          $image = Image::where([['link', '/uploads/'.$filename],['cruise_room_id',$request->cruise_room_id]])->delete();
        }
        return $filename;  
    }
    public function history(Request $request)
    {
        $id = $request->id ;
        $or = Order::where('user_id',$id)->get();
        foreach($or as $vl){
            $or->product = json_decode($vl->product);
        }
        return view('pages.history',compact('or'));
    }
} 