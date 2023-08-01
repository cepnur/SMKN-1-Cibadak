<template>
  <div class="fade-in active">
    <Hero :title="pagetitle" :subtitle="pageabout.page_header_description" />
  </div>

  <div class="container mx-auto" v-if="pageabout">
    <main class="flex lg:py-20 xl:py-20 py-10 flex-col gap-5">
      <!-- Container-->

      <article class="leading-relaxed lg:flex xl:flex gap-20">
        <!-- Content -->
        <aside class="aside lg:pt-16 xl:pt-16 lg:w-3/12 xl:w-3/12 lg:order-1 xl:order-1">
          <!-- Aside -->
          <div class="flex flex-col gap-4 md:gap-6 lg:gap-6 bg-[#F3F3F3] px-5 py-3">
            <a href="#selayang">Selayang Pandang</a>
            <a href="#visi">Visi & Misi</a>
            <a href="#detail">Identitas Sekolah Kepala Sekolah</a>
            <a href="#akreditasi">Akreditasi Program Studi Keahlian</a>
            <a href="#alamat">Alamat</a>
            <a href="#rekening">No. Rekening Sekolah</a>
          </div>
        </aside>
        <!-- ./Aside -->
        <div class="slide-in-bottom active lg:w-9/12 xl:w-9/12 box-border flex flex-wrap justify-between gap-4 xl:gap-5 xl:px-0 px-5 pt-10">
          <div class="flex flex-col gap-4" id="selayang" v-for="(item, index) in pageabout.selayangpandang" :key="index">
            <h1 class="text-32 font-bold">{{ pageabout.selayangjudul }}</h1>
            <p>{{ item.selayangtitle }}</p>
          </div>

          <div class="flex flex-col gap-4">
            <div v-for="(item, index) in jurusans" :key="index">
              <p>{{ item.title }}</p>
            </div>
          </div>
          <div class="flex flex-col gap-4">
            <div v-for="(item, index) in selayangs2" :key="index">
              <p>{{ item.title }}</p>
            </div>
          </div>
          <div class="flex flex-col gap-4">
            <div v-for="(item, index) in pemimpins" :key="index">
              <p>{{ item.title }}</p>
            </div>
          </div>
          <div class="flex flex-col gap-5 pt-8" id="visi">
            <h1 class="text-[32px] font-bold">Visi</h1>
            <p>Terwujudnya Sekolah Agribisnis dan Agroteknologi yang mandiri, unggul, berbasis imtaq, iptek, berbudaya lingkungan Indonesia dengan pelayanan prima yang diakui secara Internasional.</p>
          </div>
          <div class="flex flex-col gap-5 pt-8">
            <h1 class="text-[32px] font-bold">Misi</h1>
            <ul class="px-5 flex flex-col gap-4" v-for="(item, index) in misis" :key="index">
              <li class="list-disc text-[13px] md:text-base">
                {{ item.title }}
              </li>
            </ul>
          </div>
          <div class="flex flex-col gap-6 pt-8">
            <div class="flex flex-col gap-5" id="detail">
              <h1 class="text-[32px] font-bold">Detail Sekolah</h1>
              <h1 class="text-lg font-bold">Identitas Kepala Sekolah</h1>
              <table class="items-center text-center w-full">
                <tbody class="items-center text-base">
                  <tr class="border" v-for="(item, index) in details" :key="index">
                    <td class="border py-2 font-bold px-3 w-2/5 text-left">{{ item.title }}</td>
                    <td class="px-3 w-1/2 py-2 text-left">{{ item.title2 }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex flex-col gap-5">
              <h1 class="text-lg font-bold">Identitas Sekolah</h1>
              <table class="items-center text-center w-full">
                <tbody class="items-center text-base" v-for="(item, index) in sekolahs" :key="index">
                  <tr class="border">
                    <td class="border font-bold px-3 w-2/5 py-2 text-left">{{ item.title }}</td>
                    <td class="px-3 w-1/2 py-2 text-left">{{ item.title2 }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex flex-col gap-5" id="akreditasi">
              <h1 class="text-lg font-bold">Akreditasi Program Studi Keahlian</h1>
              <table class="items-center text-center w-full">
                <tbody class="items-center text-base" v-for="(item, index) in akreditasis" :key="index">
                  <tr class="border">
                    <td class="border font-bold px-3 w-2/5 py-2 text-left">{{ item.title }}</td>
                    <td class="px-3 w-1/2 py-2 text-left">{{ item.title2 }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex flex-col gap-5" id="alamat">
              <h1 class="text-lg font-bold">Alamat</h1>
              <table class="items-center text-center w-full">
                <tbody class="items-center text-base" v-for="(item, index) in alamats" :key="index">
                  <tr class="border">
                    <td class="border font-bold px-3 w-2/5 py-2 text-left">{{ item.title }}</td>
                    <td class="px-3 w-1/2 py-2 text-left">{{ item.title2 }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex flex-col gap-5" id="rekening">
              <h1 class="text-lg font-bold">No. Rekening Sekolah</h1>
              <table class="items-center text-center w-full">
                <tbody class="items-center text-base" v-for="(item, index) in rekenings" :key="index">
                  <tr class="border">
                    <td class="border font-bold px-3 w-2/5 py-2 text-left">{{ item.title }}</td>
                    <td class="px-3 w-1/2 py-2 text-left">{{ item.title2 }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </article>
      <!-- ./Conten -->
    </main>
    <!-- ./Container-->
  </div>
</template>

<script>
export default {
  props: ["pageabout", "pagetitle"],
  components: {},
  data() {
    return {
      title: "About",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
      jurusans: [
        {
          title: "Teknologi Hasil Pertanian",
        },
        {
          title: "Budidaya Tanaman",
        },
        {
          title: "Budidaya Ternak",
        },
        {
          title: "Budidaya Ikan Air Tawar",
        },
        {
          title:
            "Saat ini SMK Negeri 1 Cibadak berkembang pesat di lokasi barunya yaitu di Jl. Al-Muwahhidin, Desa Karangtengah, Kecamatan Cibadak, dengan beberapa fasilitas seperti Laboratoriun Uji Mutu, Biologi, Fisika, PHP, perikanan, Peternakan dan Bengkel Mekanisasi, Lab. Basah, Lab. Serealia, Lab. Penggudangan, Lab. Komputer, Lab Agronomi dan fasilitas penunjang lainnya.",
        },
      ],
      selayangs2: [
        {
          title:
            "Pada tahun 2004 SMK Negeri 1 Cibadak membuka Program Studi Keahlian baru yaitu Multimedia sehingga sampai sekarang memiliki 5 Program Studi Keahlian dan sudah banyak memiliki link atau hubungan industri dengan beberapa perusahaan termasuk dengan JIAEC-Jepang dan PT Medion sehingga hampir 150 siswa yang sudah bekerja di Jepang dan beberapa alumni lainnya yang bekerja di Medion sebagai staf ahli. Selain itu banyak bekerja di seluruh bidang termasuk TNI, Pemerintahan, Tenaga Penyuluh, Guru, Pengusaha dan lain-lain. Mereka bergabung dalam satu wadah alumni SMK Negeri 1 Cibadak yang diketuai oleh alumni tahun 1976 yang sekarang menjabat sebagai Kepala SMK Negeri 1 Cibadak saat ini.",
        },
        {
          title:
            "Saat ini SMK Negeri 1 Cibadak telah mengukuhkan diri sebagai Sekolah Bertaraf Internasional (SBI) yang ditetapkan dengan SK Direktur Pembinaan Sekolah Menengah Kejuruan, Direktorat Jenderal Manajemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional, Nomor 0351/C5.2/Kep/MN/2006, dengan jumlah peserta didik lebih dari 1200 orang dan telah bekerjasama dengan IGI (Indonesia German Institute) serta PT Bogasari dan memiliki cafe siswa di Jalan Raya Karangtengah. Berbagai prestasi telah dicapai oleh para alumni mulai dari berbagai kejuaraan olahraga, pecinta alam, debat Bahasa Inggris, Lomba Kompetensi Siswa (LKS) baik tingkat kabupaten, provinsi maupun nasional.",
        },
        {
          title: "Sejak berdiri tahun 1965 sampai sekarang, SMK Negeri 1 Cibadak mengalami beberapa kali pergantian kepemimpinan, diantaranya sebagai berikut:",
        },
      ],
      pemimpins: [
        {
          title: "H. R. E. Rusnadi, BE, tahun 1965 s.d. tahun 1970",
        },
        {
          title: "Ir. Tri Iswoyo, tahun 1970 s.d. tahun 1976",
        },
        {
          title: "Iwa, Dipl. Ing, tahun 1976 s.d. tahun 1978",
        },
        {
          title: "E. Rochaman Sumirtapura, BSc, tahun 1978 s.d. tahun 1986",
        },
        {
          title: "Dachlan Satjapradja, BA, tahun 1986 s.d. tahun 1995",
        },
        {
          title: "Drs. Sadili Samsudin, MBA, MM (selaku Pymt), tahun 1995",
        },
        {
          title: "Drs. Usup Achmad Supri, tahun 1995 s.d. tahun 2000",
        },
        {
          title: "Drs. Syamsul Azwar, MBA tahun 2000 s.d. tahun 2004",
        },
        {
          title: "H. Dadat. M. Hadiatullah, MBA Selaku PLH, tahun 2004",
        },
        {
          title: "Drs. E. Suhendi, tahun 2005 s.d. tahun 2007",
        },
        {
          title: "Ir. Yudi Karyudi, MMPd, tahun 2007 s.d tahun 2013",
        },
        {
          title: "Drs. Juanda, M.Si, tahun 2013 sampai dengan sekarang",
        },
      ],
      selayangs: [
        {
          judul: "Selayang Pandang",
        },
        {
          title:
            "SMK Negeri 1 Cibadak didirikan pada tanggal 12 Juni 1965 berdasarkan Surat Keputusan Menteri P & K Republik Indonesia No. 69/Dirpl/65 dengan nomenklatur Sekolah Teknologi Menengah Pertanian atau STM Pertanian. SMK Negeri 1 Cibadak merupakan sekolah pertanian negeri pertama di Kabupaten Sukabumi di bawah naungan Depatemen Pendidikan dan Kebudayaan. Saat pertama berdiri, sekolah berlokasi di Bojong Masjid Desa Cibadak. Saat itu dengan jumlah siswa yang relatif sedikit, tempat belajar masih menumpang di sebuah Madrasah di Bojong Masjid Cibadak selama kurang lebih 3 tahun. Selanjutnya pada tahun 1971 tempat belajar pindah ke gedung pertunjukan budaya Tionghoa di Jalan Perintis Kemerdekaan Cibadak di samping SD Negeri 5 dan SD Negeri 6 Cibadak. Sekolah berlokasi di sana hingga tahun 1974/1975.",
        },
        {
          title:
            "Pada tahun pelajaran 1975/1976 STM Pertanian Negeri Cibadak mendapat bantuan gedung baru dari Pemerintah Daerah sebanyak 6 ruang dengan sebidang tanah HGB seluas 8118 M2 di Desa Karangtengah Kecamatan Cibadak. Saat itu jumlah siswa kurang lebih antara 60-90 orang siswa dengan satu jurusan yaitu jurusan Processing.",
        },
        {
          title:
            "Tahun 1977/1978 animo masyarakat terhadap STM Pertanian mulai meningkat sejalan dengan penyerapan lulusan baik dari lembaga pemerintah maupun dari lembaga swasta, sehingga jumlah siswanya bertambah menjadi 180 orang yang datang dari berbagai pelosok Kabupaten Sukabumi bahkan dari luar Kabupaten Sukabumi. Pada tahun1984 STM Pertanian berubah nama atau nomenklatur menjadi SMT Pertanian Cibadak berdasarkan Surat Keputusan Mendikbud RI No. 561/0/1984 pada tanggal 20 Nopember 1984 dan mendapat bantuan ruangan yaitu ruang perpustakaan dan laboratorium PHP dan berlanjut penambahan beberapa ruangan lainnya yang sekarang digunakan SMP Negeri 3 Cibadak. Seiring dengan perkembangan pembangunan dan tuntutan kebutuhan di industri pada tahun 1986 dibuka jurusan UTT (Usaha Tani Terpadu) dan jurusan THP (Teknologi Hasil Pertanian).",
        },
        {
          title: "Sesuai perkembangan teknologi dan era globalisasi pada tahun 1993 terjadi perubahan nama sekolah dari SMT Pertanian menjadi SMK Negeri 1 Cibadak berdasarkan SK Mendikbud No. 088/1993 dan memiliki 4 (empat) jurusan,",
        },
      ],

      misis: [
        {
          title: "Melaksanakan pengembangan pendidikan dan Ilmu Pengetahuan dan Teknologi Agribisnis, Agroindustri dan Teknologi informasi.",
        },
        {
          title: "Mengembangkan seluruh sarana dan prasarana, SDM, SDA, dan lingkungan secara mandiri.",
        },
        {
          title: "Melaksanakan Pendidikan berkarakter dan berpola pada Ahlaqul Kharimah,Iman dan Taqwa.",
        },
        {
          title: "Mendidik kekuatan mental yang sehat dan kuat,semangat,jujur dan disiplin tinggi.",
        },
        {
          title: "Melaksankan pembelajaran yang berbasis produksi, inovatif, kreatif, terampil dan bertanggungjawab.",
        },
        {
          title: "Membina jaringan kerjasama dengan dunia usaha dan industri.",
        },
        {
          title: "Mewujudkan keunggulan sekolah di bidang 7K, kelengkapan administrasi, manajemen (SMM), akuntabilitas dan auditasyang transparan.",
        },
      ],

      details: [
        {
          title: "Nama Kepala Sekolah",
          title2: "Iwan S.pd",
        },
        {
          title: "Tempat, Tanggal Lahir",
          title2: "Bandung, 8  Maret  1964",
        },
        {
          title: "Alamat Lengkap",
          title2: "Ciaul Pasir    Rt.002    RW.009",
        },
        {
          title: "Telephone",
          title2: "-",
        },
        {
          title: "SK Pengangkatan terakhir",
          title2: "824/1019/SEKRET",
        },
        {
          title: "Tanggal SK",
          title2: "27 -12-2013",
        },
      ],

      sekolahs: [
        {
          title: "Nama resmi sekolah",
          title2: "SMK Negeri 1 Cibadak",
        },
        {
          title: "Kode Registrasi (NSS) / NIS /ID.UN",
          title2: "401020610001 / 400010 / 0224101",
        },
        {
          title: "Kode Registrasi NPSN",
          title2: "26-06-1965",
        },
        {
          title: "Kode Resmi Sekolah",
          title2: "Kode Resmi Sekolah",
        },
        {
          title: "Tanggal SK",
          title2: "26-06-1965",
        },
        {
          title: "Nomor SK Perubahan Jenis Sekolah STM ke SMK",
          title2: "0561/0/1984",
        },
        {
          title: "Nomor Sk Perubahan SMT KE SMK",
          title2: "080/U/93",
        },
        {
          title: "Tanggal SK",
          title2: "27-02-1993",
        },
      ],

      akreditasis: [
        {
          title: "Pengawasan Mutu Hasil Pertanian",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
        {
          title: "Agribisnis Hasil Pertanian dan Perikanan",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
        {
          title: "Agribisnis Tanaman Pangan dan Hortikultura.",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
        {
          title: "Agribisnis Produksi Tanaman",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
        {
          title: "Agribisnis Produksi Ternak",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
        {
          title: "Agribisnis Sumberdaya Perairan",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
        {
          title: "Multimedia",
          title2: "Status Akrediktasi : A (Amat Baik) , SK No. : 02.00/204/BAP- SM/SK/XII/2015 , Tanggal SK : 10 Desember 2015",
        },
      ],

      alamats: [
        {
          title: "Jalan",
          title2: "Al - Muwahhidin",
        },
        {
          title: "Desa",
          title2: "Karangtengah        Rt.003/Rw.001      Kode Pos. 43351",
        },
        {
          title: "Kecamatan",
          title2: "Cibadak",
        },
        {
          title: "Kabupaten",
          title2: "Sukabumi",
        },
        {
          title: "Provinsi",
          title2: "Jawa Barat",
        },
        {
          title: "No. Telp",
          title2: "(0266) 532510 / Fax. (0266) 532510",
        },
        {
          title: "Email",
          title2: "Jawa Basmkn1_cibadak@yahoo.co.idrat",
        },
        {
          title: "Website",
          title2: "smkn1cibadak.sch.id",
        },
      ],

      rekenings: [
        {
          title: "No. Rekening Sekolah",
          title2: "0181-01-030461-50-3 | 0181-01-032900-50-3 | 0181-01- 000475304",
        },
        {
          title: "Bank BRI",
          title2: "BRI Cab. Cibadak / BJB Kcp Cibadak :No.Rek. 0053240941100",
        },
        {
          title: "NPWP",
          title2: "00.002.966.0-405.000",
        },
        {
          title: "Kabupaten",
          title2: "Sukabumi",
        },
        {
          title: "Provinsi",
          title2: "Jawa Barat",
        },
        {
          title: "No. Telp",
          title2: "(0266) 532510 / Fax. (0266) 532510",
        },
        {
          title: "Email",
          title2: "Jawa Basmkn1_cibadak@yahoo.co.idrat",
        },
        {
          title: "Website",
          title2: "smkn1cibadak.sch.id",
        },
      ],

      sides: [{}],
    };
  },
  mounted() {
    // Setelah komponen dimuat, tambahkan class 'active' pada elemen dengan efek animasi
    const elements = document.querySelectorAll(".fade-in, .slide-in-left, .slide-in-right, .slide-in-bottom");
    elements.forEach((el) => {
      el.classList.add("active");
    });
  },
};
</script>

<style>
/* CSS untuk efek fade-in */
.fade-in {
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

/* CSS untuk efek slide-in dari kiri */
.slide-in-left {
  transform: translateX(-100%);
  transition: transform 1s ease-in-out;
}

/* CSS untuk efek slide-in dari kanan */
.slide-in-right {
  transform: translateX(100%);
  transition: transform 1s ease-in-out;
}

/* CSS untuk efek slide-in dari bawah */
.slide-in-bottom {
  transform: translateY(100%);
  transition: transform 1s ease-in-out;
}

/* CSS untuk mengaktifkan efek fade-in atau slide-in ketika elemen muncul di layar */
.fade-in.active,
.slide-in-left.active,
.slide-in-right.active,
.slide-in-bottom.active {
  opacity: 1;
  transform: translateX(0) translateY(0);
}
</style>
