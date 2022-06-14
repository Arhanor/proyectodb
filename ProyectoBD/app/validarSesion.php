<?php 
session_start();

//in_array($_SERVER['REQUEST_URI'], $_SESSION['permisos']) OR die('Acceso no autorizado');

if(empty($_SESSION)){
    header('Location: http://localhost/ProyectoBD/app/registro.php');
}
?>