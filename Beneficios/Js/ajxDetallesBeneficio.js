// Cargar detalles
function cargarDatos() {
    const id = new URLSearchParams(window.location.search).get('id');
    fetch(`../controlador/cntBeneficiosController.php?action=get&idBeneficio=${id}`)
      .then(r=>r.json())
      .then(d=>{
        if(!d.success) { alert('No encontrado'); return; }
        const u = d.data;
        document.getElementById('beneficioId').value = u.idBeneficio;
        document.getElementById('nombreBeneficio').value = u.nombreBeneficio || '';
        document.getElementById('idTipoBeneficio').value = u.idTipoBeneficio || 0;
        document.getElementById('descuento').value = u.descuento || 0;
        document.getElementById('descBeneficio').value = u.descBeneficio || '';
        document.getElementById('idCategoriaBeneficio').value = u.idCategoriaBeneficio || 0;
        const img = document.getElementById('imagenBeneficio');
        if (img && u.imgBeneficioP) img.src = `../controlador/cntBeneficiosController.php?action=image&name=${u.imgBeneficioP}`;
      });
}
document.addEventListener('DOMContentLoaded', cargarDatos);
