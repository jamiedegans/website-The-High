<?php
$host = 'db';
$db = 'mydatabase';
$user = 'user';
$password = 'password';
$charset = 'utf8mb4';
//opties
$opties = [
PDO ::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO ::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO ::ATTR_EMULATE_PREPARES => false,
];
//dsn = data source name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
  //create the contection
  $pdo = new PDO($dsn, $user, $password, $opties);
  //succes melding
  echo "Database connection goed <br/>";
} catch (PDOException $e) {
  //fout melding
  echo $e->getMessage();
  //stop (die)
  die("sorry, database probleem"); 
}
?>