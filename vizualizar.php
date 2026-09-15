<?php

include "conexao.php";

$id = $_GET["id"] ?? "";

if ($id == "") {

    echo "Código do chamado não informado.";
    echo "<br><br>";
    echo "<a href='visualizar.html'>Voltar</a>";

    exit;
}

$sql = "SELECT * FROM chamados WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();


if ($resultado->num_rows == 0) {

    echo "Chamado não encontrado.";
    echo "<br><br>";
    echo "<a href='visualizar.html'>Voltar</a>";

    exit;
}


$chamado = $resultado->fetch_assoc();


echo "Código: " . $chamado["id"];
echo "<br>";

echo "Solicitante: " . $chamado["solicitante"];
echo "<br>";

echo "E-mail: " . $chamado["email"];
echo "<br>";

echo "Setor: " . $chamado["setor"];
echo "<br>";

echo "Título: " . $chamado["titulo"];
echo "<br>";

echo "Descrição: " . $chamado["descricao"];
echo "<br>";

echo "Prioridade: " . $chamado["prioridade"];
echo "<br>";

echo "Status: " . $chamado["status"];
echo "<br>";

echo "Data de abertura: " . $chamado["data_abertura"];

echo "<br><br>";

echo "<a href='listar.php'>Voltar para chamados</a>";

?>