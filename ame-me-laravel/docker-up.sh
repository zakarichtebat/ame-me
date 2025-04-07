#!/bin/bash

# Assurez-vous que les dossiers nécessaires existent
mkdir -p ./docker/mysql
mkdir -p ./docker/nginx

# Construire et démarrer les conteneurs
docker-compose up -d

# Installer les dépendances Composer
docker-compose exec app composer install

# Copier le fichier .env.example en .env s'il n'existe pas
if [ ! -f ".env" ]; then
    cp .env.example .env
    docker-compose exec app php artisan key:generate
fi

# Mettre à jour le fichier .env pour la configuration Docker
sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=ame_me_db/g' .env
sed -i 's/DB_USERNAME=root/DB_USERNAME=ame_me/g' .env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=root/g' .env

# Exécuter les migrations et les seeders
docker-compose exec app php artisan migrate:fresh --seed

# Installer les dépendances npm et compiler les assets
docker-compose run --rm npm install
docker-compose run --rm npm run dev

echo "L'application est disponible à l'adresse http://localhost:8000" 