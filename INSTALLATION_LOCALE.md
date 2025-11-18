# Installation Locale - Blue Bird Express

## Prérequis
- **Windows** avec SQL Server Management Studio 20
- **PHP 8.2** ou supérieur installé
- **Extension PHP pour SQL Server** (pdo_sqlsrv)
- **SQL Server** avec Windows Authentication
- **Base de données** bluebird_express créée

## Étape 1 : Installation de PHP et extensions SQL Server

### 1.1 Télécharger PHP
1. Téléchargez PHP depuis https://windows.php.net/download/
2. Choisissez la version Thread Safe (TS)
3. Extrayez dans `C:\php`

### 1.2 Installer l'extension SQL Server pour PHP
1. Téléchargez les drivers Microsoft SQL Server depuis :
   https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server
2. Copiez les fichiers `.dll` dans le dossier `C:\php\ext\`
3. Éditez `php.ini` et ajoutez :
   ```ini
   extension=php_pdo_sqlsrv_82_ts.dll
   extension=php_sqlsrv_82_ts.dll
   ```

### 1.3 Vérifier l'installation
Ouvrez CMD et tapez :
```bash
php -v
php -m | findstr pdo_sqlsrv
```

## Étape 2 : Configuration de la Base de Données

### 2.1 Créer la base de données
1. Ouvrez SQL Server Management Studio
2. Connectez-vous avec Windows Authentication
3. Exécutez le script : `database/bluebird_express_sqlserver.sql`

### 2.2 Vérifier la connexion
La configuration dans `config/Database.php` utilise :
- **Serveur** : localhost
- **Base de données** : bluebird_express
- **Authentification** : Windows (null, null)

## Étape 3 : Lancer l'Application

### 3.1 Télécharger le projet depuis Replit
Téléchargez tous les fichiers du projet

### 3.2 Ouvrir le terminal dans le dossier du projet
```bash
cd chemin\vers\votre\projet
```

### 3.3 Lancer le serveur PHP
```bash
php -S localhost:8000 router.php
```

### 3.4 Accéder à l'application
Ouvrez votre navigateur : http://localhost:8000

## Structure du Projet
```
bluebird_express/
├── config/
│   └── Database.php          # Configuration SQL Server
├── controllers/              # Logique métier
│   ├── AuthController.php
│   ├── ClientController.php
│   ├── ReservationController.php
│   ├── VehiculeController.php
│   └── VoyageController.php
├── models/                   # Accès aux données
├── views/                    # Templates PHP
│   ├── admin/               # Interface administrateur
│   └── client/              # Interface client
├── public/                   # CSS et assets
├── database/                 # Scripts SQL
│   └── bluebird_express_sqlserver.sql
├── index.php                # Point d'entrée
└── router.php               # Routeur pour serveur PHP
```

## URLs de l'Application

### Interface Client
- Connexion : http://localhost:8000/?action=client&subaction=login
- Inscription : http://localhost:8000/?action=client&subaction=register
- Recherche de voyages : http://localhost:8000/?action=client&subaction=voyages

### Interface Admin
- Dashboard : http://localhost:8000/?action=admin&subaction=dashboard
- Gestion clients : http://localhost:8000/?action=admin&subaction=clients
- Gestion véhicules : http://localhost:8000/?action=admin&subaction=vehicules
- Gestion voyages : http://localhost:8000/?action=admin&subaction=voyages

## Dépannage

### Erreur "Could not find driver"
➜ L'extension pdo_sqlsrv n'est pas installée. Suivez l'Étape 1.2

### Erreur de connexion SQL Server
➜ Vérifiez que :
- SQL Server est démarré
- La base de données 'bluebird_express' existe
- Windows Authentication est activée
- Votre compte Windows a les permissions nécessaires

### Le serveur PHP ne démarre pas
➜ Vérifiez que le port 8000 n'est pas déjà utilisé
➜ Essayez un autre port : `php -S localhost:9000 router.php`

### Les CSS ne se chargent pas
➜ Vérifiez que le dossier `public/css/` existe
➜ Le routeur gère automatiquement les fichiers statiques

## Support
Pour toute question, consultez la documentation PHP SQL Server :
https://docs.microsoft.com/en-us/sql/connect/php/
