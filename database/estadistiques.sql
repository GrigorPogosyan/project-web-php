-- SCRIPT GENERAR LA BASE DE DADES ESTADÍSTIQUES
-- 
-- IMPLANTACIÓ D'APLICACIONS WEB // PHP

DROP DATABASE IF EXISTS estadistiques;
CREATE DATABASE estadistiques;

USE estadistiques;

CREATE TABLE dades (
	data DATETIME,
	mitjana_humitat FLOAT(3,2),
	temperatura FLOAT(5,2),
    
    CONSTRAINT pk_dades PRIMARY KEY (data)
);

CREATE TABLE usuaris (
	nom VARCHAR(30),
    password VARCHAR(255),
    
    CONSTRAINT pk_usuaris PRIMARY KEY (nom)
);

# CREACIÓ D'USUARI 
DROP USER IF EXISTS 'user'@'localhost' ;
CREATE USER 'user'@'localhost' IDENTIFIED BY 'aplicacions';

#ASSIGNR L'USUARI 'USER' EN LA BASE DE DADES de Estadistiques.
GRANT ALL PRIVILEGES ON estadistiques.* TO 'user'@'localhost';
#repair table mysql.db use_frm;

#Inserts de Prova
INSERT INTO dades (mitjana_humitat,temperatura,data)
VALUES (50,18,'2023-1-12'),
    (60,17,'2023-1-13'),
    (80,16,'2023-1-14'),
    (70,18,'2023-2-12'),
    (50,22,'2023-2-13'),
    (40,21,'2023-2-14'),
    (70,19,'2023-3-12'),
    (40,22,'2023-3-13'),
    (35,25,'2023-3-14');