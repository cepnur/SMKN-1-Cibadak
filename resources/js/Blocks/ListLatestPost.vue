<template v-if="meta_data && posts">
    <section class="pt-10 lg:pt-20 pb-10 container flex flex-col gap-6">
        <div class="flex flex-col gap-2 items-center">
            <h2 class="display-2 font-bold text-darkLight ">
                {{ meta_data.title }}
            </h2>
            <p class="paragraph text-softlight">
                {{ meta_data.sub_title }}
            </p>
        </div>
        <div class="flex flex-col lg:flex-row gap-6 pt-4">
            <a :href="largePost.link" class="large-post relative w-11/12" v-if="largePost">
                <div class="absolute bottom-0 left-0 p-2 lg:p-6 z-10">
                    <h2 class="display-3 text-white font-bold">
                        {{ largePost.title }}
                    </h2>
                    <p class="paragraph text-white pt-3">
                        {{ largePost.date }}
                    </p>
                    <div class="pt-5 post-excerpt hidden lg:block" v-html="largePost.excerpt"></div>
                </div>
                <lazy-image :src="largePost.image" :alt="largePost.title" :title="largePost.title" class="w-full h-full">
                </lazy-image>
            </a>

            <div class="flex flex-col gap-6 md:w-8/12 list-posts">
                <h2 class="display-2 font-bold">Latest News</h2>
                <div v-if="listPosts" class="flex flex-col gap-5">
                    <template v-for="post in listPosts" :key="post">
                        <a :href="post.link" class="flex flex-col gap-3 item-post pb-4 transition-all duration-300 border-b border-b-[#E8E8E8] hover:shadow-lg py-2 lg:px-3">
                            <h4 class="display-4 font-bold  text-left ">{{ post.title }}</h4>
                            <div class="post-excerpt" v-html="post.excerpt"></div>
                        </a>
                    </template>
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-4 gap-6 image-list-posts" v-if="imageListPosts">
            <a :href="post.link" class="flex flex-col gap-2 item-post transition-all duration-300" v-for="post in imageListPosts" :key="post">
                <lazy-image :src="post.image" :alt="post.title" :title="post.title" class="w-full">
                </lazy-image>

                <div class="flex flex-col gap-3">
                    <h4 class="display-4 text-darkLight line-clamp-2">{{ post.title }}</h4>
                    <p class="paragraph text-[#969696]">{{ post.date }}</p>
                    <div class="post-excerpt" v-html="post.excerpt"></div>
                </div>
            </a>
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
    import LazyImage from '../Components/LazyImage.vue';
    export default {
        name: "ListLatestPosts",
        props: [
            'list_latest_posts'
        ],
        components: {
            LazyImage
        },
        data() {
            return {
                meta_data: null,
                largePost: null,
                listPosts: [],
                imageListPosts: [],
                posts: null
            };
        },
        async created() {
            if (this.list_latest_posts)
                this.meta_data = JSON.parse(this.list_latest_posts);

            await fetch(this.$settings.endpoint + '/posts/latest')
                .then((response) => response.json())
                .then((result) => (
                    this.posts = result
                ));
        },

        watch: {
            posts: {
                handler() {
                    if (this.posts.length > 0) {
                        this.largePost = this.posts.shift();
                    }

                    if (this.posts.length > 3) {
                        for (let index = 0; index < 3; index++) {
                            const post = this.posts.shift();
                            this.listPosts.push(post);
                        }
                    } else {
                        for (let index = 0; index < this.posts.length - 1; index++) {
                            const post = this.posts.shift();
                            this.listPosts.push(post);
                        }
                    }

                    if (this.posts.length > 4) {
                        for (let index = 0; index < 4; index++) {
                            const post = this.posts.shift();
                            this.imageListPosts.push(post);
                        }
                    } else {
                        for (let index = 0; index < this.posts.length - 1; index++) {
                            const post = this.posts.shift();
                            this.imageListPosts.push(post);
                        }
                    }
                }
            }
        }
    }
</script>
<style lang="scss">
    .large-post {
        @apply transition-transform duration-300 hover:shadow-lg overflow-hidden;
        &:hover img{
            @apply scale-105
        }
        .post-excerpt {
            p {
                @apply paragraph text-white;
            }
        }
        figure {
            @apply h-full;
            img {
                @apply object-cover;
            }
        }
    }

    .list-posts {
        .item-post {
            h3{
                @apply line-clamp-2;
            }
            .post-excerpt {
                
                p {
                    @apply paragraph text-softlight line-clamp-2;
                }
            }
        }
    }

    .image-list-posts{
        .item-post{
            @apply overflow-hidden;
            figure{
                @apply overflow-hidden;
            }
            &:hover img{
                @apply scale-105;
            }
            .post-excerpt {
                @apply text-[#646464] line-clamp-2;
            }
        }
    }
</style>