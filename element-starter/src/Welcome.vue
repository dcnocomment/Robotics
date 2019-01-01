<template>
    <div id="welcome">
    <div id="welcome_upper">
        <h1 id="text-h1">Learn to Develop for Robots with ROS</h1>
        <h2 id="text-h2">Master ROS Skills and Become a Robotics Developer</h2>
        <el-button type="primary" id="btn-main">Start Right Now !!!<i class="el-icon-caret-right el-icon--right"></i></el-button>
    </div>
    <div id="welcome_down">
        <div id="banner">
            <img src="assets/images/the-construct-Trusted-by-the-worlds-leading-businesses-and-educational-organizations_.png" style="width: 80%;">
        </div>
        <div id="classes">
            <div id="cards">
            <el-row :gutter="12">
                <el-col :span="8">
                    <el-card shadow="always">
                        <img src="assets/images/cards-1.png" class="card-img">
                        The best way to learn ROS is practice
                        Give you an introduction to ROS including main concepts required to create and understand ROS programs. You will learn ROS basics by programming online simulated robots.
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card shadow="hover">
                        <img src="assets/images/cards-2.png" class="card-img">
                        In this Course, you are going to learn all the basics you need in order to start programming autonomous drones using Robot Operating System (ROS).
                        You will learn through hands on experience from day one! You will be using the Parrot AR Drone in different environments.
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card shadow="never">
                        <img src="assets/images/cards-3.png" class="card-img">
                        The objective of this ROS Navigation course is to give you the basic tools and knowledge to be able to understand and create any basic ROS Navigation related project.
                        You will be able to create maps of environments, localize the robot in the environment, make the robots perform path planning, visualize data of the different Navigation processes, debug errors using RViz and configure the different Navigation nodes.
                    </el-card>
                </el-col>
            </el-row>
        </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: 'Welcome',
    data () {
        return {
        }
    },
    methods: {
    },
    mounted(){
    },
    components: {
    }
}
</script>

<style>
    #welcome_upper{
        padding: 150px;
        text-align: center;
        background-image: url(assets/images/laptop-image-ros-training.png);
        background-repeat: no-repeat;
        background-size: 100% auto;
        position: relative;
    }
    #welcome_upper:before{
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
    }
    #text-h1{
        font-size: 60px;
        color: #FFF;
        position: relative;
    }
    #text-h2{
        font-size: 50px;
        color: #FFF;
        position: relative;
    }
    #btn-main{
        position: relative;
    }

    #banner{
        padding: 150px;
        padding-top: 50px;
        padding-bottom: 20px;
        text-align: center;
        position: relative;
    }
    #classes{
        padding: 150px;
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
        position: relative;
    }
    #cards{
        padding-left: 10%;
        padding-right: 10%;
    }
    .card-img{
        width: 100%;
        margin-bottom: 20px;
    }
</style>
