<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    protected $guarded = [];

    protected $dates = ['uptime_last_check_date'];

    const statues = [
        'not yet checked' => '<div class="label label-info">Not Yet Checked</div>',
        'up'              => '<div class="label label-success">UP</div>',
        'down'            => '<div class="label label-danger">Down</div>',
    ];

    public function getChecksStatuses()
    {
        if ($this->uptime_last_check_date == null) {
            $status = 'not yet checked';
        } else {
            $status = Carbon::now()->diffInSeconds($this->uptime_last_check_date) <= ($this->uptime_check_interval_in_seconds + 20) ? 'up' : 'down';
        }

        return self::statues[$status];
    }

    public function updateLastTimePing()
    {
        $this->update(['uptime_last_check_date' => Carbon::now()]);
        $this->logs()->create([
           'user_id' => auth()->id(),
            'header' => json_encode(request()->header()),
        ]);
    }

    public function logs()
    {
        return $this->hasMany(PingLogs::class)->orderByDesc('id');
    }
}
