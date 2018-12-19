<template>
    <div id="Platform">
        <el-button type="success" size="mini" icon="el-icon-caret-right"
            @click="try_start_instance()" v-show="!tryStartInstance && !instanceRunning">Start Your Workspace</el-button>

        <editor v-model="content" @init="editorInit" lang="html" theme="chrome" width="500" height="100"></editor>

        <div id="platform_info" v-if="tryStartInstance" v-loading="!instanceRunning">
            <p>This would take up to 10min...</p>
            <p>Your workspace {{uuid}} {{instancePhase}}</p>
            <p></p>
            <p>Step1: use "su" command, enter root previllage with root password +Un1QRTw7TgAg685AFzBkPm</p>
            <p>Step2: "cd ~; sh start_robot.sh" this will enable your simulation</p>
            <p>Step3: refresh your emulator</p>
            <el-button type="success" size="mini" icon="el-icon-tickets"
                @click="open_console()" >Open Console</el-button>
            <el-button type="success" size="mini" icon="el-icon-refresh"
                @click="refresh_emu()" >Refresh Emulator</el-button>
        </div>

        <div id="platform_itself" 
            element-loading-text="Try very hard LOADING = ="
            element-loading-spinner="el-icon-loading"
            element-loading-background="rgba(0, 0, 0, 0.8)"
            v-if="loaded" v-loading="frame_loading">
            <iframe 
                id = "gzweb"
                v-if="loaded"
                :src="src_gzweb"
                :style="style"
                :height="height"
                :width="width"
                @load="frame_load()"
                frameborder="0"
            ></iframe>

            <iframe 
                id = "console"
                v-if="loaded"
                :src="src"
                :style="style"
                :height="height"
                :width="width"
                frameborder="0"
            ></iframe>
        </div>

    </div>
</template>

<script>
export default {
    name: 'Platform',
    data () {
        return {
            loaded : false,
            src : "",
            style : null,
            height : "400px",
            width : "100%",

            frame_loading : true,

            loggedInUsername : "",
            uuid : "",
            tryStartInstance : false,
            instanceRunning : false,
            instancePhase : "",

            content : "this is code"
        }
    },
    methods: {
        is_log_in (){
            this.$http.post('is_user_logged_in.php','{}').then(res=>{
                    this.isUserLoggedIn = res.data["code"];
                    if(this.isUserLoggedIn==true){
                        this.loggedInUsername = res.data["username"];
                        this.uuid = res.data["uuid"];
                    }
                    });
        },
        do_create() {
            this.$http.post('instance_create.php', {}).then(
                    res => {
                        console.log(JSON.stringify(res.data));
                    }
                    );
        },
        try_start_instance(){
            this.tryStartInstance = true;
            this.do_create();
        },
        do_check() {
            this.$http.post('instance_check_status.php', {}).then(
                    res => {
                        console.log(JSON.stringify(res.data));
                        if("ErrorCode" in res.data){
                            return;
                        }
                        if(res.data["status"]["phase"]=="running"){
                            this.instancePhase = res.data["status"]["phase"];
                            this.instanceRunning = true;
                            this.tryStartInstance = true;
                        }
                        if(res.data["status"]["phase"]=="pending"){
                            this.instancePhase = res.data["status"]["phase"];
                            this.tryStartInstance = true;
                        }
                    }
                    );
        },
        check_instance_running() {
            this.do_check();
            if(this.instanceRunning){
                return;
            }
            setTimeout(this.check_instance_running, 5000);
        },
        open_console(){
            this.loaded = true;
            this.src = 'https://roboslab.me:2223/ssh/host/' + 'robotapp-' + this.uuid;
            this.src_gzweb = 'https://roboslab.me:8089/api/' + 'robotapp-' + this.uuid + '.robotics.svc.cluster.local' + '/';
        },
        refresh_emu(){
            this.frame_loading = true;
            document.getElementById('gzweb').src = document.getElementById('gzweb').src
        },
        frame_load() {
            this.frame_loading = false;
        },
        editorInit: function () {
            require('brace/ext/language_tools') //language extension prerequsite...
            require('brace/mode/html')                
            require('brace/mode/javascript')    //language
            require('brace/mode/less')
            require('brace/theme/chrome')
            require('brace/snippets/javascript') //snippet
        }
    },
    created(){
    },
    mounted(){
        this.is_log_in ();
        this.instanceRunning = false;
        this.do_check();
        if(this.instanceRunning==false){
            setTimeout(this.check_instance_running, 5000);
        }
    },
    destroyed(){
        this.instanceRunning = true;
    },
    components: {
        editor: require('vue2-ace-editor')
    }
}
</script>

<style>
    #editor { 
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
