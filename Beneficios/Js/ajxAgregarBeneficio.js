// enviar formulario de agregar
document.getElementById('frmAgregarBeneficio')?.addEventListener('submit', function(e){
    e.preventDefault();
    const fd = new FormData(this);
    fd.append('action','insert');
    fetch('../controlador/cntBeneficiosController.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
        if (alert('Beneficio Agregado')) return;
        setTimeout(() => { // Redirección que preserva idCategoriaBeneficio si existe en la URL actual
(function(){
  try {
    const params = new URLSearchParams(window.location.search);
    const cat = params.get('idCategoriaBeneficio');
    const destino = cat ? `vtaBeneficios.php?idCategoriaBeneficio=${encodeURIComponent(cat)}` : 'vtaBeneficios.php';
    window.location.href = destino;
  } catch(e) {
    // fallback
    window.location.href = 'vtaBeneficios.php';
  }
})();
 }, 300);
        } else {
        console.warn('[Beneficios] No se pudo insertar:', d);
        btn && (btn.disabled = false);
        }
    })
    .catch(err => {
        console.error('[Beneficios] Error de red/servidor:', err);
        btn && (btn.disabled = false);
    });
});
