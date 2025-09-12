create table usuarios_seguidores(
	id int not null primary key auto_increment,
    id_usuario int not null,
    id_usuario_seguindo int not null
);

ALTER TABLE usuarios_seguidores RENAME COLUMN id_usuario_seguidores TO id_usuario_seguindo;

select * from usuarios_seguidores;
select * from tweets;
select * from usuarios;