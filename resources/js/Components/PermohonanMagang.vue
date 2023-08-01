<template>
    <div>
        <Modal :showing="showModal" @close="closeModal()">
            <div class="modal-content" v-html="modalInfo"></div>
        </Modal>
        <div class="flex justify-end py-2 lg:py-6">
            <a :class="isDisabled ? 'disabled-link bg-gray-400' : ''" href="/magang-request" class="lg:inline-flex btn btn-primary">Buat Pengajuan</a>
        </div>
        <div class="overflow-x-auto table-container">
            <table class="w-full">
                <thead class="border-solid"> 
                    <tr>
                        <th class="bg-primary border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">NIM</th>
                        <th class="bg-primary border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white whitespace-nowrap">Nama Lengkap</th>
                        <th class="bg-primary hidden md:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">No Telepon</th>
                        <th class="bg-primary hidden md:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Email</th>
                        <th class="bg-primary hidden md:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Sekolah</th>
                        <th class="bg-primary hidden md:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Tempat Lahir</th>
                        <th class="bg-primary hidden md:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Tanggal Lahir</th>
                        <th class="bg-primary hidden md:table-cell border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Alamat</th>
                        <th class="bg-primary border-2 border-gray-100 px-3 py-4 font-bold text-sm text-white">Status</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="magang in data_magangs" :key="magang.nim">
                        <td class="p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.nim}}</td>
                        <td class="p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.nama_lengkap}}</td>
                        <td class="hidden md:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.no_telepon}}</td>
                        <td class="hidden md:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.email}}</td>
                        <td class="hidden md:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.sekolah}}</td>
                        <td class="hidden md:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.tempat_lahir}}</td>
                        <td class="hidden md:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.tanggal_lahir}}</td>
                        <td class="hidden md:table-cell p-3 border-2 border-gray-100" style="vertical-align: baseline;">{{magang.alamat}}</td>
                        <template v-if="magang.status.name === 'Diajukan'">
                            <td class="p-3 border-2 border-gray-100" style="vertical-align: baseline;">
                            <div class="flex flex-col items-center gap-2">
                                <span>{{magang.status.name}}</span>
                            </div></td>
                        </template>
                        <template v-else>
                            <td class="p-3 border-2 border-gray-100" style="vertical-align: baseline;">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="" >{{magang.status.name}}</span> 
                                    <span class="text-sm underline underline-offset-4 font-semibold hover:cursor-pointer" @click="showInfo(magang.message_info)" :class="magang.status.name === 'Diterima' ? 'text-primary' : 'text-red-700'" >Detail</span>
                                </div>
                            </td>
                        </template>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import Modal from './Modal.vue';

export default {
    props: [
        'data_magangs'
    ],
    components:{
        Modal
    },
    data(){
        return {
            showModal: false,
            modalInfo: '',
            isDisabled : false
        }
    },
    methods: {
        closeModal(){
            this.showModal = false;
        },
        showInfo(value){
            this.modalInfo = value;
            this.showModal = !this.showModal;
        }
    },
    mounted(){
        const hasDiproses = this.data_magangs.some((data) => data.status.name === "Diajukan");

        if (hasDiproses) {
            this.isDisabled = true;
        } else {
            this.isDisabled = false;
        }
    }
}
</script>

<style>
.table-container {
  position: relative;
  height: 300px; /* Atur tinggi sesuai kebutuhan */
  overflow: auto;
}

.table-container thead {
  position: sticky;
  top: 0;
  background-color: #fff;
  z-index: 2;
}
.disabled-link {
  pointer-events: none; /* Mencegah tautan diklik */
  opacity: 0.8; /* Opacity menunjukkan tautan yang tidak dapat diklik */
}
</style>