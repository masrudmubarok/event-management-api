# Event Management API

This is an event management API built with CodeIgniter 4 and MySQL.

## Requirements

* PHP (version supported by CodeIgniter 4)
* Composer
* MySQL
* Git

## Setup

1.  **Clone the repository:**

    ```bash
    git clone <repository_url>
    cd <repository_name>
    ```

2.  **Install Composer dependencies:**

    ```bash
    composer install
    ```

3.  **Database Configuration:**

    * Create a database named `event_management` in your MySQL server.
    * Copy the `env` file to `.env`:

        ```bash
        cp env .env
        ```

    * Open the `.env` file and configure the database connection:

        ```ini
        database.default.hostname = localhost
        database.default.database = event_management
        database.default.username = <your_mysql_username>
        database.default.password = <your_mysql_password>
        database.default.DBDriver = MySQLi
        database.default.DBPrefix =
        database.default.port = 3306
        ```

        Replace `<your_mysql_username>` and `<your_mysql_password>` with your MySQL credentials.

4.  **Database Migration:**

    ```bash
    php spark migrate
    ```

5.  **Run Development Server:**

    ```bash
    php spark serve
    ```

    The API will be running at `http://localhost:8080`.

## API Implementation with Postman

1.  **GET /api/events:**

    * Retrieves all events.
    * URL: `http://localhost:8080/api/events`
    * Method: GET

2.  **POST /api/events:**

    * Creates a new event.
    * URL: `http://localhost:8080/api/events`
    * Method: POST
    * Body (JSON):

        ```json
        {
            "name": "New Event",
            "date": "2024-12-31",
            "location": "New Location",
            "description": "New Description"
        }
        ```

3.  **GET /api/events/{id}:**

    * Retrieves an event by ID.
    * URL: `http://localhost:8080/api/events/{id}` (replace `{id}` with the event ID)
    * Method: GET

4.  **PUT /api/events/{id}:**

    * Updates an event by ID.
    * URL: `http://localhost:8080/api/events/{id}` (replace `{id}` with the event ID)
    * Method: PUT
    * Body (JSON):

        ```json
        {
            "name": "Updated Event",
            "date": "2025-01-01",
            "location": "Updated Location",
            "description": "Updated Description"
        }
        ```

5.  **DELETE /api/events/{id}:**

    * Deletes an event by ID.
    * URL: `http://localhost:8080/api/events/{id}` (replace `{id}` with the event ID)
    * Method: DELETE