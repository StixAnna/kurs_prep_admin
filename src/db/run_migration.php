<?php
// require 'vendor/autoload.php';
require_once __DIR__ . '/../helpers/functions.php';

// Загружаем переменные из .env файла
loadEnv();

$dbPort = isset($_ENV['DB_PORT']) ? $_ENV['DB_PORT'] : '3311';
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

// Подключаемся к базе данных
if (isset($argv[1])){
    $filename = $argv[1];
    $file = (str_contains($filename,'.sql')) ? $filename : $filename . '.sql';
    try {
        if ($file == 'create_db.sql'){
            $pdo = new PDO("mysql:host=localhost:$dbPort", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Создаем базу данных
            $sql = "CREATE DATABASE IF NOT EXISTS $database 
                    DEFAULT CHARACTER SET = 'utf8mb4';";
            $pdo->exec($sql);
            echo "Database '$database' created successfully.\n";
        }
        else{
            if(file_exists(__DIR__."/$file")){
                $pdo = new PDO("mysql:host=localhost:$dbPort;dbname=$database;", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Читаем SQL скрипт из файла
                $sql = file_get_contents(__DIR__."/$file");

                // Выполняем SQL скрипт
                $pdo->exec($sql);
                echo "SQL script executed successfully.\n";
            }
            else
                echo $file.'SQL file not exists!';
        }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
else //debug
    echo 'Need argv[1] - filename';
    