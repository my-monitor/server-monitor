<?php

namespace App\Http\Controllers;

use App\Check;
use App\Host;
use App\Http\Requests\StoreHostRequest;
use Illuminate\Http\Request;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;

class ServersController extends Controller
{
    public function index(){
        $hosts = Host::with('checks')->paginate(20);
        return view('servers.home',compact('hosts'));
    }

    public function create(){
        $checksList = Check::getList();
        return view('servers.create',compact('checksList'));
    }

    public function store(StoreHostRequest $request){
        $host = new Host;
        $host->name = $request->input('host_name');
        $host->ip = $request->input('host_ip');
        $host->ssh_user = $request->input('ssh_user');
        $host->port = $request->input('ssh_port');
        $host->save();
        foreach($request->input('checks') as $checkName) {
            $host->checks()->create([
                'type' => $checkName,
                'status' => CheckStatus::NOT_YET_CHECKED,
                'custom_properties' => [],
            ]);
        }
        return redirect()->route('servers.home');
    }
}
