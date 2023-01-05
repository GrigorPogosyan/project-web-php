-- SCRIPT GENERAR LA BASE DE DADES ESTADÍSTIQUES
--
-- IMPLANTACIÓ D'APLICACIONS WEB // PHP

DROP DATABASE IF EXISTS estadistiques;
CREATE DATABASE estadistiques;

USE estadistiques;

CREATE TABLE dades (
	data DATETIME NOT NULL,
	mitjana_humitat FLOAT(5,2) NOT NULL,
	temperatura FLOAT(5,2) NOT NULL
);

CREATE TABLE usuaris (
	nom VARCHAR(30),
    password VARCHAR(255)
);

# CREACIÓ D'USUARI
DROP USER IF EXISTS 'user'@'localhost' ;
CREATE USER 'user'@'localhost' IDENTIFIED BY 'aplicacions';

#ASSIGNR L'USUARI 'USER' EN LA BASE DE DADES de Estadistiques.
GRANT ALL PRIVILEGES ON estadistiques.* TO 'user'@'localhost';
#repair table mysql.db use_frm;

#INSERTS DE PROVA
INSERT INTO dades (mitjana_humitat,temperatura,data)
VALUES (50,12,'2022-12-12'),
    (60,13,'2022-12-13'),
    (76,14,'2022-01-01'),
    (80,12,'2022-01-07'),
    (57,16,'2022-01-15'),
    (77,15,'2022-02-03'),
    (76,14,'2022-02-17'),
    (39,17,'2022-03-04'),
    (36,18,'2022-03-25'),
    (30,18,'2022-04-09'),
    (43,19,'2022-04-13'),
    (30,22,'2022-05-02'),
    (33,20,'2022-05-17'),
    (40,22,'2022-06-07'),
    (34,21,'2022-06-16'),
    (30,24,'2022-07-22'),
    (37,27,'2022-07-25'),
    (36,29,'2022-08-03'),
    (40,26,'2022-08-22'),
    (43,24,'2022-09-23'),
    (36,23,'2022-09-29'),
    (49,19,'2022-10-12'),
    (46,17,'2022-10-19'),
    (67,14,'2022-11-01'),
    (76,15,'2022-11-25'),
    (34,5,'2023-01-03'),
    (45,30,'2023-01-03');
    
#USUARIS PER FER LOGIN
INSERT INTO usuaris (nom, password) VALUES ("Grigor","$2y$10$kM4wglgu0f9U89qv9wvTqeg.Ad.ULWOQyuas52wKzGYJf8KZue1hq");