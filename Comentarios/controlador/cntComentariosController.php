<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '0'); // evitar que warnings rompan el JSON

include('../../conexion.php');
include('../modelos/modComentariosModel.php');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

$con = fncConexcion(); // conexión a la base por PDO
$model = new ComentariosModel($con);

$action = $_GET['action'] ?? $_POST['action'] ?? null;

try {
    switch ($action) {
        case 'list':
            $rows = $model->getAllComentarios();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => true, 'data' => $rows], JSON_UNESCAPED_UNICODE);
            break;

        case 'get':
            $id = intval($_GET['idComentario'] ?? 0);
            $row = $model->getComentarios($id);
            header('Content-Type: application/json; charset=utf-8');
            if ($row) {
                echo json_encode(['success' => true, 'data' => $row], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'No encontrado']);
            }
            break;

        case 'delete':
            $id = intval($_POST['idComentarios'] ?? $_GET['idComentarios'] ?? 0);
            $ok = $model->deleteComentarios($id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => $ok], JSON_UNESCAPED_UNICODE);
            break;

        default:
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Acción no válida'], JSON_UNESCAPED_UNICODE);
    }
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => 'Error en el servidor', 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
