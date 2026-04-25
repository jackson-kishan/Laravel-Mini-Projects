<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        return parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";

        $command = 'mysqldump --user=' . env('DB_USERNAME') . " --password=" . env('# DB_PASSWORD') .
         " --host=" . env('DB_HOST') . " " . env('# DB_DATABASE') . " | gzip > " . storage_path() . "/app/back/" . $filename;

         $returnVar = null;
         $output = null;

         exec($command, $output, $returnVar);

    }
}
