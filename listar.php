<?php

include "conexao.php";

$titulo = $_GET["titulo"] ?? "";
$status = $_GET["status"] ?? "";

$sql = "SELECT * FROM chamados WHERE 1=1";

if ($titulo != "") {

    $sql .= " AND titulo LIKE '%$titulo%'";

}

if ($status != "" && $status != "Todos") {

    $sql .= " AND status = '$status'";

}

$sql .= " ORDER BY data_abertura DESC";

$resultado = $conexao->query($sql);


if ($resultado->num_rows == 0) {

    echo "Nenhum chamado encontrado";

    echo "<br><br>";

    echo "<a href='index.html'>Voltar</a>";

    exit;

}


echo "<h1>Lista de chamados</h1>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>Código</th>";
echo "<th>Título</th>";
echo "<th>Solicitante</th>";
echo "<th>Setor</th>";
echo "<th>Prioridade</th>";
echo "<th>Status</th>";
echo "<th>Data de abertura</th>";
echo "<th>Ações</th>";

echo "</tr>";


while ($chamado = $resultado->fetch_assoc()) {

    echo "<tr>";

    echo "<td>" . $chamado["id"] . "</td>";

    echo "<td>" . $chamado["titulo"] . "</td>";

    echo "<td>" . $chamado["solicitante"] . "</td>";

    echo "<td>" . $chamado["setor"] . "</td>";

    echo "<td>" . $chamado["prioridade"] . "</td>";

    echo "<td>" . $chamado["status"] . "</td>";

    echo "<td>" . $chamado["data_abertura"] . "</td>";

    echo "<td>";

    echo "<a href='visualizar.php?id=" . $chamado["id"] . "'>Consultar</a> ";

    echo "<a href='editar.php?id=" . $chamado["id"] . "'>Editar</a> ";

    echo "<form action='excluir.php' method='POST' style='display:inline;'>";

    echo "<input type='hidden' name='id' value='" . $chamado["id"] . "'>";

    echo "<button type='submit'>Excluir</button>";

    echo "</form>";

    echo "</td>";

    echo "</tr>";
}

echo "</table>";

echo "<br>";

echo "<a href='index.html'>Voltar</a>";

?>