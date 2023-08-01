<template>
  <div class="container mx-auto px-5 py-20">
    <div class="mb-4 flex space-x-2">
      <input type="text" v-model="searchQuery" placeholder="Cari nama siswa/ NIS siswa" class="p-2 border rounded" />
      <select v-model="genderFilter" class="p-2 border rounded">
        <option value="">Semua</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
        <option value="T">Tidak Ada</option>
      </select>
    </div>
    <table class="w-full">
      <thead>
        <tr class="text-white text-base bg-[#13A1A1]">
          <th class="border p-1">{{ table.no }}</th>
          <th class="border">{{ table.nis }}</th>
          <th class="border">{{ table.nama }}</th>
          <th class="border">{{ table.kelamin }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in tablebody" :key="index" class="text-base">
          <td class="border text-center py-2">{{ item.nom }}</td>
          <td class="border text-center">{{ item.ns }}</td>
          <td class="border text-center">{{ item.siswa }}</td>
          <td class="border text-center">{{ item.jk }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["tablehead", "tablebody"],
  data() {
    return {
      table: {
        no: "No",
        nis: "NIS",
        nama: "Nama Siswa",
        kelamin: "Jenis Kelamin",
      },
      td: [
        {
          nom: "1",
          ns: "10151609857",
          siswa: "AA Faisal Abdullah",
          jk: "L",
        },
        {
          nom: "2",
          ns: "10151609857",
          siswa: "BB Linda Dewi",
          jk: "P",
        },
        {
          nom: "3",
          ns: "10151609857",
          siswa: "CC Joko Susilo",
          jk: "L",
        },
        {
          nom: "4",
          ns: "10151609857",
          siswa: "Siti Maemunah",
          jk: "P",
        },
        {
          nom: "5",
          ns: "10151609857",
          siswa: "Muhamad Idrus",
          jk: "L",
        },
        {
          nom: "6",
          ns: "10151609857",
          siswa: "CC Joko Susilo",
          jk: "L",
        },
        {
          nom: "7",
          ns: "10151609857",
          siswa: "Criya Anglita",
          jk: "P",
        },
        {
          nom: "8",
          ns: "10151609857",
          siswa: "Freya Annisa",
          jk: "P",
        },
        {
          nom: "9",
          ns: "10151609857",
          siswa: "Kelvin Cristoper",
          jk: "L",
        },
        {
          nom: "10",
          ns: "10151609857",
          siswa: "Alvine Lieble",
          jk: "L",
        },
        {
          nom: "11",
          ns: "10151609857",
          siswa: "Fahrizal",
          jk: "L",
        },
        {
          nom: "12",
          ns: "10151609857",
          siswa: "Bambang",
          jk: "L",
        },
        {
          nom: "13",
          ns: "10151609857",
          siswa: "Asep suhendra",
          jk: "L",
        },
        // Tambahkan data siswa lainnya di sini
      ],
      searchQuery: "",
      genderFilter: "",
    };
  },
  computed: {
    tablebody() {
      let filtered = this.tablebody;

      if (this.searchQuery !== "") {
        filtered = filtered.filter((item) => {
          return item.siswa.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.ns.includes(this.searchQuery);
        });
      }

      if (this.genderFilter !== "") {
        filtered = filtered.filter((item) => item.jk === this.genderFilter);
      }

      return filtered;
    },
  },
};
</script>

<style></style>
