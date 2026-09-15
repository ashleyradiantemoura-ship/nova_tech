<?php
include "conexao.php";

$id = $_GET["id"] ?? "";

if ($id == "") {
    header("Location: listar.php");
    exit;
}

$sql = "SELECT * FROM chamados WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Chamado não encontrado.");
}

$chamado = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Chamado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-card">
        <div class="form-header">
            <h2>HelpDesk Industrial</h2>
            <h3>Chamado #<?= $chamado["id"] ?></h3>
        </div>

        <div class="input-group">
            <label>Solicitante:</label>
            <p><?= htmlspecialchars($chamado["solicitante"]) ?> (<?= htmlspecialchars($chamado["email"]) ?>)</p>
        </div>
        <div class="input-group">
            <label>Setor:</label>
            <p><?= htmlspecialchars($chamado["setor"]) ?></p>
        </div>
        <div class="input-group">
            <label>Título:</label>
            <p><?= htmlspecialchars($chamado["titulo"]) ?></p>
        </div>
        <div class="input-group">
            <label>Status / Prioridade:</label>
            <p><?= $chamado["status"] ?> / <?= $chamado["prioridade"] ?></p>
        </div>
        <div class="input-group">
            <label>Descrição:</label>
            <p><?= nl2br(htmlspecialchars($chamado["descricao"])) ?></p>
        </div>

        <div class="button-group">
            <a href="editar.php?id=<?= $chamado["id"] ?>"><button type="button" class="btn-submit">Editar</button></a>
            <a href="listar.php"><button type="button" class="btn-link">Voltar</button></a>
        </div>
    </div>
</body>
</html>