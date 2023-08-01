<template v-if="meta_data">
    <section class="list-partner container flex flex-col items-center gap-5 lg:gap-10 pt-8 pb-12 lg:pt-16 lg:pb-32">
        <div class="section-title flex flex-col gap-3 items-center">
            <h2 class="display-2 font-bold text-darkLight text-center">
                {{ meta_data.title }}
            </h2>
            <p class="paragraph text-softlight text-center">
                {{ meta_data.subtitle }}
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4" v-if="meta_data.list">
            <a v-for="partner in meta_data.list" :key="partner"
                class="partner-item flex flex-col gap-4 items-center py-8 border border-[#EAEAEA] rounded-xl"
                :href="partner.website.url"
                :target="partner.website.target">
                <img v-if="partner.image" :src="partner.image.url" loading="lazy" :alt="partner.image.title" :title="partner.image.title" class="max-h-[64px] object-cover">
                <h4 class="display-4 font-bold text-center">{{ partner.label }}</h4>
            </a>
        </div>
    </section>
</template>
<script>
export default {
    name: "ListPartner",
        props: [
            'list_partner'
        ],
        data() {
            return {
                meta_data: null,
            }
        },
        created() {
            if (this.list_partner)
                this.meta_data = JSON.parse(this.list_partner);
        },
}
</script>
<style lang="scss">
    
</style>