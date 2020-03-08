<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    const TAKE = 15;
    const ORDERBY = 'desc';

    public function index(Request $request)
    {
        $status = $request->status;

        try {
            $conditions = Partner::select('partners.id', 'partners.avatar' ,'partners.link', 'partners.status', 'partners.created_at');
            if (isset($status)) {
                $conditions = $conditions->where('partners.status', '=', $status);
            }
            $conditions->orderBy('partners.id', self::ORDERBY);
            $partners = $conditions->paginate(self::TAKE);
            return view('admin.partner.index', compact('partners'));

        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.partner.create');
    }

    public function store(Request $request)
    {
        $partner = new Partner();
        $partner->status = $request->status;
        $partner->link = $request->link;
        $partner->avatar = $request->thumbnail;
        $partner->save();
        return redirect()->route('system_admin.partner.index');
    }

    public function edit($id)
    {

        $partner = Partner::find($id);
        return view('admin.partner.edit', compact('partner'));
    }

    public function update(Request $request)
    {
        $partner = Partner::find($request->id);
        if ($partner) {
            $data = [
                'link' => $request->link,
                'avatar' => $request->thumbnail,
                'status' => $request->status
            ];
            $partner->update($data);
            return redirect()->back()->with(['status_update' => 'Cập nhật bài đăng thành công!']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $partner = Partner::where('id', $request->id)->first();
            if ($partner->status == Partner::PUBLISHED) {
                $partner->status = Partner::PENDING;
                $partner->save();
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
            $partners = Partner::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($partners as $partner) {
                $partner->status = Partner::PENDING;
                $partner->save();
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
            $partners = Partner::whereIn('id', $arr_id)->select('id', 'status')->get();
            foreach ($partners as $partner) {
                $partner->status = Partner::PUBLISHED;
                $partner->save();
            }
            return response()->json(array('status' => true, 'msg' => 'Thành công'));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
