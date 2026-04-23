// Cargar usuarios
function cargarCasos() {
    fetch('../controlador/cntComentariosController.php?action=list')
        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('comentariosTableBody');
            tbody.innerHTML = '';

            data.data.forEach(u => {
                const tr = document.createElement('tr');//creamos la fila 

                // columna para el id 
                const tdId = document.createElement('td');//creamos la celda
                tdId.textContent = u.idComentarios;//asigna el id al content
                tr.appendChild(tdId);//agregar el idComentario al cuerpo de la tabla(tbody)

                //descripcion
                const tdDescripcion = document.createElement('td');
                // mostrar solo los primeros 50 caracteres
                const maxLength = 50;
                let descripcionCorta = u.descripcion;
                if (descripcionCorta.length > maxLength) {
                    descripcionCorta = descripcionCorta.substring(0, maxLength) + '...';
                }
                
                tdDescripcion.textContent = descripcionCorta;
                tr.appendChild(tdDescripcion);


                // columna para el correo
                const tdCorreo = document.createElement('td');
                tdCorreo.textContent = u.correo;
                tr.appendChild(tdCorreo);

                // detalles
                const tdDetalles = document.createElement('td');//celda
                const aDetalles = document.createElement('a');//enlace
                aDetalles.classList.add('aEdit');//asignamos clase 
                aDetalles.href = `vtaDetallesComentarios.php?idComentario=${u.idComentarios}`;//le agregamos un enlace
                aDetalles.textContent = 'Ver más..';//texto visible en la pagina
                tdDetalles.appendChild(aDetalles);
                tr.appendChild(tdDetalles);

                // Eliminar
                const tdEliminar = document.createElement('td');
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btnDelete');
                btnEliminar.dataset.id = u.idComentarios;
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
                    fd.append('idComentarios', id);

                    fetch('../controlador/cntComentariosController.php', { 
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

