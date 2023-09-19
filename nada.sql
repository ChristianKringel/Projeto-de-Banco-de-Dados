USE `database`;
select * from criadorConteudo;
create table conta(
	telefone bigint,
    cpf bigint(11) not null,
    email varchar(50),
    endereco varchar(50),
    senha varchar(20),
    primary key(cpf)
);

create table criadorConteudo(
	idCriador int(8) not null auto_increment,
    nacionalidadeArtista varchar(50) default 'Brasileiro', 
    descricao varchar(100) default ' ',
    nomeArtistico varchar(50) not null,
    PRIMARY KEY(idCriador),
    cpfCriador bigint(11),
    constraint fk_cpfCriador foreign key(cpfCriador) references conta(cpf)
);

create table usuarioComum (
	nickname varchar(50),
    idUsuario int(8) not null auto_increment,
    PRIMARY KEY(idUsuario),
    cpfComum bigint(11),
    constraint fk_cpfComum foreign key(cpfComum) references conta (cpf)
);

create table artistaCRegistro (
	numeroISWC int,
    primary key(numeroISWC)
);

create table artistaSRegistro (
	dataCriacao date, 
    codigoRegistro int(8) not null auto_increment,
    cpfComum bigint(11),
    constraint fk_CpfComum foreign key(cpfComum) references usuarioComum(cpfComum),
    primary key(cpfComum) 
);

create table Status( 
	 statusRegistro boolean, 
     cpfCriador bigint(11), 
     constraint fk_cpfCriador foreign key(cpfCriador) references CriadorConteudo(cfpCriador),
     primary key(cpfCriador)
);

create table verifica (
	dataVerificacao date	
    
    -- ##########################################################################
    -- Precisa ter uma relação de foreign key com status e artista com registro
);

create table generoArtista (
	categoria varchar(50),
    codigoGenero int(8) not null auto_increment,
    primary key (codigoGenero)
);

create table artista (
	codigoArtista int(8) not null auto_increment, 
    anoInicio int(4), 
    primary key(codigoArtista)
);

USE `database`;
SELECT * FROM conta ;

SHOW DATABASES