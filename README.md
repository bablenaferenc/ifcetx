## IFCETX

**Import From CSV, Export To XML**

This application imports products and their prices, along with categories, from a structured CSV file into a database. It then generates an XML feed with the stored data.

## Installation

This is a Dockerized Laravel Sail application. To get started, follow these steps:

1. Copy the `.env.example` file to `.env`.
2. Run `./vendor/bin/sail up` to start the containers.
3. Run the database migrations with `./vendor/bin/sail artisan migrate`.
4. Start the queue worker by running `./vendor/bin/sail artisan queue:work`.
5. Open your browser and go to `localhost` to verify everything is working.

## Routes

### Upload
This route allows you to import products, prices, and categories from a CSV file.

- **Method**: POST
- **Endpoint**: `/upload`
- **Data**: `file: UploadedFile`

### Feed
This route displays the products in an XML feed.

- **Method**: GET
- **Endpoint**: `/feed`

### Homepage
The homepage displays a form for uploading files and provides information about the import process.

- **Method**: GET
- **Endpoint**: `/`

