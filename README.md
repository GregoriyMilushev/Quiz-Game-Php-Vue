# Quiz-Game-Php-Vue
Try to guess the authors of then quotes.

For the PHP Api:
1. Set in .env file your MySql DB DNS, Username and Password
2. Use in the root directory this commands. First "php migration_runner.php" to create the needed tables in your DB. Second "php database/seeders/QuizzesSeeder.php" to seed the DB.
3. You can start the server localy by "php -S localhost:8000"

If appears a CORS policy problem in the browser, go in app/Controllers/BaseController.php on line 17 (header('Access-Control-Allow-Origin: http://127.0.0.1:5173');) and change the URL to the one you use.
