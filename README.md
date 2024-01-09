# Documentação do sistema

Essa API foi criada de acordo com os requisitos do teste, que seguem:
- [Laravel 10](https://laravel.com)
- PHP 8.1
- MySQL 8.0
- Docker

Em adicional, localmente foi utilizado XDebug 3.3 para debugger de código.

## Inicialização
Para iniciar o sistema, ajuste as variaveis de inicialização no arquivo *.env*. 
Primeiramente, execute a geração do APP KEY:
```
php artisan key:generate
```
Isso irá gerar uma chave de criptografia para a aplicação.

Depois, crie a chave para segurança do JWT:
```
openssl rand -base64 32
```
Copie o código gerado e copie no seu arquivo .env:
```
JWT_SECRET=<insira aqui o código gerado acima>
JWT_ALGO=HS256
```

Depois executar os seguintes comandos:


Subir o container do banco de dados:
`docker-compose up -d`

Realizar as migrações do banco de dados:
`php artisan migrate`

Depois, subimos o serviço PHP com o comando:
`php -S localhost:8080 -t public`

**Somente após subir todo o serviço de backend, deve proceder com o front**
