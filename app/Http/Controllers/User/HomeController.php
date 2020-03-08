<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
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
        $events = Event::select('avatar','title','description','slug')->get();
        return view('front_end.index',compact('members','partners','events'));
    }

    public function eventDetail($slug){
        $event = Event::where('slug',$slug)->first();
        return view('front_end.event.detail',compact('event'));
    }

    public function listEvent(){
        $events = Event::select('avatar','title','description','slug')->paginate(6);
        return view('front_end.event.show',compact('events'));
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
        $partners = Partner::all();
        return view('front_end.partner.index',compact('partners'));
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