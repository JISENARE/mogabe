#カードのマスタテーブル
#
#package_id：パッケージ名。「第2弾○○」みたいな
#pack_num：パッケージ内での通し番号。card_idの定義でどうにかする手もある
create table cards (
    card_id varchar(256) not null primary key,
	card_name varchar(256) not null,
	package_id varchar(256) not null,
	pack_num int not null,
	card_rank int not null,
	legend varchar(256),
	parameter_1 int,
	parameter_2 int,
	parameter_3 int,
	parameter_4 int
);
