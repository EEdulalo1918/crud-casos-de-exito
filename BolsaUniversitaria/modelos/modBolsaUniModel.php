<?php
class BolsaUniModel {
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
//obtenemos todo las plataformas de la bolsa Universitaria
    public function getAllBolsaUni() {
        $sql = "SELECT `idPlataforma`, `nombre`, `urlPlataforma`, `imgPlataforma` FROM `bolsa_trabajo` ORDER BY `idPlataforma` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener Bolsa Universitaria por el id 
    public function getBolsaUni($id) {
        $stmt = $this->con->prepare("SELECT `idPlataforma`, `nombre`, `urlPlataforma`, `imgPlataforma` FROM `bolsa_trabajo` WHERE `idPlataforma` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //para agregrar un nuevo Bolsa Universitaria
    public function insertBolsaUni($nombre, $urlPlataforma, $imagenNombre = null) {
        $stmt = $this->con->prepare("INSERT INTO `bolsa_trabajo` (`nombre`, `urlPlataforma`, `imgPlataforma`) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $urlPlataforma, $imagenNombre]);
    }

    //actualizar el Bolsa Universitaria
    public function updateBolsaUni($id, $nombre, $urlPlataforma, $imagenNombre = null) {
        if ($imagenNombre !== null) {
            $stmt = $this->con->prepare("UPDATE `bolsa_trabajo` SET `nombre`=?, `urlPlataforma`=?, `imgPlataforma`=? WHERE `idPlataforma`=?");
            return $stmt->execute([$nombre, $urlPlataforma, $imagenNombre, $id]);
        } else {
            $stmt = $this->con->prepare("UPDATE `bolsa_trabajo` SET `nombre`=?, `urlPlataforma`=? WHERE `idPlataforma`=?");
            return $stmt->execute([$nombre, $urlPlataforma, $id]);
        }
    }

    //eliminar Bolsa Universitaria
    public function deleteBolsaUni($id) {
        // eliminar imagen física si existe
        $anterior = $this->getImagenNombre($id);
        if ($anterior && !empty($anterior['imgPlataforma'])) {
            $ruta = $this->uploadPath . basename($anterior['imgPlataforma']);
            if (is_file($ruta)) { @unlink($ruta); }
        }
        $stmt = $this->con->prepare("DELETE FROM `bolsa_trabajo` WHERE `idPlataforma`=?");
        return $stmt->execute([$id]);
    }

    //obtener el nombre de la imagen para el CRUD
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `imgPlataforma` FROM `bolsa_trabajo` WHERE `idPlataforma`=?");
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
