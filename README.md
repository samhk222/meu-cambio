
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

# Gere os primeiros registros 
docker exec -it NEWS-7.2.x-webserver php artisan route:call /refresh-feed

# Executando os testes
docker exec -it NEWS-7.2.x-webserver /var/www/html/vendor/bin/phpunit --testdox

php artisan make:test NewsTest

docker-machine create --digitalocean-size "s-1vcpu-1gb" --driver digitalocean --digitalocean-access-token abd888a253de5d3e2837945422d564b1acd3cd31bcf8e464cf94323f4d1c269a newsapi-prod-1

https://blog.machinebox.io/deploy-machine-box-in-digital-ocean-385265fbeafd


eval $(docker-machine env newsapi-prod-1)
