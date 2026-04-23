<?php
class RecuerdosModel {
    /*@var PDO */
    private $con;
    private $uploadPath;

    public function __construct($con) {
        $this->con = $con; // PDO
        $this->uploadPath = __DIR__ . '/../assets/img/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }
//obtenemos todo los recuerdos
    public function getAllRecuerdos() {
        $sql = "SELECT `idRecuerdo`, `nombre`, `descripcion`, `imgRecuerdo` FROM `recuerdos` ORDER BY `idRecuerdo` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener recuerdo por el id 
    public function getRecuerdos($id) {
        $stmt = $this->con->prepare("SELECT `idRecuerdo`, `nombre`, `descripcion`, `imgRecuerdo` FROM `recuerdos` WHERE `idRecuerdo` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //para agregrar un nuevo recuerdo
    public function insertRecuerdos($nombre, $descripcion, $imagenNombre = null) {
        $stmt = $this->con->prepare("INSERT INTO `recuerdos` (`nombre`, `descripcion`, `imgRecuerdo`) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $imagenNombre]);
    }

    //actualizar el recuerdo
    public function updateRecuerdos($id, $nombre, $descripcion, $imagenNombre = null) {
        if ($imagenNombre !== null) {
            $stmt = $this->con->prepare("UPDATE `recuerdos` SET `nombre`=?, `descripcion`=?, `imgRecuerdo`=? WHERE `idRecuerdo`=?");
            return $stmt->execute([$nombre, $descripcion, $imagenNombre, $id]);
        } else {
            $stmt = $this->con->prepare("UPDATE `recuerdos` SET `nombre`=?, `descripcion`=? WHERE `idRecuerdo`=?");
            return $stmt->execute([$nombre, $descripcion, $id]);
        }
    }

    //eliminar recuerdo
    public function deleteRecuerdos($id) {
        // eliminar imagen física si existe
        $anterior = $this->getImagenNombre($id);
        if ($anterior && !empty($anterior['imgRecuerdo'])) {
            $ruta = $this->uploadPath . basename($anterior['imgRecuerdo']);
            if (is_file($ruta)) { @unlink($ruta); }
        }
        $stmt = $this->con->prepare("DELETE FROM `recuerdos` WHERE `idRecuerdo`=?");
        return $stmt->execute([$id]);
    }

    //obtener el nombre de la imagen para el CRUD
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `imgRecuerdo` FROM `recuerdos` WHERE `idRecuerdo`=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    //guardar imagen
    public function guardarImagen($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al subir la imagen.');
        }
        // Validar tipo
        $allowed = ['image/gif'  => 'gif','image/jpeg' => 'jpeg','image/png' => 'png','image/jpg' => 'jpg'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!array_key_exists($mime, $allowed)) {
        throw new Exception('Formato de imagen no permitido.');
        }

        // Generar nombre único y mover a la carpeta 
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nuevoNombre = uniqid('img_', true) . '.' . strtolower($ext);
        $destino = $this->uploadPath . $nuevoNombre;
        if (!move_uploaded_file($file['tmp_name'], $destino)) {
            throw new Exception('No se pudo mover la imagen.');
        }
        return $nuevoNombre;
    }

    public function eliminarImagen($nombre) {
        if (!$nombre) return false;
        $ruta = $this->uploadPath . basename($nombre);
        if (is_file($ruta)) { return @unlink($ruta); }
        return true;
    }


}
?>