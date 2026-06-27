# 🛍️ Sakura Moon Créations — Boutique en ligne

## 📌 Présentation du projet

Sakura Moon Créations est une boutique en ligne développée dans le cadre du titre **Développeur Fullstack**.  
Le projet a pour objectif de proposer une plateforme e-commerce permettant la consultation, la gestion et l’achat de produits en ligne.

🔗 Démo en ligne :  
https://lorenzo-brissard-navarro.students-laplateforme.io/Boutique_en_ligne

---

## ⚙️ Stack technique

- **Frontend** : HTML, SCSS, JavaScript
- **Backend** : PHP
- **Base de données** : MySQL
- **Serveur** : Plesk

---

## ✨ Fonctionnalités

### 👤 Utilisateurs
- Création de compte
- Connexion / déconnexion

### 🛒 Produits
- Consultation du catalogue
- Système de filtres
- Tri des produits
- Barre de recherche

### 🛍️ Panier & commandes
- Ajout au panier
- Modification du panier
- Validation de commande
- Historique des commandes

### 📦 Gestion
- Gestion des stocks
- Mise à jour automatique des quantités après commande

---

## 🗄️ Modélisation de la base de données

La base de données a été conçue avec la méthode **Merise**, permettant une structuration normalisée des données (MCD / MLD / MPD).

---

## 🚀 Installation du projet

### 1. Cloner le projet

```bash
git clone https://github.com/lorenzo-brissardnavarro/boutique-en-ligne.git
```

## 2. Créer la base de données

### 🗄️ Créer une base de données MySQL locale
- Créer une nouvelle base de données MySQL.
- Importer le fichier `.sql` fourni dans le projet via :
  - phpMyAdmin
  - ou terminal MySQL

---

## 3. Configuration du projet

Modifier les identifiants de connexion en créant un fichier .env puis en entrant :

```bash
DB_HOST=localhost
DB_NAME=nomDeLaBDD
DB_USER=nomUtilisateur
DB_PASS=mdpUtilisateur
```

---

## 4. Lancer le projet en local

### 🔧 Installer un serveur local
- XAMPP
- WAMP
- MAMP

### 📂 Placer le projet
Mettre le projet dans le dossier du serveur (ex. `htdocs`).

### ▶️ Démarrer les services
- Apache
- MySQL

### 🌐 Accéder au projet

```bash
http://localhost/Boutique_en_ligne
```

