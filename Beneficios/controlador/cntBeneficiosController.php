<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '0'); // evita que warnings rompan el JSON

include('../../conexion.php');
include('../modelos/modBeneficiosModel.php');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

$con = fncConexcion(); // conexión PDO
$model = new BeneficiosModel($con);

function json_ok($data) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $action = $_GET['action'] ?? $_POST['action'] ?? '';

    switch ($action) {
        
        
        case 'list':
    $cat = intval($_GET['idCategoriaBeneficio'] ?? 0);
    if ($cat > 0) {
        // JOIN para garantizar relación y traer nombre de categoría
        if (method_exists($model, 'getBeneficiosJoinCategoria')) {
            $rows = $model->getBeneficiosJoinCategoria($cat);
        } else {
            $rows = $model->getBeneficiosByCategoria($cat); // fallback
        }
    } else {
        $rows = $model->getAllBeneficios();
    }
    json_ok(['success' => true, 'data' => $rows]);
    break;


        case 'get':
            $id = intval($_GET['idBeneficio'] ?? 0);
            $row = $model->getBeneficios($id);
            json_ok(['success' => (bool)$row, 'data' => $row]);
            break;

        case 'insert':
            $nombre = $_POST['txtNombreBeneficio'] ?? '';
            $tipo = intval($_POST['txtIdTipoBeneficio'] ?? 0);
            $descuento = intval($_POST['txtDescuento'] ?? 0);
            $desc = $_POST['atxtDescBeneficio'] ?? '';
            $categoria = intval($_POST['txtIdCategoriaBeneficio'] ?? 0);
            $img = null;
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $img = $model->guardarImagen($_FILES['imagen']);
            }
            $ok = $model->insertBeneficios($nombre, $tipo, $descuento, $desc, $categoria, $img);
            json_ok(['success' => $ok, 'message' => $ok ? 'Insertado' : 'No se pudo insertar']);
            break;

        case 'update':
            $id = intval($_POST['idBeneficio'] ?? 0);
            $nombre = $_POST['txtNombreBeneficio'] ?? '';
            $tipo = intval($_POST['txtIdTipoBeneficio'] ?? 0);
            $descuento = intval($_POST['txtDescuento'] ?? 0);
            $desc = $_POST['atxtDescBeneficio'] ?? '';
            $categoria = intval($_POST['txtIdCategoriaBeneficio'] ?? 0);

            $img = null;
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $anterior = $model->getImagenNombre($id);
                $img = $model->guardarImagen($_FILES['imagen']);
                if ($anterior && $anterior !== $img) { $model->eliminarImagen($anterior); }
            }
            $ok = $model->updateBeneficios($id, $nombre, $tipo, $descuento, $desc, $categoria, $img);
            json_ok(['success' => $ok, 'message' => $ok ? 'Actualizado' : 'No se pudo actualizar']);
            break;

        case 'delete':
            $id = intval($_POST['idBeneficio'] ?? $_GET['idBeneficio'] ?? 0);
            $ok = $model->deleteBeneficios($id);
            json_ok(['success' => $ok]);
            break;

        case 'image':
            $name = $_GET['name'] ?? '';
            $path = __DIR__ . '/../assets/img/' . basename($name);
            if (is_file($path)) {
                $mime = 'image/jpeg';
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext === 'png') $mime = 'image/png';
                header('Content-Type: ' . $mime);
                readfile($path);
                exit;
            }
            http_response_code(404);
            echo 'Imagen no encontrada';
            break;

        default:
            json_ok(['success' => false, 'message' => 'Acción no válida']);
    }
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => 'Error en el servidor', 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}