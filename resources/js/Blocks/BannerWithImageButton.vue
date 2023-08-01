<template v-if="meta_data">
    <section class=" py-10 bg-[#F2F6F6]">
        <div class="container mx-auto flex flex-col md:flex-row items-center w-full gap-6">
            <LazyImage v-if="meta_data.image" :src="meta_data.image.url" 
                :alt="meta_data.heading" :title="meta_data.heading" class="w-full lg:w-1/2" className="object-contain w-full" />
            <div class="flex flex-col items-start gap-5 w-full lg:w-1/2">
                <div class="flex flex-col gap-3">
                    <p class="paragraph text-primary">
                        {{ meta_data.chips_label }}
                    </p>
                    <h2 class="display-2 font-bold text-darkLight lg:mb-4">
                         {{ meta_data.heading }}
                    </h2>
                    <p class="paragraph font-normal text-softlight lg:mb-6">
                        {{ meta_data.sub_heading }}
                    </p>
                    <div v-if="meta_data.link_label">
                        <template v-for="link in meta_data.link_label" :key="link">
                            <a :href="link.url.url" :target="link.url.target" class="font-bold paragraph text-primary inline-flex gap-3 items-center mb-4">
                            {{ link.url.title }}
                            <svg class="ml-3" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.39516 6.12798L8.13109 6.39026C8.04931 6.47253 8.00341 6.5838 8.00341 6.69979C8.00341 6.81578 8.04931 6.92706 8.13109 7.00932L11.1207 9.9984L8.12767 12.9904C8.0459 13.0727 8 13.184 8 13.2999C8 13.4159 8.0459 13.5272 8.12767 13.6095L8.38996 13.8724C8.47221 13.9541 8.58346 14 8.69941 14C8.81536 14 8.9266 13.9541 9.00885 13.8724L12.5851 10.3092C12.6674 10.2269 12.7255 10.1171 12.7255 9.99889V9.99743C12.7255 9.88019 12.6674 9.76977 12.5851 9.68847L9.01861 6.12798C8.93539 6.04566 8.82296 5.99965 8.70591 6C8.64824 5.9998 8.59109 6.01101 8.53776 6.03297C8.48443 6.05493 8.43597 6.08722 8.39516 6.12798Z"
                                    fill="#005046" />
                            </svg>
                        </a>
                        </template>
                    </div>
                </div>

                <div v-if="meta_data.link_button" class="flex gap-4">
                    <a class="transition-shadow duration-200 hover:shadow-lg" 
                        v-for="imgButton in meta_data.link_button" :key="imgButton" :href="imgButton.url.url" :target="imgButton.url.target">
                        <img :src="imgButton.image_button.url">
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        name: "BannerWithImageButton",
        props: [
            'banner_with_image_button'
        ],
        components: {},
        data() {
            return {
                meta_data: null,
            };
        },
        created() {
            if (this.banner_with_image_button)
                this.meta_data = JSON.parse(this.banner_with_image_button);
        },
    }
</script>
<style lang="scss">

</style>