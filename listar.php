<?php
include "conexao.php";

$titulo = $_GET["titulo"] ?? "";
$status = $_GET["status"] ?? "";

$sql = "SELECT * FROM chamados WHERE 1=1";
$params = [];
$types = "";

if ($titulo != "") {
    $sql .= " AND titulo LIKE ?";
    $params[] = "%$titulo%";
    $types .= "s";
}

if ($status != "" && $status != "Todos") {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

$sql .= " ORDER BY data_abertura DESC";

$stmt = $conexao->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Chamados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="list-card">
        <div class="form-header">
            <h2>Lista de Chamados</h2>
            <h3>HelpDesk Industrial</h3>
        </div>

        <form action="listar.php" method="GET">
            <div class="input-group">
                <label for="titulo">Buscar por título:</label>
                <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($titulo) ?>">
            </div>
            <div class="input-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Todos" <?= $status == "Todos" ? 'selected' : '' ?>>Todos</option>
                    <option value="Aberto" <?= $status == "Aberto" ? 'selected' : '' ?>>Aberto</option>
                    <option value="Em atendimento" <?= $status == "Em atendimento" ? 'selected' : '' ?>>Em atendimento</option>
                    <option value="Finalizado" <?= $status == "Finalizado" ? 'selected' : '' ?>>Finalizado</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-submit">Filtrar</button>
            </div>
        </form>

        <div class="tabela-container">
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Título</th>
                        <th>Solicitante</th>
                        <th>Setor</th>
                        <th>Prioridade</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while ($chamado = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= $chamado["id"] ?></td>
                                <td><?= htmlspecialchars($chamado["titulo"]) ?></td>
                                <td><?= htmlspecialchars($chamado["solicitante"]) ?></td>
                                <td><?= htmlspecialchars($chamado["setor"]) ?></td>
                                <td><?= $chamado["prioridade"] ?></td>
                                <td><?= $chamado["status"] ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($chamado["data_abertura"])) ?></td>
                                <td>
                                    <a href="visualizar.php?id=<?= $chamado["id"] ?>">Ver</a> |
                                    <a href="editar.php?id=<?= $chamado["id"] ?>">Editar</a> |
                                    <form action="excluir.php" method="POST" style="display:inline;" onsubmit="return confirm('Deseja excluir?');">
                                        <input type="hidden" name="id" value="<?= $chamado["id"] ?>">
                                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="8" style="text-align:center;">Nenhum chamado encontrado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="button-group">
            <a href="cadastrar.php"><button type="button" class="btn-submit">Cadastrar Chamado</button></a>
            <a href="index.html"><button type="button" class="btn-link">Início</button></a>
        </div>
    </div>
</body>
</html>