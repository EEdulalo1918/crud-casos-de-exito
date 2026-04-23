// Cargar datos iniciales
function cargarDatos() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('idPlataforma');
  //BASE DE DATOS
    fetch(`../controlador/cntBolsaUniController.php?action=get&idPlataforma=${id}`)

    .then(r=>r.json())
    .then(d=>{

        if(!d.success) { alert('No encontrado'); return; }
        const u = d.data;
        

        document.getElementById('plataformaId').value = u.idPlataforma;
        document.getElementById('nombre').value = u.nombre;
        document.getElementById('url').value = u.urlPlataforma;
        const img = document.getElementById('imagenBolsaUni');
        if (img) { img.src = `../controlador/cntBolsaUniController.php?action=image&name=${u.imgPlataforma}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDatos);

// Submit edición
document.getElementById('formEditarBolsaUni').addEventListener('submit', e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    fd.append('action','update');
    fetch('../controlador/cntBolsaUniController.php', { method:'POST', body: fd })
        .then(r=>r.json())
        .then(resp=>{
            if(resp.success){ alert('Bolsa Universitaria Actualizada'); window.location.href='vtaBolsaUni.php'; }
            else { alert(resp.message || 'Error al actualizar'); }
        });
});
