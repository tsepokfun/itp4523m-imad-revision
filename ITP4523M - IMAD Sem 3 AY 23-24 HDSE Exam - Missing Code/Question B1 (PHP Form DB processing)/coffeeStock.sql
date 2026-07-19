drop database IF EXISTS coffeeStock;
create database coffeeStock character set utf8;
use coffeeStock;

CREATE TABLE `coffeeBean` (
  `cbID` varchar(5) NOT NULL,
  `cbName` varchar(20) NOT NULL,
  `caLevel` int(1) NOT NULL,
  `roLevel` int(1) NOT NULL,
  PRIMARY KEY (cbID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO coffeeBean VALUES ('c1101', 'Decaf Peru', 1, 1);
INSERT INTO coffeeBean VALUES ('c2201', 'Tanzania Isaiso', 2, 2);
INSERT INTO coffeeBean VALUES ('c2301', 'Peru Norandino', 2, 3);
INSERT INTO coffeeBean VALUES ('c3301', 'Bali Kintamani', 3, 3);
INSERT INTO coffeeBean VALUES ('c3201', 'Java Dadar', 3, 2);