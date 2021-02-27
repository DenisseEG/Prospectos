var table_clients;
var form_client = document.getElementById('formClient');
var form_client_name = 'formClient';
var modal_client = 'modalFormClient';
var modal_client_view = 'modalViewClient';
var id_prospecto = null;

document.addEventListener('DOMContentLoaded', function (){
    let columns = [
        {"data":"id_prospecto"},
        {"data":"nombre"},
        {"data":"apellido_paterno"},
        {"data":"apellido_materno"},
        {"data":"estatus_prospecto"},
        {"data":"observaciones"},
        {"data":"opciones"}
    ];

    table_clients = createDataTable('clientsTable', 'Prospectos/showAll', columns);

    form_client.onsubmit = function(e){
        e.preventDefault();
        let data = dataExist(form_client_name, 0,id_prospecto ? null : 'estatus_prospecto') ;
        let request;
        let ajaxUrl;
        let formData;
        let validate;

        if(!data.all){
            swAlert('warning', 'Campos vacios', 'Todos los campos son obligatorios');
            return false;
        }

        validate = document.getElementsByClassName('validate');
        for (let i = 0; i < validate.length; i++) {
            if (validate[i].classList.contains('is-invalid')) {
                swAlert('warning', 'Atención', 'Por favor verifique los campos en rojo');
                return false;
            }
        }

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = id_prospecto ? base_url+'/Prospectos/update/'+id_prospecto : base_url+'/Prospectos/create';
        formData = new FormData(form_client);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    closeModal(modal_client, form_client_name);
                    removeValidate();
                    swAlert('success', response.title, response.text);
                    table_clients.api().ajax.reload();
                }else{
                    swAlert('error', response.title, response.text);
                }
            }
        }

    }
});

function clientActions(tipo, id){
    id_prospecto = id;
    let request;
    let ajaxUrl;

    if(tipo === 'new'){
        openModal(modal_client);
        document.getElementById('modal_title_client').innerHTML = 'Nuevo Prospecto';
        document.getElementById('save_form_client').innerHTML = 'Guardar';

    }else if(tipo === 'edit'){
        document.getElementById('modal_title_client').innerHTML = 'Actualizar Prospecto';
        document.getElementById('save_form_client').innerHTML = 'Actualizar';

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Prospectos/showOne/'+id;
        request.open('GET', ajaxUrl, true);
        request.send();

        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    let data = response.data;
                    document.getElementById('prospecto_nombre').value = data.nombre;
                    document.getElementById('prospecto_apll_paterno').value = data.apellido_paterno;
                    document.getElementById('prospecto_apll_materno').value = data.apellido_materno;
                    document.getElementById('prospecto_calle').value = data.calle;
                    document.getElementById('prospecto_numero').value = data.numero;
                    document.getElementById('prospecto_colonia').value = data.colonia;
                    document.getElementById('prospecto_codigo_postal').value = data.codigo_postal;
                    document.getElementById('prospecto_telefono').value = data.telefono;
                    document.getElementById('prospecto_rfc').value = data.rfc;
                    document.getElementById('prospecto_estatus_prospecto').value = data.estatus_prospecto;
                    openModal(modal_client);
                }else{
                    swAlert('error', response.title, response.text);
                    table_clients.api().ajax.reload();
                }
            }
        }

    }else if(tipo === 'delete'){
        Swal.fire({
            icon: 'warning',
            title: 'Eliminar prospecto',
            text: '¿Realmente quieres eliminar el prospecto?',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Si, eliminar',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                ajaxUrl = base_url+'/Prospectos/delete/'+id;
                request.open('POST', ajaxUrl, true);
                request.send();

                request.onreadystatechange = function (){
                    if(request.readyState === 4 && request.status === 200){
                        let response = JSON.parse(request.responseText);

                        if(response.status == 200){
                            swAlert('success', response.title, response.text);
                            table_clients.api().ajax.reload();
                        }else{
                            swAlert('error', response.title, response.text);
                        }
                    }
                }

            }
        });

    }else if(tipo === 'view'){
        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Prospectos/showOne/'+id;
        request.open('GET', ajaxUrl, true);
        request.send();

        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    let data = response.data;
                    let usuario = data.usuario_nombre + ' ' + data.usuario_apellido_paterno + ' ' + data.usuario_apellido_materno;
                    let estatus;

                    if(data.estatus_prospecto == 'Enviado'){
                        estatus = '<span class="badge badge-info">Enviado</span>';
                    }else if(data.estatus_prospecto == 'Autorizado'){
                        estatus = '<span class="badge badge-success">Autorizado</span>';
                    }else if(data.estatus_prospecto == 'Rechazado'){
                        estatus = '<span class="badge badge-danger">Rechazado</span>';
                    }

                    document.getElementById('pv_id_prospecto').innerHTML = data.id_prospecto;
                    document.getElementById('pv_nombre').innerHTML = data.nombre;
                    document.getElementById('pv_apll_paterno').innerHTML = data.apellido_paterno;
                    document.getElementById('pv_apll_materno').innerHTML = data.apellido_materno;
                    document.getElementById('pv_calle').innerHTML = data.calle;
                    document.getElementById('pv_numero').innerHTML = data.numero;
                    document.getElementById('pv_colonia').innerHTML = data.colonia;
                    document.getElementById('pv_codigo_postal').innerHTML = data.codigo_postal;
                    document.getElementById('pv_telefono').innerHTML = data.telefono;
                    document.getElementById('pv_rfc').innerHTML = data.rfc;
                    document.getElementById('pv_estatus_prospecto').innerHTML = estatus;
                    document.getElementById('pv_observaciones').innerHTML = data.observaciones;
                    document.getElementById('pv_usuario').innerHTML = usuario;
                    document.getElementById('pv_fecha').innerHTML = data.fecha;

                    openModal(modal_client_view);
                }else{
                    swAlert('error', response.title, response.text);
                    table_clients.api().ajax.reload();
                }
            }
        }
    }else if(tipo === 'approve'){
        Swal.fire({
            icon: 'warning',
            title: 'Autorizar prospecto',
            text: '¿Realmente quieres autorizar el prospecto?',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Si, autorizar',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                ajaxUrl = base_url+'/Prospectos/approve/'+id;
                request.open('POST', ajaxUrl, true);
                request.send();

                request.onreadystatechange = function (){
                    if(request.readyState === 4 && request.status === 200){
                        let response = JSON.parse(request.responseText);

                        if(response.status == 200){
                            swAlert('success', response.title, response.text);
                            table_clients.api().ajax.reload();
                        }else{
                            swAlert('error', response.title, response.text);
                        }
                    }
                }

            }
        });
    }else if(tipo === 'reject'){
        let formData;
        let observation;

        Swal.fire({
            icon: 'warning',
            title: 'Rechazar prospecto',
            text: '¿Realmente quieres rechazar el prospecto?',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Si, rechazar',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: 'No, cancelar',
            reverseButtons: true,
            input: 'text',
            inputLabel: 'Razón de rechazo',
            inputValidator: (value) => {
                if (!value) {
                    return 'Es necesario escribir una razón'
                }
            },
            preConfirm: (value) => {
                observation = value;
            }
        }).then((result) => {
            if (result.isConfirmed) {

                request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                ajaxUrl = base_url+'/Prospectos/reject/'+id;
                formData = new FormData();
                formData.append('observaciones', observation);
                request.open('POST', ajaxUrl, true);
                request.send(formData);

                request.onreadystatechange = function (){
                    if(request.readyState === 4 && request.status === 200){
                        let response = JSON.parse(request.responseText);

                        if(response.status == 200){
                            swAlert('success', response.title, response.text);
                            table_clients.api().ajax.reload();
                        }else{
                            swAlert('error', response.title, response.text);
                        }
                    }
                }

            }
        });


        // const { value: ipAddress } = await Swal.fire({
        //     title: 'Enter your IP address',
        //     input: 'text',
        //     inputLabel: 'Your IP address',
        //     inputValue: inputValue,
        //     showCancelButton: true,
        //     inputValidator: (value) => {
        //         if (!value) {
        //             return 'You need to write something!'
        //         }
        //     }
        // })
        //
        // if (ipAddress) {
        //     Swal.fire(`Your IP address is ${ipAddress}`)
        // }
    }
}

