<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
class ListPostController extends Controller
{
		const TAKE =15;
  	const ORDERBY = 'desc'; 
   public function index(Request $request)
   {
   		$status =  $request->status;
    try {
      $conditions = Post::select('post.id','post.account_id','post.status','post.url','post.created_at');
      $conditions = $conditions->join('account','post.account_id','=','account.id');
      $conditions = $conditions->select('post.id','post.account_id','post.status','post.created_at','account.account_name','post.url','account.social','post.like','post.comment','post.share','post.retweet');

      if(isset($status)){
        $conditions = $conditions->where('post.status', '=', $status);
      }
      if ( $request->has('keyword') ) {
        
        $conditions = $conditions->where('account.account_name','like','%'.$request->keyword.'%');

      }
      
      if(isset($request->social)){
     
        $conditions = $conditions->where('account.social',$request->social);
      }
      if(isset($request->sort)){
        if($request->sort == 1){
          $conditions->orderBy('post.like', self::ORDERBY);
        }elseif($request->sort == 2){
          $conditions->orderBy('post.created_at', self::ORDERBY);
        }elseif($request->sort == 3){
          $conditions->orderBy('post.created_at', 'asc');
        }
      }else{
        $conditions->orderBy('post.id', self::ORDERBY);
      }
        $post = $conditions->paginate( self::TAKE );

      return view('admin.list_post.index', compact('post'));
      
    } catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
   }


   public function view(Request $request , $id)
   {
   	try{
   		$account = Post::where('post.id',$id);
   		$account = $account->join('account','post.account_id','=','account.id');
   		$account = $account->select('account.account_name','account.social','post.content','post.status','post.url','post.like','post.comment','post.share','post.retweet')->get();
   		// dd($account[0]['account_name']);
   		return view('admin.list_post.view',compact('account'));
   	}catch (\Exception $e) {
      return $this->renderJsonResponse( $e->getMessage() );
    }
   }
}
