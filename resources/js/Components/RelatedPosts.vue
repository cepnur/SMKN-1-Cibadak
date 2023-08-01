<template>
    <div  class="container">
        <h3 class="display-4">RELATED POSTS</h3>
        <div class="mt-6 grid md:grid-cols-4 gap-6 image-list-posts" v-if="posts && posts.relatedPosts">
            <a :href="post.link" class="flex flex-col gap-2 item-post transition-all duration-300" v-for="post in posts.relatedPosts" :key="post">
                <lazy-image :src="post.image" :alt="post.title" :title="post.title" class="w-full">
                </lazy-image>

                <div class="flex flex-col gap-3">
                    <h4 class="display-4 text-darkLight line-clamp-2">{{ post.name }}</h4>
                    <p class="paragraph text-[#969696]">{{ post.date }}</p>
                    <div class="post-excerpt line-clamp-2" v-html="post.excerpt"></div>
                </div>
            </a>
        </div>
    </div>
</template>
<script>
export default {
    props:['posts'],
    name: "RelatedPosts"
}
</script>
<style lang="scss" scoped>
    
</style>