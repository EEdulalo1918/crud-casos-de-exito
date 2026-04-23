<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
            alert("Debes de Iniciar Sesion");
            window.location = "../../index.php";
            </script>
        ';
        session_destroy();
        die();
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/styleIMG.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">

    <title>Beneficios</title>
</head>
<body>
<?php
 $cat = isset($_GET['idCategoriaBeneficio']) ? (int)$_GET['idCategoriaBeneficio'] : null;
 ?>

<?php include '../../Partials/Vista/vtaMenu.html'; ?>

    <div class="divTitle">
        <h2>Beneficios</h2>
    </div>
    
    <main class="MainContentForm">
        <div class="divContentInfo">
            <table class="TablesInfo">
                <h2 class="divTitle1">Beneficios</h2>
            <div class="divAgregar divBtn">
        <a class="btnAgregar" href="<?="vtaAgregarBeneficio.php"?><?php echo isset($cat)&&$cat?("?idCategoriaBeneficio=".$cat):""; ?>">Agregar Beneficio</a>

        <a class="btnVolver btnVolverCategoria" href="../../CategoriaBeneficios/Vista/vtaCategoriaBeneficios.php">Volver</a>
    </div>

    
    
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descuento (%)</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="beneficiosTableBody"></tbody>
    </table>
    </div>
</main>
<script src="../Js/ajxCargarBeneficios.js"></script>
<?php include '../../Partials/Vista/vtaFooter.html'; ?>
</body>
</html>
