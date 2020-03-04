<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;

class ProduceController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Produce::select('produces.id', 'produces.title','produces.date','produces.avatar', 'produces.link', 'produces.status', 'produces.created_at');
            if (isset($status)) {
                $conditions = $conditions->where('produces.status', '=', $status);
            }
            if ($request->has('keyword')) {

                $conditions = $conditions->where('produces.title', 'like', '%' . $request->keyword . '%');
            }
            $conditions->orderBy('produces.id', self::ORDERBY);
            $produces = $conditions->paginate(self::TAKE);
            return view('admin.produce.index', compact('produces'));

        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.produce.create');
    }

    public function store(CreateProductRequest $request)
    {
        $produce = new Produce();
        $produce->title = $request->title;
        $produce->slug = str_slug($request->title, '-');
        $produce->date = $request->date;
        $produce->link = $request->link;
        $produce->avatar = $request->thumbnail;
        $produce->status = $request->status;
        $produce->save();
        return redirect()->route('system_admin.produce.index');
    }

    public function edit($id)
    {
        $produce = Produce::find($id);
        return view('admin.produce.edit', compact('produce'));
    }

    public function update(EditProductRequest $request)
    {
        $produce = Produce::find($request->id);
        if ($produce) {
            $data = [
                'title' => $request->title,
                'slug' =>str_slug($request->title, '-'),
                'link' => $request->link,
                'date' => $request->date,
                'status' => $request->status,
                'avatar' => $request->thumbnail,
            ];
            $produce->update($data);
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
