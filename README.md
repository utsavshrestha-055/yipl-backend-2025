
# YIPL Library Management API

A RESTful API and Web UI for managing books and authors using Laravel and SQLite.
Provides full CRUD operations, validation, search, sorting, pagination, and interactive web views.

---

## Features

### Authors
- CRUD: Create, Read, Update, Delete
- View all books by an author
- Search by name
- Sort by number of books or creation date
- Paginated list

### Books
- CRUD operations
- View author details
- Search by title, author, or published year
- Sort by title, published year, or creation date
- Paginated list

### Validation
- **Author:** name (required, min 2 chars), email (required, unique, valid format)
- **Book:** title (required), ISBN (10 digits), published year (4 digits)
- Returns descriptive errors for invalid input

### Web UI
- Single search box for filtering authors/books
- Edit and delete actions
- Pagination & sorting in UI

### API
- REST endpoints for authors and books
- JSON responses with proper error handling

---

## Setup Instructions

### Unix/macOS (or Windows using Git Bash / WSL)

Run **once** for initial setup:

```bash
chmod +x setup.sh
./setup.sh
```

This will:

1. Check for PHP and Composer
2. Create `.env` from `.env.example` if missing
3. Install dependencies
4. Create `database/database.sqlite`
5. Generate application key
6. Run migrations and seed sample data
7. Clear all caches

After initial setup, run the server:

```bash
php artisan serve
```

Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

### Windows (CMD / PowerShell)

Run these **once** for setup:

```bat
copy .env.example .env
composer install
type nul > database\database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

After setup:

```bat
php artisan serve
```

Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## API Endpoints

### Authors

```
GET /api/authors
POST /api/authors
GET /api/authors/{id}
PUT /api/authors/{id}
DELETE /api/authors/{id}
```

**Example Response (GET /api/authors):**

```json
[
    {
        "id": 1,
        "name": "Ram Bahadur",
        "email": "rambahadur@email.com",
        "books_count": 2,
        "books": [
            {
                "id": 1,
                "title": "Rama Bahadur",
                "isbn": "1234567890",
                "published_year": 1949
            },
            {
                "id": 2,
                "title": "Nepal History",
                "isbn": "0987654321",
                "published_year": 1955
            }
        ]
    }
]
```

### Books

```
GET /api/books
POST /api/books
GET /api/books/{id}
PUT /api/books/{id}
DELETE /api/books/{id}
```

**Example Response (GET /api/books):**

```json
[
    {
        "id": 1,
        "title": "Rama Bahadur",
        "isbn": "1234567890",
        "published_year": 1949,
        "author": {
            "id": 1,
            "name": "Ram Bahadur",
            "email": "rambahadur@email.com"
        }
    },
    {
        "id": 2,
        "title": "Nepal History",
        "isbn": "0987654321",
        "published_year": 1955,
        "author": {
            "id": 1,
            "name": "Ram Bahadur",
            "email": "rambahadur@email.com"
        }
    }
]
```

---

## How to Use

* Access **Authors UI**: `/authors-ui`
* Access **Books UI**: `/books-ui`
* Use single search box to filter results
* Click book titles in author view to see details
* Use Edit/Delete buttons for CRUD
* Use REST API endpoints for integration

---

## Dependencies

* PHP >= 8.x
* Composer
* Laravel 10.x


---

## Notes

* Only run `setup.sh` (or Windows setup commands) **once** for initial setup.
* For development/testing afterward, use `php artisan serve`.
* Database file: `database/database.sqlite` with pre-seeded sample data.
