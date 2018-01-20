<?php

namespace App;


use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\ServerMonitor\Events\CheckRestored;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Spatie\ServerMonitor\Models\Concerns\HasProcess;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Spatie\ServerMonitor\Models\Presenters\CheckPresenter;
use Spatie\ServerMonitor\Exceptions\InvalidCheckDefinition;
use Spatie\ServerMonitor\Models\Concerns\HandlesCheckResult;
use Spatie\ServerMonitor\Models\Concerns\HasCustomProperties;
use Spatie\ServerMonitor\Models\Concerns\ThrottlesFailingNotifications;

class Check extends \Spatie\ServerMonitor\Models\Check
{
    const statues = [
        'not yet checked' => '<div class="label label-info">Not Yet Checked</div>',
        'success' => '<div class="label label-success">Success</div>',
        'warning' => '<div class="label label-warning">Warning</div>',
        'failed' => '<div class="label label-danger">Failed</div>',
    ];

    public function getHtmlStatus(){
        return self::statues[$this->status];
    }

    public static function getList(){
        return array_keys(config('server-monitor.checks'));
    }
}
