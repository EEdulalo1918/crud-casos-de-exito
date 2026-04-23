// Cargar usuarios
function cargarCasos() {
    fetch('../controlador/cntCategoriaBeneficiosController.php?action=list')

        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('beneficiosTableBody');
            tbody.innerHTML = '';

            data.data.forEach(u => {
                const tr = document.createElement('tr');//creamos la fila 

                // columna para el id 
                const tdId = document.createElement('td');//creamos la celda
                tdId.textContent = u.idCategoriaBeneficio;//asigna el id al content
                tr.appendChild(tdId);//agregar el idCategoriaBeneficio al cuerpo de la tabla(tbody)

                // columna para el nombre
                const tdNombre = document.createElement('td');
                tdNombre.textContent = u.nombreCategoria;
                tr.appendChild(tdNombre);

                // urlImg
                const tdImg = document.createElement('td');
                if (u.urlImg) {
                    const img = document.createElement('img');
                    img.classList.add('imgTabla');//le asignamos la clase imgTabla
                    img.src = `../controlador/cntCategoriaBeneficiosController.php?action=image&name=${u.urlImg}`;
                    img.alt = 'Imagen';
                    tdImg.appendChild(img);
                } else {
                    tdImg.textContent = 'Sin imagen';
                }
                tr.appendChild(tdImg);

                // Beneficios
                const tdBeneficios = document.createElement('td');
                const aBenef = document.createElement('a');
                aBenef.classList.add('aEdit');
                aBenef.href = `../../Beneficios/Vista/vtaBeneficios.php?idCategoriaBeneficio=${u.idCategoriaBeneficio}`;
                aBenef.textContent = 'Ver beneficios';
                tdBeneficios.appendChild(aBenef);
                tr.appendChild(tdBeneficios);

                // detalles
                const tdDetalles = document.createElement('td');//celda
                const aDetalles = document.createElement('a');//enlace
                aDetalles.classList.add('aEdit');//asignamos clase 
                aDetalles.href = `vtaDetallesCategoriaBeneficio.php?idCategoriaBeneficio=${u.idCategoriaBeneficio}`;//le agregamos un enlace
                aDetalles.textContent = 'Ver más..';//texto visible en la pagina
                tdDetalles.appendChild(aDetalles);
                tr.appendChild(tdDetalles);

                //Editar
                const tdEditar = document.createElement('td');//creamos la celda
                const aEditar = document.createElement('a');//creamos la etiqueta de enlace
                aEditar.classList.add('aEdit');//clase 
                aEditar.href = `vtaEditarCategoriaBeneficio.php?idCategoriaBeneficio=${u.idCategoriaBeneficio}`;//enlace
                aEditar.textContent = 'Editar';//texto visible en la pagina
                tdEditar.appendChild(aEditar);
                tr.appendChild(tdEditar);

                // Eliminar
                const tdEliminar = document.createElement('td');
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btnDelete');
                btnEliminar.dataset.id = u.idCategoriaBeneficio;
                btnEliminar.textContent = 'Eliminar';
                tdEliminar.appendChild(btnEliminar);
                tr.appendChild(tdEliminar);

                // agregamos la fila al tbody
                tbody.appendChild(tr);
            });

            // eliminar
            tbody.querySelectorAll('.btnDelete').forEach(btn => {
                btn.addEventListener('click', e => {
                    const id = e.target.getAttribute('data-id');
                    if (!confirm('¿Eliminar registro?')) return;

                    const fd = new FormData();
                    fd.append('action','delete');
                    fd.append('idCategoriaBeneficio', id);

                    fetch('../controlador/cntCategoriaBeneficiosController.php', { 
                        method:'POST', 
                        body: fd 
                    })
                    .then(r => r.json())
                    .then(resp => { 
                        if(resp.success){ 
                            cargarCasos(); 
                        } else { 
                            alert('No se pudo eliminar'); 
                        }
                    });
                });
            });
        });
}

document.addEventListener('DOMContentLoaded', cargarCasos);

