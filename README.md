# Exemplo de API desenvolvida em Laravel

## Passo a passo para rodar o projeto
<p>Clone o repositório</p>
```
git clone https://github.com/wesleyfranco/book-rental-api.git book-rental-api
```
```
cd book-rental-api/
```
<p>Crie o Arquivo .env</p>
```
cp .env.example .env
```
## Atualize as variáveis de ambiente do arquivo .env

```
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui
```
```
composer install
```
## Gerar a key do projeto Laravel
```
php artisan key:generate
```
## Rodar as migrações
```
php artisan migrate
```
## Gerar a chave secreta do JWT
```
php artisan jwt:secret
```
## Gerar a documentação do swagger
```
php artisan l5-swagger:generate
```
<p>Acesse a documentação via: http://localhost:8000/api/documentation</p>