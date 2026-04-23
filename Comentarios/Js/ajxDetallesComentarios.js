function cargarDetalles(){
  const params = new URLSearchParams(window.location.search);
  const id = params.get('idComentario');
  fetch(`../controlador/cntComentariosController.php?action=get&idComentario=${id}`)
    .then(r=>r.json())
    .then(d=>{

        if(!d.success){ alert('No encontrado'); return; }
        const u = d.data;

        document.getElementById('comentarioId').value = u.idComentarios;
        document.getElementById('correo').value = u.correo;
        document.getElementById('descripcion').value = u.descripcion;
    });
}
document.addEventListener('DOMContentLoaded', cargarDetalles);
