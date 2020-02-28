<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\Vertifi;
use Illuminate\Support\Facades\Auth;
use Purifier;
class LoginController extends Controller
{
   	public function signUp(Request $request)
   	{

   		$email = $request->email;
         $name = $request->name;
         $password = $request->password;
         $check1 = Purifier::clean($email);
         $check2 = Purifier::clean($name);
         $check3 = Purifier::clean($password);
         if($check1 == null || $check2 == null || $check3 == null){
            return response()->json([
               'msg' => 'HACK'
            ]);
         }else{
      		$check_mail = User::where('email',$email)->first();
      		if($check_mail){
      			return response()->json([
      			'msg'=> 'FAIL1'
      		]);
      		}else{
      			$us= new User();
      			$us->name = $request->name;
      			$us->email = $request->email;
      			$us->password = bcrypt($request->password);
      			$us->status = 0;
      			$us->save();
      			$data = array();
      			$data['id'] = base64_encode($us->id);
      			$data['email'] = base64_encode($us->email);
               
      			$this->dispatch(new Vertifi($data));
      			return response()->json([
      				'msg'=>'OK'
      			]);
      		}
         // }
   		
   	  }
      }  
   	public function confirm(Request $request)
   	{
   		$id = base64_decode($request->id);
         $email = base64_decode($request->email);
   		$uss = User::where('id',$id)->where('email',$email)->first();
         if($uss){
   		 $uss->status = 1;
   		 $uss->save();
   		    return redirect()->route('homes')->with('confirm_mail','thành công');
         }else{
            return redirect()->route('homes');
         }
   	}

   	public function login(Request $request)
   	{
   		$email = $request->email;
         $password = $request->password;
         $ifo = [
            'email'=>$email,
            'password' => $password
        ];
   		$check_mail = User::where('email',$email)->first();
   		if($check_mail){
   			if($check_mail->status == 0){
   				return response()->json([
   					'msg'=>'FAIL2'
   				]);
   			}else{
               if(Auth::attempt($ifo)){
      				return response()->json([
      					'msg'=>'OK'
      				]);
               }else{
                  return response()->json([
                     'msg'=>'FAIL3'
                  ]);
               }
   			}
   		}else{
   			return response()->json([
   				'msg'=>'FAIL1'
   			]);
   		}
   	}

      public function logout(){
         Auth::logout();
         return redirect()->route('homes');
      }

      public function update(Request $request)
      {
         $id = $request->idUser;
         $us = User::find($id);
         $us->name = $request->nameUser;
         $us->phone = $request->phoneUser;
         $us->date = $request->dateUser;
         $us->address = $request->addressUser;
         $us->address_work = $request->addressUser2;
         $us->save();

         return response()->json([
            'msg' => 'OK'
         ]);
      }

      public function updatePass(Request $request)
      {
         $id = $request->idUser;
         $us = User::find($id);
         $passOl = $request->passOldUser;

         if(Hash::check($passOl, $us->password)){
            $passNew = $request->passNewUser;

            $us->password = bcrypt($passNew);
            $us->save();
            return response()->json([
               'msg' => 'OK'
            ]);
         }else{
            return response()->json([
               'msg' => 'FAIL'
            ]);
         }
      }
}
