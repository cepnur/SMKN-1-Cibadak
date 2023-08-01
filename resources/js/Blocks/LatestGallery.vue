<template v-if="meta_data">
    <section class="flex flex-col gap-2 lg:gap-8">
        <div class="flex flex-col items-center gap-3">
            <h2 class="font-bold display-2">{{ meta_data.title }}</h2>
            <p class="paragraph text-softlight">{{ meta_data.sub_title }}</p>
        </div>
        <div class="flex flex-col lg:flex-row gap-y-6 lg:gap-y-0 justify-between">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                <template v-if="posts.length > 0">
                    <lazy-image v-for="image in posts" :key="image.id" :src="image.post_thumbnail" :alt="image.title"
                        :title="image.title" class="w-full max-h-[275px]" className="object-cover object-center w-full">
                    </lazy-image>
                </template>
            </div>
        </div>
        <template v-if="meta_data.more">
           <a :href="meta_data.more.url" :target="meta_data.more.target"
                class="more-button bg-[#005046] rounded-xl py-3 px-4 text-sm text-white hover:bg-green-800 hover:text-white min-w-[100px] text-center">
                {{ meta_data.more.title != '' ? meta_data.more.title : 'More' }}
            </a>
        </template>
        
    </section>
</template>
<script>
    export default {
        name: "LatestGallery",
        props: [
            'latest_gallery'
        ],
        data() {
            return {
                meta_data: null,
                posts: []
            }
        },
        created() {
            if (this.latest_gallery)
                this.meta_data = JSON.parse(this.latest_gallery);

            this.$api.Posts.latestGalleries().then((result)=>{
                if (result.status == 200) {
                    this.posts.push(...result.data.posts);
                }
            })
        },
    }
</script>
<style lang="scss">
    
</style>