<template>
    <div id="wedding">
        <el-button type="text" @click="trigger()">~~ Now and Ever ~~</el-button>
        <p id="title">~~ Lucky Number ~~</p>
        <p>{{num}}</p>
        <img class="wedding_welcome_pic" src="assets/images/Weddings-Slider-1.jpg">
    </div>
</template>

<script>
export default {
    name: 'Wedding',
    data () {
        return {
            run : true,
            num : 100
        }
    },
    methods: {
        refresh(){
            this.num = Math.floor(Math.random()*130);
            if(this.run==true){
                setTimeout(this.refresh,100);
            }
        },
        trigger(){
            this.run = !this.run;
            if(this.run==true){
                setTimeout(this.refresh,100);
            }
        }
    },
    mounted(){
        if(this.run==true){
            setTimeout(this.refresh,100);
        }
    },
    components: {
    }
}
</script>

<style>
    #wedding{
        font-size: 500%;
    }
    #title{
        margin : 0;
        color : #409EFF;
    }
</style>
