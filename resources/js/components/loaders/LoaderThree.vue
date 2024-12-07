<template>
    <div>
        <div class="col-lg-12 d-flex justify-content-center align-items-center" :style="'height:'+height+'px'">
            <div class="sk-wave sk-primary">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['height'],
    name: "LoaderThree"
}
</script>