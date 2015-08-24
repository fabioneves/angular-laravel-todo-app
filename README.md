# Todo app
Simple Todo app using angular and laravel.

- Frontend: Angular 1.4.4
- Backend: Laravel 5.1

## Backend configuration
Do the basic standard laravel installation, you'll need to create/edit your `.env` file with the MySQL db/user/pass. After doing this, navigate to the `backend` directory and type the following:
- composer install
- php artisan migrate
After migration, navigate to the `backend.vhost/api/todo`, you should receive an empty array with response code 200.


## Frontend configuration
The frontend just needs the backend/api url. Edit the `frontend/js/config.js` to define this.
