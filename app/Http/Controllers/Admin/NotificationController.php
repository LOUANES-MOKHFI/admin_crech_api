<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $data = [];
        $data['notifications'] = Notification::all();
        return view('admin.notifications.index',$data);
    }

   
}
