# Teste de Backend - Meu Câmbio

### Proposta
Disponibilizar uma API para um portal de notícias, com as seguintes capacidades
- Listagem das notícias, com paginação, limitado em 10 registros por chamada
- Disponibilizar um endpoint para exibir os dados de uma única notícia

### Servidores de testes
Caso prefira testar diretamente a API, disponibilizei ela em dois servidores cloud.

* Amazon
![Amazon](http://aia.la/tmp/amazon.png)

* DigitalOcean
![Amazon](http://aia.la/tmp/digitalocean.png)

* Endereços

| Servidor  | IP | 
| ------------- | ------------- | 
| Amazon  | http://18.222.255.249:8877  |
| Digital Ocean  | http://68.183.51.253:8877  |
| Local  | http://0.0.0.0:8877 (Após seguir os 10 passos de instalação, abaixo listados)  |

### Instalação
Para facilitar o deploy e os testes, a aplicação foi construída com os serviços rodando via docker. Dessa força ficará fácil para o Thiago ou qualquer outra pessoa testar, assim como foi fácil fazer o deploy na [Amazon](amazon.com) Amazon e na [DigitalOcean](www.digitalocean.com) DigitalOcean

Siga os 10 passos. Os comandos devem ser digitados no seu terminal do linux.

1. Clone o repositório
`git clone https://github.com/samhk222/news-api.git`

2. Faça um build da imagem
`docker-compose build`

3. Suba os serviços
`docker-compose up -d`
> O parâmetro -d significa *detached mode*, ou seja, não serão exibidas as sysouts. Caso queira conferir os processos e as sysouts, remova esse parâmetro. É prático quando precisamos debugar

4. Copie o o arquivo *.env.dist* para *.env*
`docker exec -it NEWS-7.2.x-webserver cp .env.dist .env`
> O ideal não seria colocar a senha do banco no .env.dist e não deveria ser comitada no github, mas para facilitar a implantação deixaremos ela aqui, já que ela é referente apenas a esse container.

5. Instalação das dependências
`docker exec -it NEWS-7.2.x-webserver composer install`

6. Geração da chave de segurança
`docker exec -it NEWS-7.2.x-webserver php artisan key:generate`

7. Execução das migrações
`docker exec -it NEWS-7.2.x-webserver php artisan migrate`

8. Geração dos seeds
`docker exec -it NEWS-7.2.x-webserver php artisan db:seed`

9. Alterar o dono dos diretórios
`docker exec -it NEWS-7.2.x-webserver chown -R www-data:www-data /var/www/html/storage`
`docker exec -it NEWS-7.2.x-webserver chown -R www-data:www-data /var/www/html/bootstrap/cache`

10. Gere os primeiros registros 
`docker exec -it NEWS-7.2.x-webserver php artisan route:call /refresh-feed`

### Testes
Execute os testes caso necessário com o comando abaixo
`docker exec -it NEWS-7.2.x-webserver /var/www/html/vendor/bin/phpunit --testdox`

![testes](http://aia.la/tmp/testes.png)
Disclaimer: foram feitos apenas alguns testes, como prova de conceito.

### Arquitetura do desenvolvimento
Algumas decisões tomadas para o desenvolvimento da API

1. Optei por salvar os registros do feed em banco de dados, ao invés de manipulá-los diretamente, por facilitar a manipulação futura (pesquisa e inserção de novos registros)
2. Armazenar o histórico, pois o feed apenas busca os últimos 40 registros, e nossa aplicação está armazenando todos a partir do momento do deploy.
2. Velocidade de acesso dos registros, uma vez que já estão na própria máquina e não teria a latencia de http
3. Utilizei o docker para facilitar o deploy e para garantir que os ambientes de desenvolvimento sejam iguais ao de produção. 
4. As notícias são recuperadas no feed do g1 de 10 em 10 minutos, através de uma rota específica (listada abaixo). Esse parâmetro é configurado dentro do dockerfile.
5. Possibilidade de filtrar os registros diretamente no banco. Pensando comercialmente, poderiamos criar filtros que não exibissem notícias com determinadas palavras, para preservar nossos clientes de ler algo que não seja conveniente, ou também podemos exibir notícias que foram aprovadas, etc.
6. Desenvolvi para ser escalável, caso futuramente decidirmos incluir uma nova fonte de notícia, do g1 ou de outro portal, basta cadastrar na tabela *feeds*, e eles serão incorporados automaticamente a nossa API
7. Como boa prática, appendei na frente das rotas a versão da API, para não quebrar em futuras implantações, e manter a compatibilidade

### Rotas
| Endpoint  | IP | 
| ------------- | ------------- | 
| /api/v01/news  | Retorna todas as notícias, de forma paginada |
| /api/v01/news/:id  | Retorna os dados de uma notícia específica, ou erro em caso de notícia não existente  |
| /  | Lista, em HTML,  as notícias, de forma paginada|
| /refresh-feed  | Rota responsável pelo parser dos dados do feed rss  |



### Modelagem
Como não temos autenticação, a modelagem ficou a mais simples possível, e documento aqui para os testes
![modelagem](http://aia.la/tmp/modelo.png)

### Documentação da API
![Documentacao](http://aia.la/tmp/postman_documentation.png)

Os endpoints para consumo da API estão disponibilizados no *postman*, no [seguinte endereço](https://documenter.getpostman.com/view/539336/RzfnkS63). Eles já estão apontando para a digitalocean, caso queira apontar para seu container local, troque o mesmo para http://0.0.0.0:8877


