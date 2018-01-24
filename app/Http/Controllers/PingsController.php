<?php

namespace App\Http\Controllers;

use App\Ping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PingsController extends Controller
{
    public function index()
    {
        $pings = Ping::all();

        return view('pings.home', compact('pings'));
    }

    public function create()
    {
        return view('pings.create');
    }

    public function store(Request $request)
    {
        Ping::create([
            'name'                             => $request->input('name'),
            'key'                              => Str::random('15'),
            'uptime_check_interval_in_seconds' => $request->input('should_run_every'),
        ]);

        return redirect()->route('pings.home');
    }

    public function edit($id)
    {
        $ping = Ping::findOrFail($id);

        return view('pings.edit', compact('ping'));
    }

    public function update(Request $request, $id)
    {
        $ping = Ping::findOrFail($id);

        $ping->update([
            'name'                             => $request->input('name'),
            'uptime_check_interval_in_seconds' => $request->input('should_run_every'),
        ]);

        return redirect()->route('pings.home');
    }

    public function show($id)
    {
        $ping = Ping::with('logs', 'logs.user')->findOrFail($id);

        return view('pings.show', compact('ping'));
    }
}
