<template>
    <div>
        <div class="col-lg-12 d-flex justify-content-center align-items-center" :style="'height:'+height+'px'">
            <div class="sk-fold sk-primary">
                <div class="sk-fold-cube"></div>
                <div class="sk-fold-cube"></div>
                <div class="sk-fold-cube"></div>
                <div class="sk-fold-cube"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['height'],
    name: "Loader"
}
</script>