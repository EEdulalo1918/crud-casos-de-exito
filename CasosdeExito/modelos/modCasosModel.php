<?php
class CasosdeExitoModel {
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
//obtenemos todo los casos_exito
    public function getAllCasosdeExito() {
        $sql = "SELECT `idCaso`, `nombre`, `carrera`, `descripcion`, `imgCE` FROM `casos_exito` ORDER BY `idCaso` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener caso de éxito por el id 
    public function getCasosdeExito($id) {
        $stmt = $this->con->prepare("SELECT `idCaso`, `nombre`, `carrera`, `descripcion`, `imgCE` FROM `casos_exito` WHERE `idCaso` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //para agregrar un nuevo caso de éxito
    public function insertCasosdeExito($nombre, $carrera, $descripcion, $imagenNombre = null) {
        $stmt = $this->con->prepare("INSERT INTO `casos_exito` (`nombre`, `carrera`, `descripcion`, `imgCE`) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $carrera, $descripcion, $imagenNombre]);
    }

    //actualizar el caso de éxito
    public function updateCasosdeExito($id, $nombre, $carrera, $descripcion, $imagenNombre = null) {
        if ($imagenNombre !== null) {
            $stmt = $this->con->prepare("UPDATE `casos_exito` SET `nombre`=?, `carrera`=?, `descripcion`=?, `imgCE`=? WHERE `idCaso`=?");
            return $stmt->execute([$nombre, $carrera, $descripcion, $imagenNombre, $id]);
        } else {
            $stmt = $this->con->prepare("UPDATE `casos_exito` SET `nombre`=?, `carrera`=?, `descripcion`=? WHERE `idCaso`=?");
            return $stmt->execute([$nombre, $carrera, $descripcion, $id]);
        }
    }

    //eliminar caso de éxito
    public function deleteCasosdeExito($id) {
        // eliminar imagen física si existe
        $anterior = $this->getImagenNombre($id);
        if ($anterior && !empty($anterior['imgCE'])) {
            $ruta = $this->uploadPath . basename($anterior['imgCE']);
            if (is_file($ruta)) { @unlink($ruta); }
        }
        $stmt = $this->con->prepare("DELETE FROM `casos_exito` WHERE `idCaso`=?");
        return $stmt->execute([$id]);
    }

    //obtener el nombre de la imagen para el CRUD
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `imgCE` FROM `casos_exito` WHERE `idCaso`=?");
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
