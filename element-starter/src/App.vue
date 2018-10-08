<template>
    <div id="app">
    <el-container>
        <el-header>
            <el-button type="success" size="mini" 
                @click="start_wedding()" v-show="true">Happy Wedding</el-button>
            <el-button type="primary" size="mini" 
                @click="registerFormVisible = true" v-show="!isUserLoggedIn">Register</el-button>
            <el-button type="success" size="mini" 
                @click="loginFormVisible = true" v-show="!isUserLoggedIn">Already got an account?</el-button>
            <el-button type="primary" size="mini" 
                @click="start_robot()" v-show="isUserLoggedIn && invited">Start Robots!</el-button>
            <el-tooltip class="item" effect="dark" content="mailto:dcnocomment@gmail.com" placement="bottom-end">
            <el-button type="primary" size="mini" icon="el-icon-message"
                @click="jump_mail()" v-show="isUserLoggedIn && !invited">Contact Us To Be Invited For Evaluation</el-button>
            </el-tooltip>
            <el-button type="primary" size="mini" 
                @click="logout()" v-show="isUserLoggedIn">Logout</el-button>
        </el-header>
        <el-main>
            <!-- <el-alert :title="welcomeMsg" type="success" v-show="isUserLoggedIn"></el-alert> -->
            <router-view></router-view>

            <el-dialog title="Register" :visible.sync="registerFormVisible">
                <el-form :model="form">
                    <el-form-item label="username" :label-width="FormLabelWidth">
                        <el-input v-model="registerForm.username"></el-input>
                    </el-form-item>
                    <el-form-item label="email" :label-width="FormLabelWidth">
                        <el-input v-model="registerForm.email"></el-input>
                    </el-form-item>
                    <el-form-item label="password" :label-width="FormLabelWidth">
                        <el-input type="password" v-model="registerForm.password"></el-input>
                    </el-form-item>
                    <el-form-item label="confirm password" :label-width="FormLabelWidth">
                        <el-input type="password" v-model="registerForm.passwordConfirm"></el-input>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click="registerFormVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="registerFormVisible = false; try_register()">Submit</el-button>
                </div>
            </el-dialog>

            <el-dialog title="Login" :visible.sync="loginFormVisible">
                <el-form :model="form">
                    <el-form-item label="username" :label-width="FormLabelWidth">
                        <el-input v-model="loginForm.username"></el-input>
                    </el-form-item>
                    <el-form-item label="password" :label-width="FormLabelWidth">
                        <el-input type="password" v-model="loginForm.password"></el-input>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click="loginFormVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="loginFormVisible = false; try_login()">Submit</el-button>
                </div>
            </el-dialog>

        </el-main>
        <el-footer></el-footer>
    </el-container>
    </div>
</template>

<script>
export default {
    name: 'Default',
    data () {
        return {
            registerFormVisible : false,
            loginFormVisible : false,
            registerFormLabelWidth : "80px",
            registerForm : {
                username : "",
                email : "",
                password : "",
                passwordConfirm : ""
            },
            loginForm : {
                username : "",
                password : ""
            },
            welcomeMsg : "welcome to Robos Lab!",
            isUserLoggedIn : false,
            loggedInUsername : "",
            uuid : "",
            invited : false
        }
    },
    methods: {
        try_register () {
            var data = this.registerForm;
            this.$http.post('try_register.php', data).then(
                    res => {
                        var return_code = res.data["code"];
                        var error_msg = res.data["error"];
                        if (return_code==false){
                            this.$notify.error({title: 'Register failed', message: error_msg, duration: 5000});
                        }else{
                            this.$notify({title: 'Success', message: 'Activation mail sent', type: 'success', duration: 5000});
                        }
                    }, res => {
                        this.$message.error("network error");
                    } 
                    );
        },
        try_login () {
            var data = this.loginForm;
            this.$http.post('try_login.php', data).then(
                    res => {
                        var return_code = res.data["code"];
                        var error_msg = res.data["error"];
                        if (return_code==true){
                            this.$notify({title: 'Success', message: 'Welcome ' + data["username"], type: 'success', duration: 5000});
                            this.isUserLoggedIn = true;
                            this.loggedInUsername = res.data["username"];
                            this.uuid = res.data["uuid"];
                            this.invited = res.data["invited"] == 'Yes' ? true : false;
                            this.welcomeMsg = "Welcome, " + this.loggedInUsername;
                        }else{
                            this.$notify.error({title: 'Login failed', message: error_msg, duration: 5000});
                        }
                    }
                    );
        },
        is_log_in (){
            this.$http.post('is_user_logged_in.php','{}').then(res=>{
                    this.isUserLoggedIn = res.data["code"];
                    if(this.isUserLoggedIn==true){
                        this.loggedInUsername = res.data["username"];
                        this.uuid = res.data["uuid"];
                        this.invited = res.data["invited"] == 'Yes' ? true : false;
                        this.welcomeMsg = "Welcome, " + this.loggedInUsername;
                    }
                    });
        },
        logout(){
            this.do_delete();
            this.$http.post('logout.php','{}');
            this.isUserLoggedIn = false;
            this.$router.push({ name: 'welcome' });
        },
        start_robot(){
            this.$router.push({ name: 'platform' });
        },
        jump_mail(){
            window.location.href = "mailto:dcnocomment@gmail.com";
        },
        do_delete() {
            this.$http.post('instance_delete.php', {}).then(
                    res => {
                        console.log(JSON.stringify(res.data));
                    }
                    );
        },
        start_wedding(){
            this.$router.push({ name: 'wedding' });
        }
    },
    mounted(){
        this.is_log_in();
        this.$router.push({ name: 'welcome' });
    },
    components: {
    }
}
</script>

<style>
    #app {
        font-family: Helvetica, sans-serif;
        text-align: center;
    }
    .el-header{
        margin-left : 4%;
        margin-right : 4%;
        margin-top : 30px;
        margin-bottom : 5px;
        text-align: right;
    }
    .el-main{
        margin-left : 4%;
        margin-right : 4%;
        min-height : 800px;
    }
    .main_welcome_pic{
        width : 100%;
    }
    .el-footer{
        margin-left : 4%;
        margin-right : 4%;
    }
</style>
