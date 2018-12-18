1 Clone o repositório
git clone https://github.com/samhk222/news-api.git

docker-compose build

docker-compose up -d

Em um processo normal de produção não informariamos a senha no git
docker exec -it NEWS-7.2.x-webserver cp .env.dist .env

# Instalar dependências
docker exec -it NEWS-7.2.x-webserver composer install

# Gerar chave de segurança
docker exec -it NEWS-7.2.x-webserver php artisan key:generate

# Rodar as migrações
docker exec -it NEWS-7.2.x-webserver php artisan migrate

# Gerar os seeds
docker exec -it NEWS-7.2.x-webserver php artisan db:seed

# Permissão nos diretórios
sudo chown -R www-data:www-data public_html/storage
sudo chown -R www-data:www-data public_html/bootstrap/cache

# docker exec -it NEWS-7.2.x-webserver php artisan route:call /refresh-feed