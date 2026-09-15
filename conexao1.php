<?php
$host = "localhost";
$usuario = "root";
$senha = ""; 
$banco = "helpdesk_industrial"; 

mysqli_report(MYSQLI_REPORT_OFF);

$conexao = @new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    $erroConexao = $conexao->connect_error;
    $conexao = null;
}
?>