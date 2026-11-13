CREATE DATABASE turismo;
USE turismo;

CREATE TABLE pontos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    endereco VARCHAR(255) DEFAULT NULL,
    url_imagem_ponto VARCHAR(255) DEFAULT NULL
);

INSERT INTO pontos (nome, descricao, endereco) VALUES
('Cachoeira das Palmeiras', 'Queda d''água no Rio Coxim, muito procurada no verão.', 'Zona rural de Coxim'),
('Encontro dos Rios', 'Ponto onde o Rio Coxim encontra o Rio Taquari.', 'Centro de Coxim');