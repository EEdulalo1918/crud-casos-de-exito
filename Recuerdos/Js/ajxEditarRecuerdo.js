// Cargar datos iniciales
function cargarDatos() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('idRecuerdo');
  //BASE DE DATOS
    fetch(`../controlador/cntRecuerdoscontroller.php?action=get&idRecuerdo=${id}`)

    .then(r=>r.json())
    .then(d=>{

        if(!d.success) { alert('No encontrado'); return; }
        const u = d.data;
        

        document.getElementById('recuerdoId').value = u.idRecuerdo;
        document.getElementById('nombre').value = u.nombre;
        document.getElementById('descripcion').value = u.descripcion;
        const img = document.getElementById('imagenRecuerdo');
        if (img) { img.src = `../controlador/cntRecuerdoscontroller.php?action=image&name=${u.imgRecuerdo}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDatos);

// Submit edición
document.getElementById('formEditarRecuerdo').addEventListener('submit', e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    fd.append('action','update');
    fetch('../controlador/cntRecuerdoscontroller.php', { method:'POST', body: fd })
        .then(r=>r.json())
        .then(resp=>{
            if(resp.success){ alert('Recuerdo Actualizado'); window.location.href='vtaRecuerdos.php'; }
            else { alert(resp.message || 'Error al actualizar'); }
        });
});
