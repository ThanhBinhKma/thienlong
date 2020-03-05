<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\Submedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubMediaRequest;
use App\Http\Requests\EditSubMediaRequest;
class SubMediaController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Submedia::select('submedias.id', 'submedias.title', 'submedias.media_id', 'submedias.link', 'submedias.status', 'submedias.created_at');
            if (isset($status)) {
                $conditions = $conditions->where('submedias.status', '=', $status);
            }
            if ($request->has('keyword')) {

                $conditions = $conditions->where('submedias.title', 'like', '%' . $request->keyword . '%');
            }
            $conditions->orderBy('submedias.id', self::ORDERBY);
            $submedias = $conditions->paginate(self::TAKE);
            return view('admin.sub_media.index', compact('submedias'));

        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }

    public function create()
    {
        $medias = Media::select('id', 'title')->get();
        return view('admin.sub_media.create', compact('medias'));
    }

    public function store(CreateSubMediaRequest $request)
    {

        $title_sub = $request->title;
        $link_sub = $request->link;
        $count = count($request->title);
        for ($i = 0; $i < $count; $i++) {
            $submedia = new Submedia();
            $submedia->media_id = $request->media;
            $submedia->title = $title_sub[$i];
            $submedia->slug = str_slug($title_sub[$i], '-');
            $submedia->link = $link_sub[$i];
            $submedia->status = 1;
            $submedia->save();

        }
        return redirect()->route('system_admin.submedia.index');
    }

    public function edit($id)
    {
        $sub_media = Submedia::find($id);
        $medias = Media::all();
        return view('admin.sub_media.edit', compact('medias', 'sub_media'));
    }

    public function update(EditSubMediaRequest $request)
    {
        $sub_media = Submedia::find($request->id);
        if ($sub_media) {
            $data = [
                'title' => $request->title,
                'slug' => str_slug($request->title, '-'),
                'link' => $request->link,
                'media_id' => $request->media,
                'status' => $request->status,
            ];
            $sub_media->update($data);
            return redirect()->back()->with(['status_update' => 'Cập nhật bài đăng thành công!']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $submedia = Submedia::where('id', $request->id)->first();
            if ($submedia->status == Submedia::PUBLISHED) {
                $submedia->status = Submedia::PENDING;
                $submedia->save();
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
            $submedias = Submedia::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($submedias as $submedia) {
                $submedia->status = Submedia::PENDING;
                $submedia->save();
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
            $submedias = Submedia::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($submedias as $submedia) {
                $submedia->status = Submedia::PUBLISHED;
                $submedia->save();
            }
            return response()->json(array('status' => true, 'msg' => 'Thành công'));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
