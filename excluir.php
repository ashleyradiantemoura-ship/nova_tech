<?php

include "conexao.php";

$id = $_POST["id"] ?? "";

if ($id == "") {

    echo "Código do chamado não informado.";

    echo "<br><br>";

    echo "<a href='excluir.html'>Voltar</a>";

    exit;
}


$sql = "DELETE FROM chamados WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();


if ($stmt->affected_rows > 0) {

    echo "<h2>Chamado excluído com sucesso!</h2>";

} else {

    echo "<h2>Chamado não encontrado.</h2>";

}


echo "<br>";

echo "<a href='listar.php'>Voltar para chamados</a>";

?>