<?php

namespace App\Http\Controllers;

use App\Uptime;
use Illuminate\Http\Request;
use Spatie\Url\Url;

class UptimeController extends Controller
{
    public function index(){
        $hosts = Uptime::all();
        return view('uptime.home',compact('hosts'));
    }

    public function create(){
        return view('uptime.create');
    }

    public function store(Request $request){

        $url = Url::fromString($request->input('url'));

        if (! in_array($url->getScheme(), ['http', 'https']) && $request->input('protocol') != null) {
            $scheme = $request->input('protocol');
            $url = $url->withScheme($scheme);
        }

        if(!empty(trim($request->input('string')))) {
            $lookForString = $request->input('string');
        }

        Uptime::create([
            'name' => $request->input('name'),
            'url' => trim($url, '/'),
            'look_for_string' => $lookForString ?? '',
            'uptime_check_method' => isset($lookForString) ? 'get' : 'head',
            'certificate_check_enabled' => false,
            'uptime_check_interval_in_minutes' => config('uptime-monitor.uptime_check.run_interval_in_minutes'),
        ]);

        return redirect()->route('uptime.home');
    }

    public function edit($id){
        $host = Uptime::findOrFail($id);
        return view('uptime.edit',compact('host'));
    }

    public function update(Request $request,$id){

        $host = Uptime::findOrFail($id);

        $url = Url::fromString($request->input('url'));

        if ($request->input('protocol') != null) {
            $scheme = $request->input('protocol');
            $url = $url->withScheme($scheme);
        }

        if(!empty(trim($request->input('string')))) {
            $lookForString = $request->input('string');
        }

        $host->update([
            'name' => $request->input('name'),
            'url' => trim($url, '/'),
            'look_for_string' => $lookForString ?? '',
            'uptime_check_method' => isset($lookForString) ? 'get' : 'head',
            'certificate_check_enabled' => false,
            'uptime_check_interval_in_minutes' => config('uptime-monitor.uptime_check.run_interval_in_minutes'),
        ]);

        return redirect()->route('uptime.home');
    }

    public function show($id){
        $host = Uptime::findOrFail($id);
        return view('uptime.show',compact('host'));
    }

}
