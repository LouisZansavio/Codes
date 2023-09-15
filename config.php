<?php
$host = 'localhost';
$username = 'root'; 
$password = ''; 
$database = 'desafio';

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sqlCreateDB) === FALSE) {
    die("Erro ao criar o banco de dados: " . $conn->error);
}

$conn->select_db($database);

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    profession VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL
)";
if ($conn->query($sqlCreateTable) === FALSE) {
    die("Erro ao criar a tabela 'users': " . $conn->error);
}

?>