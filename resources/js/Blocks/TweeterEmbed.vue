<template v-if="meta_data">
    <section class="container mx-auto flex flex-col gap-2 lg:gap-8 py-10 lg:py-20">
        <div class="flex flex-col items-center gap-3">
            <h2 class="font-bold display-2">{{ meta_data.title }}</h2>
            <p class="paragraph text-softlight">{{ meta_data.sub_title }}</p>
        </div>
        <div class="flex flex-col lg:flex-row gap-y-6 lg:gap-y-0 justify-between">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:w-[60%]">
                <template v-if="posts.length > 0">
                    <lazy-image v-for="image in posts" :key="image.id" :src="image.post_thumbnail" :alt="image.title"
                        :title="image.title" class="w-full max-h-[281px]" className="object-cover object-center w-full">
                    </lazy-image>
                </template>
            </div>
            <Tweet :tweet-id="meta_data.tweeter_id !== '' ? meta_data.tweeter_id : '692527862369357824'"
                cards="visible" conversation="all" lang="id" theme="dark" align="left" :dnt="false"
                @tweet-load-error="onTweetLoadError" @tweet-load-success="onTweetLoadSuccess">
                <template v-slot:loading>
                    <span>Loading...</span>
                </template>

                <template v-slot:error>
                    <span>Sorry, that tweet doesn’t exist!</span>
                </template>
            </Tweet>
        </div>
        <div class=" flex justify-center items-center pt-4" v-if="meta_data.more">
            <a :href="meta_data.more.url" :target="meta_data.more.target"
                class="bg-[#005046] rounded-xl py-3 px-4 text-sm text-white hover:bg-green-800 hover:text-white min-w-[100px] text-center">
                {{ meta_data.more.title != '' ? meta_data.more.title : 'More' }}
            </a>
        </div>
    </section>
</template>
<script>
    export default {
        name: "TweeterEmbed",
        props: [
            'embed_tweeter'
        ],
        data() {
            return {
                meta_data: null,
                posts: []
            }
        },
        created() {
            if (this.embed_tweeter)
                this.meta_data = JSON.parse(this.embed_tweeter);

            this.$api.Posts.latestGalleries().then((result)=>{
                if (result.status == 200) {
                    this.posts.push(...result.data.posts);
                }
            })
        },
        methods: {
            onTweetLoadSuccess(embedNode) {
                // console.log(embedNode)
            },

            onTweetLoadError() {
                // console.log("Ops... an error has occurred")
            }
        },
    }
</script>
<style lang="scss">
    .twitter-tweet.twitter-tweet-rendered {
        float: none !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        max-width: unset !important;
    }
</style>