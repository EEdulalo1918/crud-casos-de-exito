function cargarDetalles(){
  const params = new URLSearchParams(window.location.search);
  const id = params.get('idEvento');
  fetch(`../controlador/cntEventosController.php?action=get&idEvento=${id}`)
    .then(r=>r.json())
    .then(d=>{

        if(!d.success){ alert('No encontrado'); return; }
        const u = d.data;

        document.getElementById('eventoId').value = u.idEvento;
        document.getElementById('nombre').value = u.nombreEvento;
        document.getElementById('nompersona').value =u.nombrePersona;
        document.getElementById('hora').value = u.hora;
        document.getElementById('fecha').value = u.fecha;
        document.getElementById('descripcion').value = u.descEvento;
        document.getElementById('lugar').value = u.lugar;
        const img = document.getElementById('imagenEvento');
        if (img) { img.src = `../controlador/cntEventosController.php?action=image&name=${u.imagenEvento}`; }
        document.getElementById('url').value = u.urlEvento;
    });
}
document.addEventListener('DOMContentLoaded', cargarDetalles);
