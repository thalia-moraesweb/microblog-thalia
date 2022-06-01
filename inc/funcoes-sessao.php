<?php
/* Aqui programaremos futuramente
os recursos de login/logout e verificação
de permissão de acesso dos usuários */

/* VERIFICANDO SE NÃO EXISTE UMA SESSÃO EM FUNCIONAMENTO */
if(!isset($_SESSION)){
    session_start();
}

function verificaAcesso(){
    /* Se NÃO EXISTE uma variável de sessão relacionada
     ao id do usuário logado...*/
    if(!isset($_SESSION['id'])){
        /* Então significa que ele NÃO ESTÁ LOGADO, portanto 
        apague qualquer resquício de sessão e force o usuário 
        a ir para o login.php  */
    session_destroy();
    header("location:../login.php");
    die();
}

}

/* Usado na página login.php */
function login($id, $nome, $email, $tipo){
    /* Criando variáveis de Sessão ao logar */
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['tipo'] = $tipo;  
}

/* Usado nas páginas administrativas quando clicamos em Sair */
function logout(){
    session_start();
    session_destroy();
    header("location:../login.php");
    die();
}

