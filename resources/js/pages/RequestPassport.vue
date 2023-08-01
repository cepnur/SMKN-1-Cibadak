<template>
    <Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>
    <div class="form-wrapper w-full flex flex-col py-16 pl-12 pr-12 border border-[#EAEAEA] rounded-xl max-w-[800px] mx-auto">
        <form class="flex gap-6 flex-wrap">
            <div class="input-form">
                <div class="form-group">
                    <label class="block" for="name"> NIK </label>
                    <input class="form-input" id="nik" type="text" placeholder="1234123412341234" name="nik" v-model="register_data.nik">
                </div>
                
                <div class="form-group">
                    <label class="block" for="name"> Nama Lengkap </label>
                    <input class="form-input" id="name" type="text" placeholder="Nama" name="name" v-model="register_data.nama">
                </div>
                <div class="form-group">
                    <label class="block" for="name">No Telepon </label>
                    <input class="form-input" id="no_telepon" type="number" placeholder="No Telepon" name="email" v-model="register_data.no_telepon">
                </div>
                <div class="form-group">
                    <label class="block" for="name"> Email </label>
                    <input class="form-input" id="name" type="email" placeholder="nama@email.com" disabled name="email" v-model="register_data.email">
                </div>
                <div class="form-group">
                    <label class="block" for="tempat_lahir"> Tempat Lahir </label>
                    <input class="form-input" id="tempat_lahir" type="text" placeholder="Tempat Lahir" name="tempat_lahir" v-model="register_data.tempat_lahir">
                </div>
                <div class="form-group">
                    <label class="block" for="tanggal_lahir"> Tanggal Lahir </label>
                    <input class="form-input" id="tanggal_lahir" type="date" placeholder="Tanggal Lahir" name="tanggal_lahir" v-model="register_data.tanggal_lahir">
                </div>
                <div class="form-group">
                    <label class="block" for="upload"> Upload </label>
                    <input class="form-input" id="formFile" type="file" name="upload">
                </div>
            </div>
            <div class="form-group w-full">
                <label class="block" for="alamat">Alamat
                </label>
                <textarea
                    name="alamat"
                    class="w-full border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-[#969696] font-normal mt-3 focus:border-primary focus:ring-primary"
                    id="alamat"
                    rows="3"
                    v-model="register_data.alamat"></textarea>
            </div>
        </form>
        
        <button class="bg-primary text-white border border-primary py-4 px-8 rounded-xl mt-6" @click="handleRegister">Request Passport</button>

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
        <slot name="security"></slot>
    </div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
export default {
    name:"RequestPassport",
    data() {
        return {
            isLoading: false,
            register_data: {
                nik: null,
                nama: null,
                email: null,
                no_telepon: null,
                tempat_lahir: null,
                tanggal_lahir: null,
                alamat: null
            },
            maxuploadFile: 20480000,
            message: '',
            validForm : false,
        }
    },
    components:{
        Loading
    },
    mounted() {
        console.log(this.$settings.loginStatus)
        if (this.$settings && this.$settings.loginStatus) {
            this.register_data.nama = this.$settings.loginStatus.userMeta.first_name[0] + ' ' + this.$settings.loginStatus.userMeta.last_name[0];
            this.register_data.email = this.$settings.loginStatus.currentUser.data.user_email;
            this.register_data.no_telepon = this.$settings.loginStatus.userMeta.user_phone_number[0];
            this.register_data.tempat_lahir = this.$settings.loginStatus.currentUser.data.tempat_lahir;
            this.register_data.tanggal_lahir = this.$settings.loginStatus.currentUser.data.tanggal_lahir;
            this.register_data.alamat = this.$settings.loginStatus.currentUser.data.alamat;

        }
    },
    methods: {
        handleRegister(e){
            e.preventDefault();
            this.isLoading = true;

            for (const key in this.register_data) {
                if (Object.hasOwnProperty.call(this.register_data, key)) {
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

            let inputFile = document.getElementById('formFile')
            var uploadFile = inputFile.files[0];
            if (typeof uploadFile === 'undefined' || !uploadFile) {
                this.validForm = false;
                this.message = "harus mengunggah lampiran";
                this.isLoading = !this.isLoading;
                setTimeout(() => {
                    this.message = '';
                }, 3000);
                return;
            }else{
                if (uploadFile.size > this.maxuploadFile) {
                    this.validForm = false;
                    this.message = "max file upload (max 20mb)";
                    this.isLoading = !this.isLoading;
                    setTimeout(() => {
                        this.message = '';
                    }, 3000);
                    return;
                }
            }

            
            let formData = {
                nik : this.register_data.nik,
                nama : this.register_data.nama,
                email : this.register_data.email,
                no_telepon : this.register_data.no_telepon,
                tempat_lahir : this.register_data.tempat_lahir,
                tanggal_lahir : this.register_data.tanggal_lahir,
                alamat : this.register_data.alamat,
                action: 'requestPassport'


            };

            this.$api.Users.addAction(formData).then(({data}) => {
                    this.isLoading = false;
                    this.validForm = data.status;
                    this.message = data.message;
                    setTimeout(() => {
                        this.message = '';
                        if (data.status == true || data.status == 'true') {
                            window.location.href = '/imigrasi-dashboard/permohonan-passport/' 
                        }
                    }, 3000);
                    return;
            });
        }
    },
    
}
</script>
<style lang="scss">
    .form-wrapper{
        .input-group {
            @apply mb-6;
            label{
                @apply text-primary font-bold text-xs lg:text-sm leading-5;
            }
            input#name,
            input#nik,
            input#tempat_lahir,
            input#tanggal_lahir,
            textarea#alamat{
                @apply border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none w-full text-[#969696] font-normal mt-3;
            }
             input[type=submit]{
                @apply bg-primary text-white border border-primary py-4 px-8 rounded-xl;
            }
        }
    }
</style>