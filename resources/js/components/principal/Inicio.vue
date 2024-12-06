<template>
    <div>
        <!-- Si no tiene sucursal -->
        <div class="flex-grow-1 container-p-y container-fluid pt-0 container-p-y">
            <div class="app-academy">
                <div class="card p-0 mb-4">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
                        <div class="app-academy-md-25 card-body py-0">
                            <img
                            src="/assets/img/illustrations/bulb-light.png"
                            class="img-fluid app-academy-img-height scaleX-n1-rtl"
                            alt="Bulb in hand"
                            height="90" />
                        </div>
                        <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">
                            <h3 class="card-title mb-4 lh-sm px-md-5 lh-lg">
                                ¡Bienvenido al Sistema de Alerta y Retención de Pacientes 
                                <span class="text-primary fw-medium text-nowrap">SARP-DentAI</span>!
                            </h3>
                            <p class="mb-1 mx-2">
                                Nos complace darte la bienvenida. Con <span class="fw-bold">SARP-DentAI</span>, podrás mejorar la gestión de tu clínica dental al recibir alertas automáticas sobre citas próximas, seguimientos pendientes y pacientes inactivos. 
                                Nuestro sistema está diseñado para ayudarte a retener pacientes y brindar un mejor servicio de atención.
                            </p>
                            <div class="alert alert-info mt-4">
                                <h4 class="mb-0 text-info">No olvides configurar tus sucursales y comenzar a programar alertas. Si necesitas asistencia, no dudes en contactar al administrador del sistema.</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';
    import AnimatedNumber from "animated-number-vue"
    export default {
        name: 'inicio',
    }
</script>