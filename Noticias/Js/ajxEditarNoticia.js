// Cargar datos iniciales
function cargarDatos() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('idNoticia');
  //BASE DE DATOS
    fetch(`../controlador/cntNoticiascontroller.php?action=get&idNoticia=${id}`)

    .then(r=>r.json())
    .then(d=>{

        if(!d.success) { alert('No encontrado'); return; }
        const u = d.data;
        

        document.getElementById('noticiaId').value = u.idNoticia;
        document.getElementById('autor').value = u.autor;
        document.getElementById('titulo').value = u.titulo;
        document.getElementById('epigrafe').value = u.epigrafe;
        document.getElementById('descripcion').value = u.contenido;
        const img = document.getElementById('imagenNoticia');
        if (img) { img.src = `../controlador/cntNoticiascontroller.php?action=image&name=${u.imgNoticia}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDatos);

// Submit edición
document.getElementById('formEditarNoticia').addEventListener('submit', e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    fd.append('action','update');
    fetch('../controlador/cntNoticiascontroller.php', { method:'POST', body: fd })
        .then(r=>r.json())
        .then(resp=>{
            if(resp.success){ alert('Notica Actualizada'); window.location.href='vtaNews.php'; }
            else { alert(resp.message || 'Error al actualizar'); }
        });
});
