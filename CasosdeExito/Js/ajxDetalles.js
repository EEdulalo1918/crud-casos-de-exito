function cargarDetalles(){
  const params = new URLSearchParams(window.location.search);
  const id = params.get('idCaso');
  fetch(`../controlador/cntCasosController.php?action=get&idCaso=${id}`)
  //fetch('https://uaeh.edu.mx/fotografia_online/cedai/appEgresados/apisAdminEgresados/modLeerCasos.php')
    .then(r=>r.json())
    .then(d=>{

        if(!d.success){ alert('No encontrado'); return; }
        const u = d.data;

        //filtrar por api
        /*const id = new URLSearchParams(window.location.search).get('idCaso');
        const u = d.data.find(item => item.idCaso === id); // busca el caso con ese id
        if(!u){ alert('No encontrado'); return; }*/

        document.getElementById('casoexitoId').value = u.idCaso;
        document.getElementById('nombre').value = u.nombre;
        document.getElementById('carrera').value = u.carrera;
        document.getElementById('descripcion').value = u.descripcion;
        const img = document.getElementById('imagenCasodeExito');
        if (img) { img.src = `../controlador/cntCasosController.php?action=image&name=${u.imgCE}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDetalles);
