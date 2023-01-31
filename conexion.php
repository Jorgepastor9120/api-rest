<?php

$host = 'localhost';
$bdd = 'ejemplo_api';
$user = 'usuario';
$pw = 'password';

$mysqli = new mysqli($host, $user, $pw, $bdd);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}