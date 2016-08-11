<?php
if (!$conn = mysqli_connect('127.0.0.1','root',''))
	die('Falha ao conectar ao SGBD!');
if (!$db = mysqli_select_db($conn,'compras'))
	die('Falha ao selecionar database!');
?>