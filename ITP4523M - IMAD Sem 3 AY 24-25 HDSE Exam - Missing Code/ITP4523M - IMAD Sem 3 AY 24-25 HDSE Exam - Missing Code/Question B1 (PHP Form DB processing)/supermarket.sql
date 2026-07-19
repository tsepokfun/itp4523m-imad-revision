drop database IF EXISTS supermarket;
create database supermarket character set utf8;
use supermarket;

CREATE TABLE `product` (
  `prodID` varchar(4) NOT NULL,
  `prodCategory` varchar(10) NOT NULL,
  `prodName` varchar(50) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` int(3) NOT NULL,
  PRIMARY KEY (prodID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO product VALUES ('f001', 'fruit', 'Apple', '1EA', 6);
INSERT INTO product VALUES ('f002', 'fruit', 'Orange', '1EA', 10);
INSERT INTO product VALUES ('f003', 'fruit', 'Blueberry', '125GM', 15);
INSERT INTO product VALUES ('s001', 'snacks', 'Sausage', '132GM', 10);
INSERT INTO product VALUES ('s002', 'snacks', 'Jelly', '120GM', 20);
INSERT INTO product VALUES ('m001', 'meat', 'Beef', '280GM', 46);
