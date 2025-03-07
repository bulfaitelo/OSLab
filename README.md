[![OSLab](https://raw.githubusercontent.com/bulfaitelo/oslab/main/public/vendor/oslab/imgs/oslab_logo_marca.png)]()
[![Version](https://img.shields.io/badge/version-0.0.1-blue.svg?longCache=true&style=flat-square)]()
[![Issues](https://img.shields.io/github/issues/bulfaitelo/oslab.svg?longCache=true&style=flat-square)](https://github.com/bulfaitelo/OSLab/issues)
[![GitHub branch check runs](https://img.shields.io/github/check-runs/bulfaitelo/OSLab/main?logo=github-actions&logoColor=white&style=flat-square)](https://github.com/bulfaitelo/oslab/actions)
[![StyleCI](https://github.styleci.io/repos/642922269/shield?branch=main)](https://github.styleci.io/repos/642922269)
![Contributors](https://img.shields.io/github/contributors/bulfaitelo/oslab.svg?longCache=true&style=flat-square)
[![License](https://img.shields.io/badge/license-MIT-green.svg?longCache=true&style=flat-square)]()

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

## Usuário e senha padrão

No `migrate  --seed` já é criado um usuário com todas as permissões pra facilitar os testes e o primeiro acesso, segue a baixo:

**User:** admin@oslab.com.br

**Senha:** admin12345

## Contribuição

Sinta-se à vontade para contribuir para este projeto. Abra uma issue ou envie uma solicitação de pull.

## Licença  
Este projeto é distribuído sob a **OSLab License v1.0**, que permite o uso e modificação do código, mas **proíbe sua comercialização direta**.  
Para mais detalhes, consulte o arquivo [https://github.com/bulfaitelo/OSLab/blob/main/LICENSE](LICENSE).  
