
set sql_mode='';

create table user(
	id int not null auto_increment primary key,
	name varchar(50),
	lastname varchar(50),
	username varchar(50),
	email varchar(255),
	password varchar(60),
	image varchar(255),
	is_active boolean not null default 1,
	is_admin boolean not null default 0,
	created_at datetime
);

insert into user(name,lastname,email,password,is_active,is_admin,created_at) value ("Administrador", "","admin","90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad",1,1,NOW());

create table category(
	id int not null auto_increment primary key,
	image varchar(255),
	name varchar(50),
	description text,
	created_at datetime
);

create table product(
	id int not null auto_increment primary key,
	image varchar(255),
	barcode varchar(50),
	name varchar(50),
	description text,
	inventary_min int default 10,
	inventary_in int default 10,
	price_in float,
	price_out float,
	unit varchar(255),
	presentation varchar(255),
	user_id int,
	category_id int,
	created_at datetime,
	is_active boolean default 1,
	foreign key (category_id) references category(id),
	foreign key (user_id) references user(id)
);

/*
person kind
1.- Client
2.- Provider
*/
create table person(
	id int not null auto_increment primary key,
	image varchar(255),
	name varchar(255),
	lastname varchar(50),
	company varchar(50),
	address1 varchar(50),
	address2 varchar(50),
	phone1 varchar(50),
	phone2 varchar(50),
	email1 varchar(50),
	email2 varchar(50),
	kind int,
	created_at datetime
);


create table operation_type(
	id int not null auto_increment primary key,
	name varchar(50)
);

insert into operation_type (name) value ("entrada");
insert into operation_type (name) value ("salida");



create table box(
	id int not null auto_increment primary key,
	created_at datetime
);



create table sell(
	id int not null auto_increment primary key,
	person_id int ,
	user_id int ,
	operation_type_id int default 2,
	box_id int,

	total double,
	cash double,
	discount double,

	foreign key (box_id) references box(id),
	foreign key (operation_type_id) references operation_type(id),
	foreign key (user_id) references user(id),
	foreign key (person_id) references person(id),
	created_at datetime
);

create table operation(
	id int not null auto_increment primary key,
	product_id int,
	q float,
	operation_type_id int,
	sell_id int,
	created_at datetime,
	foreign key (product_id) references product(id),
	foreign key (operation_type_id) references operation_type(id),
	foreign key (sell_id) references sell(id)
);



