create database Information;
use Information;
create table userInfo(
IdNo int primary key auto_increment,
Name varchar(20),
phoneNumber varchar(15),
address varchar(100),		
email varchar(35)
);	
ALTER TABLE userInfo AUTO_INCREMENT = 1;
select * from userInfo; 	
ALTER TABLE userInfo MODIFY IdNo INT NOT NULL AUTO_INCREMENT;
SHOW CREATE TABLE userInfo;
ALTER TABLE userinfo 
MODIFY IdNo INT NOT NULL,
ADD PRIMARY KEY (IdNo);
ALTER TABLE userinfo 
MODIFY IdNo INT NOT NULL AUTO_INCREMENT;
ALTER TABLE userinfo 
MODIFY IdNo INT NOT NULL AUTO_INCREMENT;
SET SQL_SAFE_UPDATES = 0;
delete from userInfo ;

drop table userinfo;


