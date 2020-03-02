<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Image;

class EventController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Event::select('events.id', 'events.title', 'events.avatar', 'events.date', 'events.status', 'events.created_at');
            if (isset($status)) {
                $conditions = $conditions->where('events.status', '=', $status);
            }
            if ($request->has('keyword')) {

                $conditions = $conditions->where('events.title', 'like', '%' . $request->keyword . '%');
            }
            $conditions->orderBy('events.id', self::ORDERBY);
            $events = $conditions->paginate(self::TAKE);
            return view('admin.event.index', compact('events'));

        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request){
        $event = new Event();
        $event->title = $request->title;
        $event->date = $request->date;
        $event->status = $request->status;
        $event->place = $request->place;
        $event->description = $request->content;
        $event->avatar = $request->thumbnail;
        $event->save();
        $images= json_decode($request->images);
        foreach ($images as $image){
            $im = new Image();
            $im->link = $image;
            $im->event_id = $event->id;
            $im->status = 1;
            $im->save();
        }
        return redirect()->route('system_admin.member.index');
    }

    public function edit($id)
    {

        $event = Event::find($id);
        $images =Image::where('event_id',$id)->get();
        return view('admin.event.edit', compact('event','images'));
    }

    public function update(Request $request)
    {
        $member = Member::find($request->id);
        if ($member) {
            $data = [
                'name_member' => $request->name_member,
                'position' => $request->position,
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
