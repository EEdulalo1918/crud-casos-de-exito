<?php
        session_start();

        if(isset($_SESSION['usuario'])){
            header("location: Inicio/Vista/vtaInicio.php");
        }

?>


    <!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login y Registro</title>
                <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="Estilos/styleLogin.css">
                
        </head>
 <body>
    
    <main>

      <div class="ContendorTodo">
          <div class= "CajaTrasera">
                  <div class="CajaTraseraLogin">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesion para acceder</p>

                    
                    
              </div>
                <div class="CajaTraseraRegister">
                   <h2>Hola! Bienvenido de Nuevo</h2>
                   <p>Registrate para acceder, si no cuentas<br>
                    con un número de empleado y contraseña <br>
                    solicitalo con personal autorizado.</p>
                   <!--<button id="btn__registrarse">Registrarme</button>-->
                </div>
           </div>

           <!--contenbedor del formulario de login y Registro-->
           <div class="ContenedorLoginRegister">

              <!--Login-->
              <form action="Inicio/modelos/modLogin.php" method="POST" class="FormularioLogin" id="formLogin">
                    <h2>Iniciar Sesion</h2>
                    <input type="text" placeholder="Número de Empleado" name="txtnumempleado" required>
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <button>Acceder</button>
               </form>

               <!--Registro-->
               <!--<form action="Inicio/Vista/vtaRegistroUsuario.php" method="POST" class="FormularioRegister" id="formRegistro">
                    <h2>Registrarme</h2>
                    <input type="text" placeholder="Numero de Empleado" name="numempleado">
                    <input type="text" placeholder="Correo" name="txtcorreo">
                    <input type="text" placeholder="Usuario" name="txtusername">
                    <input type="password" placeholder="Password" name="password">
                    <button>Registrarme</button>
                </form>-->
           </div>
       </div>  
   </main>



  </body>
</html>