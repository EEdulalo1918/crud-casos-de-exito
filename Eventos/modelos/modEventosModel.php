<?php
class EventosModel {
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
//obtenemos todo los eventos
    public function getAllEventos() {
        $sql = "SELECT `idEvento`, `nombreEvento`, `nombrePersona`, `hora`,`fecha`,`descEvento`,`lugar`, `imagenEvento`,`urlEvento` FROM `eventos` ORDER BY `idEvento` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener Evento por el id 
    public function getEventos($id) {
        $stmt = $this->con->prepare("SELECT `idEvento`, `nombreEvento`, `nombrePersona`, `hora`,`fecha`,`descEvento`,`lugar`, `imagenEvento`,`urlEvento` FROM `eventos` WHERE `idEvento` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //para agregrar un nuevo Evento
    public function insertEventos($nombre, $nompersona,$hora,$fecha, $descripcion,$lugar, $imagenNombre = null, $url) {
        $stmt = $this->con->prepare("INSERT INTO `eventos` (`nombreEvento`, `nombrePersona`, `hora`,`fecha`,`descEvento`,`lugar`, `imagenEvento`,`urlEvento`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $nompersona,$hora,$fecha, $descripcion,$lugar, $imagenNombre,$url]);
    }

    //actualizar el Evento
    public function updateEventos($id, $nombre, $nompersona,$hora,$fecha, $descripcion,$lugar, $imagenNombre = null,$url) {
        if ($imagenNombre !== null) {
            $stmt = $this->con->prepare("UPDATE `eventos` SET `nombreEvento`=?, `nombrePersona`=?,`hora`=?,`fecha`=?, `descEvento`=?, `lugar`=?, `imagenEvento`=?, urlEvento=? WHERE `idEvento`=?");
            return $stmt->execute([$nombre, $nompersona,$hora,$fecha, $descripcion,$lugar, $imagenNombre,$url, $id]);
        } else {
            $stmt = $this->con->prepare("UPDATE `eventos` SET `nombreEvento`=?, `nombrePersona`=?,`hora`=?,`fecha`=?, `descEvento`=?, `lugar`=?, urlEvento=? WHERE `idEvento`=?");
            return $stmt->execute([$nombre, $nompersona,$hora,$fecha, $descripcion,$lugar,$url,$id]);
        }
    }

    //eliminar Evento
    public function deleteEventos($id) {
        // eliminar imagen física si existe
        $anterior = $this->getImagenNombre($id);
        if ($anterior && !empty($anterior['imagenEvento'])) {
            $ruta = $this->uploadPath . basename($anterior['imagenEvento']);
            if (is_file($ruta)) { @unlink($ruta); }
        }
        $stmt = $this->con->prepare("DELETE FROM `eventos` WHERE `idEvento`=?");
        return $stmt->execute([$id]);
    }

    //obtener el nombre de la imagen para el CRUD
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `imagenEvento` FROM `eventos` WHERE `idEvento`=?");
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
