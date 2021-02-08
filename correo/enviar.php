<?php
if(isset($_POST["cliente"]) &&
    isset($_POST["correo"])&&
    isset($_POST["mensaje"])){
    $cliente = $_POST["cliente"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    include_once 'PHPMailer/mail.php';
    
    $html = '<head>
        <style>
            .div-email{
                display: grid;
                grid-gap: 10px;
            }
            .div-email > div{
                display: flex;
                background: bisque;
                border: 1px dotted black;
                padding: 10px;
                font-size: initial;
            }
            .cliente{
                margin-right: 7px;
                font-weight: 900;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="div-email">
            <div>
                <label class="cliente">Cliente: </label>
                <div>'.$cliente.'</div>
            </div>
            <div>
                <label class="cliente">Correo: </label>
                <div>'.$correo.'</div>
            </div>
            <div>
                <label class="cliente">Mensaje: </label>
                <div>'.$mensaje.'</div>
            </div>
        </div>
    </body>';

    $boolEmail = enviarEmail($correo, $html, $password, $mail);

    if($boolEmail){
        echo '
        <h2>El mensaje ha sido enviado.</h2>
        <script>
        setTimeout(() => {
            window.close();
        }, 4000);
        </script>
        ';        
    }else{
        echo '<h2>No se ha podido enviar el correo, intentar de nuevo..</h2>';
    }
}else{
    echo '<h2>No se ha podido enviar el correo, intentar de nuevo..</h2>';
}

function enviarEmail($correo, $html, $password, $mail){
    try{
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jhosuelyon@gmail.com';
        $mail->Password = $password;
        $mail->Port = 587;
        $mail->setFrom('jhosuelyon@gmail.com', 'Email Cliente '.$correo);
        $mail->AddAddress('jhosuelyon@gmail.com', 'Email Cliente '.$correo);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Email Cliente '.$correo;
        $mail->Body = $html;
        $mail->Send();

        return true;
    }catch(Exception $e){
        echo $e;
    }
    return false;
}