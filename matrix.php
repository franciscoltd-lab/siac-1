<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body{
            /* position: relative;
            max-width: 100%;
            max-height: 100%; */
            /* background-color: #84f3bf;
            background-size: cover; */
            /* background-position: center; */
            background-image: url('img/banner/01.png');
            color: white;

        }
        .background-color{
            font-family: 'Gayathri', sans-serif;
            margin: 0;
            padding: 0;
            height: 1200px;
            background-color: rgba(0, 40, 5, 0.6);
            
        }
    </style>

</head>
 
<body>

    <div class="generar-turno">
        <h3>TURNO GENERADO</h3>
        <h3 id="turno"></h3>
    </div>
    
    <div class="background-color">
        <header class="logo-back" >   
            <div>
                <a href="matrix.html">
                    <img src="img/cfe-contigo.png" alt="Logo CFE contigo" class="float-left logo-cfe-contigo">
                </a>
               
                <!-- <img src="img/suterm-logo.png" alt="Logo Suterm" class="float-right suterm-logo"> -->
            </div>
            
        </header>

        <a href="matrix.php">
            <img src="img/regresar.png" alt="Regresar" class="ico float-right" style="display: none;">            
        </a>
        
        <div class="" id="informacion-contrato"></div>
        
            
        <div class="container" id="faces-preguntas">

            <span style=" color:white; padding: 5px; text-transform: uppercase; background-color: #555; border-radius:5px;"><?php echo $_SESSION['cac']?></span>

            
            <h2 style="margin-bottom: 50px;">¿Cuál es el motivo de su visita?</h2>

            <div class="faces">            

                <div>
                    <img src="img/contrato.png" alt="contrato" name="contrato" id="contrato" class="face-ico-principal">
                    <p class="ico-information">Contrato</p>
                </div>

                <div>
                    <img src="img/pago.png" alt="pago" name="pago" id="pago" class="face-ico-principal">
                    <p class="ico-information">Pago</p>
                </div>

                <div>
                    <img src="img/queja.png" alt="queja" name="queja" id="queja" class="face-ico-principal">
                    <p class="ico-information">Queja</p>
                </div>

                <div>
                    <img src="img/informacion.png" alt="informacion" name="informacion" id="informacion" class="face-ico-principal">
                    <p class="ico-information">información</p class="ico-information">
                </div>

            </div>
        </div>

        
        <footer class="site-footer seccion" onmouseover="mostrar();" onmouseout="ocultar();">
            <a class="cerrar-sesion" style="display: none;" href="static/php/cerrar-sesion.php" >Cerrar Sesión</a>
        </footer>
    </div>
</body>

<script src="js/jquery.js"></script>
<script>
   $('.face-ico-principal').click(function () { 
    
    $('#faces-preguntas').hide();
    var respuesta = $(this).attr('name');   
    $('.ico').show();
    localStorage.setItem("motivo-principal", respuesta);


    if(respuesta == "contrato"){
        $("#informacion-contrato").load("html/contrato.html");
        $('body').css('background-image', 'url(img/contrato.jpg)');   
		
    }
    else if(respuesta == "pago"){
        $("#informacion-contrato").load("html/pago.html");
        $('body').css('background-image', 'url(img/pago.jpg)');    

    }
    else if(respuesta == "queja"){
        $("#informacion-contrato").load("html/queja.html");
        $('body').css('background-image', 'url(img/queja.jpg)');    

    }
    else{
        $(".generar-turno").fadeIn('slow');
        $(".lugar").hide();    
        $('body').css('background-image', 'url(img/informacion.jpg)');    

        if(localStorage.getItem('turno') == null){
            localStorage.setItem('turno', '1');
            document.getElementById("turno").innerHTML = localStorage.getItem('turno'); 
        }
        else{
            var turno = localStorage.getItem('turno');
            parseInt(turno);
            turno++;
            document.getElementById("turno").innerHTML = turno; 

            localStorage.setItem('turno', turno.toString());
        } 

        var respuesta = {
            "motivo": $(this).attr('name'),
            "detalle": 'vacio'
        }

        $.ajax({            
            data: respuesta,
            url: 'php/guardar-motivo.php',
            type: 'POST'
        })
        .done(function(respuesta) {
            console.log(respuesta);
            
            // $("#pregunta").html(respuesta);
            
        })
        .fail(function() {
            console.log("error");
        });


        setTimeout(function() {                                       
            location = 'matrix.html';
        }, 3000); 
    }
    // document.getElementById("informacion").innerHTML = "Hola";
    

   });

   function mostrar(){
    $(".cerrar-sesion").show();
   }

   function ocultar(){
    $(".cerrar-sesion").hide();
   }

</script>

</html>