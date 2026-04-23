<?php
session_start();
header('Content-Type: application/json');

include '../modelos/modLogin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numempleado = $_POST['numempleado'] ?? '';
    $password = $_POST['password'] ?? '';

    $loginModel = new LoginModel();
    $resultado = $loginModel->verificarUsuario($numempleado, $password);

    if ($resultado) {
        $_SESSION['usuario'] = $numempleado;
        echo json_encode([
            'success' => true,
            'redirect' => 'Inicio/Vista/vtaInicio.php'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'El usuario no existe, verifica tus datos.'
        ]);
    }
}
