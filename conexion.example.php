<?php
function fncConexcion(){
    $host = "localhost";         // servidor
    $user = "TU_USUARIO";        // usuario de MySQL
    $pass = "TU_CONTRASEÑA";     // contraseña
    $bd   = "NOMBRE_DE_TU_BD";   // nombre de la base de datos

    $dsn = "mysql:host={$host};dbname={$bd};charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'message' => 'Error de conexión']);
        exit;
    }
}
?>