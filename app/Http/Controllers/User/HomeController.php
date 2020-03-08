<?php

namespace App\Http\Controllers\User;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Images;
use DB;
use Illuminate\Support\Facades\Auth;
use Purifier;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::select('name','avatar','position','position_id')->get();
        $partners = Partner::select('avatar')->get();
        return view('front_end.index',compact('members','partners'));
    }

    public function contact()
    {
        return view('front_end.contact.index');
    }

    public function about()
    {
        return view('front_end.about.index');
    }

    public function service()
    {
        return view('front_end.service.index');
    }

    public function partner()
    {
        return view('front_end.partner.index');
    }

    public function activate()
    {
        return view('front_end.activate.index');
    }

    public function saveImage(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $uploadPath = 'uploads';
        $image->move(public_path($uploadPath), time() . $imageName);
        $data = '/' . $uploadPath . '/' . time() . $imageName;
        return $data;
    }

    public function deleteImage(Request $request)
    {
        $filename = $request->get('filename');
        $path = public_path() . '/uploads/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        if (isset($request->cruise_id) && $request->cruise_id) {
            $image = Image::where([['link', '/uploads/' . $filename], ['cruise_id', $request->cruise_id]])->delete();
        }
        if (isset($request->cruise_room_id) && $request->cruise_room_id) {
            $image = Image::where([['link', '/uploads/' . $filename], ['cruise_room_id', $request->cruise_room_id]])->delete();
        }
        return $filename;
    }
} 