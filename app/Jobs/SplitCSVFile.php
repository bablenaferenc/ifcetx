<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SplitCSVFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        if (!file_exists($this->filePath)) {
            Log::info('File does not exist: ' . $this->filePath);
            throw new \Exception("File does not exist: " . $this->filePath);
        }

        $handle = fopen($this->filePath, 'r');
        if ($handle === false) {
            Log::info('Failed to open file: ' . $this->filePath);
            throw new \Exception("Failed to open file: " . $this->filePath);
        }

        $firstRow = true;

        $chunkSize = 100;
        $chunk = [];

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            if (!$firstRow) {

                $chunk[] = $row;

                if (count($chunk) >= $chunkSize) {
                    ProcessCSVChunk::dispatch($chunk);
                    $chunk = [];
                }
            }

            $firstRow = false;
        }

        if (count($chunk) > 0) {
            ProcessCSVChunk::dispatch($chunk);
        }

        fclose($handle);
    }
}
