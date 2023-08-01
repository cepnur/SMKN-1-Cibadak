<template>

<Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>
    
    <div
        class="wrapper w-fit mx-auto gap-6 flex flex-col py-16 pl-12 pr-12 border border-[#EAEAEA] rounded-xl max-w-[700px]">

        <div class="wrapper-title flex flex-col gap-4 text-center justify-center">
            <h3 class="dispay-2 font-bold text-[#080D13]" style="margin-bottom: 0!important;">Register</h3>
            <p class="paragraph-2 text-softlight mb-0">In registering there are users, super users, central members,
                branch members, there are advantages for each member list</p>
        </div>


        <form action="" id="register-user" class="flex gap-6 flex-wrap">
            <div class="input-form">
                <label for="first-name" class="form-group">
                    <span class="label">First name</span>
                    <input type="text" name="first-name" id="first-name" placeholder="First name" class="form-input" v-model="register_data.first_Name">
                </label>

                <label for="last-name" class="form-group">
                    <span class="label">Last name</span>
                    <input type="text" name="last-name" id="last-name" placeholder="Last name" class="form-input" v-model="register_data.last_Name">
                </label>

                <label for="nik" class="form-group">
                    <span class="label">NIK</span>
                    <input type="text" name="nik" id="nik" placeholder="1111111111111111" class="form-input" v-model="register_data.nik">
                </label>

                <label for="email" class="form-group">
                    <span class="label">Email</span>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-input" v-model="register_data.email">
                </label>

                <label for="tlp" class="form-group">
                    <span class="label">No. Telp</span>
                    <input type="text" name="tlp" id="tlp" placeholder="+62" class="form-input" v-model="register_data.phone_Number">
                </label>

                <label for="password" class="form-group">
                    <span class="label">Password</span>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-input" v-model="register_data.password">
                </label>

                <label for="re-password" class="form-group">
                    <span class="label">Retype password</span>
                    <input type="password" name="re-password" id="re-password" placeholder="Password"
                        class="form-input" v-model="register_data.re_Password">
                </label>
            </div>
        </form>

        <div class="flex flex-col gap-6">
            <button class="btn btn-primary w-full" data-v-29977bac="" @click="handleRegister">Registrasi</button>
            <p class="inline-flex paragrpah-2 text-darkLight mx-auto">Do you have account ? <a href="/login-member/"
                    class="text-primary font-bold paragrpah-2"> Login</a> </p>
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
                register_data: {
                    email: null,
                    phone_Number: null,
                    first_Name: null,
                    last_Name: null,
                    nik: null,
                    password: null,
                    re_Password: null,
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
                for (const key in this.register_data) {
                    if (Object.hasOwnProperty.call(this.register_data, key)) {
                        if (key != "last_Name") {
                            if (!this.register_data[key] || this.register_data[key] == "") {
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

                if (this.register_data.password !== this.register_data.re_Password ) {
                    this.validForm = false;
                    this.message = "Password Not Match !!";
                    this.isLoading = !this.isLoading;
                    setTimeout(() => {
                        this.message = '';
                    }, 3000);
                    return;
                }

                let rawData = this.register_data;

                if (isProxy(this.register_data)){
                    rawData = toRaw(this.register_data)
                }

                let formData = rawData;
                this.$api.Users.register(formData).then((result) => {
                    this.isLoading = false;
                    this.validForm = result.data.success;
                    this.message = result.data.message;
                    setTimeout(() => {
                        this.message = '';
                        if (result.data.success == true || result.data.success == 'true') {
                            this.register_data =  {
                                email: null,
                                phone_Number: null,
                                first_Name: null,
                                nik: null,
                                last_Name: null,
                                password: null,
                                re_Password: null
                            };
                        }
                        
                        window.location.href = '/login-member'
                    }, 1500);
                    return;
                });
            }
        },
    }
</script>
<style lang="scss" scoped>
.form-group{
    @apply flex justify-between;
    label{
        @apply w-1/3;
    }
    input {
        @apply w-2/3;
    }
}

</style>