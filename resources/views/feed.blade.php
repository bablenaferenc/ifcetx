<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<products>
    @foreach($products as $product)
        <product>
            <title>{{ $product->name }}</title>
            <price>{{ $product->price }}</price>
            <categories>
                @foreach($product->categories as $category)
                    <category>{{ $category->name }}</category>
                @endforeach
            </categories>
        </product>
    @endforeach
</products>
