/*BANCO
    MariaDB
*/

/*CREATES*/
create table setor (
    numero int primary key auto_increment,
    nome varchar(50) not null,
    ativo boolean not null
);

create table funcao (
    codigo int primary key auto_increment,
    nome varchar(50) not null,
    ativo boolean not null
);

create table nivel_acesso (
    codigo int primary key auto_increment,
    nome varchar(20) not null,
    ativo boolean not null
);

create table usuario (
    codigo int primary key auto_increment,
    nome varchar(50) not null,
    usuario varchar(10) not null,
    senha varchar(10) not null,
    ativo boolean not null,
    numero_setor int not null,
    codigo_funcao int not null,
    codigo_nivel_acesso int not null,
    foreign key (numero_setor) references setor (numero),
    foreign key (codigo_funcao) references funcao (codigo),
    foreign key (codigo_nivel_acesso) references nivel_acesso (codigo)
);

create table equipamento (
    codigo int primary key auto_increment,
    nome varchar(50) not null,
    quantidade int not null,
    ativo boolean not null,
    data_hora_cadastro datetime not null
);

create table solicitacao (
    codigo int primary key auto_increment,
    estado int not null,
    data_hora datetime not null
);

create table usuario_realiza_solicitacao_equipamento (
    codigo int primary key auto_increment,
    codigo_usuario int not null,
    codigo_equipamento int not null,
    codigo_solicitacao int not null,
    foreign key (codigo_usuario) references usuario (codigo),
    foreign key (codigo_equipamento) references equipamento (codigo),
    foreign key (codigo_solicitacao) references solicitacao (codigo)
);

/*INSERTS TESTE*/
insert into setor (
    nome, 
    ativo
) 
values (
    'Setor Teste', 
    1
);

insert into funcao (
    nome, 
    ativo
) 
values (
    'Função Teste', 
    1
);

insert into nivel_acesso (
    nome, 
    ativo
) 
values (
    'DEV', 
    1
);

insert into usuario (
    nome, 
    usuario, 
    senha, 
    ativo, 
    numero_setor, 
    codigo_funcao, 
    codigo_nivel_acesso
)
values (
    'Dev',
    'd',
    'e',
    1,
    1,
    1,
    1
);

insert into equipamento (
    nome,
    quantidade,
    ativo,
    data_hora_cadastro
)
values (
    "Mouse Logitech",
    3,
    1,
    NOW()
);

insert into solicitacao (    
    estado,
    data_hora
)
values (
    0,
    NOW()
);

insert into usuario_realiza_solicitacao_equipamento (    
    codigo_usuario,
    codigo_equipamento,
    codigo_solicitacao
)
values (
    1,
    1,
    1
);
