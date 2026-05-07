<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'scout_shop_db';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connection = mysqli_connect($server, $user, $password, $database);
    mysqli_set_charset($connection, 'utf8mb4');
} catch (mysqli_sql_exception $error) {
    http_response_code(500);
    die('Database connection failed. Import backend/schema.sql in phpMyAdmin first.');
}
?>
