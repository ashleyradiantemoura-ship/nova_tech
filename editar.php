<?php
include "conexao.php";

$mensagem = "";
$id = $_GET["id"] ?? $_POST["id"] ?? "";

if ($id == "") {
    header("Location: listar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $status = $_POST["status"];
    $prioridade = $_POST["prioridade"];
    $descricao = $_POST["descricao"];

    $sql = "UPDATE chamados SET titulo=?, status=?, prioridade=?, descricao=? WHERE id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $status, $prioridade, $descricao, $id);

    if ($stmt->execute()) {
        $mensagem = "<div class='alerta sucesso'>Chamado atualizado com sucesso!</div>";
    } else {
        $mensagem = "<div class='alerta erro'>Erro ao atualizar.</div>";
    }
}

$sql = "SELECT * FROM chamados WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$chamado = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Chamado #<?= $id ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-card">
        <div class="form-header">
            <h2>HelpDesk Industrial</h2>
            <h3>Editar Chamado #<?= $id ?></h3>
        </div>

        <?= $mensagem ?>

        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?= $chamado["id"] ?>">

            <div class="input-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($chamado["titulo"]) ?>" required>
            </div>

            <div class="input-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Aberto" <?= $chamado["status"] == "Aberto" ? 'selected' : '' ?>>Aberto</option>
                    <option value="Em atendimento" <?= $chamado["status"] == "Em atendimento" ? 'selected' : '' ?>>Em atendimento</option>
                    <option value="Finalizado" <?= $chamado["status"] == "Finalizado" ? 'selected' : '' ?>>Finalizado</option>
                </select>
            </div>

            <div class="input-group">
                <label for="prioridade">Prioridade:</label>
                <select id="prioridade" name="prioridade">
                    <option value="Baixa" <?= $chamado["prioridade"] == "Baixa" ? 'selected' : '' ?>>Baixa</option>
                    <option value="Média" <?= $chamado["prioridade"] == "Média" ? 'selected' : '' ?>>Média</option>
                    <option value="Alta" <?= $chamado["prioridade"] == "Alta" ? 'selected' : '' ?>>Alta</option>
                </select>
            </div>

            <div class="input-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required><?= htmlspecialchars($chamado["descricao"]) ?></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Salvar Alterações</button>
                <a href="listar.php"><button type="button" class="btn-link">Voltar</button></a>
            </div>
        </form>
    </div>
</body>
</html>