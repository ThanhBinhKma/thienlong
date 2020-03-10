<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Member;
use App\Models\Partner;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Admin\ChangePassRequest;
class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::where('status',1)->get();
        $members  = Member::where('status',1)->get();
        $events = Event::where('status',1)->get();
        return view('admin.index',compact('partners','members','events'));
    }

    public function changePass()
    {
        return view('admin.changepass.index');
    }

    public function handleChangePass(ChangePassRequest $request)
    {
        $admin =Admin::find(Auth::guard('admin')->user()->id);
        $admin->password = bcrypt($request->password);
        $admin->save();
        return redirect()->back()->with('done','Thay đổi thành công');
    }

    public function logout()
    {
        session()->forget('admin_login');
        return redirect('admin-login');
    }
}
