// Cargar usuarios
function cargarRecuerdos() {
    fetch('../controlador/cntRecuerdoscontroller.php?action=list')
    //fetch('https://uaeh.edu.mx/fotografia_online/cedai/appEgresados/apisAdminEgresados/modLeerCasos.php')
        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('RecuerdosTable');
            tbody.innerHTML = '';

            data.data.forEach(u => {
                const tr = document.createElement('tr');//creamos la fila 

                // columna para el id 
                const tdId = document.createElement('td');//creamos la celda
                tdId.textContent = u.idRecuerdo;//asigna el id al content
                tr.appendChild(tdId);//agregar el idRecuerdo al cuerpo de la tabla(tbody)

                // columna para el nombre
                const tdNombre = document.createElement('td');
                tdNombre.textContent = u.nombre;
                tr.appendChild(tdNombre);


                // imgRecuerdo
                const tdImg = document.createElement('td');
                if (u.imgRecuerdo) {
                    const img = document.createElement('img');
                    img.classList.add('imgTabla');//le asignamos la clase imgTabla
                    img.src = `../controlador/cntRecuerdoscontroller.php?action=image&name=${u.imgRecuerdo}`;
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
                aDetalles.href = `vtaDetalles.php?idRecuerdo=${u.idRecuerdo}`;//le agregamos un enlace
                aDetalles.textContent = 'Ver más..';//texto visible en la pagina
                tdDetalles.appendChild(aDetalles);
                tr.appendChild(tdDetalles);

                //Editar
                const tdEditar = document.createElement('td');//creamos la celda
                const aEditar = document.createElement('a');//creamos la etiqueta de enlace
                aEditar.classList.add('aEdit');//clase 
                aEditar.href = `vtaEditar.php?idRecuerdo=${u.idRecuerdo}`;//enlace
                aEditar.textContent = 'Editar';//texto visible en la pagina
                tdEditar.appendChild(aEditar);
                tr.appendChild(tdEditar);

                // Eliminar
                const tdEliminar = document.createElement('td');
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btnDelete');
                btnEliminar.dataset.id = u.idRecuerdo;
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
                    fd.append('idRecuerdo', id);

                    fetch('../controlador/cntRecuerdoscontroller.php', { 
                        method:'POST', 
                        body: fd 
                    })
                    .then(r => r.json())
                    .then(resp => { 
                        if(resp.success){ 
                            cargarRecuerdos(); 
                        } else { 
                            alert('No se pudo eliminar'); 
                        }
                    });
                });
            });
        });
}

document.addEventListener('DOMContentLoaded', cargarRecuerdos);

