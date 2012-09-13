CREATE TABLE REGISTRATION
(
registration_id int NOT NULL AUTO_INCREMENT,
family_id int,
payment_id int,
coupon_id int,
code referral(255) NOT NULL,
PRIMARY KEY (registration_id)
}