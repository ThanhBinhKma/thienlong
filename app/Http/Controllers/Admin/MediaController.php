<?php

namespace App\Http\Controllers\Admin;

use App\Models\Submedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Http\Requests\CreateMediaRequest;

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

    public function store(CreateMediaRequest $request)
    {
        $media = new Media();
        $media->title = $request->title;
        $media->slug = str_slug($request->title, '-');
        $media->date = $request->date;
        $media->status = $request->status;
        $media->avatar = $request->thumbnail;
        $media->save();
        return redirect()->route('system_admin.media.index');
    }

    public function edit($id)
    {

        $medias = Media::find($id);
        $sub_medias = Submedia::where('media_id',$id)->get();
        return view('admin.media.edit', compact('medias','sub_medias'));
    }

    public function update(Request $request)
    {
        $media = Media::find($request->id);
        if ($media) {
            $data = [
                'title' => $request->title,
                'date' => $request->date,
                'avatar' => $request->thumbnail,
                'status' => $request->status,
                'slug' =>str_slug($request->title, '-'),
            ];
            $media->update($data);
            return redirect()->back()->with(['status_update' => 'Cập nhật bài đăng thành công!']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $media = Media::where('id', $request->id)->first();
            if ($media->status == Media::PUBLISHED) {
                $media->status = Media::PENDING;
                $media->save();
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
            $medias = Media::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($medias as $media) {
                $media->status = Media::PENDING;
                $media->save();
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
            $medias = Media::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($medias as $media) {
                $media->status = Media::PUBLISHED;
                $media->save();
            }
            return response()->json(array('status' => true, 'msg' => 'Thành công'));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
