<template>
  <div>
    <Hero :title="title" :subtitle="subtitle" />
  </div>

  <div class="container py-20 mx-auto">
    <div class="px-5">
      <form action="/save" class="gap-6 lg:flex xl:flex">
        <div class="flex flex-col w-full gap-3">
          <p class="font-bold">Your Name {{ message }}</p>
          <input class="px-3 py-3 border" type="text" v-model="message" placeholder="your name" />

          <p class="font-bold">Subject {{ message }}</p>
          <input class="px-3 py-3 border" type="text" v-model="message" placeholder="subject" />

          <p class="font-bold">Message {{ message }}</p>
          <textarea v-model="message" placeholder="let's tell us your problem" class="border px-3 py-3" name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="flex flex-col w-full gap-3 pt-4 lg:pt-0 xl:pt-0">
          <p class="font-bold">Your Email {{ email }}</p>
          <input type="email" v-model="email" placeholder="your email" class="border p-3" />

          <p class="font-bold">Phone {{ number }}</p>
          <input type="number" v-model="number" placeholder="+62" class="border p-3" />
          <div class="lg:flex xl:flex lg:justify-between xl:justify-between md:justify-between pt-2 gap-6">
            <div class="flex flex-col gap-3 lg:w-2/5 xl:w-2/5">
              <p class="font-bold">Alamat</p>
              <div class="flex gap-3">
                <img :src="this.$settings.images + '/lokasi.svg'" alt="" />
                <p class="text-sm">Jl. Al-Muwahhiddin, Karangtengah, Cibadak, Kab. Sukabumi. Sukabumi 43351</p>
              </div>
            </div>
            <div class="flex flex-col pt-5 lg:pt-0 xl:pt-0 gap-3">
              <p class="font-bold">Kontak</p>
              <div class="flex gap-3">
                <img :src="this.$settings.images + '/cell.svg'" alt="" />
                <p class="text-sm">(0266) 532510</p>
              </div>
              <div class="flex gap-3">
                <img :src="this.$settings.images + '/email.svg'" alt="" />
                <p class="text-sm">smkn1_cibadak@yahoo.co.id</p>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="flex pt-8 left-38">
        <button class="py-3 px-5 lg:py-4 xl:py-4 lg:px-6 xl:px-6 hover:bg-[#032626] bg-[#0DC0C0] rounded-2xl text-white" @click="pesan('Pesan Anda Terkirim')">Send Message</button>
      </div>
    </div>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15843.88593579355!2d106.8149959!3d-6.8940143!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e683135863873e5%3A0xf4c7ee13f4d622ad!2sSMK%20NEGERI%201%20CIBADAK!5e0!3m2!1sid!2sid!4v1684827131728!5m2!1sid!2sid"
      class="w-full h-545 px-5 pt-10"
      style="border: 0"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
  </div>
</template>

<script>
export default {
  setup() {
    return {
      title: "Contact Us",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
    };
  },
  methods: {
    pesan(pesanin) {
      alert(pesanin);
    },
  },
};
</script>

<style></style>
