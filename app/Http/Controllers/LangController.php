<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
     private $langActive = [
       'vi',
       'en',
   		];
   public function lang(Request $request, $lang)
   {
       if (in_array($lang, $this->langActive)) {
           $request->session()->put(['lang' => $lang]);
           return redirect()->back();
       }
   }
 }
