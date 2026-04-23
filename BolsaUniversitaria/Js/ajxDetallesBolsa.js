function cargarDetalles(){
  const params = new URLSearchParams(window.location.search);
  const id = params.get('idPlataforma');
  fetch(`../controlador/cntBolsaUniController.php?action=get&idPlataforma=${id}`)
    .then(r=>r.json())
    .then(d=>{

        if(!d.success){ alert('No encontrado'); return; }
        const u = d.data;

        document.getElementById('plataformaId').value = u.idPlataforma;
        document.getElementById('nombre').value = u.nombre;
        document.getElementById('url').value = u.urlPlataforma;
        const img = document.getElementById('imagenBolsaUni');
        if (img) { img.src = `../controlador/cntBolsaUniController.php?action=image&name=${u.imgPlataforma}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDetalles);
