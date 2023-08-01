<template>
  <div class="container mx-auto py-20">
    pppppp
    <img class="w-full px-14" :src="gambar" alt="" />

    <main class="px-14 flex pt-4 flex-col gap-5">
      <!-- Container-->

      <article class="leading-relaxed lg:flex xl:flex gap-6">
        <!-- Content -->
        <div class="lg:w-9/12 xl:w-9/12 box-border flex flex-wrap justify-between gap-4 xl:gap-5">
          <div v-for="(item, ind) in bacaan" :key="ind">
            <p class="text-32 font-bold leading-normal">
              {{ item.h1 }}
            </p>
            <p>{{ item.title }}</p>
            <img class="w-full" :src="item.image" alt="" />
            <p>{{ item.title2 }}</p>
          </div>
        </div>

        <aside class="w-full lg:w-3/12 xl:w-3/12 pt-10 lg:pt-0 xl:pt-0">
          <!-- Aside -->
          <div class="flex flex-col gap-3 lg:px-5 xl:px-5">
            <p class="text-2xl font-bold">{{ judul.h1 }}</p>
            <div v-for="(item, index) in program" :key="index" class="flex flex-col gap-2 border-b-2 py-3">
              <a href=""> {{ item.title }} </a>
            </div>
          </div>
        </aside>
        <!-- ./Aside -->
      </article>
      <!-- ./Conten -->
    </main>
    <!-- ./Container-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      gambar: this.$settings.images + "/detailprogram.png",
      judul: {
        h1: "Program Study",
      },
      program: [
        {
          title: "Agribisnis Pengolahan Hasil Pertanian / Agriteknologi Pertanian",
        },
        {
          title: "Agribisnis Tanaman Pangan dan Holtikultura / Agribisnis Pertanian",
        },
        {
          title: "Agribisnis Ternak Ruminansia / Agribisnis Ternak",
        },
        {
          title: "Agribisnis Ternak Unggas / Agribisnis Ternak",
        },
        {
          title: "Agribisnis Perikanan Air Tawar / Agribisnis Perikanan",
        },
        {
          title: "Multimedia / Desain Komunikasi Visual",
        },
        {
          title: "Agroindustri / Agriteknologi Pertanian",
        },
      ],
      bacaan: [
        {
          h1: "Pengawasan Mutu Hasil Pertanian / Agriteknologi Pertanian",
        },
        {
          title:
            "Lörem ipsum spegt vagt att kvasiheten, än povis, kor i krosade om än geoledes huruvida kontratyp ugen gäss interaktiv skrivtavla än fönisade egovis piplande teleling. Masam saskapet om nir dekår läslov, plall digiv tragisk eller gyliga missmatchning tegirade och vårdskuld väkrologi, i taspede. Prerad tibelt tetira såsom givomat, med fickla. An regnbågskväll och plasade det vill säga nemebän fast böledes tiheten. Plabösamma polig lolaska girädade bioliga, i tirade ponde roföd i viktig. Sebepp viback symyr.",
        },
        {
          title:
            "Mikrosat lopesm igt beling men ang reans ljudaffisch best, därför att digital-tv, men pebös antropomani. Tevis sode. Krosonade ägäheten, trel ambisiv förutom telefiering: inte tesat pohast, utan begilogi, diant par i pohipesade öbelt liksom låskade, sönessade. Bröllopsklänning sar, transtiv, kåfövis. Oras satresam, polyvung då virat, nespenade om vor de polyren tivåning, i egonelingar suprasamma syfir det vill säga homossa spett sobekåvis mijånat. Debel astron miv sör, liksom nyfön ifall låvärat nigon hypohosa, i jåskade: trev rer, tijåna tredilig ojesov netesamma loginat.",
        },
        {
          title:
            "Nenas sasamma dir gähisade, makrorade snurrmästare utan vovode, nessade. Tell pressa som gyr våck, fast beslutsblindhet, intrar jag jår fredsring, poharas ävis vobening. Gyv ose sol kalsongbombare som jis lavuling: vapera för att tritism avoktigt medan hipesamma, nenar om monoktiga diabövis ygt savåning. Rosågt lör. Bäs poning autogt tiförade assade, jeda triage defiktig i tiheten, ofaska respektive sms-anställning i endiktisk. Vina avura, faktaresistens och ultrak analiga tida därför att belåsk kvasiföre.",
        },
        {
          title: "Dinade decibel och ade ivis reagyn ren inte homong skynka heterodere vade, niktig till örådisera. Megast fövusk gitengen. Tins spesortad kåvogisk och bera i nid SMS-meddelande, tel spenade fast jelödade. Per pejången.",
        },
        {
          image: this.$settings.images + "/detailprogram2.png",
        },
        {
          title2:
            "Lörem ipsum spegt vagt att kvasiheten, än povis, kor i krosade om än geoledes huruvida kontratyp ugen gäss interaktiv skrivtavla än fönisade egovis piplande teleling. Masam saskapet om nir dekår läslov, plall digiv tragisk eller gyliga missmatchning tegirade och vårdskuld väkrologi, i taspede. Prerad tibelt tetira såsom givomat, med fickla. An regnbågskväll och plasade det vill säga nemebän fast böledes tiheten. Plabösamma polig lolaska girädade bioliga, i tirade ponde roföd i viktig. Sebepp viback symyr.",
        },
        {
          title2:
            "Mikrosat lopesm igt beling men ang reans ljudaffisch best, därför att digital-tv, men pebös antropomani. Tevis sode. Krosonade ägäheten, trel ambisiv förutom telefiering: inte tesat pohast, utan begilogi, diant par i pohipesade öbelt liksom låskade, sönessade. Bröllopsklänning sar, transtiv, kåfövis. Oras satresam, polyvung då virat, nespenade om vor de polyren tivåning, i egonelingar suprasamma syfir det vill säga homossa spett sobekåvis mijånat. Debel astron miv sör, liksom nyfön ifall låvärat nigon hypohosa, i jåskade: trev rer, tijåna tredilig ojesov netesamma loginat.",
        },
      ],
    };
  },
};
</script>

<style></style>
