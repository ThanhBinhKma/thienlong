<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Helpers\Helpers;
use DB;
use Auth;
class CategoryController extends Controller
{
  const TAKE =15;
  const ORDERBY = 'desc'; 
  /*
  |--------------------------------------------------------------------------
  | Category Index
  |--------------------------------------------------------------------------
  */
  public function index(Request $request)
  {
    $status =  $request->status;
    try {
      $conditions = Categories::select('id','name','status','created_at');
      if($status){
        $conditions = $conditions->where('status', '=', $status);
      }
      if ( $request->has('keyword') ) {
        $valSearch = $request->query('keyword');
        $conditions->where(function ($query) use ($valSearch) {
          $query->where('title', 'like', '%' . $valSearch. '%');
        });
      }
      $conditions->orderBy('id', self::ORDERBY);
      $categories = $conditions->paginate( self::TAKE );
      return view('admin.categories.index', compact('categories'));
      
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  } 
  /*
  |--------------------------------------------------------------------------
  | Post Create
  |--------------------------------------------------------------------------
  */
  public function create()
  {
    try {
      $categories = Categories::where('status',Categories::PUBLISHED)->select('*')->get();
      return view('admin.categories.create',compact('categories'));
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
  /*
  |--------------------------------------------------------------------------
  | Post Store
  |--------------------------------------------------------------------------
  */
  public function store(CategoryFormRequest $request)
  {
    try {
      DB::beginTransaction();
      $category = new Categories();
      $category->name = $request->title;
      $category->status = $request->status;
      $category->save();
      DB::commit();
      return redirect()->route( 'system_admin.category.index' )->with([ 'status_store' => 'Tạo danh mục thành công!']);
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
  /*
  |--------------------------------------------------------------------------
  | Category Edit
  |--------------------------------------------------------------------------
  */
  public function edit(Request $request , $id)
  {
    try {
      $categories = Categories::where('id',$id)->select('id','name','status')->first();
      // dd($categories);
      return view('admin.categories.edit',compact('categories'));
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
  /*
  |--------------------------------------------------------------------------
  | Category Update
  |--------------------------------------------------------------------------
  */
  public function update(CategoryFormRequest $request,$id)
  {
    try {
      DB::beginTransaction();
      $categorycategory = Categories::where('id', $request->id)->first();
      $categorycategory->name = $request->title;
      $categorycategory->status = $request->status;
      $categorycategory->save();
      DB::commit();
      return redirect()->route( 'system_admin.category.edit' , ['id'=>$id] )->with([ 'status_update' => 'Cập nhật danh mục thành công!']);
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
  /*
  |--------------------------------------------------------------------------
  | Category Destroy
  |--------------------------------------------------------------------------
  */
  public function destroy(Request $request)
  {
    try {
      $category = Categories::where('id', $request->id)->first();
      if ( $category->status == Categories::PUBLISHED ) {
        $category->status = Categories::PENDING;
        $category->save();
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
      $categories = Categories::whereIn('id', $arr_id)->select('id','status')->get();
      foreach ($categories as $category) {
        $category->status = Categories::PENDING;
        $category->save();
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
      $categories = Categories::whereIn('id', $arr_id)->select('id','status')->get();
      foreach ($categories as $category) {
        $category->status = Categories::PUBLISHED;
        $category->save();
      }
      return response()->json(array('status' => true, 'msg'=>'Thành công')); 
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
  }
}
