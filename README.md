# Unamed CTF - Plataforma de CTF
> Deixamos o nome pra depois e acabou ficando sem xD

## Desenvolvedores
- Programação Backend, Design/FrontEnd: [VandalVNL](https://github.com/vandalvnl)
- Programação Backend e Modelagem: [Tristão]

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

