create database safe;
/*drop database safe;*/
use safe;

create table User( 
	id_User int primary key auto_increment, 
    user_name varchar(50) not null,
	email varchar(50) not null,
	pass_word varchar(250) not null
)engine=innodb; 	

INSERT INTO User(id_User, User_name, email, pass_word) Values 
				 ( 1, "Karolyne","karolyne@gmail.com" , MD5('123'));

select * from User;