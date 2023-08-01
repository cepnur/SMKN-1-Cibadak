<template>
  <div class="flex flex-col">
    <p class="font-bold paragraph text-[#001F22]">Get in touch</p>
    <div class="sm:col-span-2 col-span-3">
      <div class="flex flex-col gap-4 mt-6 space-y-1">
        <div class="contact-email flex gap-4">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M4.21046 5H19.7895C21.2593 5 22 5.68833 22 7.08833V16.9117C22 18.3 21.2593 19 19.7895 19H4.21046C2.74074 19 2 18.3 2 16.9117V7.08833C2 5.68833 2.74074 5 4.21046 5ZM11.9941 15.0333L19.9189 8.58167C20.2011 8.34833 20.4245 7.81167 20.0717 7.33333C19.7307 6.855 19.1076 6.84333 18.6961 7.135L11.9941 11.6383L5.30394 7.135C4.89242 6.84333 4.26925 6.855 3.92828 7.33333C3.57554 7.81167 3.79894 8.34833 4.08113 8.58167L11.9941 15.0333Z"
              fill="#005046"
            />
          </svg>
          <a :href="'mailto:' + $settings.contact_us_setting.email" class="paragraph-2 font-normal text-softlight">{{ $settings.contact_us_setting.email }}</a>
        </div>
        <div class="contact-phone flex gap-4">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_129_1010)">
              <path
                d="M20.7563 5.39531L18.2602 2.90156C18.0841 2.72471 17.8748 2.58439 17.6443 2.48867C17.4139 2.39294 17.1667 2.34369 16.9172 2.34375C16.4086 2.34375 15.9305 2.54297 15.5719 2.90156L12.8859 5.5875C12.7091 5.76358 12.5688 5.97286 12.473 6.20333C12.3773 6.4338 12.3281 6.68091 12.3281 6.93047C12.3281 7.43906 12.5273 7.91719 12.8859 8.27578L14.85 10.2398C14.3903 11.2532 13.7511 12.175 12.9633 12.9609C12.1775 13.7506 11.2557 14.3922 10.2422 14.8547L8.27813 12.8906C8.10205 12.7138 7.89277 12.5735 7.6623 12.4777C7.43183 12.382 7.18472 12.3328 6.93516 12.3328C6.42656 12.3328 5.94844 12.532 5.58985 12.8906L2.90156 15.5742C2.7245 15.7506 2.58406 15.9603 2.48832 16.1912C2.39259 16.4221 2.34346 16.6696 2.34375 16.9195C2.34375 17.4281 2.54297 17.9062 2.90156 18.2648L5.39297 20.7562C5.96485 21.3305 6.75469 21.6562 7.56563 21.6562C7.73672 21.6562 7.90078 21.6422 8.0625 21.6141C11.2219 21.0938 14.3555 19.4133 16.8844 16.8867C19.4109 14.3625 21.0891 11.2312 21.6164 8.0625C21.7758 7.09453 21.4547 6.09844 20.7563 5.39531Z"
                fill="#005046"
              />
            </g>
            <defs>
              <clipPath id="clip0_129_1010">
                <rect width="24" height="24" fill="white" />
              </clipPath>
            </defs>
          </svg>
          <p class="paragraph-2 font-normal text-softlight">{{ $settings.contact_us_setting.phone }}</p>
        </div>
        <div class="contact-address flex gap-4">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_129_1015)">
              <path
                d="M12 2C10.3424 2 8.75269 2.65848 7.58058 3.83058C6.40848 5.00269 5.75 6.5924 5.75 8.25C5.75 14.5 12 22 12 22C12 22 18.25 14.5 18.25 8.25C18.25 6.5924 17.5915 5.00269 16.4194 3.83058C15.2473 2.65848 13.6576 2 12 2V2ZM12 12C11.0054 12 10.0516 11.6049 9.34835 10.9017C8.64509 10.1984 8.25 9.24456 8.25 8.25C8.25 7.25544 8.64509 6.30161 9.34835 5.59835C10.0516 4.89509 11.0054 4.5 12 4.5C12.9946 4.5 13.9484 4.89509 14.6517 5.59835C15.3549 6.30161 15.75 7.25544 15.75 8.25C15.75 9.24456 15.3549 10.1984 14.6517 10.9017C13.9484 11.6049 12.9946 12 12 12Z"
                fill="#005046"
              />
            </g>
            <defs>
              <clipPath id="clip0_129_1015">
                <rect width="20" height="20" fill="white" transform="translate(2 2)" />
              </clipPath>
            </defs>
          </svg>

          <p class="paragraph-2 font-normal text-softlight" v-html="$settings.contact_us_setting.address"></p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ContactInfo",
  created() {},
};
</script>
<style lang="scss">
.contact-wrapper {
  @apply gap-8 lg:gap-20;
}
</style>
