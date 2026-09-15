CREATE TABLE chamados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    setor ENUM('Produção', 'Manutenção', 'TI', 'Administrativo') NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao VARCHAR(1000) NOT NULL,
    prioridade ENUM('Baixa', 'Média', 'Alta') NOT NULL,
    status ENUM('Aberto', 'Em andamento', 'Fechado') NOT NULL DEFAULT 'Aberto',
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP
);