<?php

namespace App\Http\Controllers\Admin;

use App\Models\Submedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Media::select('medias.id', 'medias.title', 'medias.date', 'medias.avatar', 'medias.status', 'medias.created_at');
            if (isset($status)) {
                $conditions = $conditions->where('medias.status', '=', $status);
            }
            if ($request->has('keyword')) {

                $conditions = $conditions->where('medias.title', 'like', '%' . $request->keyword . '%');
            }
            $conditions->orderBy('medias.id', self::ORDERBY);
            $medias = $conditions->paginate(self::TAKE);
            return view('admin.media.index', compact('medias'));

        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $media = new Media();
        $media->title = $request->title;
        $media->date = $request->date;
        $media->status = $request->status;
        $media->avatar = $request->thumbnail;
        $media->save();

        $title_sub = $request->subtitle;
        $link_sub = $request->link;
        $count = count($request->subtitle);
        for ($i = 0; $i < $count; $i++) {
            $submedia = new Submedia();
            $submedia->media_id = $media->id;
            $submedia->title = $title_sub[$i];
            $submedia->link = $link_sub[$i];
            $submedia->status = 1;
            $submedia->save();

        }
        return redirect()->route('system_admin.media.index');
    }

    public function edit($id)
    {

        $medias = Media::find($id);
        $sub_media = Submedia::where('media_id',$id)->get();
        return view('admin.media.edit', compact('medias','sub_media'));
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
