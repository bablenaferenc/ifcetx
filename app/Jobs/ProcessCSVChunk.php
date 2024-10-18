<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ProcessProduct;

class ProcessCSVChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chunk;

    public function __construct(array $chunk)
    {
        $this->chunk = $chunk;
    }

    public function handle()
    {
        foreach ($this->chunk as $row) {
            ProcessProduct::dispatch($row);
        }
    }
}
