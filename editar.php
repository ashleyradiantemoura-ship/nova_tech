<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Excluir chamado</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-card">

        <div class="form-header">
            <h2>HelpDesk Industrial</h2>
            <h3>Excluir chamado</h3>
            <p>Informe o código do chamado que deseja excluir.</p>
        </div>

        <form action="excluir.php" method="POST">

            <div class="input-group">

                <label for="id">Código do chamado:</label>

                <input
                    type="number"
                    id="id"
                    name="id"
                    placeholder="Digite o código"
                    required
                >

            </div>

            <div class="button-group">

                <button
                    type="submit"
                    class="btn-submit"
                    onclick="return confirm('Tem certeza que deseja excluir este chamado?');"
                >
                    Excluir
                </button>

                <a href="listar.php">
                    <button type="button" class="btn-link">
                        Voltar
                    </button>
                </a>

            </div>

        </form>

    </div>

</body>

</html>
