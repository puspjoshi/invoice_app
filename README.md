## About Invoice App

Invoice app is developed in Laravel and Vuejs. It can be used to create invoice and keep all data of invoices. This application can be used professionally:

- create invoice.
- list them and search ( can find fast invoices).
- Edit invoice if there is any error in invoice data.
- can implement as per the requirement.
- Database and Factory for dummy data.
- To see demo please install the app.
- Invoice pagination for large scale list
- Download Invoice
- Attach in email and send to client


## Installing invoice app

- clone the app form GitHub.
- `composer install`.
- ` npm run dev ` for development and ` npm run prod ` for production.
- `php artisan migrate:fresh`.
- `php artisan tinker`. 

To create dummy data, inside tinker following command can be executed.
` App\Models\Customer:factory(5)->create() `
` App\Models\Invoice:factory(5)->create() `
` App\Models\Product:factory(5)->create() `


## Authentication

There is no login system so it can be publically access by all, if you need authentication you can keep laravel breeze. you also can contact me.

