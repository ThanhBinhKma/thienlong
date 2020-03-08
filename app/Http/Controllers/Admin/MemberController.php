<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;

class MemberController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Member::select('members.id', 'members.name', 'members.position', 'members.position_id', 'members.avatar', 'members.status', 'members.created_at');
            if (isset($status)) {
                $conditions = $conditions->where('members.status', '=', $status);
            }
            if ($request->has('keyword')) {

                $conditions = $conditions->where('members.name', 'like', '%' . $request->keyword . '%');
            }
            $conditions->orderBy('members.id', self::ORDERBY);
            $members = $conditions->paginate(self::TAKE);
            return view('admin.member.index', compact('members'));

        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(CreateUserRequest $request)
    {
        $member = new Member();
        $member->name = $request->name_member;
        $member->position = $request->position;
        $member->position_id = $request->position_id;
        $member->status = $request->status;
        $member->avatar = $request->thumbnail;
        $member->save();
        return redirect()->route('system_admin.member.index');
    }

    public function edit($id)
    {

        $member = Member::find($id);

        return view('admin.member.edit', compact('member'));
    }

    public function update(EditUserRequest $request)
    {
        $member = Member::find($request->id);
        if ($member) {
            $data = [
                'name_member' => $request->name_member,
                'position' => $request->position,
                'position_id' => $request->position_id,
                'avatar' => $request->thumbnail,
                'status' => $request->status,
            ];
            $member->update($data);
            return redirect()->back()->with(['status_update' => 'Cập nhật bài đăng thành công!']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $member = Member::where('id', $request->id)->first();
            if ($member->status == Member::PUBLISHED) {
                $member->status = Member::PENDING;
                $member->save();
                return response()->json(array('status' => true, 'html' => 'Thành công'));
            } else {
                return response()->json(array('msg' => 'Danh mục chưa tồn tại hoặc chưa được kích hoạt'));
            }
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
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
            $arr_id = explode(',', $ids);
            $members = Member::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($members as $member) {
                $member->status = Member::PENDING;
                $member->save();
            }
            return response()->json(array('status' => true, 'msg' => 'Thành công'));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
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
            $arr_id = explode(',', $ids);
            $members = Member::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($members as $member) {
                $member->status = Member::PUBLISHED;
                $member->save();
            }
            return response()->json(array('status' => true, 'msg' => 'Thành công'));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
