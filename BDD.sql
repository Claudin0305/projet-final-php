use projet_final_php;
CREATE TABLE anneeAcademique(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    annee_debut INT UNSIGNED NOT NULL,
    annee_fin INT UNSIGNED NOT NULL,
    date_debut VARCHAR(15) NOT NULL,
    date_fin VARCHAR(15) NOT NULL,
    etat VARCHAR(2) check(etat LIKE'F' OR etat LIKE'O'),
    annee_academique VARCHAR(15) NOT NULL UNIQUE,
    PRIMARY KEY(id)
);

CREATE TABLE etudiant(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    photo VARCHAR(255),
    code VARCHAR(15) UNIQUE NOT NULL,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(40) NOT NULL,
    sexe VARCHAR(10) NOT NULL,
    lieu_de_naissance VARCHAR(200) NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    date_de_naissance VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    niveau VARCHAR(15) NOT NULL,
    filiere VARCHAR(255) NOT NULL,
    memo VARCHAR(255),
    etat VARCHAR(10) NOT NULL,
    nif_or_cin VARCHAR(20) UNIQUE NOT NULL,
    personne_de_reference VARCHAR(100) NOT NULL,
    tel_personne_de_ref VARCHAR(15) NOT NULL,
    id_annee_academique INT UNSIGNED NOT NULL,
    CONSTRAINT fk_anne
        foreign key (id_annee_academique)
        references anneeAcademique(id)
        ON DELETE CASCADE
        ON UPDATE restrict,
    PRIMARY KEY(id)
);

CREATE TABLE professeur(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    photo VARCHAR(255),
    code VARCHAR(15) UNIQUE NOT NULL,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(40) NOT NULL,
    sexe VARCHAR(10) NOT NULL,
    lieu_de_naissance VARCHAR(200) NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    date_de_naissance VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    niveau VARCHAR(15) NOT NULL,
    filiere VARCHAR(255) NOT NULL,
    memo VARCHAR(255),
    etat VARCHAR(10) NOT NULL,
    nif_or_cin VARCHAR(20) UNIQUE NOT NULL,
    cours_a_enseigner VARCHAR(100) NOT NULL,
    poste VARCHAR(30),
    statut VARCHAR(15) NOT NULL,
    salaire float NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE cours (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30) NOT NULL,
    code VARCHAR(15) NOT NULL,
    filiere VARCHAR(30) NOT NULL,
    niveau VARCHAR(10) NOT NULL,
    session VARCHAR(10) NOT NULL,
    etat VARCHAR(10) NOT NULL,
    prof_sup_id INT UNSIGNED,
    coefficient INT UNSIGNED NOT NULL,
    prof_id INT UNSIGNED NOT NULL,
    jours VARCHAR(100) NOT NULL,
    heure_debut VARCHAR(255) NOT NULL,
    heure_fin VARCHAR(255) NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT fk_prof
        foreign key (prof_id)
        references professeur(id)
        ON DELETE CASCADE
        ON UPDATE restrict
)Engine=InnoDB;

CREATE TABLE note (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    session VARCHAR(10) NOT NULL,
    id_cours INT UNSIGNED NOT NULL,
    id_etudiant INT UNSIGNED NOT NULL,
    id_annee_academique INT UNSIGNED NOT NULL,
    note float NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT fk_cours
        foreign key (id_cours)
        references cours(id)
        ON DELETE CASCADE
        ON UPDATE restrict,
    CONSTRAINT fk_etudiant
        foreign key (id_etudiant)
        references etudiant(id)
        ON DELETE CASCADE
        ON UPDATE restrict,
    CONSTRAINT fk_annee
        foreign key (id_annee_academique)
        references anneeAcademique(id)
        ON DELETE CASCADE
        ON UPDATE restrict
)Engine=InnoDB;

CREATE TABLE utilisateur(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    photo VARCHAR(255),
    pseudo VARCHAR(15) UNIQUE NOT NULL,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(40) NOT NULL,
    etat VARCHAR(10) NOT NULL,
    poste VARCHAR(30),
    modules VARCHAR(255) NOT NULL,
    passWord VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
)Engine=InnoDB;

/*script pour la publication des resultats*/
SELECT e.nom, prenom, c.nom, e.filiere, note, coefficient, n.note * coefficient as total, n.session from etudiant e, note n, cours c 
WHERE e.id = n.id_etudiant AND c.id = n.id_cours AND c.session = n.session AND c.session='S1';

SELECT c.nom from etudiant e, note n, cours c 
WHERE e.id = n.id_etudiant AND c.id = n.id_cours
AND c.session = n.session AND c.session='S1' order by c.nom desc;

SELECT n.note from etudiant e, note n, cours c 
WHERE e.id = n.id_etudiant AND c.id = n.id_cours
AND c.session = n.session AND c.session='S1' order by c.nom desc;

SELECT coefficient from etudiant e, note n, cours c 
WHERE e.id = n.id_etudiant AND c.id = n.id_cours
AND c.session = n.session AND c.session='S1' order by c.nom desc;

SELECT DISTINCT e.prenom, e.nom from etudiant e, note n, cours c 
WHERE e.id = n.id_etudiant AND c.id = n.id_cours
AND c.session = n.session AND c.session='S1' order by c.nom desc;