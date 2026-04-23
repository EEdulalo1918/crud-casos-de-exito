document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(location.search);
  const cat = params.get('idCategoriaBeneficio');

  if (cat) {
    const sel = document.querySelector('select[name="txtIdCategoriaBeneficio"]');
    if (sel) {
      sel.value = cat;
    }
  }

  const btnCancelar = document.querySelector('a.btnCancelar');
  if (btnCancelar) {
    btnCancelar.href = cat
      ? `vtaBeneficios.php?idCategoriaBeneficio=${encodeURIComponent(cat)}`
      : 'vtaBeneficios.php';
  }

  const btnVolver = document.querySelector('a.btnVolver');
  if (btnVolver) {
    btnVolver.href = cat
      ? `vtaBeneficios.php?idCategoriaBeneficio=${encodeURIComponent(cat)}`
      : 'vtaBeneficios.php';
  }
  


});