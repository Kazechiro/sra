create schema sra;
use sra;


CREATE TABLE usuario(
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100),
  senha VARCHAR(20),
  adm int(1)
);

create table tarefa(
id_tarefa int auto_increment primary key,
nome_tarefa varchar(100) not null,
desc_tarefa varchar(255),
concluida tinyint(1)
);

create table relatorio(
id_relatorio int primary key auto_increment,
titulo varchar(75),
descricao varchar(1000),
data_relatorio date,
hora time
);

insert into usuario(id_usuario,nome,email,senha,adm)
values ('','Arnaldo Samuel','arnaldo221@gmail.com','arnaldose','0'),
		('','kaio','kaio221@gmail.com','kaiose','1');