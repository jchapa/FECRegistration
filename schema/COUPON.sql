/* Create a coupon - using ints for discounts */

CREATE TABLE COUPON
(
coupon_id int NOT NULL AUTO_INCREMENT,
start_date datetime NOT NULL,
end_date datetime,
family_discount int,
individual_discount int,
name varchar(255) NOT NULL,
code varchar(255) NOT NULL,
PRIMARY KEY (coupon_id)
);