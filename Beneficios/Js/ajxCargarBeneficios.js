// Cargar beneficios (tabla) — versión estilo “cargarCasos”
function cargarBeneficios() {
    (() => { const p=new URLSearchParams(window.location.search); const cat=p.get('idCategoriaBeneficio'); 
    const url = cat 
    ? `../controlador/cntBeneficiosController.php?action=list&idCategoriaBeneficio=${encodeURIComponent(cat)}`
    : '../controlador/cntBeneficiosController.php?action=list';
    return fetch(url) })()
    .then(r => r.json())
    .then(data => {
        const tbody = document.getElementById('beneficiosTableBody');
        tbody.innerHTML = '';

        //  actualizamos título al nombre de la categoria
        if (data.data && data.data.length > 0 && data.data[0].nombreCategoria) {
            const nombreCategoria = data.data[0].nombreCategoria;

            // Cambiar el 
           // document.title = `Categoría: ${nombreCategoria}`;

            // Cambiar el <h2>
            const h2Title = document.querySelector('.divTitle1');
            if (h2Title) h2Title.textContent = `Categoría: ${nombreCategoria}`;
        }

        (data.data || []).forEach(u => {
        const tr = document.createElement('tr');

        // idBeneficio
        const tdId = document.createElement('td');
        tdId.textContent = u.idBeneficio;
        tr.appendChild(tdId);

        // nombreBeneficio
        const tdNombre = document.createElement('td');
        tdNombre.textContent = u.nombreBeneficio ?? '';
        tr.appendChild(tdNombre);


        // descuento
        const tdDescuento = document.createElement('td');
        tdDescuento.textContent = u.descuento ?? '';
        tr.appendChild(tdDescuento);

        // descBeneficio
        const tdDesc = document.createElement('td');
        tdDesc.textContent = u.descBeneficio ?? '';
        tr.appendChild(tdDesc);

        // idCategoriaBeneficio
        const tdCat = document.createElement('td');
        tdCat.textContent = u.idCategoriaBeneficio ?? '';
        tr.appendChild(tdCat);

        // imgBeneficioP
        const tdImg = document.createElement('td');
        if (u.imgBeneficioP) {
            const img = document.createElement('img');
            img.classList.add('imgTabla');
            img.src = `../controlador/cntBeneficiosController.php?action=image&name=${u.imgBeneficioP}`;
            img.alt = 'Imagen';
            tdImg.appendChild(img);
        } else {
            tdImg.textContent = 'Sin imagen';
        }
        tr.appendChild(tdImg);

        // Detalles
        const tdDetalles = document.createElement('td');
        const aDetalles = document.createElement('a');
        aDetalles.classList.add('aEdit');
        aDetalles.href = `vtaDetallesBeneficio.php?id=${u.idBeneficio}`;
        aDetalles.textContent = 'Ver más..';
        tdDetalles.appendChild(aDetalles);
        tr.appendChild(tdDetalles);

        // Editar
        const tdEditar = document.createElement('td');
        const aEditar = document.createElement('a');
        aEditar.classList.add('aEdit');
        aEditar.href = `vtaEditarBeneficio.php?id=${u.idBeneficio}`;
        aEditar.textContent = 'Editar';
        tdEditar.appendChild(aEditar);
        tr.appendChild(tdEditar);

        // Eliminar
        const tdEliminar = document.createElement('td');
        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('btnDelete');
        btnEliminar.dataset.id = u.idBeneficio;
        btnEliminar.textContent = 'Eliminar';
        tdEliminar.appendChild(btnEliminar);
        tr.appendChild(tdEliminar);

        tbody.appendChild(tr);
    });

      // manejadores de eliminación
        tbody.querySelectorAll('.btnDelete').forEach(btn => {
        btn.addEventListener('click', e => {
        const id = e.currentTarget.dataset.id;
        if (!confirm('¿Eliminar registro?')) return;

        const fd = new FormData();
        fd.append('action', 'delete');
        fd.append('idBeneficio', id);
        fetch('../controlador/cntBeneficiosController.php', { method: 'POST', body: fd })
            .then(r => r.json())
            .then(resp => {
                if (resp.success) cargarBeneficios();
                else alert('No se pudo eliminar');
            });
        });
    });
    });
}

document.addEventListener('DOMContentLoaded', cargarBeneficios);

