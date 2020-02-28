<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
	protected function renderJsonResponse($data = [], $msg = '', $code = 0) {
		$response = array();
		$response['response_status'] = $code;
		$response['response_msg'] = $msg;
		$response['response_content'] = $data;
		return response()->json($response);
	}
}
