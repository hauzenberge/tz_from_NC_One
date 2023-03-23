## Installation

- [Clone the repository:] git clone https://github.com/hauzenberge/tz_from_NC_One.git
- [Navigate to the project directory:] cd your-project
- [Install the project dependencies:] composer install
- [Rename the .env.example file to .env:] cp .env.example .env
- [Generate the application key:] php artisan key:generate
- [Set up your database in the .env file:] 
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

- [Run the database migrations] php artisan migrate
- [Import the house data:] php artisan import:houses