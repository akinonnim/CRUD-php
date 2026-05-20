<?php
session_start();
require 'conexao.php';

if (isset($_POST['create-usuario'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)) : '';

    $sql = "INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES ('$nome', '$email', '$data_nascimento', '$senha')";

    // echo $sql;
    // exit;

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso!!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não criado, verifique...';
        header('Location:index.php');
        exit;
    }
}

// if (isset($_POST['update_usuario'])) {
//     $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
//     $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
//     $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
//     $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
//     $senha =  mysqli_real_escape_string($conexao, trim($_POST['senha']));

//     $sql = "UPDATE usuarios SET nome = '$nome', email= '$email', data_nascimento = 'data_nascimento'";

//     if (!empty($senha)) {
//         $sql .= ", senha='" . password_hash($senha, PASSWORD_DEFAULT) . "'";
//     }

//     $sql .= "WHERE id = 'usuario_id'";

//     mysqli_query($conexao, $sql);



//     if (mysqli_affected_rows($conexao) > 0) {
//         $_SESSION['mensagem'] = 'Usuário editado com sucesso!!';
//         header('Location: index.php');
//         exit;
//     } else {
//         $_SESSION['mensagem'] = 'Usuário não atualizado, verifique...';
//         header('Location:index.php');
//         exit;
//     }
// }

if (isset($_POST['update-usuario'])) {  // agora com underline
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $senha = trim($_POST['senha']);

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', data_nascimento = '$data_nascimento'";

    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = '$senha_hash'";
    }

    $sql .= " WHERE id = '$usuario_id'";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = 'Usuário editado com sucesso!!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao editar usuário: ' . mysqli_error($conexao);
    }
    header('Location: index.php');
    exit;
}
