<!-- PHP !-->
<?php
include "conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $solicitante = $_POST["solicitante"] ?? "";
    $email = $_POST["email"] ?? "";
    $setor = $_POST["setor"] ?? "";
    $titulo = $_POST["titulo"] ?? "";
    $descricao = $_POST["descricao"] ?? "";
    $prioridade = $_POST["prioridade"] ?? "";

    $sql = "INSERT INTO chamados (solicitante, email, setor, titulo, descricao, prioridade) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssss", $solicitante, $email, $setor, $titulo, $descricao, $prioridade);

    if ($stmt->execute()) {
        $mensagem = "<div class='alerta sucesso'>Chamado cadastrado com sucesso!</div>";
    } else {
        $mensagem = "<div class='alerta erro'>Erro ao cadastrar chamado.</div>";
    }
}
?>

<!-- HTML !-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Chamado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-card">
        <div class="form-header">
            <h2>HelpDesk Industrial</h2>
            <h3>Novo Chamado</h3>
        </div>

        <?= $mensagem ?>

        <form action="cadastrar.php" method="POST">
            <div class="input-group">
                <label for="solicitante">Solicitante:</label>
                <input type="text" id="solicitante" name="solicitante" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="setor">Setor:</label>
                <input type="text" id="setor" name="setor" required>
            </div>
            <div class="input-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="input-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            <div class="input-group">
                <label for="prioridade">Prioridade:</label>
                <select id="prioridade" name="prioridade">
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-submit">Salvar Chamado</button>
                <a href="listar.php"><button type="button" class="btn-link">Ver Todos</button></a>
            </div>
        </form>
    </div>
</body>
</html>