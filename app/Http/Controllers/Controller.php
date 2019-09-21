<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function toList($data, $id)
    {	
    	$a_data = [];

    	foreach ($data as $key => $value) {
    		$a_data[$value->id] = $value;
    	}

    	return $a_data;
    }
}
