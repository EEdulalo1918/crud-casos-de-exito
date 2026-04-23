document.getElementById('formAgregarRecuerdos').addEventListener('submit', e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    fd.append('action','insert');
    fetch('../controlador/cntRecuerdoscontroller.php', { method:'POST', body: fd })
      .then(r=>r.json())
      .then(data=>{
        const mensajeDiv = document.getElementById('mensaje');
        if(data.success){
            mensajeDiv.innerHTML = '<p style="color: green;">Recuerdo agregado correctamente</p>';
            setTimeout(()=>{ window.location.href='vtaRecuerdos.php'; }, 1200);
        } else {
            mensajeDiv.innerHTML = `<p style="color:red;">${data.message||'Error'}</p>`;
        }
      })
      .catch(err => { document.getElementById('mensaje').innerHTML = `<p style="color:red;">${err}</p>`; });
});