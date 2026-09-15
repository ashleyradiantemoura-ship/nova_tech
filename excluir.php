<?php
include "conexao.php";

$id = $_POST["id"] ?? "";

$mensagem = "";
$sucesso = false;

if ($id == "") {
    $mensagem = "Código do chamado não informado.";
} else {
    $sql = "DELETE FROM chamados WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $mensagem = "Chamado excluído com sucesso!";
        $sucesso = true;
    } else {
        $mensagem = "Chamado não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Chamado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-card">

        <div class="form-header">
            <h2>HelpDesk Industrial</h2>
            <h3>Exclusão de Chamado</h3>
        </div>

        <div class="alerta <?= $sucesso ? 'sucesso' : 'erro' ?>">
            <?= htmlspecialchars($mensagem) ?>
        </div>

        <div class="button-group">
            <a href="listar.php">
                <button type="button" class="btn-submit">
                    Voltar para a lista
                </button>
            </a>
            <a href="index.html">
                <button type="button" class="btn-link">
                    Ir para a página inicial
                </button>
            </a>
        </div>

    </div>

</body>
</html>