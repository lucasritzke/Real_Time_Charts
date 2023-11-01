Visão Geral

O projeto consiste em uma página da web que exibe um gráfico de uso de memória com base em dados armazenados em um banco de dados. Os principais recursos do projeto incluem:

    Visualização de gráfico em tempo real do uso de memória.
    Opção para selecionar o número de atualizações exibidas no gráfico.
    Alternar a atualização em tempo real do gráfico.
    Filtragem de dados com base no período desejado (últimos 5, 15 ou 30 dias).

Conteúdo do Projeto

O projeto é composto por vários arquivos, sendo os principais:

    index.php: A página principal que exibe o gráfico em tempo real do uso de memória.
    advanced_grapic.php: Uma página que exibe o gráfico mais antigo com opções de filtro.
    main.css e styles.css: Arquivos de estilo CSS para a formatação da página.
    Chart.js: A biblioteca JavaScript utilizada para criar o gráfico.
    README.md: Este arquivo que fornece informações sobre o projeto.

Configuração e Requisitos

Para executar o projeto localmente, é necessário configurar um servidor web, PHP e um banco de dados MySQL. Siga os seguintes passos:

    Configure um servidor web (como Apache) e certifique-se de que o PHP esteja instalado.
    Importe o banco de dados SQL fornecido para armazenar os dados do gráfico.
    Certifique-se de que o arquivo de configuração do banco de dados ($conn) em "index.php" esteja correto.
    Certifique-se de que o Chart.js esteja incluído no projeto a partir do CDN fornecido no cabeçalho do arquivo HTML.
    Coloque todos os arquivos na raiz do servidor web.

Uso

Após configurar o ambiente, você pode acessar o projeto no navegador da seguinte forma:

    Página Principal: http://seuservidor/index.php
    Gráfico Mais Antigo: http://seuservidor/advanced_grapic.php

O projeto permite:

    Visualizar o gráfico em tempo real do uso de memória.
    Alternar a atualização em tempo real do gráfico pressionando o botão "Parar Atualização".
    Selecionar o número de atualizações exibidas no gráfico usando o menu suspenso "Filtrar por data".

Contribuição

Este projeto é um exemplo básico de um gráfico de uso de memória e pode ser personalizado e aprimorado de várias maneiras. Se você desejar contribuir para o projeto, sinta-se à vontade para fazer alterações e melhorias, como aprimoramento do design, adição de recursos adicionais ou otimização do código.
Autor

    Nome: Lucas Felipe Ritzke
    Email: lucasritzke@gmail.com
