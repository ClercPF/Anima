-- CLERC.PF 2018-10-25

--CREATE DATABASE Anima;
--USE Anima;

-- Création de la table modele de personnage
CREATE TABLE modele(
  id_mod int,
  joueur varchar(30),
  nom varchar(30),
  classe varchar(30),
  niveau int,
  race varchar(30),
  sexe varchar(1),
  pnj boolean,
  CONSTRAINT modele_pk PRIMARY KEY (id_mod)
);

-- Création de la table initiative
CREATE TABLE init(
  id_init int,
  lib varchar(30),
  armure int,
  arme int,
  special int,
  id_mod int,
  CONSTRAINT init_pk PRIMARY KEY (id_init),
  CONSTRAINT init_fk_modele FOREIGN KEY (id_mod) REFERENCES modele(id_mod)
);

-- Création de la table type de caracteristique
CREATE TABLE type_carac(
  code_type_carac varchar(5),
  lib varchar(20),
  CONSTRAINT type_carac_pk PRIMARY KEY (code_type_carac)
);

-- Insertion des types des caracteristiques de base
INSERT INTO type_carac(code_type_carac, lib) VALUES('AGI','Agilité');
INSERT INTO type_carac(code_type_carac, lib) VALUES('CON','Constitution');
INSERT INTO type_carac(code_type_carac, lib) VALUES('DEX','Dexterité');
INSERT INTO type_carac(code_type_carac, lib) VALUES('FOR','Force');
INSERT INTO type_carac(code_type_carac, lib) VALUES('INT','Intelligence');
INSERT INTO type_carac(code_type_carac, lib) VALUES('PER','Perception');
INSERT INTO type_carac(code_type_carac, lib) VALUES('POU','Pouvoir');
INSERT INTO type_carac(code_type_carac, lib) VALUES('VOL','Volonté');
-- Insertion des types des indices de protection
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPTRA','IP Tranchant');
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPCON','IP Contendant');
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPPER','IP Perforant');
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPCHA','IP Chaleur');
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPELE','IP Eléctrique');
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPFRO','IP Froid');
INSERT INTO type_carac(code_type_carac, lib) VALUES('IPENE','IP Energie');
-- Insertion des types des infos de combat, magie, spy, conju ...
INSERT INTO type_carac(code_type_carac, lib) VALUES('ATT','Attaque');
INSERT INTO type_carac(code_type_carac, lib) VALUES('PAR','Parade');
INSERT INTO type_carac(code_type_carac, lib) VALUES('ESQ','Esquive');
INSERT INTO type_carac(code_type_carac, lib) VALUES('PMAGO','Proj. Magique Off.');
INSERT INTO type_carac(code_type_carac, lib) VALUES('PMAGD','Proj. Magique Def.');
INSERT INTO type_carac(code_type_carac, lib) VALUES('TPSY','Talent Psychique');
INSERT INTO type_carac(code_type_carac, lib) VALUES('PPSY','Proj. Psychique');
INSERT INTO type_carac(code_type_carac, lib) VALUES('CONV','Convoquer');
INSERT INTO type_carac(code_type_carac, lib) VALUES('DOMI','Dominer');
INSERT INTO type_carac(code_type_carac, lib) VALUES('LIER','Lier');
INSERT INTO type_carac(code_type_carac, lib) VALUES('REVO','Révoquer');

-- Création de la table caracteristique
CREATE TABLE carac(
  id_mod int,
  code_type_carac varchar(5),
  base int,
  modif int,
  CONSTRAINT carac_pk PRIMARY KEY (id_mod, code_type_carac),
  CONSTRAINT carac_fk_modele FOREIGN KEY (id_mod) REFERENCES modele(id_mod),
  CONSTRAINT carac_fk_type_carac FOREIGN KEY (code_type_carac) REFERENCES type_carac(code_type_carac)
);

-- Création de la table type d'action
CREATE TABLE type_action(
  code_type_act varchar(5),
  lib varchar(20),
  CONSTRAINT type_action_pk PRIMARY KEY (code_type_act)
);

-- Insertion des types d'action
INSERT INTO type_action(code_type_act, lib) VALUES('ATT','Attaque');
INSERT INTO type_action(code_type_act, lib) VALUES('DEF','Defense');
INSERT INTO type_action(code_type_act, lib) VALUES('RES','Résistance');

-- Création de la table action
CREATE TABLE action(
  id_act int,
  lib varchar(30),
  base int,
  classe int,
  special int,
  code_type_carac varchar(5),
  code_type_act varchar(5),
  CONSTRAINT action_pk PRIMARY KEY (id_act),
  CONSTRAINT action_fk_type_carac FOREIGN KEY (code_type_carac) REFERENCES type_carac(code_type_carac),
  CONSTRAINT action_fk_type_act FOREIGN KEY (code_type_act) REFERENCES type_action(code_type_act)
);

-- Création de la table des parties
CREATE TABLE partie(
  id_partie int,
  nom varchar(30),
  obs varchar(300),
  creation date,
  CONSTRAINT partie_pk PRIMARY KEY (id_partie)
);

-- Création de la table des personnages
CREATE TABLE perso(
  id_perso int,
  nom varchar(30),
  pv int,
  couleur varchar(6),
  id_partie int,
  id_mod int,
  CONSTRAINT perso_pk PRIMARY KEY (id_perso),
  CONSTRAINT perso_fk_partie FOREIGN KEY (id_partie) REFERENCES partie(id_partie),
  CONSTRAINT perso_fk_modele FOREIGN KEY (id_mod) REFERENCES modele(id_mod)
);

-- Sequance pour l'id de Partie
CREATE SEQUENCE seq_id_partie;

-- Procédure d'insertion pour la table Partie
CREATE OR REPLACE FUNCTION insert_partie(nom_part varchar(30), obs_part varchar(300)) RETURNS integer AS $$
DECLARE
  newid int;
BEGIN
  newid := nextval('seq_id_partie');
  INSERT INTO partie(id_partie, nom, obs, creation)
  VALUES(newid, nom_part, obs_part, NOW());
  RETURN newid;
END;
$$ LANGUAGE plpgsql;

-- Procédure de modification pour la table Partie
CREATE OR REPLACE FUNCTION update_partie(id_part int, nom_part varchar(30), obs_part varchar(300)) RETURNS integer AS $$
DECLARE

BEGIN
  UPDATE partie
  SET nom = nom_part, obs = obs_part
  WHERE id_partie = id_part;
  RETURN id_part;
END;
$$ LANGUAGE plpgsql;

-- Procédure de modification pour la table Partie
CREATE OR REPLACE FUNCTION delete_partie(id_part int) RETURNS integer AS $$
DECLARE

BEGIN
  DELETE FROM perso
  WHERE id_partie = id_part;

  DELETE FROM partie
  WHERE id_partie = id_part;
  
  RETURN id_part;
END;
$$ LANGUAGE plpgsql;
