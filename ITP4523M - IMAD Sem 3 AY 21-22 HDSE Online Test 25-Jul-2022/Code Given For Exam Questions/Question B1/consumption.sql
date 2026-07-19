-- Create and use database consumption
drop database IF EXISTS consumption;
create database consumption character set utf8;
use consumption;

-- Create table: spendDetails
CREATE TABLE `spendDetails` (
  `cardID` varchar(9) NOT NULL,
  `sDateTime` datetime NOT NULL,
  `sCategory` int(1) NOT NULL,
  `sDesc` varchar(30) NOT NULL,
  `sAmount` decimal(6, 1) NOT NULL,
  PRIMARY KEY (cardID, sDateTime)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO spenddetails VALUES ('638619775', '2022-05-18 08:30:00', 1, 'MTR Corportaion Limited', 10.1);
INSERT INTO spenddetails VALUES ('638619775', '2022-05-18 12:30:00', 2, 'Fishball Noodle Limited', 46.0);
INSERT INTO spenddetails VALUES ('638619775', '2022-05-18 17:05:00', 1, 'MTR Corportaion Limited', 10.1);
INSERT INTO spenddetails VALUES ('638619775', '2022-05-18 18:00:00', 2, 'Chicken Yeah Food', 52.0);
INSERT INTO spenddetails VALUES ('512761106', '2022-05-14 10:15:00', 1, 'KMB', 15.0);
INSERT INTO spenddetails VALUES ('512761106', '2022-05-14 17:39:00', 2, 'Bread Baking', 11.0);
INSERT INTO spenddetails VALUES ('512761106', '2022-05-14 16:41:00', 1, 'KMB', 15.0);
