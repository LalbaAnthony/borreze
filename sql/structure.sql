
CREATE DATABASE IF NOT EXISTS 'borreze' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE 'borreze';

#------------------------------------------------------------
# Table: page
#------------------------------------------------------------

DROP TABLE IF EXISTS page;
CREATE TABLE page(
        idPage INT AUTO_INCREMENT NOT NULL UNIQUE,
        slugPage VARCHAR (50) NOT NULL UNIQUE,
        nomPage VARCHAR (50) NOT NULL UNIQUE,
        pathPage VARCHAR (50) NOT NULL UNIQUE,
        titrePage VARCHAR (150) NOT NULL,
        sousTitrePage VARCHAR (250) NOT NULL,
        contenuPage VARCHAR (5000),
        navBarPosPage BOOLEAN DEFAULT FALSE,
	CONSTRAINT page_PK PRIMARY KEY (idPage)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: menu
#------------------------------------------------------------

DROP TABLE IF EXISTS menu;
CREATE TABLE menu(
        idMenu INT AUTO_INCREMENT NOT NULL UNIQUE,
        lundiDate DATE NOT NULL,
        lundiRepas VARCHAR (100),
        mardiRepas VARCHAR (100),
        mercrediRepas VARCHAR (100),
        jeudiRepas VARCHAR (100),
        vendrediRepas VARCHAR (100),
        isLundiFerie BOOLEAN NOT NULL DEFAULT FALSE,
        isMardiFerie BOOLEAN NOT NULL DEFAULT FALSE,
        isMercrediFerie BOOLEAN NOT NULL DEFAULT FALSE,
        isJeudiFerie BOOLEAN NOT NULL DEFAULT FALSE,
        isVendrediFerie BOOLEAN NOT NULL DEFAULT FALSE,
        lastModifDateTimeMenu DATETIME NOT NULL DEFAULT NOW(),
	CONSTRAINT idMenu_PK PRIMARY KEY (idMenu)
)ENGINE=InnoDB;
