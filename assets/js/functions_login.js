var form_login = document.getElementById('formLogin');
var form_login_name = 'formLogin';
var id_prospecto = null;

$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

document.addEventListener('DOMContentLoaded', function (){

    form_login.onsubmit = function(e){
        e.preventDefault();
        let data = dataExist(form_login_name, 0,null) ;
        let request;
        let ajaxUrl;
        let formData;

        if(!data.all){
            swAlert('warning', 'Campos vacios', 'Todos los campos son obligatorios');
            return false;
        }

        request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        ajaxUrl = base_url+'/Login/login';
        formData = new FormData(form_login);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function (){

            if(request.readyState === 4 && request.status === 200){
                let response = JSON.parse(request.responseText);

                if(response.status == 200){
                    Swal.fire({
                        icon: 'success',
                        title: response.title,
                        confirmButtonColor: '#009688',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = base_url+'/dashboard';
                        }
                    });
                }else{
                    swAlert('error', response.title, response.text);
                }
            }
        }

    }
});