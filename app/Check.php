<?php

namespace App;

class Check extends \Spatie\ServerMonitor\Models\Check
{
    const statues = [
        'not yet checked' => '<div class="label label-info">Not Yet Checked</div>',
        'success'         => '<div class="label label-success">Success</div>',
        'warning'         => '<div class="label label-warning">Warning</div>',
        'failed'          => '<div class="label label-danger">Failed</div>',
    ];

    public function getHtmlStatus()
    {
        return self::statues[$this->status];
    }

    public static function getList()
    {
        return collect(array_keys(config('server-monitor.checks')));
    }
}
