<?php
define('DIR_PATH', realpath(dirname(__FILE__)));
define('ROOT_PATH', 'http://172.17.34.253:1200/projetos/202400005/PHP/Eduardo_Php/Aula-11-BLOG-1/');

//Garante que a sessão esteja Habilitada
if (session_status()===PHP_SESSION_NONE){
    session_start();
}

// Inicializar as variaveis de Sessão
$mensagem = $_SESSION['mensagem'] ?? null;
$cor = $_SESSION['cor'] ?? null;
unset($_SESSION['mensagem']);
unset($_SESSION['cor']);

// variaveis Logado
$logado = $_SESSION['logado'] ?? FALSE;
$idUser = $_SESSION['idUser'] ?? "";
$nomeUser = $_SESSION['nomeUser'] ?? "";