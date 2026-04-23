<?php
class BeneficiosModel {
    /** @var PDO */
    private $con;
    private $uploadPath;

    public function __construct($con) {
        $this->con = $con; // PDO
        $this->uploadPath = __DIR__ . '/../assets/img/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }

    // obtener los beneficiso
    public function getAllBeneficios() {
        $sql = "SELECT `idBeneficio`, `nombreBeneficio`, `idTipoBeneficio`, `descuento`, `descBeneficio`, `idCategoriaBeneficio`, `imgBeneficioP`
                FROM `beneficios` ORDER BY `idBeneficio` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // obtener un beneficio 
    public function getBeneficios($id) {
        $stmt = $this->con->prepare("SELECT `idBeneficio`, `nombreBeneficio`, `idTipoBeneficio`, `descuento`, `descBeneficio`, `idCategoriaBeneficio`, `imgBeneficioP`
                                     FROM `beneficios` WHERE `idBeneficio` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // crear beneficio
    public function insertBeneficios($nombreBeneficio, $idTipoBeneficio, $descuento, $descBeneficio, $idCategoriaBeneficio, $imagenNombre = null) {
        $stmt = $this->con->prepare("INSERT INTO `beneficios`
            (`nombreBeneficio`, `idTipoBeneficio`, `descuento`, `descBeneficio`, `idCategoriaBeneficio`, `imgBeneficioP`)
            VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombreBeneficio, $idTipoBeneficio, $descuento, $descBeneficio, $idCategoriaBeneficio, $imagenNombre]);
    }

    // actualizar beneficio
    public function updateBeneficios($idBeneficio, $nombreBeneficio, $idTipoBeneficio, $descuento, $descBeneficio, $idCategoriaBeneficio, $imagenNombre = null) {
        if ($imagenNombre) {
            $stmt = $this->con->prepare("UPDATE `beneficios`
                    SET `nombreBeneficio`=?, `idTipoBeneficio`=?, `descuento`=?, `descBeneficio`=?, `idCategoriaBeneficio`=?, `imgBeneficioP`=?
                    WHERE `idBeneficio`=?");
            return $stmt->execute([$nombreBeneficio, $idTipoBeneficio, $descuento, $descBeneficio, $idCategoriaBeneficio, $imagenNombre, $idBeneficio]);
        } else {
            $stmt = $this->con->prepare("UPDATE `beneficios`
                    SET `nombreBeneficio`=?, `idTipoBeneficio`=?, `descuento`=?, `descBeneficio`=?, `idCategoriaBeneficio`=?
                    WHERE `idBeneficio`=?");
            return $stmt->execute([$nombreBeneficio, $idTipoBeneficio, $descuento, $descBeneficio, $idCategoriaBeneficio, $idBeneficio]);
        }
    }

    // eliminar
    public function deleteBeneficios($id) {
        $stmt = $this->con->prepare("DELETE FROM `beneficios` WHERE `idBeneficio`=?");
        return $stmt->execute([$id]);
    }

    // ibtener imagen y nombre 
    public function getImagenNombre($id) {
        $stmt = $this->con->prepare("SELECT `imgBeneficioP` FROM `beneficios` WHERE `idBeneficio`=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['imgBeneficioP'] : null;
    }

    // guardar
    public function guardarImagen($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $ext = $ext ? ('.' . strtolower($ext)) : '';
        $nuevoNombre = 'img_' . uniqid('', true) . $ext;
        $destino = $this->uploadPath . $nuevoNombre;
        if (!move_uploaded_file($file['tmp_name'], $destino)) {
            throw new Exception('No se pudo mover la imagen.');
        }
        return $nuevoNombre;
    }

    public function eliminarImagen($nombreArchivo) {
        if (!$nombreArchivo) return false;
        $ruta = $this->uploadPath . basename($nombreArchivo);
        if (is_file($ruta)) { return @unlink($ruta); }
        return true;
    }

    //leer por categoria con JOIN
public function getBeneficiosJoinCategoria($idCategoriaBeneficio) {
    $sql = "SELECT b.`idBeneficio`, b.`nombreBeneficio`, b.`idTipoBeneficio`, b.`descuento`, b.`descBeneficio`,
                   b.`idCategoriaBeneficio`, b.`imgBeneficioP`, c.`nombreCategoria` AS `nombreCategoria`
            FROM `beneficios` b
            INNER JOIN `categoria_beneficios` c
                ON b.`idCategoriaBeneficio` = c.`idCategoriaBeneficio`
            WHERE c.`idCategoriaBeneficio` = ?
            ORDER BY b.`idBeneficio` ASC";
    $stmt = $this->con->prepare($sql);
    $stmt->execute([$idCategoriaBeneficio]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




}
?>