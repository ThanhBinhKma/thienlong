<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotels;
use App\Models\Image;
use DB;
use App\Http\Requests\Admin\HotelFormRequest;
class ImageController extends Controller
{
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $uploadPath = 'uploads/demo';
        $image->move(public_path($uploadPath),time().$imageName);
        $data = '/'.$uploadPath.'/'.time().$imageName;
        return response()->json($data);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path().$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        if(isset($request->cruise_id) && $request->cruise_id){
            $image = Image::where([['link', '/uploads/demo/'.$filename],['cruise_id',$request->cruise_id]])->delete();
        }
        if(isset($request->cruise_room_id) && $request->cruise_room_id){
            $image = Image::where([['link', '/uploads/demo/'.$filename],['cruise_room_id',$request->cruise_room_id]])->delete();
        }
        return $filename;
    }
}
