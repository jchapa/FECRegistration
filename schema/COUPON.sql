CREATE TABLE COUPON
(
coupon_id int NOT NULL AUTO_INCREMENT,
start_date datetime NOT NULL,
end_date datetime,
name varchar(255) NOT NULL,
code varchar(255) NOT NULL,
PRIMARY KEY (coupon_id)
}