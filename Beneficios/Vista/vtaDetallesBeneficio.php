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

    <title>Detalles del Beneficio</title>
</head>
<body>
<?php include '../../Partials/Vista/vtaMenu.html'; ?>

<main class="MainContentForm">
    <div class="divTitle2"><h2>Detalles del Beneficio</h2></div>

    <div class="divImagenContainer">
        <img id="imagenBeneficio" alt="Imagen del beneficio">
    </div>


    <form class="frmEditar">
        <label>ID:</label>
        <input class="InputsEditar" type="text" id="beneficioId" readonly>

        <label>Nombre:</label>
        <input class="InputsEditar" type="text" id="nombreBeneficio" readonly>

        <label>Tipo de Beneficio:</label>
        <input class="InputsEditar" type="number" id="idTipoBeneficio" readonly>

        <label>Descuento (%):</label>
        <input class="InputsEditar" type="number" id="descuento" readonly>     
        
        <label>Descripción:</label>
        <textarea class="atxtDescriptionEditar" name="atxtDescBeneficio" id="descBeneficio" readonly></textarea><br>

       <!-- <label>Categoría:</label>
        <input class="InputsEditar" type="number" id="idCategoriaBeneficio" readonly>-->

        <label>Número de la Categoría Asociada:</label>
       <!-- <input class="InputsEditar" type="number" name="txtIdCategoriaBeneficio" required>-->
        <select name="txtIdCategoriaBeneficio" id="idCategoriaBeneficio" class="InputsEditarCategoria" disabled>
        <option value="1">(1) Alimentos y Bebidas</option>
        <option value="2">(2) Entretenimiento</option>
        <option value="3">(3) Salud y Bienestar</option>
        <option value="4">(4) Decoracion</option>
        <option value="5">(5) Belleza</option>
        <option value="6">(6) Hospedaje</option>
        <option value="7">(7) Seguros</option>
        <option value="8">(8) Otros</option>
        </select>

        <a class="btnVolver" href="vtaBeneficios.php">Volver</a>
    </form>
</main>
<script src="../Js/ajxDetallesBeneficio.js"></script>
<?php include '../../Partials/Vista/vtaFooter.html'; ?>
</body>
</html>
