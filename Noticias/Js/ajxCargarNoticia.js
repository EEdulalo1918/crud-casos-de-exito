// Cargar usuarios
function cargarNoticias() {
    fetch('../controlador/cntNoticiascontroller.php?action=list')
        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('NoticiaTable');
            tbody.innerHTML = '';

            data.data.forEach(u => {
                const tr = document.createElement('tr');//creamos la fila 

                // columna para el id 
                const tdId = document.createElement('td');//creamos la celda
                tdId.textContent = u.idNoticia;//asigna el id al content
                tr.appendChild(tdId);//agregar el idNoticia al cuerpo de la tabla(tbody)

                // columna para el titulo
                const tdTitulo = document.createElement('td');
                tdTitulo.textContent = u.titulo;
                tr.appendChild(tdTitulo);

                // columna para el autor
                //const tdAutor = document.createElement('td');
                //tdAutor.textContent = u.autor;
                //tr.appendChild(tdAutor);

                // columna para la epigrafe
                //const tdEpigrafe = document.createElement('td');
                //tdEpigrafe.textContent = u.epigrafe;
                //tr.appendChild(tdEpigrafe);


                // imgNoticia
                const tdImg = document.createElement('td');
                if (u.imgNoticia) {
                    const img = document.createElement('img');
                    img.classList.add('imgTabla');//le asignamos la clase imgTabla
                    img.src = `../controlador/cntNoticiascontroller.php?action=image&name=${u.imgNoticia}`;
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
                aDetalles.href = `vtaDetallesNoticia.php?idNoticia=${u.idNoticia}`;//le agregamos un enlace
                aDetalles.textContent = 'Ver más..';//texto visible en la pagina
                tdDetalles.appendChild(aDetalles);
                tr.appendChild(tdDetalles);

                //Editar
                const tdEditar = document.createElement('td');//creamos la celda
                const aEditar = document.createElement('a');//creamos la etiqueta de enlace
                aEditar.classList.add('aEdit');//clase 
                aEditar.href = `vtaEditarNoticia.php?idNoticia=${u.idNoticia}`;//enlace
                aEditar.textContent = 'Editar';//texto visible en la pagina
                tdEditar.appendChild(aEditar);
                tr.appendChild(tdEditar);

                // Eliminar
                const tdEliminar = document.createElement('td');
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btnDelete');
                btnEliminar.dataset.id = u.idNoticia;
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
                    fd.append('idNoticia', id);

                    fetch('../controlador/cntNoticiascontroller.php', { 
                        method:'POST', 
                        body: fd 
                    })
                    .then(r => r.json())
                    .then(resp => { 
                        if(resp.success){ 
                            cargarNoticias(); 
                        } else { 
                            alert('No se pudo eliminar'); 
                        }
                    });
                });
            });
        });
}

document.addEventListener('DOMContentLoaded', cargarNoticias);

