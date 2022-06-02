<?php 
require "../inc/cabecalho-admin.php"; 
require "../inc/funcoes-usuarios.php";

//Carregaremos os dados da pessoa logada na sessão ($_SESSION['id'])
$usuario = lerUmUsuario($conexao, $_SESSION['id']);


  if (isset($_POST['atualizar'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $tipo = $_SESSION['tipo']; // recuperando qual o tipo de usuário
    $id = $_SESSION['id']; // recuperando qual o id de usuário
  
    // Lógica para a senha Se o campo da senha do formulario estiver vazio, entao significa que o usuario NÃO MUDOU A SENHA
    // 
    if( empty($_POST['senha'])) {
      $senha = $usuario['senha'];  //MANTER a senha já existente no banco 
    } else {
      /*Caso contrário, se o usuario digitou alguma coisa no campo senha, precisamos verificar a senha digitada. */
      $senha = verificaSenha($_POST['senha'], $usuario['senha']);
    }
    //TESTES DE SENHAS
  /*  echo "senha no banco:" .$usuario['senha'];
    echo "<br>";
    echo "senha do formulario:" .$senha; */
  atualizarUsuario($conexao, $id, $nome, $email, $senha, $tipo);
  header("location:index.php");

  }

?>
  <div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">
      <h2 class="text-center">Atualizar meu perfil</h2>

      <form action="" method="post" id="form-atualizar" name="form-atualizar" class="mx-auto w-75">
       <!--  <input class="form-control" type="hidden" name="id"> -->

        <div class="form-group">
          <label for="nome">Nome:</label>
          <input value="<?=$usuario['nome']?>" class="form-control" required type="text" id="nome" name="nome" placeholder="Nome (obrigatório)">
        </div>
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input value="<?=$usuario['email']?>"class="form-control" required type="email" id="email" name="email" placeholder="E-mail (obrigatório)">
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input class="form-control" type="password" id="senha" name="senha"  placeholder="Preencha apenas se for alterar">
        </div>

        <!-- //Select de tipos/níveis de usuários
        <div class="form-group">
          <label for="tipo">Tipo:</label>
          <select name="tipo" id="tipo" required class="custom-select">
              <option value=""></option>                    
              <option value="editor">Editor</option>     
              <option value="admin">Administrador</option>
          </select>
        </div> -->

        <button class="btn btn-lg btn-primary" name="atualizar">Atualizar</button>
      </form>
    </article>
  </div>

<?php
require "../inc/rodape-admin.php"; 
?>