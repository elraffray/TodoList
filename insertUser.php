<?php
/**
 * Created by PhpStorm.
 * User: elone
 * Date: 16/12/17
 * Time: 15:50
 */


global $dsn, $user, $pass;

$con = new Connection($dsn, $user, $pass);

$username = "elone";
$password = "elone";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;


$query = "INSERT INTO users VALUES (:username, :password)";

$args = array(
    ':username' => array($username, PDO::PARAM_STR),
    ':password' => array($hash, PDO::PARAM_STR)
);

try {
    $con->executeQuery($query, $args);
} catch (PDOException $e1) {
    var_dump($e1);
} catch (Exception $e2) {
    var_dump($e2);
}