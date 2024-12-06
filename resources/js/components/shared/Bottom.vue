<template>
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl">
            <div class="footer-container d-flex align-items-center justify-content-between flex-md-row flex-column">
                <div>
                {{ gestion }}, hecho con ❤️ por <a href="#" class="fw-medium">Heber</a>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
    export default{
        name: 'bottom',
        data(){
          return {
            gestion: 0
          }
        },
        mounted(){
          this.gestion = new Date().getFullYear();
        }
    }
</script>