create database mogabe;
grant all on mogabe.* to jisenare@localhost identified by '*****';

use mogage

create table users (
    seq int not null auto_increment primary key,
    user_id varchar(256) not null,
	password varchar(256) not null
);

insert into users (user_id, password) values
('sasashou', 'sasashou'),
('ken1988', 'ken1988'),
('saku39', 'saku39'),
('kyoda-akira', 'kyoda-akira'),
('yukiot', 'yukiot'),
('takewo', 'takewo'),
('talesing', 'talesing'),
('itfkubota1985', 'itfkubota1985');