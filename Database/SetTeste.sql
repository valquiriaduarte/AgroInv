insert into Curso(nome, sigla) values ('Agropecuária', 'TA'), ('Meio Ambiente', 'MA'), ('Informática', 'TI'), ('Agroindústria', 'AI');

insert into Turma(ano, nome, quantidadeAlunos, curso) values (2022, 'TA101', 30, 1), (2022, 'TA102', 30, 1), (2022, 'MA103', 30, 2), (2022, 'MA104', 30, 2), (2022, 'TI105', 30, 3), (2022, 'AI107', 30, 4), (2022, 'TA201', 30, 1), (2022, 'TA202', 30, 1), (2022, 'MA203', 30, 2), (2022, 'MA204', 30, 2), (2022, 'TI205', 30, 3), (2022, 'AI207', 30, 4), (2022, 'TA301', 30, 1), (2022, 'TA302', 30, 1), (2022, 'MA303', 30, 2), (2022, 'MA304', 30, 2), (2022, 'TI305', 30, 3), (2022, 'AI306', 30, 4), (2022, 'AI307', 30, 4);

insert into Laboratorio(sigla) values ("Lab1"), ("Lab2"), ("Lab3"); 

insert into tipoUsuario(nome) values ("Professor"), ("Administrador");

insert into Usuario(nome, email, senha, telefone, tipoUsuario) values ("Usuario 1", "usuario1@gmail.com", "usuario123", "21 9999-99990", 1), ("Usuario 2", "usuario2@gmail.com", "usuario123", "21 9999-99990", 1), ("Usuario 3", "usuario3@gmail.com", "usuario123", "21 9999-99990", 2), ("Usuario 4", "usuario4@gmail.com", "usuario123", "21 9999-99990", 2), ("Usuario 5", "usuario5@gmail.com", "usuario123", "21 9999-99990", 1), ("Usuario 6", "usuario6@gmail.com", "usuario123", "21 9999-99990", 1), ("Usuario 7", "usuario7@gmail.com", "usuario123", "21 9999-99990", 1), ("Usuario 8", "usuario8@gmail.com", "usuario123", "21 9999-99990", 1);

insert into Categoria(nome) values ("Ferramenta"), ("Vegetal"), ("Derivado Animal"), ("Carne"); 

insert into Material(nome, quantidade, categoria) values ("Ovo", 50, 3), ("Faca", 51, 1), ("Carne de Coelho", 52, 4), ("Couve", 53, 2);

insert into Alimento(material, unidade, dataLote, dataValidade) values (1, "uni", "23-09-2022", "23-09-2022"), (3, "kg", "23-09-2022", "23-09-2022"), (4, "kg", "23-09-2022", "23-09-2022");

insert into Aula(titulo, horario, laboratorio, turma, quantAlunos, dataAula, professor) values ("Oi1", "07:00:00", 1, 1, 30, "23-09-2022", 1), ("Oi2", "08:30:00", 1, 2, 30, "23-09-2022", 2), ("Oi3", "09:20:00", 1, 3, 30, "23-09-2022", 2);

insert into MateriaisAula(codMaterial, codAula, quantidadeUtilizada) values (1, 1, 10), (2, 1, 30), (3, 1, 10);