function cargarDetalles(){
  const params = new URLSearchParams(window.location.search);
  const id = params.get('idRecuerdo');
  fetch(`../controlador/cntRecuerdoscontroller.php?action=get&idRecuerdo=${id}`)

    .then(r=>r.json())
    .then(d=>{

        if(!d.success){ alert('No encontrado'); return; }
        const u = d.data;

        document.getElementById('recuerdoId').value = u.idRecuerdo;
        document.getElementById('nombre').value = u.nombre;
        document.getElementById('descripcion').value = u.descripcion;
        const img = document.getElementById('imagenRecuerdos');
        if (img) { img.src = `../controlador/cntRecuerdoscontroller.php?action=image&name=${u.imgRecuerdo}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDetalles);
