<template>

<Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>
    
    <div
        class="wrapper w-fit mx-auto gap-6 flex flex-col py-16 pl-12 pr-12 border border-[#EAEAEA] rounded-xl max-w-[700px]">

        <div class="wrapper-title flex flex-col gap-4 text-center justify-center">
                <h3 class="dispay-2 font-bold text-[#080D13]" style="margin-bottom: 0!important;">Login</h3>
                <p class="paragraph-2 text-softlight mb-0">In registering there are users, super users, central members, branch members, there are advantages for each member list</p>
            </div>
            

            <form action="" id="register-user" class="flex flex-col gap-6">
                <div class="input-form flex-nowrap flex-col">
                    <label for="email" class="form-group">
                        <span class="label">Email</span>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-input" v-model="login_data.username">
                    </label>

                    <label for="password" class="form-group">
                        <span class="label">Password</span>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-input" v-model="login_data.password">
                    </label>
                
                </div>
            </form>

        <div class="flex flex-col gap-6">
            <button class="btn btn-primary w-full" data-v-29977bac="" @click="handleRegister">Login</button>
            <p class="inline-flex paragrpah-2 text-darkLight mx-auto">Don’t have account ? <a href="/register-user/" class="text-primary font-bold paragrpah-2"> Register</a> </p>
        </div>

        <div v-if="!validForm && message !=''" class="mx-auto py-5 w-full">
            <div class="text-center text-white capitalize bg-red-700 py-5 rounded">
                {{ message }}
            </div>
        </div>

        <div v-if="validForm && message !=''" class="mx-auto py-5 w-full">
            <div class="text-center text-white capitalize bg-green-500 py-5 rounded">
                {{ message }}
            </div>
        </div>
    </div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import { isProxy, toRaw } from 'vue';
    export default {
        components:{
            Loading
        },
        data() {
            return {
                login_data: {
                    username: null,
                    password: null,
                },
                message: '',
                validForm : false,
                isLoading: false
            }
        },
        mounted() {
            this.isLoading = false;
        },
        methods: {
            handleRegister(e){
                e.preventDefault();
                this.isLoading = true;
                for (const key in this.login_data) {
                    if (Object.hasOwnProperty.call(this.login_data, key)) {
                        if (key != "last_Name") {
                            if (!this.login_data[key] || this.login_data[key] == "") {
                                this.validForm = false;
                                this.message = key.toString().replace("_", " ") + " tidak boleh kosong";
                                this.isLoading = !this.isLoading;
                                setTimeout(() => {
                                    this.message = '';
                                }, 3000);
                                return;
                            }
                        }
                    }
                }

                let rawData = this.login_data;

                if (isProxy(this.login_data)){
                    rawData = toRaw(this.login_data)
                }

                let formData = rawData;
                this.$api.Users.loginUser(formData).then((result) => {
                    this.isLoading = false;
                    this.validForm = result.data.success;
                    this.message = result.data.message;
                    
                    console.log(window.location.pathname)
                    setTimeout(() => {
                        if (window.location.pathname.includes('/login-member/')) {
                            window.location.href = '/'
                        }else{
                            window.location.reload()
                        }
                    }, 800);
                });
            }
        },
    }
</script>
<style lang="scss" scoped>

.form-group {
    @apply justify-between;
    span.label {
        @apply w-1/3
    }
    input.form-input{
        @apply w-2/3;
    }

}

</style>