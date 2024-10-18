<?php

namespace App\Repositories;

use App\Jobs\SplitCSVFile;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductRepository
{
    public static function create($row)
    {
        return Product::create(
            [
                'name' => $row[0],
                'price' => $row[1],
            ]
        );
    }

    public static function getByName($name)
    {
        return Product::whereName($name)->with('categories')->first();
    }

    public function handleCSV(UploadedFile $file)
    {
        $path = $file->store('csv_files');

        SplitCSVFile::dispatch(storage_path('app/private/' . $path));
    }
}
