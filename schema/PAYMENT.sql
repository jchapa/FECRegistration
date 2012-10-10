CREATE TABLE PAYMENT
(
payment_id int NOT NULL AUTO_INCREMENT,
family_id int,
amount double,
status int,
PRIMARY KEY (payment_id)
)