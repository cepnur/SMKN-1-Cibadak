<template lang="">
  <Loading
    v-model:active="isLoading"
    :can-cancel="false"
    :is-full-page="true"
  />

  <div>
    <form action="#" method="post">
      <div class="grid grid-cols-2 gap-x-3 gap-y-4">
        <div class="flex flex-col gap-3">
          <label class="text-gray-700 text-xs font-bold dark:text-lable w-full">
            First Name
            <sup class="text-red-500">*</sup>
          </label>
          <div>
            <input
              required="required"
              type="text"
              placeholder="Your Name"
              v-model="first_name"
              class="w-full block mt-1 rounded-md text-sm border-input-border focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-600 dark:focus:shadow-outline-gray form-input disabled:bg-gray-200"
            />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label class="text-gray-700 text-xs font-bold dark:text-lable w-full">
            Last Name
            <sup class="text-red-500">*</sup>
          </label>
          <div>
            <input
              required="required"
              type="text"
              v-model="last_name"
              placeholder="Your Name"
              class="w-full block mt-1 rounded-md text-sm border-input-border focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-600 dark:focus:shadow-outline-gray form-input disabled:bg-gray-200"
            />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label class="text-gray-700 text-xs font-bold dark:text-lable w-full">
            Email
            <sup class="text-red-500">*</sup>
          </label>
          <div>
            <input
              required="required"
              type="email"
              v-model="email"
              placeholder="Your Email"
              class="w-full block mt-1 rounded-md text-sm border-input-border focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-600 dark:focus:shadow-outline-gray form-input disabled:bg-gray-200"
            />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label class="text-gray-700 text-xs font-bold dark:text-lable w-full">
            No.Telp
            <sup class="text-red-500">*</sup>
          </label>
          <div>
            <input
              required="required"
              type="text"
              v-model="phone_number"
              placeholder="No.Telp"
              class="w-full block mt-1 rounded-md text-sm border-input-border focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-600 dark:focus:shadow-outline-gray form-input disabled:bg-gray-200"
            />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label class="text-gray-700 text-xs font-bold dark:text-lable w-full">
            NIK
            <sup class="text-red-500">*</sup>
          </label>
          <div>
            <input
              required="required"
              type="text"
              v-model="nik"
              placeholder="1111111111111111"
              class="w-full block mt-1 rounded-md text-sm border-input-border focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-600 dark:focus:shadow-outline-gray form-input disabled:bg-gray-200"
            />
          </div>
        </div>
      </div>
      <div class="flex justify-end py-6">
        <button
          @click="handleUpdateProfile"
          class="lg:inline-flex btn btn-primary"
        >
          Save Change
        </button>
      </div>

      <div v-if="message != ''" class="mx-auto py-5 w-full">
        <div class="text-center text-white capitalize py-5 rounded" :class="validForm ? 'bg-blue-500' : 'bg-red-500'">
          {{ message }}
        </div>
      </div>
      <slot name="security"></slot>
    </form>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/css/index.css";
export default {
  data() {
    return {
      eyePassword: "/eye.png",
      eyeRetypePassword: "/eye.png",
      isLoading: false,
      message: "",
      validForm: false,
      first_name: "",
      last_name: "",
      email: "",
      phone_number: "",
      nik: ""
    };
  },
  components:{
    Loading
  },
  mounted() {
    this.first_name= this.$settings.loginStatus.userMeta.first_name[0],
    this.last_name= this.$settings.loginStatus.userMeta.last_name[0],
    this.email= this.$settings.loginStatus.currentUser.data.user_email,
    this.phone_number= this.$settings.loginStatus.userMeta.user_phone_number[0]
    this.nik= this.$settings.loginStatus.userMeta.user_nik[0]
  },
  methods: {
    handleUpdateProfile(e) {
      e.preventDefault();
      this.isLoading = true;

      if(this.first_name == ''){
        this.message = 'First Name Required'
        return;
      }

      if(this.last_name == ''){
        this.message = 'Last Name Required'
        return;
      }

      if(this.email == ''){
        this.message = 'Email Required'
        return;
      }

      if(this.phone_number == ''){
        this.message = 'Phone Number Required'
        return;
      }

      if(this.nik == ''){
        this.message = 'NIK Required'
        return;
      }
      
      let formData = {
        first_name: this.first_name,
        last_name: this.last_name,
        email: this.email,
        phone_number: this.phone_number,
        nik: this.nik
      };

      this.$api.Users.updateProfile(formData).then(({ data }) => {
        this.isLoading = false;
        this.validForm = data.status;
        this.message = data.message;
        setTimeout(() => {
          this.message = "Berhasil";
        }, 3000);
        return;
      });
    },
  },
};
</script>
<style lang="css">
.input-eye {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-40%);
}
</style>
