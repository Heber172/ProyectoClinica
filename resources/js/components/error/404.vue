<template>
    <div id="fof">
        <div class="fl_right">
            <div class="row">
                <div class="col-lg-6" id="texto">
                    <h1>ERROR 404!</h1><br>
                    <h3>No pudimos encontrar la pagina solicitada.</h3><br>
                    <p class="ml-5">Si cree que se trate de una error, contactese con el <strong>administrador del sistema</strong> o regrese al inicio.</p>
                    <router-link class="float-center btn btn-primary" to="/inicio">Regresar al inicio</router-link>
                </div>
                <div class="col-lg-6"><img src="/assets/img/illustrations/girl-sitting-with-laptop.png" alt="" id="img403"></div>
            </div>
        </div>
    </div>
  </template>
  <style scoped>
    #fof {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Fondo semitransparente */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999; /* Para asegurarse de que esté por encima de otros elementos */
    }
  
    #fof .fl_right {
        background-color: #fff; /* Color de fondo del contenido */
        padding: 20px;
        border-radius: 8px;
    }
  
    #fof .fl_right h1 {
        font-size: 60px;
        text-transform: uppercase;
    }
  
    #fof .fl_right p {
        font-size: 16px;
        text-align: center;
    }
  
    #texto {
        text-align: center;
        margin-top: 50px;
    }
  
    #img403 {
        width: 500px;
        height: 400px;
    }
  </style>