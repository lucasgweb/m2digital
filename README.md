## Requisitos 

Docker - https://www.docker.com/

## Instalação

Você pode clonar este repositório ou baixar o .zip

>git clone https://github.com/lucasgweb/m2digital-api-test.git

## Uso

Você deve acessar a pasta *root* do projeto pelo *prompt/terminal*.

Ainda na pasta root renomeie o arquivo .env.example para .env
>cp .env.example .env

Va para a pasta **docker-compose**
>cd docker-compose

Na pasta docker-compose renomeie o arquivo **.env.example** para **.env**
>cp .env.example .env

Execute os containers do projeto
>docker-compose up -d nginx mysql phpmyadmin workspace

Entre no workspace do docker
>docker exec -it m2digital-workspace-1 /bin/sh 

Instale todas as dependencias do laravel com o composer
>composer install

Execute as migrations do projeto
>php artisan migrate

## Testando

Todos arquivos de testes você pode consefir na raiz do projeto no diretorio *tests/Feature*.

para executar os testes use o comando 
>php artisan test

ou podera testar fazendo requisições manualmente

Instale o Insomnia https://insomnia.rest/download

Importe o workspace pela URL 
>https://github.com/lucasgweb/m2digital/blob/master/Insomnia.json

Execute a migration e o seeder em seu *prompt/terminal* ainda dentro do workspace do docker
>php artisan migrate:fresh

>php artisan db:seed
