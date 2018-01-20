<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\ServerMonitor\Models\Enums\HostHealth;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ServerMonitor\Models\Presenters\HostPresenter;
use Spatie\ServerMonitor\Models\Concerns\HasCustomProperties;

class Host extends \Spatie\ServerMonitor\Models\Host
{
    const statues = [
        'not yet checked' => '<div class="label label-info">%v Not Yet Checked</div>',
        'success' => '<div class="label label-success">%v Success</div>',
        'warning' => '<div class="label label-warning">%v Warning</div>',
        'failed' => '<div class="label label-danger">%v Failed</div>',
    ];

    public function getChecksStatuses(){
        $checks = $this->checks->groupBy('status');
        $statuses = $checks->keys();
        $html = '';
        foreach($statuses as $status){
            $html .= str_replace('%v',$checks[$status]->count(),self::statues[$status]) . '<br>';
        }
        return $html;
    }
}
