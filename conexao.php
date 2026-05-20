<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', 'Onnim@937539#');
define('DB', 'appCrud');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possivel estabelecer uma conexão com o banco de dados');
