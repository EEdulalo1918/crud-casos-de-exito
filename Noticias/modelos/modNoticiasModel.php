<?php
class NoticiasModel {
    private $con;
    private $uploadPath;

    public function __construct($con) {
        $this->con = $con; // PDO
        $this->uploadPath = __DIR__ . '/../assets/img/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }
//obtenemos todo las noticias
    public function getAllNoticias() {
        $sql = "SELECT `idNoticia`,`titulo`,`autor`, `epigrafe`, `contenido`, `imgNoticia` FROM `noticias` ORDER BY `idNoticia` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener noticia por el id 
    public function getNoticias($id) {
        $stmt = $this->con->prepare("SELECT `idNoticia`,`titulo`,`autor`, `epigrafe`, `contenido`, `imgNoticia` FROM `noticias` WHERE `idNoticia` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //para agregrar un nueva noticia
    public function insertNoticias($titulo,$autor,$epigrafe, $contenido, $imagenNombre = null) {
        $stmt = $this->con->prepare("INSERT INTO `noticias`( `titulo`,`autor`, `epigrafe`, `contenido`, `imgNoticia`) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$titulo,$autor,$epigrafe, $contenido, $imagenNombre]);
    }

    //actualizar la noticia
    public function updateNoticias($id, $titulo,$autor,$epigrafe, $contenido, $imagenNombre = null) {
        if ($imagenNombre !== null) {
            $stmt = $this->con->prepare("UPDATE `noticias` SET `titulo`=?,`autor`=?, `epigrafe`=?,`contenido`=?, `imgNoticia`=? WHERE `idNoticia`=?");
            return $stmt->execute([$titulo,$autor,$epigrafe, $contenido, $imagenNombre, $id]);
        } else {
            $stmt = $this->con->prepare("UPDATE `noticias` SET`titulo`=?,`autor`=?, `epigrafe`=?,`contenido`=? WHERE `idNoticia`=?");
            return $stmt->execute([$titulo,$autor,$epigrafe, $contenido, $id]);
        }
    }

    //eliminar noticia
    public function deleteNoticias($id) {
        // eliminar imagen física si existe
        $anterior = $this->getImagenNombre($id);
        if ($anterior && !empty($anterior['imgNoticia'])) {
            $ruta = $this->uploadPath . basename($anterior['imgNoticia']);
            if (is_file($ruta)) { @unlink($ruta); }
        }
        $stmt = $this->con->prepare("DELETE FROM `noticias` WHERE `idNoticia`=?");
        return $stmt->execute([$id]);
    }

    //obtener el titulo de la imagen para el CRUD
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `imgNoticia` FROM `noticias` WHERE `idNoticia`=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    //guardar imagen
    public function guardarImagen($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al subir la imagen.');
        }
        // Validar tipo
        $allowed = ['image/jpeg' => 'jpeg','image/png' => 'png','image/jpg' => 'jpg', 'image/gif'=>'gif'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!array_key_exists($mime, $allowed)) {
        throw new Exception('Formato de imagen no permitido.');
        }

        // Generar titulo único y mover a la carpeta 
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nuevoNombre = uniqid('img_', true) . '.' . strtolower($ext);
        $destino = $this->uploadPath . $nuevoNombre;
        if (!move_uploaded_file($file['tmp_name'], $destino)) {
            throw new Exception('No se pudo mover la imagen.');
        }
        return $nuevoNombre;
    }

    public function eliminarImagen($titulo){
        if (!$titulo) return false;
        $ruta = $this->uploadPath . basename($titulo);
        if (is_file($ruta)) { return @unlink($ruta); }
        return true;
    }


}
?>