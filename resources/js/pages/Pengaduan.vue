<template>
    <Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>
    <div class="form-wrapper w-full flex flex-col py-16 pl-12 pr-12 border border-[#EAEAEA] rounded-xl max-w-[800px] mx-auto">
        <form class="flex gap-6 flex-wrap">
            <div class="input-form">
                <div class="form-group">
                    <label class="block" for="name"> Nama Lengkap </label>
                    <input class="form-input" id="name" type="text" placeholder="Nama" name="name" disabled v-model="register_data.nama">
                </div>
                <div class="form-group">
                    <label class="block" for="nik"> Nik </label>
                    <input class="form-input" id="nik" type="text" placeholder="nik" name="nik" disabled v-model="register_data.nik">
                </div>
                <div class="form-group">
                    <label class="block" for="email"> Email </label>
                    <input class="form-input" id="email" type="email" placeholder="nama@email.com" disabled name="email" v-model="register_data.email">
                </div>
                <div class="form-group flex gap-6 items-center" >
                    <label class="block" for="kategori"> Kategori </label>
                    <select class="form-select form-input w-2/3" name="kategori" id="kategori" v-model="register_data.kategori">
                        <option :value="item.slug" v-for="(item, index) in terms" :key="index" v-html="item.name"></option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="block" for="subject"> Subject </label>
                    <input class="form-input" id="subject" type="text" placeholder="" name="subject" v-model="register_data.subject">
                </div>
                <div class="form-group">
                    <label class="lg:inline-flex lg:h-full lg:items-start" for="pesan"> Pesan </label>
                    <textarea name="pesan" id="pesan" rows="5" class="w-2/3 border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-[#969696] font-normal mt-3 focus:border-primary focus:ring-primary" v-model="register_data.pesan"></textarea>
                </div>
                <div class="form-group">
                    <label class="block" for="upload"> Upload </label>
                    <input class="form-input" id="formFile" type="file" name="upload">
                </div>
            </div>
        </form>
        
        <button class="bg-primary text-white border border-primary py-4 px-8 rounded-xl mt-6" @click="handleRegister">Kirim</button>

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
    name:"Pengaduan",
    props:{
        terms: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            isLoading: false,
            register_data: {
                nama: null,
                nik: null,
                email: null,
                kategori: null,
                subject: null,
                pesan: null,
            },
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
            this.register_data.nik = this.$settings.loginStatus.userMeta.user_nik[0]
        }

        if (this.terms && this.terms.length >= 0) {
            this.register_data.kategori = this.terms[0].slug
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
                            }, 1500);
                            return;
                        }
                }
            }

            
            let formData = {
                nama : this.register_data.nama,
                email: this.register_data.email,
                kategori : this.register_data.kategori,
                pesan : this.register_data.pesan,
                subject : this.register_data.subject,
                nik : this.register_data.nik
            };

            this.$api.Users.actionPengaduan(formData).then(({data}) => {
                console.log(data.status);
                    this.isLoading = false;
                    this.validForm = data.status;
                    this.message = data.message;
                    setTimeout(() => {
                        this.message = '';
                        if (data.status == true || data.status == 'true') {
                            window.location.href = '/imigrasi-dashboard/pengaduan-list/';
                        }
                    }, 1500);
                    return;
            }).catch((e) => alert(e));
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
    input, select, textarea {
        @apply w-full lg:w-2/3;
    }
}
    .form-wrapper{
        .input-group {
            @apply mb-6;
            label{
                @apply text-primary font-bold text-xs lg:text-sm leading-5 w-1/3;
            }
            input,
            input#name,
            input#nim,
            input#sekolah{
                @apply border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none w-full text-[#969696] font-normal mt-3;
            }
             input[type=submit]{
                @apply bg-primary text-white border border-primary py-4 px-8 rounded-xl;
            }
        }
    }
</style>