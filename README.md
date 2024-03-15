<p align="center"><a href="https://oslab.com" target="_blank"><img src="https://raw.githubusercontent.com/bulfaitelo/oslab/main/public/vendor/oslab/imgs/oslab_logo.svg?token=GHSAT0AAAAAACLZ2RMQTXGEAH5ZFA6LX5RGZMMBXXA" width="400" alt="OSLab"></a></p>

<p align="center">
<a href="https://github.com/bulfaitelo/OSLab/issues" target="_blank" ><img alt="GitHub issues" src="https://img.shields.io/github/issues/bulfaitelo/OsLAb"></a>
<a href="https://github.com/bulfaitelo/oslab/actions" target="_blank" ><img src="https://github.com/bulfaitelo/oslab/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework" target="_blank" ><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# OSLab

O OsLab é um projeto desenvolvido para controlar os processo de abertura de chamados pagamentos e estoque, o seu maior beneficio e automatizar os processos repetitivos.

Ainda estamos em uma versão bem embrionária, porem os processos principais já estão funcionando razoavelmente bem!

## Requisitos

Apache com php 8.1 e um banco de dados podendo ser mysql ou algum outro banco relacional

## Docker_Dev_Web
Esse container que usei para desenvolver o projeto, caso queiram usar basta seguir nesse link:

[https://github.com/bulfaitelo/Docker_Dev_Web](https://github.com/bulfaitelo/Docker_Dev_Web)

Esse container já atende todos os requisitos do projeto, futuramente irei já integra de forma que fique mais fácil a aplicação como um container Docker. 

## Instalação

Certifique-se de ter o Composer instalado antes de seguir estas etapas.

1. Clone o repositório:

    ```bash
    git clone https://github.com/bulfaitelo/oslab
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd oslab
    ```

3. Instale as dependências do Composer:

    ```bash
    composer install
    ```

4. Copie o arquivo de ambiente:

    ```bash
    cp .env.example .env
    ```

5. Configure o arquivo `.env` com suas configurações de banco de dados e outras preferências.

6. Gere a chave de aplicativo:

    ```bash
    php artisan key:generate
    ```

7. Execute as migrações do banco de dados:

    ```bash
    php artisan migrate --seed
    ```
8. Dependendo do ambiente é só configura um vhost ou proxy reverso. o meu caso usei um container docker, que também usei pra desevolver esse projeto. 

## Contribuição

Sinta-se à vontade para contribuir para este projeto. Abra uma issue ou envie uma solicitação de pull.

