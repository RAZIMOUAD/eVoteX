# 📌 eVoteX - Système de Vote en Ligne

## 📝 Description
Ce projet est une application de vote en ligne permettant aux utilisateurs de s'inscrire, voter et consulter les résultats des élections. Il utilise **PHP, MySQL, FPDF pour la génération de PDF, PHPMailer pour l'envoi d'e-mails et Ajax pour les requêtes dynamiques.**

> 🏆 **Objectif :** Créer un système de vote en ligne sécurisé, rapide et efficace avec une interface moderne et une gestion fluide des votes.

---
## 📂 Structure du Projet

📁 **RAZI_MOUAD/** *(Racine du projet)*
- 📂 **controllers/** → Gère la logique métier (Authentification, Candidats, Votes).
- 📂 **models/** → Contient les classes pour la gestion des données.
- 📂 **views/** → Interface utilisateur avec les fichiers HTML et PHP.
- 📂 **fpdf/** → Génération des fichiers PDF.
- 📂 **includes/** → Contient PHPMailer pour l'envoi des e-mails.
- 📂 **vendor/** → Contient les dépendances gérées avec Composer.
- 📂 **css/** → Styles CSS pour le design de l’application.
- 📂 **js/** → JavaScript et Ajax pour améliorer l’interactivité.
- 📂 **database/** → *(Fichier SQL pour la base de données, voir section Configuration de la BD.)*

---
## ⚙️ Installation et Configuration

### 1️⃣ **Prérequis**
✅ **PHP 7+** (ou version plus récente)  
✅ **Serveur Apache (XAMPP, WAMP, MAMP, ou un hébergement en ligne)**  
✅ **Base de Données MySQL**  
✅ **Composer** *(gestionnaire de dépendances PHP)*  

### 2️⃣ **Installation du Projet**
```bash
# Cloner le projet depuis GitHub
git clone https://github.com/votre-utilisateur/votre-repo.git
cd votre-repo
```

### 3️⃣ **Configurer la Base de Données**
- **Créer une base de données MySQL** :
```sql
CREATE DATABASE voting_system;
```
- **Importer le fichier SQL** (ajouter le chemin vers le fichier si nécessaire) :
```bash
mysql -u root -p voting_system < database.sql
```
- **Modifier les accès MySQL dans `models/Database.php`** :
```php
private $host = "localhost";
private $db_name = "voting_system";
private $username = "root";
private $password = "";
```

### 4️⃣ **Lancer le Serveur**
```bash
# Démarrer Apache et MySQL avec XAMPP/WAMP
# Accéder à l’application via :
http://localhost/nom_du_dossier/
```

---
## 🚀 Fonctionnalités Principales
✅ **Inscription et connexion des utilisateurs avec validation sécurisée**  
✅ **Vote sécurisé pour les candidats (1 vote par utilisateur)**  
✅ **Génération de PDF des résultats avec FPDF**  
✅ **Affichage des résultats en temps réel avec mises à jour dynamiques**  
✅ **Envoi d'e-mails de confirmation via PHPMailer**  
✅ **Interface interactive avec Ajax pour éviter le rechargement des pages**  
✅ **Système d'administration pour la gestion des votes et des utilisateurs**  

---
## 🔧 Technologies Utilisées
🔹 **Langages** : PHP, HTML, CSS, JavaScript  
🔹 **Base de données** : MySQL  
🔹 **Frameworks & Librairies** : Bootstrap, PHPMailer, FPDF, Ajax  
🔹 **Gestion des dépendances** : Composer  

---
## 🛠 Dépendances PHP
```bash
# Installer les dépendances via Composer
composer install
```
> **💡 Note :** Assurez-vous que `vendor/` est bien présent après l’installation. Si ce n’est pas le cas, exécutez `composer update`.

---
## 🎯 Améliorations Futures
🔸 **Ajout d'une API REST pour une intégration mobile** 📱  
🔸 **Implémentation de WebSockets pour un comptage des votes en temps réel** ⚡  
🔸 **Ajout d'une authentification OAuth (Google, Facebook, GitHub, etc.)** 🔑  
🔸 **Création d’un tableau de bord administrateur avec statistiques détaillées** 📊  

---
## 🎉 Merci d’avoir exploré ce projet !



