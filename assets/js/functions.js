function createDataTable(table, url, columns){
    return $('#'+table).dataTable({
        "aProsessing": true,
        "aServerSide": true,
        "autoWidth": false,
        "dom": 'lBfrtip',
        "buttons": [
            {
                "extend" : "copyHtml5",
                "text": '<i class="fas fa-copy"></i> Copiar',
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend" : "excelHtml5",
                "text": '<i class="fas fa-file-excel"></i> Excel',
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-secondary"
            }, {
                "extend" : "pdfHtml5",
                "text": '<i class="fas fa-file-pdf"></i> PDF',
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-secondary"
            }, {
                "extend" : "csvHtml5",
                "text": '<i class="fas fa-file-csv"></i> CSV',
                "titleAttr": "Exportar  CSV",
                "className": "btn btn-secondary"
            }
        ],
        "language": {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %d fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "1": "Mostrar 1 fila",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir"
            },
            "decimal": ",",
            "select": {
                "1": "%d fila seleccionada",
                "_": "%d filas seleccionadas",
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "$d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Proximo",
                "hours": "Horas"
            }
        },
        "ajax": {
            "url": " "+base_url+"/"+url,
            "dataSrc":""
        },
        "columns": columns,
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]

    });
}

function dataExist(form, default_data, exception){
    let data = 0;
    let array_form = $('#'+form).serializeArray();
    let array_length = array_form.length;
    let obj_data = {};

    array_form.map(obj => {
        if(exception && exception == obj.name){
            data++
        }else{
            let value = obj.value.replace(/\s+/g, '');
            if(value){
                data++
            }
        }
    });

    obj_data.all = array_length === data;
    obj_data.some = data > default_data;
    return obj_data;
}

function openModal(modal){
    $('#'+modal).modal({
        backdrop: 'static',
        keyboard: false
    });
}

function closeModal(modal, form){
    $('#'+modal).modal('hide');
    document.getElementById(form).reset();
}

function removeValidate() {
    let validate = document.getElementsByClassName('validate');
    let invalid_msg = document.getElementsByClassName('invalid-msg');

    for (let i = 0; i < validate.length; i++) {
        if (validate[i].classList.contains('is-valid')) {
            validate[i].classList.remove('is-valid');
        }
        if (validate[i].classList.contains('is-invalid')) {
            validate[i].classList.remove('is-invalid');
        }
    }

    for (let i = 0; i < invalid_msg.length; i++) {
        if(invalid_msg[i].style.display == 'block'){
            invalid_msg[i].style.display = 'none';
        }
    }
}

function cancelModal(modal, form, default_data, remove_validate){
    let data = dataExist(form, default_data, null);

    if(data.some){
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Al salir perdera todos los datos capturados',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                closeModal(modal, form);
                if(remove_validate){
                    removeValidate();
                }
            }
        });
    }else{
        closeModal(modal, form);
        if(remove_validate){
            removeValidate();
        }
    }
}

function swAlert(type, title, text){
    return Swal.fire({
        icon: type,
        title: title,
        text: text,
        confirmButtonColor: '#009688',
        confirmButtonText: 'Aceptar',
        allowOutsideClick: false
    });
}

function validateData(type, element, msj){
    let condition;
    let result;

    if(type === 'text'){
        condition = new RegExp(/^[A-zÀ-ÿ ]+$/);

    }else if(type === 'number'){
        condition = new RegExp(/^([0-9])+$/);

    }else if(type === 'email'){
        condition = new RegExp(/^([a-zA-Z0-9_.-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    }else if(type === 'address'){
        condition = new RegExp(/^([A-zÀ-ÿ0-9 /.-])+$/);

    }else if(type === 'rfc'){
        condition = new RegExp(/^([A-Z0-9])+$/);
    }

    result = condition.test(element.value);

    if(result){
        document.getElementById(msj).style.display = 'none';
        element.classList.remove('is-invalid');
        element.classList.add('is-valid');

    }else{
        document.getElementById(msj).style.display = 'block';
        element.classList.remove('is-valid');
        element.classList.add('is-invalid');
    }
}


