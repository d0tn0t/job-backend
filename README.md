# Documentação do sistema

Essa API foi criada de acordo com os requisitos do teste, que seguem:
- [Laravel 10](https://laravel.com)
- PHP 8.1
- MySQL 8.0
- Docker

Em adicional, localmente foi utilizado XDebug 3.3 para debugger de código.

## Inicialização
Para iniciar o sistema, ajuste as variaveis de inicialização no arquivo *.env*. depois executar os seguintes comandos:


Primeiramente, deve-se subir o banco de dados:
`docker-compose up -d`

Realizar as migrações do banco de dados:
`php artisan migrate`


Depois, subimos o serviço PHP com o comando:
`php -S localhost:8080 -t public`

**Somente após subir todo o serviço de backend, deve proceder com o front**
