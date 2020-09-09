/* BANCO: MariaDB */

/*CREATES*/
create database callsys;

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
    data_hora_solicitacao datetime not null
);

create table equipamento_solicitacao (
    id int zerofill unsigned primary key auto_increment,
    id_solicitacao int unsigned zerofill not null,
    id_equipamento int unsigned zerofill not null,
    foreign key (id_solicitacao) references solicitacao (id),
    foreign key (id_equipamento) references equipamento (id)
);

/*INSERTS TESTE*/
insert into setor (
    nome, 
    ativo
) 
values (
    'Setor Desenvolvimento', 
    1
);

insert into funcao (
    nome, 
    ativo
) 
values (
    'Desenvolvedor', 
    1
);

insert into nivel_acesso (
    nome, 
    ativo
) 
values (
    'Desenvolvedor', 
    1
);

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
    'admin',
    'admin@',
    'admin',
    1    
);

insert into equipamento (
    nome,
    ativo,
    data_hora_cadastro
)
values (
    'Mouse',    
    1,
    NOW()
);

insert into solicitacao (    
    id_usuario,
    estado,
    descricao_problema,
    data_hora_solicitacao
)
values (
    1,
    1,
    'Mouse com defeito',
    NOW()
);

insert into equipamento_solicitacao (    
    id_solicitacao,
    id_equipamento    
)
values (
    1,
    1    
);
