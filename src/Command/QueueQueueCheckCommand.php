<?php
namespace JKatzen\QueueMonitor\Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use JKatzen\QueueMonitor\QueueMonitor;

class QueueQueueCheckCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:queuecheck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Queue a check to make sure a queue is functioning properly";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        QueueMonitor::queueQueueCheck($this->argument('queue'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            [
                'queue',
                InputArgument::OPTIONAL,
                "Queue to queue a check for"
                . " (default is the application's default queue)",
                null,
            ],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
