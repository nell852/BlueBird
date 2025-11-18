# Blue Bird Express 🚌

Application web PHP pour la gestion d'une compagnie de transport.

## 🎯 Fonctionnalités

### Pour les Clients
- ✅ Inscription et connexion
- 🔍 Recherche de voyages
- 🎫 Réservation de sièges
- 💳 Gestion des paiements
- 📋 Historique des réservations

### Pour les Administrateurs
- 🚐 Gestion des véhicules
- 👥 Gestion des clients
- 🗺️ Gestion des voyages et itinéraires
- 💰 Suivi des paiements
- 🔧 Maintenance des véhicules
- 📊 Tableau de bord

## 🛠️ Technologies
- **Backend** : PHP 8.2+ (MVC Pattern)
- **Base de données** : SQL Server (Windows Authentication)
- **Frontend** : HTML, CSS, PHP Templates
- **Serveur** : PHP Built-in Server

## 📥 Installation

**Pour une installation locale sur Windows :**
Consultez le fichier [INSTALLATION_LOCALE.md](INSTALLATION_LOCALE.md) pour les instructions détaillées.

**Résumé rapide :**
```bash
# 1. Créer la base de données SQL Server
# Exécutez database/bluebird_express_sqlserver.sql dans SSMS

# 2. Lancer le serveur
php -S localhost:8000 router.php

# 3. Ouvrir dans le navigateur
http://localhost:8000
```

## 📁 Structure
```
├── config/          # Configuration (Database)
├── controllers/     # Logique métier
├── models/          # Accès aux données
├── views/           # Templates PHP
│   ├── admin/      # Interface admin
│   └── client/     # Interface client
├── public/          # Assets (CSS, JS)
├── database/        # Scripts SQL
├── index.php        # Point d'entrée
└── router.php       # Routeur
```

## 🔐 Sécurité
- Authentification par sessions PHP
- Mots de passe hashés (à vérifier dans AuthController)
- Protection SQL Injection via PDO
- Validation des entrées utilisateur

## 📝 Base de Données
**Tables principales :**
- Client, Reservation, Voyage
- Vehicule, Chauffeur, Employe
- Ville, Agence, Paiement
- Maintenance, Panne, Suivi_GPS

## 🚀 Déploiement
Cette application est configurée pour fonctionner en local avec SQL Server.

Pour un déploiement en production, considérez :
- Configuration d'un serveur web (Apache/Nginx)
- Migration vers MySQL/PostgreSQL si nécessaire
- Configuration HTTPS
- Optimisation des performances

## 📄 Licence
Projet académique - Blue Bird Express

---
Développé avec ❤️ pour la gestion de transport
