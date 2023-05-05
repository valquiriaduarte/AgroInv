create table TipoUsuario(
  codTipoUsuario integer primary key,
  nome varchar(20) not null unique
);
create table Usuario(
  codUsuario integer not null primary key,
  nome varchar(100) not null,
  email varchar(100) not null unique,
  senha varchar(255) not null,
  matricula varchar(11) unique,
  telefone varchar(15),
  deletado boolean default false,
  tipoUsuario integer not null,
  constraint usuario_fk_tipoUsuario foreign key(tipoUsuario) references tipoUsuario(codTipoUsuario)
);
create table Curso(
    codCurso integer primary key,
    nome varchar(20) unique not null,
    sigla varchar(3)
);
create table Turma(
    codTurma integer primary key,
    ano integer not null,
    nome varchar(10) not null,
    quantidadeAlunos integer not null,
    curso integer not null,
    constraint curso_fk_turma foreign key(curso) references Curso(codCurso)
);
create table Laboratorio(
	codLaboratorio integer primary key,
	sigla varchar(10) not null unique
);
create table Aula(
  codAula integer primary key,
  titulo varchar(100) not null,
  horario time not null,
  laboratorio integer not null,
  turma integer not null,
  professor integer not null,
  quantAlunos integer not null,
  dataAula date not null,
  constraint turma_fk_aula foreign key(turma) references Turma(codTurma),
  constraint professor_fk_aula foreign key(professor) references Usuario(codUsuario),
  constraint laboratorio_fk_aula foreign key(laboratorio) references Laboratorio(codLaboratorio)
); -- código atualizado, com aquele inserido na documentação - Júlia --
create table Categoria(
    codCategoria integer primary key,
    nome varchar(50) unique not null
);
create table Material(
    codMaterial integer primary key,
    nome varchar(30) not null unique,
    quantidade decimal(6,2),
    categoria integer not null,
    constraint categoria_fk_material foreign key(categoria) references Categoria(codCategoria)
);
create table MateriaisAula(
    codMaterial integer not null,
    codAula integer not null,
    quantidadeUtilizada integer not null,
    constraint materialaula_fk_material foreign key(codMaterial) references Material(codMaterial),
    constraint materialaula_fk_aula foreign key(codAula) references Aula(codAula)
);
create table Alimento(
    codAlimento integer primary key,
    material integer not null,
    unidade varchar(10) not null,
    dataLote date not null, -- data que o alimento chegou
    dataValidade date not null, -- erika quer aquele troço de aparecer "quantos dias faltam para a validade de um alimento chegar"
    constraint material_fk_alimento foreign key(material) references Material(codMaterial)
);