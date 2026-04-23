<?php
class ComentariosModel {
    private $con;
    
    public function __construct($con) {
        $this->con = $con; // PDO
    }

//obtenemos todo los comentarios
    public function getAllComentarios() {
        $sql = "SELECT `idComentarios`,`descripcion`, `correo` FROM `comentarios` ORDER BY `idComentarios` ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(); // array<assoc>
    }

    //obtener comentarios por el id 
    public function getComentarios($id) {
        $stmt = $this->con->prepare("SELECT `idComentarios`,`descripcion`, `correo` FROM `comentarios` WHERE `idComentarios` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(); // assoc|false
    }

    //eliminar comentarios
    public function deleteComentarios($id) {
        $stmt = $this->con->prepare("DELETE FROM `comentarios` WHERE `idComentarios`=?");
        return $stmt->execute([$id]);
    }

}
?>
