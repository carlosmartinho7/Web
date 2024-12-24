<?php
$host = 'localhost';
$dbname = 'brokentimemachine';
$user = 'web';
$password = 'web';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
} catch (PDOException $e) {
    die("Erro na conexão com a bd: " . $e->getMessage());
}