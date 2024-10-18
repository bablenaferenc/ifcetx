<?php

namespace App\Jobs;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $row;

    public function __construct(array $row)
    {
        $this->row = $row;
    }

    public function handle()
    {
        $product = ProductRepository::getByName($this->row[0]);

        if (isset($product)) {
            $product->update(['price' => $this->row[1]]);
        } else {
            $product = ProductRepository::create($this->row);
        }

        $categories = [];
        for ($i = 2; $i <= 4; $i++) {
            if (isset($this->row[$i]) && $this->row[$i] !== '') {
                $categories[] = $this->row[$i];
            }
        }

        $categoryIds = [];
        foreach ($categories as $categoryName) {
            $category = CategoryRepository::getByName($categoryName);

            if (!isset($category)) {
                $category = CategoryRepository::create($categoryName);
            }
            $categoryIds[] = $category->id;
        }

        $product->categories()->sync($categoryIds);
    }
}
