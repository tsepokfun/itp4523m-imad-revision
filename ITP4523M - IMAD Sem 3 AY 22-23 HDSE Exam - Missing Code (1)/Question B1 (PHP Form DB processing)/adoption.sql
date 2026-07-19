-- Create and use database adoption
drop database IF EXISTS adoption;
create database adoption character set utf8;
use adoption;


-- Create table: animals
CREATE TABLE `animals` (
  `aID` varchar(5) NOT NULL,
  `aName` varchar(20) NOT NULL,
  `aSpecies` varchar(10) NOT NULL,
  `aBreed` varchar(30) NOT NULL,
  `aFile` varchar(50) NOT NULL,
  PRIMARY KEY (aID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO animals VALUES ('85669', 'Dom', 'dog', 'Mongrel', '85669.jpg');
INSERT INTO animals VALUES ('84510', 'Rocky', 'dog', 'Sharpei Cross', '84510.jpg');
INSERT INTO animals VALUES ('82911', 'Candy', 'cat', 'Domestic Short Hair', '82911.jpg');
INSERT INTO animals VALUES ('83704', 'Cindy', 'cat', 'Maine Coon', '83704.jpg');





