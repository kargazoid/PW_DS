create database projeto_site;

use projeto_site;

create table contatos(
	id int auto_increment primary key,
    nome varchar (100) not null,
    email varchar (100) not null,
    mensagem text not null
);