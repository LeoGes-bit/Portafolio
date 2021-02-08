const eventoCorreo = document.getElementById("enviarCorreo");
const cliente = document.getElementById("cliente");
const correo = document.getElementById("correo");
const mensaje = document.getElementById("mensaje");

eventoCorreo.addEventListener('click', function(){

    $jsonDataCliente = {"formulario": {
        "cliente": cliente.value,
        "correo": correo.value,
        "mensaje": mensaje.value
    }};

    $.ajax({
        url: 'correo/enviar.php',
        type: 'POST',
        dataType: 'JSON',
        data: $jsonDataCliente,
        success: function(respuesta){
            if(respuesta == 100){
                alert("Su correo ha sido enviado.");
            }else{
                alert("No se ha podido enviar el correo, intentar de nuevo..");
            }
        }
    });
})

setTimeout(() => {
    window.close;
}, 4000);
