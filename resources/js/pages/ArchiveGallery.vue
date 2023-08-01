<template>
    <Transition :duration="550">
    <div class="archive-gallery" v-if="posts">
        <vue-easy-lightbox
            scrollDisabled
            escDisabled
            moveDisabled
            :visible="visibleLightbox"
            :imgs="imgsLightbox"
            :index="indexLightbox"
            @hide="handleHide"
            ></vue-easy-lightbox>

        <Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>

        <div class="filter-wrapper mb-10 relative" v-click-outside="closeFilter">
            <button class="btn-filter bg-[#FAFAFA] py-4 px-6 inline-flex border border-[#F6F6F6] rounded-full" @click="showFilter = !showFilter">
                <p class="paragraph text-primary font-bold min-w-[120px] text-start">Filter</p>
                <svg-vue icon="filter-icon" alt="logo" aria-label="logo" class="icon" width="20px" height="20px">
                </svg-vue>
            </button>
            <div class="filter-list absolute p-6 bg-white rounded-lg shadow-lg md:w-[315px]" :class="showFilter === true ? ' active' : ''"
            >
                <div class="filter-header flex justify-between mb-6">
                    <p class="paragrapah font-bold font-base text-darkLight">
                        Filter
                    </p>

                    <button class="paragraph text-primary border-b border-b-transparent 
                        transition-all duration-300 hover:border-b-primary"
                        @click="checkedCategory = []">
                        Clear All
                    </button>
                </div>
                <p class="paragraph text-darkLight pb-4">Categories</p>

                <div class="filter-item flex gap-2 pb-4" v-for="item in category" :key="item">
                    <input type="checkbox" name="" :id="item.slug" :value="item.slug" v-model="checkedCategory">
                    <label :for="item.slug" class="paragraph-2 text-primary">{{ item.name }}</label>
                </div>
            </div>
        </div>

        <div class="gallery-list grid grid-cols-1 lg:grid-cols-3 gap-6">
            <button v-for="(post, index) in posts" :key="index" class="transition-all hover:scale-110 hover:shadow-sm"
            @click="showSingle(post)">
                <div class="relative">
                    <p class="absolute bottom-0 left-0 transform z-10 -translate-y-full translate-x-4 font-bold text-xs lg:text-base text-white  ">{{ post.title }}</p>
                    <LazyImage
                        :src="post.post_thumbnail" 
                        :alt="post.title" 
                        :className="'w-full max-h-[240px] object-cover object-center rounded-xl'"></LazyImage>
                </div>
            </button>
        </div>

        <div class=" flex justify-center items-center pt-10" v-if="has_next_page">
            <button @click="loadfetchPostGalleryPosts"
                class="bg-[#005046] rounded-xl py-3 px-4 text-sm text-white
                hover:bg-green-800 hover:text-white min-w-[100px] text-center">
                View More
            </button>
        </div>
    </div>
    </Transition>
    
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
export default {
    name: "ArchiveGallery",
    props: [
        'galleries', 'pagination', 'category'
    ],
    components:{
        Loading
    },
    data() {
        return {
            isLoading : false,
            currentPage: 1,
            has_next_page: false,
            posts: [],
            imgsLightbox: [],
            visibleLightbox: false,
            indexLightbox: 0,
            checkedCategory: [],
            showFilter: false
        }
    },
    mounted() {
        this.isLoading = false;
        this.currentPage = this.pagination.current_page ?? 0;
        this.has_next_page = this.pagination.has_next_page ?? false;
        this.posts = this.galleries ?? []
    },

    methods: {
        showSingle(n) {
            let v = { 
                src: n.post_thumbnail, 
                title: n.title 
                }
            this. imgsLightbox[this.indexLightbox] = v;
            this.show()
        },
        show() {
            this.visibleLightbox = true
        },
        handleHide() {
            this.visibleLightbox = false
        },
        closeFilter(){
            this.showFilter = false
        },
        loadfetchPostGalleryPosts(){
            this.isLoading = true;
            let formData = {
                paged: this.currentPage + 1,
                term: this.checkedCategory
            };
            this.$api.Posts.fetchPostGalleries(formData).then((result)=>{
                this.isLoading = false;
                if (result.status == 200) {
                    this.posts.push(...result.data.posts); 
                    this.currentPage = result.data.pagination.current_page ?? 1;
                    this.has_next_page = result.data.pagination.next_page
                }
            })
        }
    },
    watch:{
        checkedCategory:{
            handler() {
                if (this.checkedCategory) {
                    this.currentPage = 0;
                    this.posts = [];
                    this.loadfetchPostGalleryPosts();
                }
            }
        }
    }
}
</script>
<style lang="scss">
    .v-enter-active,
    .v-leave-active {
        transition: opacity 5s ease;
    }

    .v-enter-from,
    .v-leave-to {
    opacity: 0;
    }

    .vel-img-title{
        font-size: 16px !important;
        color: white !important;
    }

    .filter-wrapper {
        button.btn-filter{
            &:hover{
                @apply bg-primary border-primary;
                p {
                    @apply text-white;
                }
            }
        }
    }

    .filter-list {
        @apply -z-10 opacity-0 max-h-0 transition-all duration-500;
        &.active{
            @apply z-10 opacity-100 max-h-[1000px];
        }
    }
</style>