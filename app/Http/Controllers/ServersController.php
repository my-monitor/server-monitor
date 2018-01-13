<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\ServerMonitor\Models\Host;

class ServersController extends Controller
{
    public function index(){
        $hosts = Host::with('checks')->paginate(20);
        return view('servers.home',compact('hosts'));
    }
}
