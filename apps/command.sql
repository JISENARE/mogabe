create database mogabe;
grant all on mogabe.* to jisenare@localhost identified by '*****';

use mogage

create table users (
    seq int not null auto_increment primary key,
    user_id varchar(256) not null,
	password varchar(256) not null,
	user_name varchar(256) not null,
	point int not null
);

insert into users (user_id, password, user_name, point) values
('sasashou', 'sasashou', 'sasashou', 100),
('ken1988', 'ken1988', 'ken', 100),
('saku39', 'saku39', 'saku', 100),
('kyoda-akira', 'kyoda-akira', 'kyoda', 100),
('yukiot', 'yukiot', 'yukiot', 100),
('takewo', 'takewo','takewo',100),
('talesing', 'talesing','talesing',100),
('itfkubota1985', 'itfkubota1985','kubota',100);

#新規取得でレコード作成
#2枚目以降はcard_numを増加させる
create table user_cards{
	seq int not null auto_increment primary key,
	user_id varchar(256) not null,
	card_id int not null,
	card_num int not null
};

insert into user_cards('user_id', 'card_id', 'card_num') values
('sasashou', 1, 1),
('sasashou', 2, 1),
('ken1988', 3, 1);