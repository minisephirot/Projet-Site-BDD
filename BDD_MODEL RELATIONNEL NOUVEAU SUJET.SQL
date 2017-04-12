-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                      Oracle Version 10g
--                        (12/4/2017 16:07:41)
-- -----------------------------------------------------------------------------
--      Nom de la base : BDD_Model Relationnel nouveau sujet
--      Projet : 
--      Auteur : This
--      Date de dernière modification : 12/4/2017 15:59:11
-- -----------------------------------------------------------------------------

DROP TABLE MUSIQUE CASCADE CONSTRAINTS;

DROP TABLE LIVRE CASCADE CONSTRAINTS;

DROP TABLE FILM CASCADE CONSTRAINTS;

DROP TABLE MEDIA CASCADE CONSTRAINTS;

DROP TABLE PRODUIS CASCADE CONSTRAINTS;

DROP TABLE ARTISTE CASCADE CONSTRAINTS;

DROP TABLE PALMARES CASCADE CONSTRAINTS;

DROP TABLE HISTORIQUE_NB_PARTAGE CASCADE CONSTRAINTS;

DROP TABLE ALBUM CASCADE CONSTRAINTS;

DROP TABLE PARTAGER CASCADE CONSTRAINTS;

DROP TABLE UTILISATEUR CASCADE CONSTRAINTS;

-- -----------------------------------------------------------------------------
--       CREATION DE LA BASE 
-- -----------------------------------------------------------------------------

CREATE DATABASE BDD_Model Relationnel nouveau sujet;

-- -----------------------------------------------------------------------------
--       TABLE : MUSIQUE
-- -----------------------------------------------------------------------------

CREATE TABLE MUSIQUE
   (
    TITRE CHAR(32)  NOT NULL,
    NOM_ALBUM CHAR(32)  NOT NULL,
    DURÉE CHAR(16)  NOT NULL,
    GENRE CHAR(32)  NOT NULL
,   CONSTRAINT PK_MUSIQUE PRIMARY KEY (TITRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE MUSIQUE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_MUSIQUE_MEDIA
     ON MUSIQUE (TITRE ASC)
    ;

CREATE  INDEX I_FK_MUSIQUE_ALBUM
     ON MUSIQUE (NOM_ALBUM ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : LIVRE
-- -----------------------------------------------------------------------------

CREATE TABLE LIVRE
   (
    GENRE CHAR(32)  NOT NULL,
    TITRE CHAR(32)  NOT NULL
,   CONSTRAINT PK_LIVRE PRIMARY KEY (TITRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE LIVRE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_LIVRE_MEDIA
     ON LIVRE (TITRE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : FILM
-- -----------------------------------------------------------------------------

CREATE TABLE FILM
   (
    TITRE CHAR(32)  NOT NULL,
    GENRE CHAR(32)  NOT NULL
,   CONSTRAINT PK_FILM PRIMARY KEY (TITRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE FILM
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_FILM_MEDIA
     ON FILM (TITRE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : MEDIA
-- -----------------------------------------------------------------------------

CREATE TABLE MEDIA
   (
    TITRE CHAR(32)  NOT NULL,
    EDITEUR CHAR(32)  NOT NULL,
    DATE_EDITION DATE  NOT NULL,
    URL CHAR(128)  NULL,
    NB_PARTAGE NUMBER(10,2)  NOT NULL,
    NOM_ARTISTE CHAR(32)  NOT NULL
,   CONSTRAINT PK_MEDIA PRIMARY KEY (TITRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE MEDIA
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_MEDIA_ARTISTE
     ON MEDIA (NOM_ARTISTE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : PRODUIS
-- -----------------------------------------------------------------------------

CREATE TABLE PRODUIS
   (
    NOM_ARTISTE CHAR(32)  NOT NULL,
    TITRE CHAR(32)  NOT NULL
,   CONSTRAINT PK_PRODUIS PRIMARY KEY (TITRE, NOM_ARTISTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PRODUIS
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PRODUIS_ARTISTE
     ON PRODUIS (NOM_ARTISTE ASC)
    ;

CREATE  INDEX I_FK_PRODUIS_MEDIA
     ON PRODUIS (TITRE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : ARTISTE
-- -----------------------------------------------------------------------------

CREATE TABLE ARTISTE
   (
    NOM_ARTISTE CHAR(32)  NOT NULL,
    NOM CHAR(32)  NOT NULL,
    PRENOM CHAR(32)  NOT NULL
,   CONSTRAINT PK_ARTISTE PRIMARY KEY (NOM_ARTISTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PALMARES
-- -----------------------------------------------------------------------------

CREATE TABLE PALMARES
   (
    NOM_ARTISTE CHAR(32)  NOT NULL,
    RANG_SEMAINE NUMBER(10,2)  NOT NULL,
    RANG_TOTAL NUMBER(10,2)  NOT NULL
,   CONSTRAINT PK_PALMARES PRIMARY KEY (NOM_ARTISTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PALMARES
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PALMARES_ARTISTE
     ON PALMARES (NOM_ARTISTE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : HISTORIQUE_NB_PARTAGE
-- -----------------------------------------------------------------------------

CREATE TABLE HISTORIQUE_NB_PARTAGE
   (
    DATE_DEB DATE  NOT NULL,
    DATE_FIN DATE  NOT NULL,
    NB_PARTAGE NUMBER(10,2)  NOT NULL,
    NOM_ARTISTE CHAR(32)  NOT NULL,
    TITRE CHAR(32)  NOT NULL
,   CONSTRAINT PK_ARTISTE PRIMARY KEY (TITRE, NOM_ARTISTE, DATE_DEB, DATE_FIN)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE HISTORIQUE_NB_PARTAGE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_HISTORIQUE_NB_PARTAGE_ART
     ON HISTORIQUE_NB_PARTAGE (NOM_ARTISTE ASC)
    ;

CREATE  INDEX I_FK_HISTORIQUE_NB_PARTAGE_MED
     ON HISTORIQUE_NB_PARTAGE (TITRE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : ALBUM
-- -----------------------------------------------------------------------------

CREATE TABLE ALBUM
   (
    NOM_ALBUM CHAR(32)  NOT NULL,
    TYPE CHAR(32)  NOT NULL
,   CONSTRAINT PK_ALBUM PRIMARY KEY (NOM_ALBUM)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PARTAGER
-- -----------------------------------------------------------------------------

CREATE TABLE PARTAGER
   (
    TITRE CHAR(32)  NOT NULL,
    PSEUDO CHAR(32)  NOT NULL,
    SUPPORT CHAR(32)  NULL,
    DATE_PARTAGE DATE  NOT NULL
,   CONSTRAINT PK_PARTAGER PRIMARY KEY (PSEUDO, TITRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PARTAGER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PARTAGER_MEDIA
     ON PARTAGER (TITRE ASC)
    ;

CREATE  INDEX I_FK_PARTAGER_UTILISATEUR
     ON PARTAGER (PSEUDO ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE TABLE UTILISATEUR
   (
    PSEUDO CHAR(32)  NOT NULL,
    MDP CHAR(64)  NOT NULL,
    MAIL CHAR(32)  NOT NULL,
    TRANCHE_AGE CHAR(16)  NOT NULL,
    CODEPOSTAL NUMBER(10,2)  NOT NULL
,   CONSTRAINT PK_UTILISATEUR PRIMARY KEY (PSEUDO)  
   ) ;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE MUSIQUE ADD (
     CONSTRAINT FK_MUSIQUE_MEDIA
          FOREIGN KEY (TITRE)
               REFERENCES MEDIA (TITRE))   ;

ALTER TABLE MUSIQUE ADD (
     CONSTRAINT FK_MUSIQUE_ALBUM
          FOREIGN KEY (NOM_ALBUM)
               REFERENCES ALBUM (NOM_ALBUM))   ;

ALTER TABLE LIVRE ADD (
     CONSTRAINT FK_LIVRE_MEDIA
          FOREIGN KEY (TITRE)
               REFERENCES MEDIA (TITRE))   ;

ALTER TABLE FILM ADD (
     CONSTRAINT FK_FILM_MEDIA
          FOREIGN KEY (TITRE)
               REFERENCES MEDIA (TITRE))   ;

ALTER TABLE MEDIA ADD (
     CONSTRAINT FK_MEDIA_ARTISTE
          FOREIGN KEY (NOM_ARTISTE)
               REFERENCES ARTISTE (NOM_ARTISTE))   ;

ALTER TABLE PRODUIS ADD (
     CONSTRAINT FK_PRODUIS_ARTISTE
          FOREIGN KEY (NOM_ARTISTE)
               REFERENCES ARTISTE (NOM_ARTISTE))   ;

ALTER TABLE PRODUIS ADD (
     CONSTRAINT FK_PRODUIS_MEDIA
          FOREIGN KEY (TITRE)
               REFERENCES MEDIA (TITRE))   ;

ALTER TABLE PALMARES ADD (
     CONSTRAINT FK_PALMARES_ARTISTE
          FOREIGN KEY (NOM_ARTISTE)
               REFERENCES ARTISTE (NOM_ARTISTE))   ;

ALTER TABLE HISTORIQUE_NB_PARTAGE ADD (
     CONSTRAINT FK_HISTORIQUE_NB_PARTAGE_ARTIS
          FOREIGN KEY (NOM_ARTISTE)
               REFERENCES ARTISTE (NOM_ARTISTE))   ;

ALTER TABLE HISTORIQUE_NB_PARTAGE ADD (
     CONSTRAINT FK_HISTORIQUE_NB_PARTAGE_MEDIA
          FOREIGN KEY (TITRE)
               REFERENCES MEDIA (TITRE))   ;

ALTER TABLE PARTAGER ADD (
     CONSTRAINT FK_PARTAGER_MEDIA
          FOREIGN KEY (TITRE)
               REFERENCES MEDIA (TITRE))   ;

ALTER TABLE PARTAGER ADD (
     CONSTRAINT FK_PARTAGER_UTILISATEUR
          FOREIGN KEY (PSEUDO)
               REFERENCES UTILISATEUR (PSEUDO))   ;


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------
