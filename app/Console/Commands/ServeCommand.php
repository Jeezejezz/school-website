<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve {--host=127.0.0.1} {--port=8080}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server with default port 8080';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $host = $this->option('host');
        $port = $this->option('port');

        $this->info("Starting Laravel development server: http://{$host}:{$port}");

        $process = new Process([
            PHP_BINARY,
            '-S',
            "{$host}:{$port}",
            '-t',
            public_path(),
            base_path('server.php')
        ]);

        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            if ($type === Process::ERR) {
                $this->error($buffer);
            } else {
                $this->output->write($buffer);
            }
        });
    }
}
