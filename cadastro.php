<?php
include "conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$setor = $_POST["setor"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$prioridade = $_POST["prioridade"]; 

$status = "Aberto"; 

$setoresPermitidos = ['Produção', 'Manutenção', 'TI', 'Administrativo'];
$prioridadesPermitidas = ['Baixa', 'Média', 'Alta'];
$statusPermitidos = ['Aberto', 'Em andamento', 'Finalizado'];

if(!in_array($setor, $setoresPermitidos)) {
    die("Setor inválido."); 
}

if (!in_array($prioridade, $prioridadesPermitidas)) {
    die("Prioridade inválida.");
}

if (!in_array($status, $statusPermitidos)) { 
    die ("Status inválido.");
}

$sql = "INSERT INTO chamados
     (nome,email,setor,titulo,descricao,prioridade,status)
     VALUES
     ('$nome', '$email', '$setor', '$titulo', '$descricao', '$prioridade', '$status')"; 

     if ($conexao->query($sql)) {
        echo "Chamado cadastrado com sucesso!"; 
     } else { 
        echo "Erro ao cadastrar chamado";
     }
?> 