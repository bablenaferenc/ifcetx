<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product CSV to Feed</title>
    </head>
    <body>
        <header>
            <h1>Product CSV to Feed</h1>
        </header>

        <main>
            <section>
                <h2>Upload csv</h2>
                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" id="file">
                    <button type="submit">
                        Send
                    </button>
                </form>
            </section>

            <section>
                <h2>Queues in the database</h2>
                <p>{{ $queues }}</p>
            </section>

            <section>
                <h2>Products in the database</h2>
                <p>{{ $products }}</p>
            </section>

            <section>
                <h2>Open XML feed</h2>
                <a href="{{ route('feed') }}">
                    {{ route('feed') }}
                </a>
            </section>
        </main>
    </body>
</html>
