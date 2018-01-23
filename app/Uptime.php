<?php

namespace App;

use Spatie\UptimeMonitor\Models\Monitor;

class Uptime extends Monitor
{
    protected $table = 'monitors';

    protected $appends = [
        'protocol',
    ];

    const statues = [
        'not yet checked' => '<div class="label label-info">Not Yet Checked</div>',
        'up'              => '<div class="label label-success">UP</div>',
        'warning'         => '<div class="label label-warning">Warning</div>',
        'down'            => '<div class="label label-danger">Down</div>',
    ];

    public function getChecksStatuses()
    {
        return self::statues[$this->uptime_status];
    }

    public function getProtocolAttribute()
    {
        return $this->url->getScheme();
    }
}
