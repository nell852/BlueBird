-- Blue Bird Express - MySQL Schema
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS bluebird_express;
USE bluebird_express;

-- 1. Ville
CREATE TABLE Ville (
    id_ville INT AUTO_INCREMENT PRIMARY KEY,
    nom_ville VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Agence
CREATE TABLE Agence (
    id_agence INT AUTO_INCREMENT PRIMARY KEY,
    nom_agence VARCHAR(100) NOT NULL,
    adresse TEXT NOT NULL,
    telephone VARCHAR(20),
    id_ville INT NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES Ville(id_ville) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Employe
CREATE TABLE Employe (
    id_employe INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    email VARCHAR(150) UNIQUE,
    date_embauche DATE NOT NULL,
    salaire DECIMAL(10, 2) NOT NULL,
    id_agence INT NOT NULL,
    FOREIGN KEY (id_agence) REFERENCES Agence(id_agence) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Chauffeur (Héritage: PK est FK vers Employe)
CREATE TABLE Chauffeur (
    id_employe INT PRIMARY KEY,
    numero_permis VARCHAR(50) NOT NULL UNIQUE,
    date_validite_permis DATE NOT NULL,
    FOREIGN KEY (id_employe) REFERENCES Employe(id_employe) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Mecanicien (Héritage: PK est FK vers Employe)
CREATE TABLE Mecanicien (
    id_employe INT PRIMARY KEY,
    specialite VARCHAR(100),
    FOREIGN KEY (id_employe) REFERENCES Employe(id_employe) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Vehicule
CREATE TABLE Vehicule (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    immatriculation VARCHAR(20) NOT NULL UNIQUE,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50),
    nombre_sieges INT NOT NULL CHECK (nombre_sieges > 0),
    annee_acquisition INT,
    statut VARCHAR(20) DEFAULT 'disponible' CHECK (statut IN ('disponible', 'en_voyage', 'en_maintenance'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Voyage
CREATE TABLE Voyage (
    id_voyage INT AUTO_INCREMENT PRIMARY KEY,
    id_vehicule INT NOT NULL,
    id_chauffeur INT NOT NULL,
    ville_depart INT NOT NULL,
    ville_arrivee INT NOT NULL,
    date_heure_depart DATETIME NOT NULL,
    tarif DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_vehicule) REFERENCES Vehicule(id_vehicule) ON DELETE RESTRICT,
    FOREIGN KEY (id_chauffeur) REFERENCES Chauffeur(id_employe) ON DELETE RESTRICT,
    FOREIGN KEY (ville_depart) REFERENCES Ville(id_ville) ON DELETE RESTRICT,
    FOREIGN KEY (ville_arrivee) REFERENCES Ville(id_ville) ON DELETE RESTRICT,
    CONSTRAINT chk_villes_differentes CHECK (ville_depart != ville_arrivee)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Client
CREATE TABLE Client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Reservation
CREATE TABLE Reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_voyage INT NOT NULL,
    siege_assigne INT NOT NULL,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_retour DATE NULL,
    statut VARCHAR(20) DEFAULT 'confirmée' CHECK (statut IN ('confirmée', 'annulée', 'terminée')),
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE,
    FOREIGN KEY (id_voyage) REFERENCES Voyage(id_voyage) ON DELETE CASCADE,
    CONSTRAINT chk_siege_valide CHECK (siege_assigne > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. Colis
CREATE TABLE Colis (
    id_colis INT AUTO_INCREMENT PRIMARY KEY,
    id_reservation INT NOT NULL,
    description TEXT,
    poids DECIMAL(6, 2),
    tarif_colis DECIMAL(10, 2),
    FOREIGN KEY (id_reservation) REFERENCES Reservation(id_reservation) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. Paiement
CREATE TABLE Paiement (
    id_paiement INT AUTO_INCREMENT PRIMARY KEY,
    id_reservation INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    date_paiement DATETIME DEFAULT CURRENT_TIMESTAMP,
    mode_paiement VARCHAR(20) NOT NULL CHECK (mode_paiement IN ('espece', 'mobile_money', 'carte')),
    statut VARCHAR(20) DEFAULT 'payé' CHECK (statut IN ('payé', 'en_attente', 'échoué')),
    FOREIGN KEY (id_reservation) REFERENCES Reservation(id_reservation) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. Panne
CREATE TABLE Panne (
    id_panne INT AUTO_INCREMENT PRIMARY KEY,
    id_vehicule INT NOT NULL,
    date_signalement DATETIME NOT NULL,
    description TEXT NOT NULL,
    statut VARCHAR(20) DEFAULT 'signalée' CHECK (statut IN ('signalée', 'en_cours', 'résolue')),
    FOREIGN KEY (id_vehicule) REFERENCES Vehicule(id_vehicule) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. Maintenance
CREATE TABLE Maintenance (
    id_maintenance INT AUTO_INCREMENT PRIMARY KEY,
    id_vehicule INT NOT NULL,
    id_mecanicien INT,
    date_debut DATE NOT NULL,
    date_fin DATE,
    cout DECIMAL(10, 2),
    description TEXT,
    FOREIGN KEY (id_vehicule) REFERENCES Vehicule(id_vehicule) ON DELETE CASCADE,
    FOREIGN KEY (id_mecanicien) REFERENCES Mecanicien(id_employe) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 14. Partenaire
CREATE TABLE Partenaire (
    id_partenaire INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    type_service VARCHAR(100),
    contact VARCHAR(150),
    telephone VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 15. Suivi_GPS
CREATE TABLE Suivi_GPS (
    id_suivi INT AUTO_INCREMENT PRIMARY KEY,
    id_voyage INT NOT NULL,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_voyage) REFERENCES Voyage(id_voyage) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Index pour performances
CREATE INDEX idx_voyage_depart ON Voyage(ville_depart, ville_arrivee);
CREATE INDEX idx_reservation_client ON Reservation(id_client);
CREATE INDEX idx_reservation_voyage ON Reservation(id_voyage);
CREATE INDEX idx_suivi_voyage ON Suivi_GPS(id_voyage);

-- Données d'initialisation
INSERT INTO Ville (nom_ville) VALUES ('Dakar'), ('Thiès'), ('Kaolack'), ('Tambacounda'), ('Ziguinchor');

INSERT INTO Agence (nom_agence, adresse, telephone, id_ville) VALUES 
('Blue Bird Express - Dakar', '123 Avenue Lamine Gueye, Dakar', '+221701234567', 1),
('Blue Bird Express - Thiès', '456 Rue Blaise Diagne, Thiès', '+221701234568', 2);
