/* BANCO: MySQL MariaDB */
/*CREATES*/
drop database if exists callsys;
create database callsys;
use callsys;
create table setor (
    id int zerofill unsigned primary key auto_increment,
    nome varchar(50) not null,
    ativo boolean not null
);
create table funcao (
    id int zerofill unsigned primary key auto_increment,
    nome varchar(50) not null,
    ativo boolean not null
);
create table nivel_acesso (
    id int zerofill unsigned primary key auto_increment,
    nome varchar(50) not null,
    ativo boolean not null
);
create table usuario (
    id int zerofill unsigned primary key auto_increment,
    id_setor int unsigned zerofill not null,
    id_funcao int unsigned zerofill not null,
    id_nivel_acesso int unsigned zerofill not null,
    nome varchar(100) not null,
    usuario varchar(10) not null,
    senha varchar(10) not null,
    ativo boolean not null,
    foreign key (id_setor) references setor (id),
    foreign key (id_funcao) references funcao (id),
    foreign key (id_nivel_acesso) references nivel_acesso (id)
);
create table equipamento (
    id int zerofill unsigned primary key auto_increment,
    nome varchar(50) not null,
    ativo boolean not null,
    data_hora_cadastro datetime not null
);
create table solicitacao (
    id int zerofill unsigned primary key auto_increment,
    id_usuario int unsigned zerofill not null,
    estado int unsigned not null,
    descricao_problema varchar(1000),
    data_hora_solicitacao datetime not null,
    foreign key (id_usuario) references usuario (id)
);
create table equipamento_solicitacao (
    id int zerofill unsigned primary key auto_increment,
    id_solicitacao int unsigned zerofill not null,
    id_equipamento int unsigned zerofill not null,
    foreign key (id_solicitacao) references solicitacao (id),
    foreign key (id_equipamento) references equipamento (id)
);
/*INSERTS PRIMEIRO LOGIN*/
insert into setor (nome, ativo)
values ('Setor Desenvolvimento', 1);
insert into funcao (nome, ativo)
values ('Desenvolvedor', 1);
insert into nivel_acesso (nome, ativo)
values ('Desenvolvedor', 1);
insert into usuario (
        id_setor,
        id_funcao,
        id_nivel_acesso,
        nome,
        usuario,
        senha,
        ativo
    )
values (
        1,
        1,
        1,
        'a',
        'a',
        'a',
        1
    );