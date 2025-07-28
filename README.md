<h1>Exemplo de API desenvolvida em Laravel</h1>

<h2>Passo a passo para rodar o projeto</h2>
<p>Clone o repositório</p>
<p>git clone https://github.com/wesleyfranco/book-rental-api.git book-rental-api</p>
<p>cd book-rental-api/</p>
<p>Crie o Arquivo .env</p>
<p>cp .env.example .env</p>
<h2>Atualize as variáveis de ambiente do arquivo .env</h2>

APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

<p>composer install</p>
<h2>Gerar a key do projeto Laravel</h2>
<p>php artisan key:generate</p>
<h2>Rodar as migrações</h2>
<p>php artisan migrate</p>
<h2>Gerar a chave secreta do JWT</h2>
<p>php artisan jwt:secret</p>
<h2>Gerar a documentação do swagger</h2>
<p>php artisan l5-swagger:generate</p>
<p>Acesse a documentação via: http://localhost:8000/api/documentation</p>