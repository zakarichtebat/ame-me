# AME Maintenance Engineering - Configuration Docker

Ce document explique comment démarrer le projet en utilisant Docker, ce qui vous permet de développer sans avoir à installer PHP, MySQL et autres dépendances directement sur votre machine.

## Prérequis

-   Docker Desktop installé sur votre machine ([Télécharger Docker Desktop](https://www.docker.com/products/docker-desktop))
-   Git pour cloner le repository

## Installation avec Docker

### 1. Cloner le repository

```bash
git clone <url-du-repository>
cd ame-me-laravel
```

### 2. Démarrer l'environnement Docker

#### Sous Windows:

Double-cliquez simplement sur le fichier `docker-up.bat` ou exécutez-le depuis une invite de commande:

```bash
.\docker-up.bat
```

#### Sous Linux/Mac:

Rendez le script exécutable et lancez-le:

```bash
chmod +x docker-up.sh
./docker-up.sh
```

### 3. Accéder à l'application

Une fois le script terminé, l'application est disponible à l'adresse:
[http://localhost:8000](http://localhost:8000)

## Commandes Docker utiles

### Arrêter les conteneurs

```bash
docker-compose down
```

### Voir les logs

```bash
docker-compose logs -f
```

### Exécuter des commandes Artisan

```bash
docker-compose exec app php artisan <commande>
```

Exemples:

```bash
# Créer un nouveau contrôleur
docker-compose exec app php artisan make:controller NomController

# Effacer le cache
docker-compose exec app php artisan cache:clear
```

### Exécuter des commandes npm

```bash
docker-compose run --rm npm <commande>
```

Exemples:

```bash
# Compiler les assets en mode développement
docker-compose run --rm npm run dev

# Compiler les assets pour la production
docker-compose run --rm npm run build
```

### Exécuter des commandes composer

```bash
docker-compose exec app composer <commande>
```

Exemples:

```bash
# Installer une nouvelle dépendance
docker-compose exec app composer require package/name

# Mettre à jour les dépendances
docker-compose exec app composer update
```

## Structure des conteneurs

-   **app**: Conteneur PHP pour l'application Laravel
-   **db**: Base de données MySQL
-   **nginx**: Serveur web
-   **npm**: Pour la compilation des assets (Node.js)

## Accès à la base de données

-   **Hôte**: localhost
-   **Port**: 3306 (port par défaut de MySQL)
-   **Nom de la base**: ame_me_db
-   **Utilisateur**: ame_me
-   **Mot de passe**: root

Vous pouvez vous connecter à la base de données avec n'importe quel client MySQL (comme MySQL Workbench, TablePlus, etc.) en utilisant ces informations.
