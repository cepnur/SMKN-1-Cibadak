<template v-if="meta_data">
    <Carousel class="hero-slider-with-image-button">
        <Slide v-for="slide in meta_data" :key="slide">
            <div class="carousel__item relative w-full">
                <LazyImage v-if="slide.image_cover" :src=" slide.image_cover ? slide.image_cover.url : $settings.images + '/hero-default.jpg' " 
                :alt=" slide.image_cover.title ? slide.image_cover.title : 'Hero' " 
                height="680px" class="w-full"
                    className="object-contain w-full" />
                <div class="container">
                    <div class="hero-content absolute top-8 md:top-1/2 transform md:-translate-y-1/2 z-10 text-left w-[80%] lg:w-[60%]">
                        <h3 class="paragraph text-white" v-html="slide.image_content.chips_label"></h3>
                        <h1 class="display-1 text-white pb-6" v-html="slide.image_content.heading"></h1>
                        <h2 class="hidden lg:block paragraph text-white pb-8" v-html="slide.image_content.sub_heading"></h2>
                        <template v-if="slide.image_button">
                            <div class="hidden md:flex gap-6">
                                <a class="transition-shadow duration-200 hover:shadow-lg" 
                                    v-for="imgButton in slide.image_button" :key="imgButton" :href="imgButton.url.url" :target="imgButton.url.target">
                                    <img :src="imgButton.image.url">
                                </a>
                                
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </Slide>

        <template #addons>
            <Pagination />
        </template>
    </Carousel>
</template>

<script>
    import { Carousel, Navigation, Slide, Pagination } from "vue3-carousel";
    import "vue3-carousel/dist/carousel.css";
    import LazyImage from '../Components/LazyImage.vue'
    export default {
        name: "HeroSliderWithImageButton",
        props: [
            'hero_slider_with_image_button'
        ],
        components: {
            Pagination,
            Carousel,
            LazyImage,
            Slide,
            Navigation,
        },
        data() {
            return {
                meta_data: null,
                settings: {
                    itemsToShow: 1,
                    snapAlign: "center",
                },
            };
        },
        created() {
            if (this.hero_slider_with_image_button)
                this.meta_data = JSON.parse(this.hero_slider_with_image_button);
        },
    }
</script>

<style lang="scss">
    .hero-slider-with-image-button{
        @apply relative;
        .carousel__pagination{
            @apply absolute bottom-3 lg:bottom-8 mt-0 left-1/2 transform -translate-x-1/2;
        }
        .carousel__pagination-button::after{
            @apply w-[6px] h-[6px] rounded-full bg-white/50;
        }
        .carousel__pagination-button:hover::after, .carousel__pagination-button--active::after{
            @apply bg-white;
        }
    }
</style>