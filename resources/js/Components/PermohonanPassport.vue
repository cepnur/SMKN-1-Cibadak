<template>
    <div class="check-passport w-full h-full">

      <Modal :showing="showModal" @close="closeModal()">
        <div class="modal-content">
          <p class="font-bold text-2xl text-[#FFBF1C] mx-auto">Layanan Drive Thru</p>
          <template v-if="result && result[0] && result[0].metafield && result[0].metafield.passport_drive_thru === ''">
            <div class="form-group">
              <label class="block mb-2" for="tanggal_lahir"> Rencana tanggal pengambilan passport </label>
              <input class="form-input w-full" id="pengambilan_passport" type="date" placeholder="Pengambilan Passport" name="pengambilan_passport" v-model="driveTrhuDate">
            </div>
          </template>
          <template v-else>
            <div class="text-center capitalize py-5 rounded w-full">
                <p>Anda telah melakukan janji pengambilan pada tanggal {{ result[0].metafield.passport_drive_thru }}</p>
            </div>
          </template>
          <div v-if="driveThruShowMessage" class="mx-auto py-5 w-full">
            <div class="text-center text-white capitalize py-5 rounded w-full" :class="driveThruShowMessage ? 'bg-green-500' : 'bg-red-600'">
                {{ driveThruMessage }}
            </div>
        </div>
          <button class="btn btn-primary mt-10 w-full" @click="updateDriveThru" v-if="result[0].metafield.passport_drive_thru === ''">Ajukan Drive Thru</button>
        </div>
      </Modal>
        
        <div class="input-wrapper">
            <form action="#" @submit="findData">
                <div class="input-form">
                    <div class="form-group" flex-row gap-4>
                        <label class="block w-1/4" for="permohonan"> Nomor Permohonan </label>
                        <input class="form-input w-full" id="permohonan" required="true" type="text" placeholder="11111111" name="permohonan" v-model="permohonan">
                    </div>

                    <!-- <div class="form-group" flex-row gap-4>
                        <label class="block w-1/4" for="name"> Nama </label>
                        <input class="form-input w-full" id="name" required="true" type="text" placeholder="Jhony" name="name" v-model="name">
                    </div> -->
                </div>

                <div class="form-group mt-10 flex flex-col-reverse lg:flex-row justify-end gap-10">
                  <div v-if="!isLoading" class="mt-5 flex w-full">
                      <div class="respone-result" v-if="resultMessage != ''"> 
                        <div class="flex gap-2 items-center mb-1" v-if="result" >
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="20" height="20" rx="10" fill="#409F66" fill-opacity="0.15"/>
                            <path d="M6 11.0769L8.33333 13L13 8" stroke="#409F66" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                          <p class="text-2xl font-bold text-[#409F66]" style="margin: 0px!important;">Data Ditemukan !</p>

                        </div>
                        <div class="flex gap-2 items-center mb-1" v-else>
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="20" height="20" rx="10" fill="#D20101" fill-opacity="0.15"/>
                            <path d="M6.22 6.22C6.28956 6.15033 6.37218 6.09507 6.46312 6.05736C6.55406 6.01965 6.65155 6.00024 6.75 6.00024C6.84845 6.00024 6.94593 6.01965 7.03687 6.05736C7.12782 6.09507 7.21043 6.15033 7.28 6.22L10 8.939L12.72 6.22C12.7896 6.1504 12.8722 6.09519 12.9632 6.05752C13.0541 6.01985 13.1516 6.00047 13.25 6.00047C13.3484 6.00047 13.4459 6.01985 13.5368 6.05752C13.6278 6.09519 13.7104 6.1504 13.78 6.22C13.8496 6.2896 13.9048 6.37223 13.9425 6.46316C13.9801 6.5541 13.9995 6.65157 13.9995 6.75C13.9995 6.84843 13.9801 6.9459 13.9425 7.03683C13.9048 7.12777 13.8496 7.2104 13.78 7.28L11.061 10L13.78 12.72C13.9206 12.8606 13.9995 13.0512 13.9995 13.25C13.9995 13.4488 13.9206 13.6394 13.78 13.78C13.6394 13.9206 13.4488 13.9995 13.25 13.9995C13.0512 13.9995 12.8606 13.9206 12.72 13.78L10 11.061L7.28 13.78C7.13943 13.9206 6.94879 13.9995 6.75 13.9995C6.55121 13.9995 6.36056 13.9206 6.22 13.78C6.07943 13.6394 6.00047 13.4488 6.00047 13.25C6.00047 13.0512 6.07943 12.8606 6.22 12.72L8.939 10L6.22 7.28C6.15033 7.21043 6.09507 7.12782 6.05736 7.03687C6.01965 6.94593 6.00024 6.84845 6.00024 6.75C6.00024 6.65155 6.01965 6.55406 6.05736 6.46312C6.09507 6.37218 6.15033 6.28956 6.22 6.22Z" fill="#D20101"/>
                          </svg>

                          <p class="text-2xl font-bold text-[#D20101]" style="margin: 0px!important;">Data tidak ditemukan !</p>

                        </div>
                        
                        <div class="respone-success-message pl-7" v-html="resultMessage"></div>
                      </div>
                  </div>
                    <button type="submit" @click="findData" class="btn btn-primary h-fit w-full lg:w-1/3">Periksa Data</button>
                </div>
            </form>

            <div class="drive-tru flex flex-col gap-8 mt-8" v-if="result !== false && result[0].metafield.passport_status.slug !== 'selesai' && !isLoading">
                  <img :src="$settings.images + '/logo_imigrasi.png'" :alt="$settings.site.title" width="85" height="44" class="object-cover">
                  <div class="banner-content">
                    <p class="text-2xl font-bold text-white leading-relaxed">Drive Thru</p>
                    <div class="drive-thru-message"  v-html="driveTruMessage"></div>
                    <button class="mt-10 py-4 px-6 rounded-xl transition-colors duration-300 bg-white text-primary hover:bg-primary hover:text-white"
                    @click="openModal">Drive Thru</button>
                  </div>
                </div>
        </div>

        <div class="loading w-full flex justify-center transition-all duration-500" v-if="isLoading">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        

    </div>
</template>
<script>
import Modal from './Modal.vue';

export default {
    props: [
        
    ],
    components:{
      Modal,
    },
    data(){
        return {
            isLoading: false,
            // name: '',
            permohonan: '',
            resultMessage: '',
            driveTruMessage :'',
            result: false,
            finishStatus: false,
            showModal: false,
            driveTrhuDate : null,
            driveThruShowMessage: false,
            driveThruMessage: ''
        }
    },
    methods: {
        findData(e){
            
            if (e) {
              e.preventDefault();
            }
            this.isLoading = true;
            this.result = false;

            let formData = {
                'permohonan' : this.permohonan,
                // 'name' : this.name
            }

            this.$api.Users.findPassport(formData).then((result) => {
                this.isLoading = false;
                this.resultMessage = result.data.message
                this.driveTruMessage = result.data.drive_true
                this.result = result.data.result
                this.finishStatus = result.data.finishStatus
            }).catch((error) => {
                this.isLoading = false;
            })
            
            
        },
        closeModal(){
            this.showModal = false;
            if (this.isLoading) {
              this.isLoading = false
            }
        },
        openModal(){
          this.driveThruShowMessage = false
          this.showModal = !this.showModal;
        },
        updateDriveThru(){
          this.isLoading = true;
          if (!this.driveTrhuDate) {
              this.driveThruShowMessage = true;
              this.driveThruMessage = "Tanggal tidak boleh kosong";
              this.isLoading = false;
              setTimeout(() => {
                  this.driveThruMessage = '';
                  this.driveThruShowMessage= false;
              }, 1500);
              return;
          }

          let formData = {
            postID : this.result[0].id,
            date: this.driveTrhuDate
          }

          this.$api.Users.updateDriveThru(formData).then((result) => {
            console.log('result update drivethru - ', result);
              this.driveThruMessage = result.data.message;
              this.driveThruShowMessage= true;
            setTimeout(() => {
                  this.driveThruMessage = '';
                  this.driveThruShowMessage= false;
                  this.closeModal();
                  this.findData();
            }, 1500)
          }).catch((error) => {
            this.driveThruMessage = error;
            this.driveThruShowMessage= true;
            setTimeout(() => {
                  this.driveThruMessage = '';
                  this.driveThruShowMessage= false;
                  this.closeModal();
            }, 1500)
          })
        }
    },
    mounted(){

    }
}
</script>

<style lang="scss">

.input-form{
    @apply flex-col;
    .form-group{
        @apply flex-row items-center;
    }
}

.respone-result {
    .respone-success-message{
      @apply text-sm text-[#969696];
      p{
        @apply mb-0 leading-relaxed;
      }
    }
}

.drive-thru-message{
  @apply text-sm text-white;
      p{
        @apply mb-0 leading-relaxed;
      }
}

div.drive-tru{
  @apply py-8 px-6;
  background: linear-gradient(180deg, #F3BA40 0%, #427B76 100%);
  box-shadow: 0px 4px 24px rgba(0, 0, 0, 0.08);
  border-radius: 12px;
}

.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #005046;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}

</style>