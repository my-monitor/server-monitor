<?php

namespace App\Checks;

use Spatie\Regex\Regex;
use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Symfony\Component\Process\Process;

class MemoryUsage extends CheckDefinition
{
    public $command = "free | grep Mem";

    public function resolve(Process $process)
    {
        $percentage = $this->getMemoryUsagePercentage($process->getOutput());

        $message = "usage at {$percentage}%";

        $thresholds = config('server-monitor.memoryusage_percentage_threshold', [
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

    protected function getMemoryUsagePercentage(string $commandOutput): int
    {
        $outputValues = explode(' ',preg_replace('!\s+!', ' ', $commandOutput));
        return $outputValues[2] / $outputValues[1] * 100;
    }
}
