<h3 align="center">
  <p> API REST - GERENCIAMENTO DE PRODUTOS EM ESTOQUE </p>
</h3>
<img src="./public/swagger_doc.png" />
<h1>
  <p> Documentação Swagger | Endpoints </p>
</h1>

## 📖 Sobre o projeto

-   Criando uma **api rest** para gerenciamento de produtos e clientes.

-   A Aplicação é um teste técnico aplicado pela empresa Coalize para ser feito com o framework Yii2, porém além de fazer em Yii2 ➡️ (https://github.com/jefersoniw/avaliacao-tecnico-coalize), também decidir fazer usando o framework Laravel.

## ✅ Requisitos

-   Autenticação por credencial (usuário/senha) e retorno de token (Bearer sugerido).
-   Todas APIs (exceto a de autenticação) devem ter a validação do token fornecido ao efetuar
    a autenticação, preferencialmente passar pelo Header (Authorization).
-   Desenvolver APIs para os seguinte
    -   Autenticação
    -   Cadastro de cliente básico
        -   Nome
        -   CPF (com validação)
        -   Dados de endereço (CEP, Logradouro, Número, Cidade, Estado,
            Complemento)
        -   Foto
        -   Sexo
    -   Lista dos clientes
        -   Usar paginação para o retorno
    -   Cadastro de produto
        -   Nome
        -   Preço
        -   Cliente (detentor do produto)
        -   Foto
    -   Lista dos produtos
        -   Retornar paginado
        -   Permitir filtrar pelo cliente

## 🔨 Tecnologias utilizadas

-   [PHP](https://www.php.net/)
-   [Laravel](https://laravel.com/)
-   [Composer](https://getcomposer.org/)
-   [MySql](https://dev.mysql.com/doc/)
-   [Docker](https://www.docker.com/)
-   [Nginx](https://nginx.org/en/)
-   [Swagger](https://swagger.io/docs/)

## ♻️ Como executar o projeto

### Pré-requisitos:

-   Docker Desktop
-   Git

```bash
  # Clonar repositório
  $ git clone https://github.com/jefersoniw/project_product_manager_api.git
```

```bash
  # Entrar na pasta do projeto
  $ cd project_product_manager_api
```

```bash
  # copiar o env example para a nova configuração do env
  $ cp .env.example .env
```

```bash
  # copiar e ajustar as configurações de environment
  DB_CONNECTION=mysql
  DB_HOST=db_product_manager
  DB_PORT=3306
  DB_DATABASE=db_product_manager
  DB_USERNAME=root
  DB_PASSWORD=root

  REDIS_HOST=redis_product_manager
  REDIS_PASSWORD=null
  REDIS_PORT=6379
```

```bash
  # Cria e inicia os containers docker
  $ docker compose up -d
```

```bash
  # No docker, acessa o container do php para instalação das dependencias.
  $ docker compose exec app_product_manager bash
```

```bash
  # Instalando dependências
  $ composer install
```

```bash
  # Gerando uma nova chave no seu arquivo .env
  $ php artisan key:generate
```

```bash
  $ php artisan optimize
```

```bash
  # Publicando todo o schema de dados no banco de dados | Criação das tabelas no banco.
  $ php artisan migrate
```

```bash
  # Preenchendo o banco de dados com dados padrões.
  $ php artisan db:seed
```

-   ### Para acessar a documentação Swagger pelo projeto acesse ➡️ http://localhost/api/doc

## 🛎️ License

[![NPM](https://img.shields.io/badge/license-MIT-green)](https://github.com/jefersoniw/atendimento_nodejs/blob/main/LICENSE)

## 🤓 Autor

### Jeferson Chagas Silva

### https://www.linkedin.com/in/jefersoniw/
