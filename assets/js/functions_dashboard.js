document.addEventListener('DOMContentLoaded', function (){
    getCountStatus();
});

function getCountStatus(){
    let request;
    let ajaxUrl;

    request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrl = base_url+'/Prospectos/getCountStatus/';
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function (){

        if(request.readyState === 4 && request.status === 200){
            let response = JSON.parse(request.responseText);

            document.getElementById('enviados').innerHTML = response['enviados'];
            document.getElementById('autorizados').innerHTML = response['autorizados'];
            document.getElementById('rechazados').innerHTML = response['rechazados'];
        }
    }
}

