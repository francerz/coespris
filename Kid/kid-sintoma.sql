create table kid(
id_kid int not null auto_increment,
kd_nombre varchar(220) not null,
kd_apaterno varchar(220) not null,
kd_amaterno varchar(220) not null,
kd_genero tinyint not null,
kd_fnacimiento date not null,
kd_foto varchar(380) not null,
PRIMARY KEY(id_kid)
)

create table sintoma(
id_sintoma int not null auto_increment,
sin_nombre varchar(380) not null,
sin_tipo varchar(200) not null,
PRIMARY KEY	(id_sintoma)
)