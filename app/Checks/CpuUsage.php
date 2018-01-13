<?php

namespace App\Checks;

use Spatie\Regex\Regex;
use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Symfony\Component\Process\Process;

class CpuUsage extends CheckDefinition
{
    public $command = 'grep \'cpu \' /proc/stat';

    public function resolve(Process $process)
    {
        $percentage = $this->getCpuUsage($process->getOutput());

        $message = "usage at {$percentage}%";

        $thresholds = config('server-monitor.cpuusage_percentage_threshold', [
            'fail' => 80,
            'warning' => 90,
        ]);

        if ($percentage >= $thresholds['fail']) {
            $this->check->fail($message);

            return;
        }

        if ($percentage >= $thresholds['warning']) {
            $this->check->warn($message);

            return;
        }

        $this->check->succeed($message);
    }

    protected function getCpuUsage($getOutput)
    {
        $cpuData = explode("\n",$getOutput)[0];
        $cpuData  = explode(' ',preg_replace('!\s+!', ' ', $cpuData));
        $percentage = (($cpuData[1] + $cpuData[3]) * 100) / ($cpuData[1]+$cpuData[3]+$cpuData[4]);
        return round($percentage);
    }
}
