  document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
  document.getElementById("btn__registrarse").addEventListener("click", register);
  window.addEventListener("resize", anchoPagina);

//Declaracion de Variables
  var ContenedorLoginRegister = document.querySelector(".ContenedorLoginRegister");
  var FormularioLogin = document.querySelector(".FormularioLogin");
  var FormularioRegister = document.querySelector(".FormularioRegister");
  var CajaTraseraLogin = document.querySelector(".CajaTraseraLogin");
  var CajaTraseraRegister = document.querySelector(".CajaTraseraRegister");


  function anchoPagina () {

      if (window.innerWidth > 850) {
        CajaTraseraLogin.style.display = "block";
        CajaTraseraRegister.style.display = "block";
      } else {
        CajaTraseraRegister.style.display = "block";
        CajaTraseraRegister.style.opacity = "1";
        CajaTraseraLogin.style.display = "none";
        FormularioLogin.style.display = "block";
        FormularioRegister.style.display = "none";
        ContenedorLoginRegister.style.left = "0px";
  }
}
    anchoPagina();

  function iniciarSesion() {

      if (window.innerWidth > 850) {
        FormularioRegister.style.display = "none";
        ContenedorLoginRegister.style.left = "10px";
        FormularioLogin.style.display = "block";
        CajaTraseraRegister.style.opacity = "1";
        CajaTraseraLogin.style.opacity = "0";
      } else {
        FormularioRegister.style.display = "none";
        ContenedorLoginRegister.style.left = "0px";
        FormularioLogin.style.display = "block";
        CajaTraseraRegister.style.display = "block";
        CajaTraseraLogin.style.display = "none";
  }
}

  function register() { 

      if (window.innerWidth > 850) {
          FormularioRegister.style.display = "block";
          ContenedorLoginRegister.style.left = "410px";
          FormularioLogin.style.display = "none";
          CajaTraseraRegister.style.opacity = "0";
          CajaTraseraLogin.style.opacity = "1";
      } else {
          FormularioRegister.style.display = "block";
          ContenedorLoginRegister.style.left = "0px";
          FormularioLogin.style.display = "none";
          CajaTraseraRegister.style.display = "none";
          CajaTraseraLogin.style.display = "block";
          CajaTraseraLogin.style.opacity = "1";
    }
  }