<?php
class BeneficiosModel {
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
//obtenemos todo los beneficios
    public function getAllBeneficios() {
        $sql = "SELECT `idCategoriaBeneficio`, `nombreCategoria`, `urlImg` FROM `categoria_beneficios` ORDER BY `idCategoriaBeneficio` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener Beneficios por el id 
    public function getBeneficios($id) {
        $stmt = $this->con->prepare("SELECT `idCategoriaBeneficio`, `nombreCategoria`, `urlImg` FROM `categoria_beneficios` WHERE `idCategoriaBeneficio` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //para agregrar un nuevo Beneficios
    public function insertBeneficios($nombreCategoria, $imagenNombre = null) {
        $stmt = $this->con->prepare("INSERT INTO `categoria_beneficios` (`nombreCategoria`, `urlImg`) VALUES (?,?)");
        return $stmt->execute([$nombreCategoria, $imagenNombre]);
    }

    //actualizar el Beneficios
    public function updateBeneficios($id, $nombreCategoria, $imagenNombre = null) {
        if ($imagenNombre !== null) {
            $stmt = $this->con->prepare("UPDATE `categoria_beneficios` SET `nombreCategoria`=?, `urlImg`=? WHERE `idCategoriaBeneficio`=?");
            return $stmt->execute([$nombreCategoria, $imagenNombre, $id]);
        } else {
            $stmt = $this->con->prepare("UPDATE `categoria_beneficios` SET `nombreCategoria`=?
            WHERE `idCategoriaBeneficio`=?");
            return $stmt->execute([$nombreCategoria, $id]);
        }
    }

    //eliminar Beneficios
    public function deleteBeneficios($id) {
        // eliminar imagen física si existe
        $anterior = $this->getImagenNombre($id);
        if ($anterior && !empty($anterior['urlImg'])) {
            $ruta = $this->uploadPath . basename($anterior['urlImg']);
            if (is_file($ruta)) { @unlink($ruta); }
        }
        $stmt = $this->con->prepare("DELETE FROM `categoria_beneficios` WHERE `idCategoriaBeneficio`=?");
        return $stmt->execute([$id]);
    }

    //obtener el nombre de la imagen para el CRUD
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `urlImg` FROM `categoria_beneficios` WHERE `idCategoriaBeneficio`=?");
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

        public function eliminarImagen($nombreCategoria) {
        if (!$nombreCategoria) return false;
        $ruta = $this->uploadPath . basename($nombreCategoria);
        if (is_file($ruta)) { return @unlink($ruta); }
        return true;
    }

}
?>
