<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;

class DashboardController extends CapsuleController
{
    public function getIndex()
    {
    	return view('welcome');
    }
}
