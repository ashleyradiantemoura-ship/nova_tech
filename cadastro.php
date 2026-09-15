<!-- PHP !-->
<?php
$mensagem = "";
$tipoMensagem = "";

// Verifica se o arquivo de conexão existe antes de incluir
if (file_exists("conexao1.php")) {
    include "conexao1.php";
} else {
    // Caso não exista o arquivo conexao.php, exibe mensagem sem quebrar o layout
    $mensagem = "Aviso: O arquivo 'conexao1.php' não foi encontrado na pasta do projeto.";
    $tipoMensagem = "erro";
}

// Executa a lógica apenas se o formulário foi enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($conexao)) {
        $mensagem = "Erro: Sem conexão com o banco de dados.";
        $tipoMensagem = "erro";
    } else {
        $nome = $_POST["nome"] ?? '';
        $email = $_POST["email"] ?? '';
        $setor = $_POST["setor"] ?? '';
        $titulo = $_POST["titulo"] ?? '';
        $descricao = $_POST["descricao"] ?? '';
        $prioridade = $_POST["prioridade"] ?? ''; 

        $status = "Aberto"; 

        $setoresPermitidos = ['Produção', 'Manutenção', 'TI', 'Administrativo', 'Logistíca'];
        $prioridadesPermitidas = ['Baixa', 'Média', 'Alta'];
        $statusPermitidos = ['Aberto', 'Em andamento', 'Finalizado'];

        if (!in_array($setor, $setoresPermitidos)) {
            $mensagem = "Setor inválido.";
            $tipoMensagem = "erro";
        } elseif (!in_array($prioridade, $prioridadesPermitidas)) {
            $mensagem = "Prioridade inválida.";
            $tipoMensagem = "erro";
        } elseif (!in_array($status, $statusPermitidos)) { 
            $mensagem = "Status inválido.";
            $tipoMensagem = "erro";
        } else {
            $nomeEscaped = $conexao->real_escape_string($nome);
            $emailEscaped = $conexao->real_escape_string($email);
            $setorEscaped = $conexao->real_escape_string($setor);
            $tituloEscaped = $conexao->real_escape_string($titulo);
            $descricaoEscaped = $conexao->real_escape_string($descricao);
            $prioridadeEscaped = $conexao->real_escape_string($prioridade);
            $statusEscaped = $conexao->real_escape_string($status);

            $sql = "INSERT INTO chamados (nome, email, setor, titulo, descricao, prioridade, status)
                    VALUES ('$nomeEscaped', '$emailEscaped', '$setorEscaped', '$tituloEscaped', '$descricaoEscaped', '$prioridadeEscaped', '$statusEscaped')"; 

            if ($conexao->query($sql)) {
                $mensagem = "Chamado cadastrado com sucesso!"; 
                $tipoMensagem = "sucesso";
            } else { 
                $mensagem = "Erro ao cadastrar chamado: " . $conexao->error;
                $tipoMensagem = "erro";
            }
        }
    }
}
?>

<!-- HTML !-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de cadastro</title>
    
    <!-- Fontes do Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>

    <div class="form-card">
        <div class="form-header">
            <span class="logo-icon"></span>
            <h2>NovaTech</h2>
            <h3>HelpDesk</h3>
            <p>Precisa de ajuda?<br>Cadastre seu chamado técnico!</p>
        </div>
    
        <!-- Alerta de Sucesso ou Erro do PHP -->
        <?php if (!empty($mensagem)): ?>
            <div class="alerta <?php echo $tipoMensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        
        <!-- Formulário !-->
        <form action="form.php" method="post">
            <div class="input-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>

            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>

            <div class="input-group">
                <label for="setor">Setor</label>
                <select id="setor" name="setor" required>
                    <option value="" disabled selected>Selecione setor</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Logistíca">Logistíca</option>
                    <option value="Manutenção">Manutenção</option>
                    <option value="Produção">Produção</option>
                    <option value="TI">TI</option>
                </select>
            </div>

            <div class="input-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Digite título da solicitação" required>
            </div>

            <div class="input-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Digite a descrição da solicitação" required></textarea>
            </div>

            <div class="input-group">
                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade" required>
                    <option value="" disabled selected>Selecione prioridade</option>
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>
                </select>
            </div>

            <!-- Botões !-->
            <div class="button-group">
                <button type="submit" class="btn-submit">Enviar</button>
                <a href="outrapagina.html">
                    <button type="button" class="btn-link">Ir para chamados</button>
                </a>
            </div>
        </form>
    </div>

</body>
</html>