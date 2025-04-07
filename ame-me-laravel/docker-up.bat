@echo off
ECHO Démarrage de l'environnement Docker pour AME Maintenance Engineering...

REM Assurez-vous que les dossiers nécessaires existent
mkdir docker\mysql 2>nul
mkdir docker\nginx 2>nul

REM Construire et démarrer les conteneurs
docker-compose up -d

REM Installer les dépendances Composer
docker-compose exec app composer install

REM Copier le fichier .env.example en .env s'il n'existe pas
IF NOT EXIST .env (
    COPY .env.example .env
    docker-compose exec app php artisan key:generate
)

REM Exécuter les migrations et les seeders
docker-compose exec app php artisan migrate:fresh --seed

REM Installer les dépendances npm et compiler les assets
docker-compose run --rm npm install
docker-compose run --rm npm run dev

ECHO L'application est disponible à l'adresse http://localhost:8000 