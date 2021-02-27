var table_users;
var form_user = document.getElementById('formUser');
var form_user_name = 'formUser';
var modal_user = 'modalFormUser';
var modal_user_view = 'modalViewUser';
var id_user = null;

document.addEventListener('DOMContentLoaded', function (){
    let columns = [
        {"data":"id_usuario"},
        {"data":"nombre"},
        {"data":"correo"},
        {"data":"nombre_rol"},
        {"data":"estatus"},
        {"data":"opciones"}
    ];

    table_users = createDataTable('usersTable', 'Usuarios/showAll', columns);
    getRolesUser();

    form_user.onsubmit = function(e){
        e.preventDefault();
        let data = dataExist(form_user_name, 2, id_user ? 'contrasena' : null) ;
        let request;
        let ajaxUrl;
        let formData;
        let validate;

        if(!data.all && !id_user){
            swAlert('warning', 'Campos vacios', 'Todos los campos son obligatorios');
            return false;
        }else if(!data.all){
            swAlert('warning', 'Campos vacios', 'Todos los campos a excepción de la contraseña son obligatorios');
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
        ajaxUrl = id_user ? base_url+'/Usuarios/update/'+id_user : base_url+'/Usuarios/create';
        formData = new FormData(form_user);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    closeModal(modal_user, form_user_name);
                    removeValidate();
                    swAlert('success', response.title, response.text);
                    table_users.api().ajax.reload();
                }else{
                    swAlert('error', response.title, response.text);
                }
            }
        }

    }
});

function getRolesUser(){
    let request;
    let ajaxUrl;

    request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrl = base_url+'/Roles/getRoles/';
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function (){
        if(request.readyState === 4 && request.status === 200){
            document.getElementById('usuario_rol').innerHTML = request.responseText;
        }
    }
}

function userActions(tipo, id){
    id_user = id;
    let request;
    let ajaxUrl;

    if(tipo === 'new'){
        openModal(modal_user);
        document.getElementById('modal_title_user').innerHTML = 'Nuevo Usuario';
        document.getElementById('save_form_user').innerHTML = 'Guardar';
        document.getElementById('usuario_contrasena').required = true;

    }else if(tipo === 'edit'){
        document.getElementById('modal_title_user').innerHTML = 'Actualizar Usuario';
        document.getElementById('save_form_user').innerHTML = 'Actualizar';
        document.getElementById('usuario_contrasena').required = false;

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Usuarios/showOne/'+id;
        request.open('GET', ajaxUrl, true);
        request.send();

        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    let data = response.data;
                    document.getElementById('usuario_nombre').value = data.nombre;
                    document.getElementById('usuario_apll_paterno').value = data.apellido_paterno;
                    document.getElementById('usuario_apll_materno').value = data.apellido_materno;
                    document.getElementById('usuario_correo').value = data.correo;
                    document.getElementById('usuario_rol').value = data.rol_id;
                    document.getElementById('rol_estatus').value = data.estatus;
                    document.getElementById('usuario_contrasena').value = '';
                    openModal(modal_user);
                }else{
                    swAlert('error', response.title, response.text);
                    table_users.api().ajax.reload();
                }
            }
        }

    }else if(tipo === 'delete'){
        Swal.fire({
            icon: 'warning',
            title: 'Eliminar usuario',
            text: '¿Realmente quieres eliminar el usuario?',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Si, eliminar',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                ajaxUrl = base_url+'/Usuarios/delete/'+id;
                request.open('POST', ajaxUrl, true);
                request.send();

                request.onreadystatechange = function (){
                    if(request.readyState === 4 && request.status === 200){
                        let response = JSON.parse(request.responseText);

                        if(response.status == 200){
                            swAlert('success', response.title, response.text);
                            table_users.api().ajax.reload();
                        }else{
                            swAlert('error', response.title, response.text);
                        }
                    }
                }

            }
        });

    }else if(tipo === 'view'){
        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Usuarios/showOne/'+id;
        request.open('GET', ajaxUrl, true);
        request.send();

        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    let data = response.data;
                    let estatus = data.estatus == 1 ?
                        '<span class="badge badge-success">Activo</span>' :
                        '<span class="badge badge-secondary">Inactivo</span>';

                    document.getElementById('uv_id_user').innerHTML = data.id_usuario;
                    document.getElementById('uv_nombre').innerHTML = data.nombre;
                    document.getElementById('uv_apll_paterno').innerHTML = data.apellido_paterno;
                    document.getElementById('uv_apll_materno').innerHTML = data.apellido_materno;
                    document.getElementById('uv_correo').innerHTML = data.correo;
                    document.getElementById('uv_rol').innerHTML = data.nombre_rol;
                    document.getElementById('uv_estatus').innerHTML = estatus;
                    document.getElementById('uv_fecha').innerHTML = data.fecha;
                    openModal(modal_user_view);
                }else{
                    swAlert('error', response.title, response.text);
                    table_users.api().ajax.reload();
                }
            }
        }

    }
}



