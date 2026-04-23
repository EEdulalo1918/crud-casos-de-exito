// Cargar usuarios
function cargarCasos() {
    fetch('../controlador/cntCasosController.php?action=list')
    //fetch('https://uaeh.edu.mx/fotografia_online/cedai/appEgresados/apisAdminEgresados/modLeerCasos.php')
        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('casosTableBody');
            tbody.innerHTML = '';

            data.data.forEach(u => {
                const tr = document.createElement('tr');//creamos la fila 

                // columna para el id 
                const tdId = document.createElement('td');//creamos la celda
                tdId.textContent = u.idCaso;//asigna el id al content
                tr.appendChild(tdId);//agregar el idCaso al cuerpo de la tabla(tbody)

                // columna para el nombre
                const tdNombre = document.createElement('td');
                tdNombre.textContent = u.nombre;
                tr.appendChild(tdNombre);

                // carrera
                const tdCarrera = document.createElement('td');
                tdCarrera.textContent = u.carrera;
                tr.appendChild(tdCarrera);

                // imgCE
                const tdImg = document.createElement('td');
                if (u.imgCE) {
                    const img = document.createElement('img');
                    img.classList.add('imgTabla');//le asignamos la clase imgTabla
                    img.src = `../controlador/cntCasosController.php?action=image&name=${u.imgCE}`;
                    img.alt = 'Imagen';
                    tdImg.appendChild(img);
                } else {
                    tdImg.textContent = 'Sin imagen';
                }
                tr.appendChild(tdImg);

                // detalles
                const tdDetalles = document.createElement('td');//celda
                const aDetalles = document.createElement('a');//enlace
                aDetalles.classList.add('aEdit');//asignamos clase 
                aDetalles.href = `vtaDetalles.php?idCaso=${u.idCaso}`;//le agregamos un enlace
                aDetalles.textContent = 'Ver más..';//texto visible en la pagina
                tdDetalles.appendChild(aDetalles);
                tr.appendChild(tdDetalles);

                //Editar
                const tdEditar = document.createElement('td');//creamos la celda
                const aEditar = document.createElement('a');//creamos la etiqueta de enlace
                aEditar.classList.add('aEdit');//clase 
                aEditar.href = `vtaEditar.php?idCaso=${u.idCaso}`;//enlace
                aEditar.textContent = 'Editar';//texto visible en la pagina
                tdEditar.appendChild(aEditar);
                tr.appendChild(tdEditar);

                // Eliminar
                const tdEliminar = document.createElement('td');
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btnDelete');
                btnEliminar.dataset.id = u.idCaso;
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
                    fd.append('idCaso', id);

                    fetch('../controlador/cntCasosController.php', { 
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

