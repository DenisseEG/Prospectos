var table_roles;
var form_role = document.getElementById('formRole');
var form_role_name = 'formRole';
var modal_role = 'modalFormRole';
var form_permissions = 'formPermissions';
var modal_permissions = 'modalPermissions';
var id_rol = null;

document.addEventListener('DOMContentLoaded', function (){
    let columns = [
        {"data":"id_rol"},
        {"data":"nombre"},
        {"data":"descripcion"},
        {"data":"estatus"},
        {"data":"opciones"}
    ];

    table_roles = createDataTable('rolesTable', 'Roles/showAll', columns);

    form_role.onsubmit = function(e){
        e.preventDefault();
        let data = dataExist(form_role_name, 1, null);
        let request;
        let ajaxUrl;
        let formData;

        if(!data.all){
            swAlert('warning', 'Campos vacios', 'Todos los campos son obligatorios');
            return false;
        }

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = id_rol ? base_url+'/Roles/update/'+id_rol : base_url+'/Roles/create';
        formData = new FormData(form_role);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    closeModal(modal_role, form_role_name);

                    if(response.rol && response.rol == 'exist'){
                        swAlert('warning', response.title, response.text);
                    }else{
                        swAlert('success', response.title, response.text);
                    }

                    table_roles.api().ajax.reload();
                }else{
                    swAlert('error', response.title, response.text);
                }
            }
        }

    }
});

function roleActions(tipo, id){
    id_rol = id;
    let request;
    let ajaxUrl;

    if(tipo === 'new'){
        openModal(modal_role);
        document.getElementById('modal_title_role').innerHTML = 'Nuevo Rol';
        document.getElementById('save_form_role').innerHTML = 'Guardar';

    }else if(tipo === 'edit'){
        document.getElementById('modal_title_role').innerHTML = 'Actualizar Rol';
        document.getElementById('save_form_role').innerHTML = 'Actualizar';

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Roles/showOne/'+id;
        request.open('GET', ajaxUrl, true);
        request.send();

        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    let data = response.data;
                    document.getElementById('rol_nombre').value = data.nombre;
                    document.getElementById('rol_descripcion').value = data.descripcion;
                    document.getElementById('rol_estatus').value = data.estatus;
                    openModal(modal_role);
                }else{
                    swAlert('error', response.title, response.text);
                    table_roles.api().ajax.reload();
                }
            }
        }

    }else if(tipo === 'delete'){
        Swal.fire({
            icon: 'warning',
            title: 'Eliminar rol',
            text: '¿Realmente quieres eliminar el rol?',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Si, eliminar',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                ajaxUrl = base_url+'/Roles/delete/'+id;
                request.open('POST', ajaxUrl, true);
                request.send();

                request.onreadystatechange = function (){
                    if(request.readyState === 4 && request.status === 200){
                        let response = JSON.parse(request.responseText);

                        if(response.status == 200){
                            swAlert('success', response.title, response.text);
                            table_roles.api().ajax.reload();
                        }else{
                            swAlert('error', response.title, response.text);
                        }
                    }
                }

            }
        });

    }else if(tipo === 'permissions'){

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Permisos/show/'+id;
        request.open('GET', ajaxUrl, true);
        request.send();

        request.onreadystatechange = function (){
            if(request.readyState === 4 && request.status === 200){
                document.getElementById('content_ajax').innerHTML = request.responseText;
                openModal(modal_permissions);
                document.getElementById(form_permissions).addEventListener('submit', savePermissions);
            }
        }
    }
}

function savePermissions(e){
    e.preventDefault();
    let request;
    let ajaxUrl;
    let formData;
    let formElement;

    request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrl = base_url+'/Permisos/setPermissions/';
    formElement = document.getElementById(form_permissions);
    formData = new FormData(formElement);
    formData.append('rol_id', id_rol);
    request.open('POST', ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function (){
        if(request.readyState === 4 && request.status === 200){
            let response = JSON.parse(request.responseText);

            if(response.status == 200){
                closeModal(modal_permissions, form_permissions);
                swAlert('success', response.title, response.text);
            }else{
                swAlert('error', response.title, response.text);
            }
        }
    }

}
