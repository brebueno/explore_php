<?php

//recebe os campos do formulário
$nome = $_POST ['nome'];
$email = $_POST ['email'];
$sexo = $_POST ['sexo'];
$telefone = $_POST ['telefone'];
$senha = $_POST ['senha'];
$estado = $_POST ['estado'];
$cidade = $_POST ['cidade'];
$destinos = $_POST ['destinos'];
$idade = $_POST ['idade'];
$hospedagem = $_POST ['hospedagem'];
$dt_cadastro = $_POST ['dt-cadastro'];
$mensagem = $_POST ['mensagem'];


//Para investigar variáveis e expressões
//var_dump($_POST);

//Conecta ao banco e grava os dados (insert com PDO)
try{

    //Instancia o banco por meio do PDO
    $pdo = new PDO('mysql:host=localhost;dbname=explore', 'root', '');
    //insert na tabela users
    $sql = $pdo->prepare('insert into users_2 
    (nome, email, sexo, telefone, senha, estado, cidade, destinos, idade, hospedagem, dt_cadastro, mensagem) 
    values(:nome, :email, :sexo, :telefone, :senha, :estado, :cidade, :destinos, :idade, :hospedagem, :dt_cadastro, :mensagem)');
    $sql->execute(array(

        ':nome' => $nome,
        ':email' => $email,
        ':sexo' => $sexo,
        ':telefone' => $telefone,
        ':senha' => md5($senha), //coloca criptografia na senha
        ':estado' => $estado,
        ':cidade' => $cidade,
        ':destinos' => implode(', ', $destinos), //converte array em texto
        ':idade' => $idade,
        ':hospedagem' => $hospedagem,
        ':dt_cadastro' => date('Y-m-d', strtotime($dt_cadastro)),
        ':mensagem' => $mensagem,

        ));
        //carrega a pagina index.html enviando variavel GET cadastro
        //para separar parametros, usa &
        header('Location: index.html?cadastro=ok');

    /* echo '<h1> usuario cadastrado </h1>';
    var_dump($_POST); */

} catch (PDOException $erro) {
    //se der erro, exibe o erro aqui
    echo $erro;

}
