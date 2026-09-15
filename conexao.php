<?php
$servidor = "localhost";
$usuario = "root"; 
$senha = "";
$banco = "helpdesk_industrial"; 

$conexao = new mysqli($sevidor, $usuario, $usuario, $banco); 

if ($conexao-> connect_error) {
    die("Erro na conexão:" . $conexao->connect_error);
}

?> 