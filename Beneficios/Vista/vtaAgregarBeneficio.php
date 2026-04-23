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

    <title>Agregar Beneficio</title>
</head>
<body>
<?php include '../../Partials/Vista/vtaMenu.html'; ?>
<main class="MainContentForm">

    <div class="divTitle2"><h2>Agregar Beneficio</h2></div>

    <form id="frmAgregarBeneficio" class="frmAgregar" enctype="multipart/form-data">
        <label>Nombre:</label>
        <input class="InputsEditar" type="text" name="txtNombreBeneficio" required>

       <!-- <label>Tipo (1 o 2, cualquiera ) :</label>
        <input class="InputsEditar" type="number" name="txtIdTipoBeneficio" required>-->

        <label>Tipo de Beneficio:</label>
        <select name="txtIdTipoBeneficio" id="lista_desplegable">
        <option value="1">1.- Comercial </option>
        <option value="2">2.- Institucional</option>
        </select>

        <label>Descuento (%):</label>
        <input class="InputsEditar" type="number" name="txtDescuento">

        <label>Descripción:</label>
        <textarea class="atxtDescriptionEditar" name="atxtDescBeneficio" required></textarea><br>

        <label>Número de la Categoría Asociada:</label>
       <!-- <input class="InputsEditar" type="number" name="txtIdCategoriaBeneficio" required>-->
        <select name="txtIdCategoriaBeneficio" required>
        <option value="1">(1) Alimentos y Bebidas</option>
        <option value="2">(2) Entretenimiento</option>
        <option value="3">(3) Salud y Bienestar</option>
        <option value="4">(4) Decoracion</option>
        <option value="5">(5) Belleza</option>
        <option value="6">(6) Hospedaje</option>
        <option value="7">(7) Seguros</option>
        <option value="8">(8) Otros</option>
        </select>

        <label>Imagen:</label>
        <input class="InputsEditar" type="file" name="imagen" accept="image/*">

        <button class="btnAgregarSumit" type="submit">Guardar</button>
        <a class="btnCancelar" href="vtaBeneficios.php">Cancelar</a>
    </form>
    <div id="mensaje"></div>
</main>
<script src="../Js/ajxAgregarBeneficio.js"></script>
<script src="../Js/ajxScripBeneficio.js"></script>
<?php include '../../Partials/Vista/vtaFooter.html'; ?>


</body>
</html>
