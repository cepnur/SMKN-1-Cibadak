<template>
    <Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>
    <div class="form-wrapper w-full flex flex-col py-16 pl-12 pr-12 border border-[#EAEAEA] rounded-xl max-w-[800px] mx-auto">
        <form class="flex gap-6 flex-wrap">
            <div class="input-form">
                <div class="form-group">
                    <label class="block" for="name"> Nim / Nis </label>
                    <input class="form-input" id="nim" type="text" placeholder="11111111" name="nim" v-model="register_data.nim">
                </div>
                
                <div class="form-group">
                    <label class="block" for="name"> Nama Lengkap </label>
                    <input class="form-input" id="name" type="text" placeholder="Nama" name="name" disabled v-model="register_data.nama">
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
                    <label class="block" for="sekolah"> Sekolah / Kampus </label>
                    <input class="form-input" id="sekolah" type="text" placeholder="Sekolah" name="sekolah" v-model="register_data.sekolah">
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
            <div class="input-form">
                <div class="form-group">
                    <label class="block" for="tanggal_lahir"> Mulai Magang </label>
                    <input class="form-input" id="mulai_magang" type="date" placeholder="Mulai Magang" name="mulai_magang" v-model="register_data.mulai_magang">
                </div>
                <div class="form-group">
                    <label class="block" for="tanggal_lahir"> Berakhir Magang </label>
                    <input class="form-input" id="berakhir_magang" type="date" placeholder="Berakhir Magang" name="berakhir_magang" v-model="register_data.berakhir_magang">
                </div>
            </div>
        </form>
        
        <button class="bg-primary text-white border border-primary py-4 px-8 rounded-xl mt-6" @click="handleRegister">Request Magang</button>

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
    name:"MagangRequest",
    data() {
        return {
            isLoading: false,
            register_data: {
                nim: null,
                nama: null,
                email: null,
                sekolah: null,
                no_telepon: null,
                tempat_lahir: null,
                tanggal_lahir: null,
                alamat: null,
                mulai_magang: null,
                berakhir_magang: null
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
                nim : this.register_data.nim,
                nama : this.register_data.nama,
                email : this.register_data.email,
                no_telepon : this.register_data.no_telepon,
                sekolah : this.register_data.sekolah,
                tempat_lahir : this.register_data.tempat_lahir,
                tanggal_lahir : this.register_data.tanggal_lahir,
                alamat : this.register_data.alamat,
                mulai_magang : this.register_data.mulai_magang,
                berakhir_magang : this.register_data.berakhir_magang
            };

            this.$api.Users.doAction(formData).then(({data}) => {
                    this.isLoading = false;
                    this.validForm = data.status;
                    this.message = data.message;
                    setTimeout(() => {
                        this.message = '';
                        if (data.status == true || data.status == 'true') {
                            this.register_data.nim = null;
                            this.register_data.sekolah = null;
                            window.location.href = '/imigrasi-dashboard/permohonan-magang/'
                        }
                    }, 1500);
                    return;
            });
        }
    },
    
}
</script>
<style lang="scss" scoped>
    .form-group{
        @apply flex flex-col lg:flex-row gap-1 lg:justify-between;
        label{
            @apply w-full lg:w-1/3;
        }
        input, textarea{
            @apply w-full lg:w-2/3;
        }
    }

    .form-wrapper{
        .input-group {
            @apply mb-6;
            label{
                @apply text-primary font-bold text-xs lg:text-sm leading-5;
            }
            input#name,
            input#nim,
            input#tempat_lahir,
            input#tanggal_lahir,
            textarea#alamat,
            input#sekolah{
                @apply border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none w-full text-[#969696] font-normal mt-3;
            }
             input[type=submit]{
                @apply bg-primary text-white border border-primary py-4 px-8 rounded-xl;
            }
        }
    }
</style>