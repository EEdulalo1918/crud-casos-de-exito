// Cargar usuarios
function cargarEventos() {
    fetch('../controlador/cntEventosController.php?action=list')
        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('eventosTableBody');
            tbody.innerHTML = '';

            data.data.forEach(u => {
                const tr = document.createElement('tr');//creamos la fila 

                // columna para el id 
                const tdId = document.createElement('td');//creamos la celda
                tdId.textContent = u.idEvento;//asigna el id al content
                tr.appendChild(tdId);//agregar el idEvento al cuerpo de la tabla(tbody)

                // columna para el nombre
                const tdNombre = document.createElement('td');
                tdNombre.textContent = u.nombreEvento;
                tr.appendChild(tdNombre);

                // Hora
                const tdHora = document.createElement('td');
                tdHora.textContent = u.hora;
                tr.appendChild(tdHora);

                // Fecha
                const tdFecha = document.createElement('td');
                tdFecha.textContent = u.fecha;
                tr.appendChild(tdFecha);

                // lugar
                const tdLugar = document.createElement('td');
                tdLugar.textContent = u.lugar;
                tr.appendChild(tdLugar);

                // imagen
                const tdImg = document.createElement('td');
                if (u.imagenEvento) {
                    const img = document.createElement('img');
                    img.classList.add('imgTabla');//le asignamos la clase imgTabla
                    img.src = `../controlador/cntEventosController.php?action=image&name=${u.imagenEvento}`;
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
                aDetalles.href = `vtaDetallesEvento.php?idEvento=${u.idEvento}`;//le agregamos un enlace
                aDetalles.textContent = 'Ver más..';//texto visible en la pagina
                tdDetalles.appendChild(aDetalles);
                tr.appendChild(tdDetalles);

                //Editar
                const tdEditar = document.createElement('td');//creamos la celda
                const aEditar = document.createElement('a');//creamos la etiqueta de enlace
                aEditar.classList.add('aEdit');//clase 
                aEditar.href = `vtaEditarEvento.php?idEvento=${u.idEvento}`;//enlace
                aEditar.textContent = 'Editar';//texto visible en la pagina
                tdEditar.appendChild(aEditar);
                tr.appendChild(tdEditar);

                // Eliminar
                const tdEliminar = document.createElement('td');
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btnDelete');
                btnEliminar.dataset.id = u.idEvento;
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
                    fd.append('idEvento', id);

                    fetch('../controlador/cntEventosController.php', { 
                        method:'POST', 
                        body: fd 
                    })
                    .then(r => r.json())
                    .then(resp => { 
                        if(resp.success){ 
                            cargarEventos(); 
                        } else { 
                            alert('No se pudo eliminar'); 
                        }
                    });
                });
            });
        });
}

document.addEventListener('DOMContentLoaded', cargarEventos);

