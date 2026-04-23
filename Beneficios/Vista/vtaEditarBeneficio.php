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

    <title>Editar Beneficio</title>
</head>
<body>
<?php include '../../Partials/Vista/vtaMenu.html'; ?>
<main class="MainContentForm">
    <div class="divTitle2"><h2>Editar Beneficio</h2></div>

    <div class="divImagenContainer">
        <img id="imagenBeneficioActual" alt="Imagen actual">
    </div>


    <form id="frmEditarBeneficio" class="frmEditar" enctype="multipart/form-data">
        <input type="hidden" name="idBeneficio" id="beneficioId">
        
        <label>Nombre:</label>
        <input class="InputsEditar" type="text" name="txtNombreBeneficio" id="nombreBeneficio" required>

        <!--<label>Tipo (idTipoBeneficio):</label>
        <input class="InputsEditar" type="number" name="txtIdTipoBeneficio" id="idTipoBeneficio" required>-->

        <label>Tipo de Beneficio :</label>
        <select name="txtIdTipoBeneficio" id="idTipoBeneficio">
        <option value="1">1.- Comercial </option>
        <option value="2">2.- Institucional</option>
        </select>

        <label>Descuento (%):</label>
        <input class="InputsEditar" type="number" name="txtDescuento" id="descuento" required>

        <label>Descripción:</label>
        <textarea class="atxtDescriptionEditar" name="atxtDescBeneficio" id="descBeneficio" required></textarea><br>


        <!--<label>Categoría (idCategoriaBeneficio):</label>
        <input class="InputsEditar" type="number" name="txtIdCategoriaBeneficio" id="idCategoriaBeneficio" required>-->

        <label>Número de la Categoria Asociada:</label>
        <!-- <input class="InputsEditar" type="number" name="txtIdCategoriaBeneficio" required>-->
        <select name="txtIdCategoriaBeneficio" id="idCategoriaBeneficio" required>
        <option value="1">(1) Alimentos y Bebidas</option>
        <option value="2">(2) Entretenimiento</option>
        <option value="3">(3) Salud y Bienestar</option>
        <option value="4">(4) Decoracion</option>
        <option value="5">(5) Belleza</option>
        <option value="6">(6) Hospedaje</option>
        <option value="7">(7) Seguros</option>
        <option value="8">(8) Otros</option>
        </select>

        <label>Imagen (opcional):</label>
        <input class="InputsEditar" type="file" name="imagen" accept="image/*">

        <button class="InputEditarSubmit" type="submit">Actualizar</button>
        <a class="btnCancelar" href="vtaBeneficios.php">Cancelar</a>
    </form>
    <div id="mensaje"></div>
</main>
<script src="../Js/ajxEditarBeneficio.js"></script>
<?php include '../../Partials/Vista/vtaFooter.html'; ?>
</body>
</html>
