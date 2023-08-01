<template>
    <div>
        <Modal :showing="showModal" @close="closeModal()" :width="'w-[80%] lg:w-1/2 rounded-lg lg:rounded-2xl'">
                <div class="dialog-header flex flex-col gap-4 items-center">

                    <template v-if="dialogType === 'detail'">
                        <svg class="hidden lg:block" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="48.5" fill="#FFBF1C" stroke="#EBAC0A" stroke-width="3"/>
                            <path d="M56.0421 23.4595L55.0501 59.9369H45.7399L44.7224 23.4595H56.0421ZM50.395 76.2169C48.7161 76.2169 47.2747 75.6233 46.0706 74.4363C44.8666 73.2322 44.273 71.7908 44.29 70.1119C44.273 68.45 44.8666 67.0255 46.0706 65.8384C47.2747 64.6513 48.7161 64.0578 50.395 64.0578C52.006 64.0578 53.4221 64.6513 54.6431 65.8384C55.8641 67.0255 56.483 68.45 56.5 70.1119C56.483 71.2311 56.1863 72.2571 55.6097 73.1898C55.0501 74.1056 54.3124 74.8433 53.3966 75.4029C52.4809 75.9456 51.4803 76.2169 50.395 76.2169Z" fill="white"/>
                        </svg>
                        <p class="text-2xl font-bold text-[#FFBF1C]">Detail Pengaduan</p>
                    </template>
                    <template v-else>
                        <svg v-if="modalInfo.message_info !== ''" class="hidden lg:block" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="48.5" fill="#FFBF1C" stroke="#EBAC0A" stroke-width="3"/>
                            <path d="M56.0421 23.4595L55.0501 59.9369H45.7399L44.7224 23.4595H56.0421ZM50.395 76.2169C48.7161 76.2169 47.2747 75.6233 46.0706 74.4363C44.8666 73.2322 44.273 71.7908 44.29 70.1119C44.273 68.45 44.8666 67.0255 46.0706 65.8384C47.2747 64.6513 48.7161 64.0578 50.395 64.0578C52.006 64.0578 53.4221 64.6513 54.6431 65.8384C55.8641 67.0255 56.483 68.45 56.5 70.1119C56.483 71.2311 56.1863 72.2571 55.6097 73.1898C55.0501 74.1056 54.3124 74.8433 53.3966 75.4029C52.4809 75.9456 51.4803 76.2169 50.395 76.2169Z" fill="white"/>
                        </svg>
                        <svg v-else width="101" height="100" viewBox="0 0 101 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50.5" cy="50" r="48.5" fill="#FB4B4B" stroke="#F6BDBD" stroke-width="3"/>
                            <path d="M67.5 67L33.5 33M67.5 33L33.5 67" stroke="white" stroke-width="5" stroke-linecap="round"/>
                        </svg>
                        
                        <p v-if="modalInfo.message_info === ''" class="text-2xl font-bold text-[#FB4B4B]">Mohon Maaf !</p>
                        <p v-else class="text-2xl font-bold text-[#FFBF1C]">Tanggapan</p>
                    </template>
                    
                </div>

                <div class="dialog-body">
                    <template v-if="dialogType === 'detail'">
                        <div class="form-group flex flex-col lg:flex-row lg:justify-between lg:items-center">
                            <p class="block w-full lg:w-1/3 text-primary font-semibold"> Subject </p>
                            <p class="form-input w-full lg:w-2/3 border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-gray-600 font-normal" v-html="modalInfo.name"></p>
                        </div>

                        <div class="form-group flex flex-col lg:flex-row lg:justify-between lg:items-center">
                            <p class="block w-full lg:w-1/3 text-primary font-semibold"> Tanggal </p>
                            <p class="form-input w-full lg:w-2/3 border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-gray-600 font-normal" v-html="modalInfo.date"></p>
                        </div>

                        <div class="form-group flex flex-col lg:flex-row lg:justify-between lg:items-center">
                            <p class="block w-full lg:w-1/3 text-primary font-semibold"> Kategori </p>
                            <p class="form-input w-full lg:w-2/3 border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-gray-600 font-normal" v-html="modalInfo.kategori"></p>
                        </div>

                        <div class="form-group flex flex-col lg:flex-row lg:justify-between lg:items-center">
                            <p class="block w-full lg:w-1/3 text-primary font-semibold"> status </p>
                            <p class="form-input w-full lg:w-2/3 border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-gray-600 font-normal" v-html="modalInfo.status"></p>
                        </div>

                        <div class="form-group flex flex-col gap-2">
                            <p class="block w-1/3 text-primary font-semibold"> Pesan </p>
                            <p class="form-input max-h-28 overflow-y-auto lg:min-h-[200px] lg:max-h-min border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-gray-600 font-normal" v-html="modalInfo.pesan"></p>
                        </div>
                    </template>
                    <template v-else>
                        <p  v-if="modalInfo.message_info !== ''" class="form-input max-h-28 overflow-y-auto lg:min-h-[200px] lg:max-h-min border border-[#EAEAEA] rounded-xl py-3 px-4 focus:outline-none text-gray-600 font-normal" v-html="modalInfo.message_info"></p>
                        <p v-else class="py-3 px-4 text-gray-600 font-bold text-xl text-center">Pengaduan Anda Belum ditanggapi, Harap Bersabar</p>
                    </template>
                </div>
        </Modal>
        <div class="flex justify-end py-2 lg:py-6">
            <a href="/pengaduan" class="inline-flex btn btn-primary">Buat Pengaduan</a>
        </div>
       <table class="w-full">
            <thead class="bg-primary border-solid"> 
                <tr>
                    <th class="border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Subject</th>
                    <th class="hidden lg:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Email</th>
                    <th class="hidden lg:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">tanggal</th>
                    <th class="border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Status</th>
                    <th class="border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="pengajuan in data_pengaduan" :key="pengajuan">
                    <td class="p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{pengajuan.name}}</td>
                    <td class="hidden lg:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{pengajuan.email}}</td>
                    <td class="hidden lg:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{pengajuan.date}}</td>
                    <td class="p-3 border-2 border-gray-100" style="vertical-align: baseline;">
                        <div class="flex gap-2 flex-col items-center">
                            <span>{{pengajuan.status}}</span>
                        </div>
                    </td>
                    <td class="flex flex-col items-center gap-2 lg:gap-0 lg:flex-row lg:justify-between">
                        <button @click="showDialog(pengajuan, 'detail')" class="btn bg-primary/25 text-primary hover:bg-primary hover:text-white transi duration-200 w-full lg:w-fit">Detail</button>
                        <button @click="showDialog(pengajuan, 'tanggapan')" class="btn bg-primary/25 text-primary hover:bg-primary hover:text-white transi duration-200">Tanggapan</button>
                    </td>
                </tr>
            </tbody>
       </table>
    </div>
</template>
<script>
import Modal from './Modal.vue';
export default {
    props: [
        'data_pengaduan'
    ],
    components:{
        Modal
    },
    data(){
        return {
            showModal: false,
            modalInfo: null,
            dialogType: 'detail'
        }
    },
    methods: {
        closeModal(){
            this.showModal = false;
        },
        showInfo(value){
            this.modalInfo = value;
            this.showModal = !this.showModal;
        },
        showDialog(value, dialogType){
            this.showModal = !this.showModal;
            this.dialogType = dialogType;
            this.modalInfo = value;
        }
    },
    mounted(){
        
    }
}
</script>
<style lang="">
    
</style>