**Backend**
- Laravel 10
- Laravel Fortify for authentication (login, registration & password reset)
- Laravel Sail for local development
- Laravel Pint for backend linting
- MySQL database

**Frontend SPA**
- Vue 3
- Vuetify 3
- Vue router
- ESLint for frontend linting


## Installation

Clone the repository and init your environment:

```bash
git clone git@github.com:DinShaCha/Todo-App.git
cd Todo-App
cp .env.example .env
```

```bash
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs
```

Then the project can be initiated:

```bash
./vendor/bin/sail up -d
```

Then, the following commands:

```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

You can now access the project at [http://localhost](http://localhost).

## Testing

For testing:

```bash
./vendor/bin/sail artisan test
```

## Linting

To lint the code, you can use Laravel Pint for the backend and ESLint for the frontend.

```bash
./vendor/bin/sail pint            # Lint backend
./vendor/bin/sail npm run lint    # Lint frontend
```

## Mail

The Sail environment includes Mailpit, which can be accessed at http://localhost:8025. You can use it to view the emails sent by the app.
