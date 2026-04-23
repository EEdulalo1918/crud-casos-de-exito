// Cargar datos iniciales
function cargarDatos() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('idCategoriaBeneficio');
  //BASE DE DATOS
    fetch(`../controlador/cntCategoriaBeneficiosController.php?action=get&idCategoriaBeneficio=${id}`)

    .then(r=>r.json())
    .then(d=>{

        if(!d.success) { alert('No encontrado'); return; }
        const u = d.data;       

        document.getElementById('categoriabeneficioId').value = u.idCategoriaBeneficio;
        document.getElementById('nombrecategoria').value = u.nombreCategoria;
        const img = document.getElementById('imagenCategoriaBeneficio');
        if (img) { img.src = `../controlador/cntCategoriaBeneficiosController.php?action=image&name=${u.urlImg}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDatos);