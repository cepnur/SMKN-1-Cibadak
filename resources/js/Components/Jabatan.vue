<template>
  <div v-for="item in xdata" :key="item.nama" class="lg:flex xl:flex px-5 xl:px-0 lg:px-0" :style="item.leftImage ? '' : 'flex-direction: row-reverse'">
    <div class="relative flex-row">
      <img class="" :src="this.$settings.imagesPublic + '/Group1.png'" alt="" />
      <img class="absolute top-10 left-16" :src="item.img" alt="" />
    </div>

    <div class="flex info gap-4 lg:gap-28 xl:gap-28 lg:py-40 xl:py-40 py-28 xl:px-18 lg:px-18 md:px-10">
      <div>
        <p class="font-bold">Nama</p>
        <p class="font-bold">Tanggal Lahir</p>
        <p class="font-bold">Alamat</p>
        <p class="font-bold">Jabatan</p>
        <p class="font-bold">Mata Pembelajaran</p>
      </div>
      <div>
        <p>{{ item.nama }}</p>
        <p>{{ item.tgl }}</p>
        <p>{{ item.alamat }}</p>
        <p>{{ item.jabatan }}</p>
        <p>{{ item.matkul }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      xdata: [
        {
          img: this.$settings.imagesPublic + "/group1.2.png",
          nama: ": Drs. Iwan M.kom",
          tgl: ": Bandung, 8  Maret  1964",
          alamat: ": Ciaul Pasir    Rt.002    RW.009",
          jabatan: ": Kepala Sekolah",
          matkul: ": Komputer",
          leftImage: true,
        },
        {
          img: this.$settings.imagesPublic + "/group1.3.png",
          nama: ": Drs. Iwan M.kom",
          tgl: ": Bandung, 8  Maret  1964",
          alamat: ": Ciaul Pasir    Rt.002    RW.009",
          jabatan: ": Kepala Sekolah",
          matkul: ": Komputer",
          leftImage: false,
        },
        {
          img: this.$settings.imagesPublic + "/group1.4.png",
          nama: ": Drs. Iwan M.kom",
          tgl: ": Bandung, 8  Maret  1964",
          alamat: ": Ciaul Pasir    Rt.002    RW.009",
          jabatan: ": Kepala Sekolah",
          matkul: ": Komputer",
          leftImage: true,
        },
        {
          img: this.$settings.imagesPublic + "/group1.5.png",
          nama: ": Drs. Iwan M.kom",
          tgl: ": Bandung, 8  Maret  1964",
          alamat: ": Ciaul Pasir    Rt.002    RW.009",
          jabatan: ": Kepala Sekolah",
          matkul: ": Komputer",
          leftImage: false,
        },
      ],
    };
  },
};
</script>

<style></style>
