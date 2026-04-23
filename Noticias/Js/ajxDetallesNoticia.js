function cargarDetalles(){
  const params = new URLSearchParams(window.location.search);
  const id = params.get('idNoticia');
  fetch(`../controlador/cntNoticiascontroller.php?action=get&idNoticia=${id}`)

    .then(r=>r.json())
    .then(d=>{

        if(!d.success){ alert('No encontrado'); return; }
        const u = d.data;

        document.getElementById('noticiaId').value = u.idnoticia;
        document.getElementById('autor').value = u.autor;
        document.getElementById('titulo').value = u.titulo;
        document.getElementById('epigrafe').value = u.epigrafe;
        document.getElementById('descripcion').value = u.contenido;
        const img = document.getElementById('imagenNoticias');
        if (img) { img.src = `../controlador/cntNoticiascontroller.php?action=image&name=${u.imgNoticia}`; }
    });
}
document.addEventListener('DOMContentLoaded', cargarDetalles);
