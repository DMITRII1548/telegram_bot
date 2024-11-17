<?php

namespace App\Jobs;

use App\Models\KworkProject;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SaveKworkProject implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $kworkProject
    ) { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        KworkProject::firstOrCreate([
            'id' => $this->kworkProject['id'],
        ], $this->kworkProject);
    }
}
