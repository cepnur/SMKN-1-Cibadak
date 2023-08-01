<template>
    <section v-if="meta_data" class="container mx-auto flex flex-col items-center pt-20 pb-20 gap-6">
            <img v-if="meta_data.image" :src="meta_data.image.url" alt="" class="items-center order-0">
            <div class="flex flex-col items-center gap-10 order-1">
                <div class="w-full md:w-3/4 lg:w-2/3 flex flex-col items-center gap-3">
                    <h2 class="display-2 font-bold text-darkLight">
                    {{ meta_data.title }}
                    </h2>
                    <p class="paragraph text-softlight">
                    {{ meta_data.description }}
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" v-if="meta_data.lists">
                    <div v-for="service in meta_data.lists" :key="service"
                        class="bg-white hover:drop-shadow-md border rounded-lg px-6 py-6 text-left
                            flex flex-col gap-6">
                        <img v-if="service.icon" :src="service.icon.url" alt="" width="52" height="40">
                        <div class="flex flex-col gap-4">
                            <h3 class="display-3 font-bold text-darkLight">
                            {{ service.title }}
                        </h3>
                        <p class="paragraph text-softlight">
                            {{ service.description }}
                        </p>
                        <a :href="service.url.url" :target="service.url.target" 
                        class="font-bold text-[#005046] paragraph pt-4 flex gap-2 items-center">
                            More Information <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 leading-6 ">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>  
                        </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</template>
<script>
export default {
    name: "ListCardService",
    props: [
        'list_card_service'
    ],
    components: { },
    data() {
        return {
            meta_data: null,
        };
    },
    created() {
        if (this.list_card_service)
            this.meta_data = JSON.parse(this.list_card_service);
    },
}
</script>
<style lang="scss">
    
</style>