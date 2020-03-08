<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Image;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\EditEvenRequest;

class EventController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Event::select('events.id', 'events.title', 'events.avatar', 'events.description', 'events.date', 'events.status', 'events.created_at');
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

    public function store(CreateEventRequest $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->date = $request->date;
        $event->status = $request->status;
        $event->place = $request->place;
        $event->description = $request->description;
        $event->content = $request->content;
        $event->slug = str_slug($request->title, '-');
        $event->avatar = $request->thumbnail;
        $event->save();
        return redirect()->route('system_admin.event.index');
    }

    public function edit($id)
    {

        $event = Event::find($id);
        return view('admin.event.edit', compact('event'));
    }

    public function update(EditEvenRequest $request)
    {
        $event = Event::find($request->id);
        if ($event) {
            $data = [
                'title' => $request->title,
                'date' => $request->date,
                'place' => $request->place,
                'status' => $request->status,
                'description ' => $request->description,
                'content' => $request->content,
                'slug' => str_slug($request->title, '-'),
                'avatar' => $request->thumbnail
            ];
            $event->update($data);
            return redirect()->route('system_admin.event.index')->with(['status_update' => 'Cập nhật bài đăng thành công!']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $event = Event::where('id', $request->id)->first();
            if ($event->status == Event::PUBLISHED) {
                $event->status = Event::PENDING;
                $event->save();
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
            $events = Event::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($events as $event) {
                $event->status = Event::PENDING;
                $event->save();
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
            $events = Event::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($events as $event) {
                $event->status = Event::PUBLISHED;
                $event->save();
            }
            return response()->json(array('status' => true, 'msg' => 'Thành công'));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
