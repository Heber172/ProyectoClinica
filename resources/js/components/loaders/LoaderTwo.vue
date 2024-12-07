<template>
    <!-- <div class="row"> -->
    <div>
        <div class="col-lg-12 d-flex justify-content-center align-items-center" :style="'height:'+height+'px'">
            <div class="sk-chase sk-primary">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['height'],
    name: "LoaderTwo"
}
</script>