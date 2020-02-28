<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
	const TAKE =15;
  	const ORDERBY = 'desc'; 
    public function index(Request $request)
    {
      $status =  $request->status;

      try {
        $conditions = Member::select('members.id','members.name','members.position','members.avatar','members.status','members.created_at');
        if(isset($status)){
          $conditions = $conditions->where('members.status', '=', $status);
        }
        if ( $request->has('keyword') ) {
          
          $conditions = $conditions->where('members.name','like','%'.$request->keyword.'%');
        }
          $conditions->orderBy('members.id', self::ORDERBY);
          $members = $conditions->paginate( self::TAKE );
        return view('admin.member.index', compact('members'));
        
      } catch (\Exception $e) {
        return $this->renderJsonResponse( $e->getMessage() );
      }
    }

    public function create()
    {
      return view('admin.member.create');
    }

    public function store(Request $request)
    {
      $member = new Member();
      $member->name = $request->name_member;
      $member->position = $request->position;
      $member->status = $request->status;
      $member->avatar = $request->thumbnail; 
      $member->save();
      return redirect()->route('system_admin.member.index');
    }

    public function edit($id)
    {

      $member = Member::find($id);

      return view('admin.member.edit',compact('member'));
    }

    public function update(Request $request)
    {
      dd($request->all());
    }
}
