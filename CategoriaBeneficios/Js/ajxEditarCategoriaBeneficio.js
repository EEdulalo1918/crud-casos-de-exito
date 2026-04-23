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

// Submit edición
document.getElementById('formEditarBeneficio').addEventListener('submit', e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    fd.append('action','update');
    fetch('../controlador/cntCategoriaBeneficiosController.php', { method:'POST', body: fd })
        .then(r=>r.json())
        .then(resp=>{
            if(resp.success){ alert('Categoría Actualizada'); window.location.href='vtaCategoriaBeneficios.php'; }
            else { alert(resp.message || 'Error al actualizar'); }
        });
});
