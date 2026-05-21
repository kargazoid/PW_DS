create database faculdade;

use faculdade;

create table alunos (
id int auto_increment primary key,
nome varchar(100),
idade int,
curso varchar(100),
nota decimal(10,2)
);

insert into alunos (nome, idade, curso, nota)
values ("Lucas", 20, "Matemática", 8.5);

insert into alunos (nome, idade, curso, nota)
values ("Mariana", 22, "História", 9.0);

insert into alunos (nome, idade, curso, nota)
values ("Pedro", null, null, null);

insert into alunos (nome, idade, curso, nota)
values ("Ana", 19, null, null);

insert into alunos (nome, idade, curso, nota)
values ("Carlos", null, "Física", null);

insert into alunos (nome, idade, curso, nota)
values ("Fernanda", 21, null, 10.0);

insert into alunos (nome, idade, curso, nota)
values ("Roberto", 18, "Geografia", null);

insert into alunos (id, nome, idade, curso, nota)
values (100, "João", 25, null, null);

insert into alunos (nome, idade, curso, nota)
values ("Beatriz", null, "Química", 7.5);

insert into alunos (nome, idade, curso, nota)
values ("Rafael", 30, "Artes", 6.0);

select * from alunos;

select nome from alunos;

select * from alunos where curso = "Matemática";

select * from alunos where idade >= 20;

select * from alunos where nota <= 7.0;

select * from alunos where id = 5;

select nome nota where curso = "História";

select * where idade = 18;

select * where nota = 10;

select * where nome = "Ana";

set sql_safe_updates = 0;

update alunos
set nota = 9.5
where id = 1;

update alunos
set curso = "Geografia"
where nome = "Mariana";

update alunos
set idade = 21
where id = 3;

update alunos
set nota = 8.0
where curso = "Física";

update alunos
set nome = "Ana Carolina"
where id = 4;

update alunos
set curso = "Design"
where curso = "Artes";

update alunos
set nota = 8.5
where nome = "Beatriz";

update alunos
set idade = 21, nota = 9.0
where nome = "Lucas";

update alunos
set nota = 5.0
where id = 10;

update alunos
set curso = "Ciências da Computação"
where id = 2;

set sql_safe_updates = 1;

truncate table alunos;

