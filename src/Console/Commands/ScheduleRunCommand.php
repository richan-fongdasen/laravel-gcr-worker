<?php

namespace RichanFongdasen\GCRWorker\Console\Commands;

use Illuminate\Console\Scheduling\ScheduleRunCommand as BaseScheduleRunCommand;

class ScheduleRunCommand extends BaseScheduleRunCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gcr-schedule:run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->fixStartTime();
    }

    /**
     * Fix the start time of the command.
     *
     * @return void
     */
    protected function fixStartTime(): void
    {
        $this->startedAt->second(0);
    }
}
