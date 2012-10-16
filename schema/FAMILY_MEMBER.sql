CREATE TABLE FAMILY_MEMBER
(
family_member_id int NOT NULL AUTO_INCREMENT,
family_id int NOT NULL,
first_name varchar(255),
last_name varchar(255),
age varchar(255),
PRIMARY KEY (family_member_id),
FOREIGN KEY (family_id) REFERENCES FAMILY(family_id)
)