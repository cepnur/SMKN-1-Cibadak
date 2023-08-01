<template>
  <div class="container mx-auto py-20">
    <div class="px-5">
      <div class="flex flex-col gap-8">
        <img class="w-full" :src="gambar1" alt="" />
        <p class="text-2xl lg:text-32 xl:text-32 font-bold lg:w-3/5 xl:w-3/5">2022 Indonesia National Figure Skating Championships & Invitational Competition</p>
        <div class="flex gap-8">
          <div v-for="(item, ind) in gambar" :key="ind">
            <a href=""> <img :src="item.image" alt="" /></a>
          </div>
        </div>
        <p class="text-[#969696]">September 6, 2022</p>
      </div>
      <main class="flex pt-16 flex-col gap-5">
        <!-- Container-->

        <article class="leading-relaxed lg:flex xl:flex gap-6">
          <!-- Content -->
          <div class="lg:w-9/12 xl:w-9/12 box-border flex flex-wrap justify-between gap-4 xl:gap-5">
            <div v-for="(item, index) in items" :key="index">
              <p>
                {{ item.title }}
              </p>
            </div>
          </div>
          <aside class="lg:w-3/12 xl:w-3/12 pt-5 lg:pt-0 xl:pt-0">
            <!-- Aside -->
            <div class="flex flex-col gap-3 bg-[] lg:px-5 xl:px-5">
              <p class="text-2xl font-bold">Latest News</p>
              <div v-for="(item, ind) in sides" :key="ind">
                <a href="" class="flex flex-col gap-2 border-b-2 py-3">
                  <p class="text-sm font-bold">{{ item.title }}</p>
                  <p class="text-sm text-[#969696]">{{ item.sub }}</p>
                </a>
              </div>
            </div>
          </aside>
          <!-- ./Aside -->
        </article>
        <!-- ./Conten -->
      </main>
      <!-- ./Container-->
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      gambar1: this.$settings.images + "/detailnews.jpg",
      gambar: [
        {
          image: this.$settings.images + "/ig.svg",
        },
        {
          image: this.$settings.images + "/twitter.svg",
        },
        {
          image: this.$settings.images + "/fb.svg",
        },
        {
          image: this.$settings.images + "/link.svg",
        },
      ],
      items: [
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
      ],

      sides: [
        {
          title: "Besic of UI/UX Design With Mangcoding",
          sub: "September 14, 2022",
        },
        {
          title: "Besic of JavaScript With Mangcoding",
          sub: "September 14, 2022",
        },
        {
          title: "Besic of HTML CSS With Mangcoding",
          sub: "September 14, 2022",
        },
        {
          title: "Besic of PHP With Mangcoding",
          sub: "September 14, 2022",
        },
        {
          title: "Besic of Laavel  With Mangcoding",
          sub: "September 14, 2022",
        },
      ],
    };
  },
};
</script>

<style></style>
