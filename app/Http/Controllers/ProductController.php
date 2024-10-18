<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class ProductController extends Controller
{
    /**
     * Upload a CSV file
     *
     * @param \Illuminate\Http\Request $request input request
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('file');

        (new ProductRepository())->handleCSV($file);

        return back();
    }

    /**
     * Display the feed
     *
     * @return \Illuminate\View\View
     */
    public function feed()
    {
        $products = Product::with('categories')->get();

        return response()
            ->view('feed', compact('products'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Display the home page
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $queues = Queue::size();

        $products = Product::count();

        return view('welcome', compact(['products', 'queues']));
    }
}
