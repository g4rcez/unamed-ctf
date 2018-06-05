# Unamed CTF - Plataforma de CTF

## **Esse repositório será mantido em: [unamecorporation/unamed-ctf](https://github.com/unamecorporation/unamed-ctf)**

> Deixamos o nome pra depois e acabou ficando sem xD

## Desenvolvedores
- Programação Backend, Design/FrontEnd: [VandalVNL](https://github.com/vandalvnl)
- Programação Backend e Modelagem: [Tristão](https://github.com/ricardoporfirio)
- Testes de Segurança: [ninj4c0d3r](https://github.com/ninj4c0d3r)

Agradecemos a todos os que nos deram boas ideias para a implementação da plataforma, bem
como as demais plataformas de CTF que nos inspiraram para tal.

## Introdução

Com a proposta do KurupiraOS de ser um sistema operacional voltado para o ensino de Segurança da Informação, havia a necessidade de dar um modo aos usuários de aplicar o conhecimento prático através de desafios. Para evitar problemas de licença e patente, nossa equipe (Eu e Tristão, e sim, Tristão é um sobrenome) optamos por desenvolver esta plataforma.

Com o decorrer do projeto, outras oportunidades de uso surgiram, e decidimos não atrelar a plataforma diretamente ao sistema, liberando o código fonte da plataforma, sob a licença GPL2.

## Sobre a Plataforma

Esta plataforma foi desenvolvida em PHP, utilizando o Framework Laravel em sua versão 5.4 e banco de dados MariaDB/MySQL (v5.7.x). A escolha de PHP para a plataforma é pela facilidade de instalação em qualquer servidor, sem que hava um host com configuração bastante parruda.

A escolha do Framework foi para agilizar o desenvolvimento e garantir a integridade de certas funções que seriam críticas ao sistema. Como o Laravel é um dos melhores, se não o melhor Framework do mercado, foi quase que instantânea a escolha.

Algumas das funções citadas a seguir já estão implementadas, outras são planos para versões futuras:

- Sistema de login do usuário, com escolhe de categoria favorita
- Rota dinâmica para o painel do administrador
- Cadastro de Desafios, Categorias, Maestrias
- Identificação de erros e repetições em challenges
- Gráfico de pontuação dos usuários
- Tabela de Scoreboard

## Versões Futuras

Afim de adiantar o lançamento da primeira versão, nem todas as funcionalidades desejadas foram implementadas. Os itens a seguir são as futuras implementações da plataforma:

- Sistema de Times
- Bug Bounty embutido na plataforma
- Sistema de avaliação para as challenges disponíveis
- Divisão de grupos na plataforma, onde usuários poderão acrescentar desafios e categorias, sob aprovação do administrador
- Rota dinâmica com armazenamento no banco, existindo mais de uma possibilidade para o painel de administrador

## Uso da plataforma

Como a plataforma foi desenvolvida em um Framework PHP, algumas coisas devem ser feitas antes de instalar. Para maiores informações sobre os requisitos básicos, basta seguir as recomendações de [Laravel Server Requirements](https://laravel.com/docs/5.5#server-requirements).

Caso você tenha dificuldades em achar os pacotes para a instalação, estes são os necessários

```bash
php php-mcrypt composer mariadb nginx
```
**De acordo com sua distribuição, o nome dos pacotes podem mudar**

### Especificações do Banco de Dados

Na pasta '/developer' contem arquivos referentes ao banco de dados, incluindo a modelagem e o script sql. Assumindo que esta seja uma instalação feita do zero, e que não existe o banco de dados 'unamectf' em seu localhost, basta rodar o seguinte comando para a configuração do banco, e que esteja na pasta raiz deste projeto:

```bash
cat developer/database.sql | mysql -u'seu usuário' -p'senha do usuário'
```

### Configuração do Framework

Laravel exige que você rode comandos do composer para a instalação e atualização de seu projeto. Primeiro, será necessário criar o arquivo '.env' para o projeto ter suas variáveis de ambiente. Dentro da raiz do projeto, basta rodar os seguintes comandos:

```bash
cp env.example .env # cria o arquivo .env para o projeto
composer install && composer update # instala e atualiza os pacotes necessários
php artisan key:generate
```

Com isso, todo o necessário para o uso da plataforma já está instalado e quase tudo pronto para uso. No arquivo recém criado, '.env', deve-se configurar certos parâmetros. Abaixo, você confere os parâmetros que precisam ser modificados.

- DB_CONNECTION=mysql
SGBD para seu projeto. Não foram realizados testes com Postgresql, apenas com MySQL/MariaDB

- DB_HOST=127.0.0.1
Host onde o banco de dados do projeto se encontra

- DB_PORT=3306
Porta do MySql no servidor

- DB_DATABASE='unamectf'
Nome do banco usado para a aplicação

- DB_USERNAME='user'
Nome do usuário com as devidas permissões para acesso ao banco

- DB_PASSWORD='password'
Senha do usuário

Os itens citados a seguir, são configurações relacionadas aos estados de dados dos itens da plataforma.

- CTF_NAME='UnamedCTF'
Nome que deseja utilizar para a plataforma

- ADMIN_PERM='administrador'
Campo da tabela que possui a permissão de administrador. [Funcionalidade ainda não implementada]

- ADMIN_ROUTE='administrador'
Rota que contém o painel administrativo

- CTF_REGISTER='registrar'
Rota para cadastro de usuários

- USER_ROUTE='home'
Rota inicial para os jogadores
