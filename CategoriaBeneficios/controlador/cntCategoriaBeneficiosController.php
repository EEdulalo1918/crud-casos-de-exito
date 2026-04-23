<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '0'); // evitar que warnings rompan el JSON

include('../../conexion.php');
include('../modelos/modCategoriaBeneficiosModel.php');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

$con = fncConexcion(); // conexión a la base por PDO
$model = new BeneficiosModel($con);

$action = $_GET['action'] ?? $_POST['action'] ?? null;

try {
    switch ($action) {
        case 'list':
            $rows = $model->getAllBeneficios();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => true, 'data' => $rows], JSON_UNESCAPED_UNICODE);
            break;

        case 'get':
            $id = intval($_GET['idCategoriaBeneficio'] ?? 0);
            $row = $model->getBeneficios($id);
            header('Content-Type: application/json; charset=utf-8');
            if ($row) {
                echo json_encode(['success' => true, 'data' => $row], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'No encontrado']);
            }
            break;

        case 'insert':
            $nombreCategoria = $_POST['txtNombreCategoria'] ?? '';
            $imagenNombre = null;
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $imagenNombre = $model->guardarImagen($_FILES['imagen']);
            }
            $ok = $model->insertBeneficios($nombreCategoria, $imagenNombre);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => $ok, 'message' => $ok ? 'Insertado' : 'No se pudo insertar'], JSON_UNESCAPED_UNICODE);
            break;

        case 'update':
            $id = intval($_POST['idCategoriaBeneficio'] ?? 0);
            $nombreCategoria = $_POST['txtNombreCategoria'] ?? '';
            $imagenNombre = null;

            if (!empty($_FILES['imagen']['tmp_name'])) {
                // borrar la anterior si existe
                $anterior = $model->getImagenNombre($id);
                $imagenNombre = $model->guardarImagen($_FILES['imagen']);
                if ($anterior && !empty($anterior['urlImg']) && $anterior['urlImg'] !== $imagenNombre) {
                    $model->eliminarImagen($anterior['urlImg']);
                }
            }

            $ok = $model->updateBeneficios($id, $nombreCategoria, $imagenNombre);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => $ok, 'message' => $ok ? 'Actualizado' : 'No se pudo actualizar'], JSON_UNESCAPED_UNICODE);
            break;

        case 'delete':
            $id = intval($_POST['idCategoriaBeneficio'] ?? $_GET['idCategoriaBeneficio'] ?? 0);
            $ok = $model->deleteBeneficios($id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => $ok], JSON_UNESCAPED_UNICODE);
            break;

        case 'image':
            // cargar la imagen
            $nombreCategoria = $_GET['name'] ?? '';
            $path = __DIR__ . '/../assets/img/' . basename($nombreCategoria);
            if (is_file($path)) {
                $mime = mime_content_type($path);
                header("Content-Type: {$mime}");
                readfile($path);
                exit;
            }
            http_response_code(404);
            echo 'Imagen no encontrada';
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
