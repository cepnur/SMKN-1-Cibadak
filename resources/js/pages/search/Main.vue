<template>

    <main class="search-page container flex flex-col lg:flex-row pt-10 lg:pt-20 pb-10 lg:pb-32 gap-5 lg:gap-14">
        <Loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="true"/>
        <sidebar class="w-full lg:w-1/3" :s="keywords" 
            @updateKeyword="((value) => s = value)" 
            :activeTerm="category_name" 
            :terms="terms" 
            @selectedTerms="selectedTerms"
            @submitedSearch="fechingSearch"></sidebar>
        <div class="search-list w-full lg:w-2/3">
            <div class="search-tools flex flex-col lg:flex-row justify-end gap-4 lg:gap-8">
                <div class="flex gap-4 items-center justify-between">
                    <label for="" class="semi-bold lg:font-bold lg:text-base text-xs ">Show</label>
                    <select name="" id=""
                        v-model="per_page"
                        class="bg-white py-2 px-6 border-2 rounded-xl lg:text-base text-xs text-[#005046] semi-bold lg:font-bold items-center "
                        @change="fechingSearch">
                        <option :value="opt" class="" v-for="opt in perpageSetting" :key="opt">{{opt}} Result per page</option>
                    </select>
                </div>
                <div class="flex gap-4 items-center justify-between">
                    <label for="" class="semi-bold lg:font-bold lg:text-base text-xs">Ordering</label>
                    <select name="" id=""
                        v-model="order"
                        class="bg-white py-2 px-6 border-2 rounded-xl lg:text-base text-xs text-[#005046] semi-bold lg:font-bold"
                        @change="fechingSearch">
                        <option :value="order" class="" v-for="order in orderingSetting" :key="order">{{order}}</option>
                    </select>
                </div>
                <div class="flex gap-4">
                    <button class="btn-layout " @click="listLayout = 'grid'" :class="listLayout === 'grid' ? 'btn-layout__show' : ''">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="8" y="8" width="10" height="10" rx="2" fill="white" stroke="#E6E6E6"
                                stroke-width="1.5" />
                            <rect x="8" y="22" width="10" height="10" rx="2" fill="white" stroke="#E6E6E6"
                                stroke-width="1.5" />
                            <rect x="22" y="8" width="10" height="10" rx="2" fill="white" stroke="#E6E6E6"
                                stroke-width="1.5" />
                            <rect x="22" y="22" width="10" height="10" rx="2" fill="white" stroke="#E6E6E6"
                                stroke-width="1.5" />
                        </svg>

                    </button>
                    <button class="btn-layout " @click="listLayout = 'list'" :class="listLayout === 'list' ? 'btn-layout__show' : ''">
                        <svg class="w-4 h-4 lg:h-8 lg:w-8" viewBox="0 0 24 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.6667 16H13.3333C14.0667 16 14.6667 15.4 14.6667 14.6667C14.6667 13.9333 14.0667 13.3333 13.3333 13.3333H10.6667C9.93333 13.3333 9.33333 13.9333 9.33333 14.6667C9.33333 15.4 9.93333 16 10.6667 16ZM0 1.33333C0 2.06667 0.6 2.66667 1.33333 2.66667H22.6667C23.4 2.66667 24 2.06667 24 1.33333C24 0.6 23.4 0 22.6667 0H1.33333C0.6 0 0 0.6 0 1.33333ZM5.33333 9.33333H18.6667C19.4 9.33333 20 8.73333 20 8C20 7.26667 19.4 6.66667 18.6667 6.66667H5.33333C4.6 6.66667 4 7.26667 4 8C4 8.73333 4.6 9.33333 5.33333 9.33333Z"
                                fill="#E6E6E6" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="search-list " :class="'search-list__'+listLayout" v-if="postList.length > 0">
                <transition-group name="fade" :duration="500">
                    <a href="" class="search-item" v-for="post in postList" :key="post">
                        <article class="card-item " :class="listLayout === 'grid' ? 'card-item__vertical' : 'card-item__horizontal shadow'">
                            <LazyImage
                                :src="this.$images + '/no-image.png'" 
                                :alt="'Biaya Keimigrasian'" 
                                class="overflow-hidden"
                                :className="'w-full max-h-[231px] object-cover object-center rounded-xl'"></LazyImage>
                                <div class="flex flex-col gap-1 lg:gap-3">
                                    <h3 class="font-bold text-sm md:text-2xl text-left line-clamp-2">{{ post.title }}</h3>
                                    <p class="text-gray-400 text-xs md:text-sm lg:text-base ">{{ post.date }}</p>
                                    <div class="exerpt line-clamp-2" v-html="post.excerpt"></div>
                                </div>
                        </article>
                    </a>
                </transition-group>
            </div>

            <div v-else>
                <p class="text-gray-400 text-xs md:text-sm lg:text-base font-bold" v-if="isLoading == false">No Post Found</p>
            </div>

            <div class=" flex justify-center items-center mt-5" v-if="has_next_page & isLoading == false">
                <button 
                    class="bg-[#005046] rounded-xl py-3 px-4 text-sm text-white
                    hover:bg-green-800 hover:text-white min-w-[100px] text-center"
                    @click="loadMore">
                    View More
                </button>
            </div>
        </div>
    </main>
</template>

<script>
    import sidebar from './Sidebar.vue';
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';

    export default {
        props: {
            terms: { 
                type: Object, 
                default: {} 
            },
            posts: {
                Type: Array,
                default: []
            },
            pagination: {
                type: Object, 
                default: {} 
            },
            keywords: {
                type: String, 
                default: ''
            },
            cat_name: {
                type: String, 
                default: ''
            }
        },
        components: {
            sidebar,
            Loading
        },
        data() {
            return {
                perpageSetting:[4,6,8],
                orderingSetting:['Newest First', 'Latest First'],
                updateData: null,
                showWrapper: false,
                listLayout: 'grid',
                isLoading : false,
                currentPage: 1,
                has_next_page: false,
                per_page: 4,
                order: 'Newest First',
                s: '',
                category_name: '',
                postList: [],
            };
        },

        computed: {
            defaultImage() {
                return this.$images + "/no-image.png";
            }
        },

        mounted() {
            this.currentPage = this.pagination.current_page;
            this.has_next_page = this.pagination.next_page;
            this.s = this.keywords;
            this.category_name = this.cat_name
            this.postList = this.posts
        },

        methods: {
            selectedTerms(value){
                this.category_name = value.slug;
                this.currentPage = 1;
                this.fetchSearch();
            },
            fetchSearch(){
                this.isLoading = true;

                let ordering = 'DESC';

                if (this.order === 'Newest First') {
                    ordering = 'DESC';
                }else{
                    ordering = 'ASC';
                }

                let formData = {
                    paged: this.currentPage,
                    term: this.category_name,
                    per_page: this.per_page,
                    s: this.s,
                    order: ordering
                };
                this.$api.Posts.fetchSearch(formData).then((result)=>{
                    this.isLoading = false;
                    if (result.status == 200) {
                        if (result.data.posts.length > 0) {
                            this.postList.push(...result.data.posts); 
                        }else{
                            this.postList = [];
                        }
                        this.currentPage = result.data.pagination.current_page ?? 1;
                        this.has_next_page = result.data.pagination.next_page
                    }
                })
            },
            loadMore(){
                this.currentPage =+ 1;
                this.fetchSearch();
            },
            fechingSearch(){
                this.currentPage = 1;
                this.postList = [];
                this.fetchSearch();
            }
        },
    };
</script>


<style lang="scss" scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: all 0.5s ease-in;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }

    .btn-layout{
        &:hover{
            rect {
                @apply stroke-primary;
            }
            path {
                @apply fill-primary;
            }
        }
        svg{
            @apply transition-all duration-300;
        }
        &__show{
            svg {
                rect {
                    @apply stroke-primary;
                }
                path {
                    @apply fill-primary;
                }
            }
        }
    }

    .search-list{
        @apply grid gap-6;
        &__list{
            @apply grid-cols-1;
        }
        &__grid{
            @apply grid-cols-1 md:grid-cols-2;
        }
    }

    article.card-item{
        @apply flex;
        
        .shadow{
            box-shadow: 0px 4px 30px rgba(0, 0, 0, 0.05);
        }

        .excerpt p{
            @apply text-gray-400 text-xs md:text-sm lg:text-base;
        }

        &__vertical{
            @apply flex-col gap-6;
        }
        &__horizontal{
            @apply flex-col lg:flex-row rounded-lg items-center p-3 md:p-6 justify-center gap-2 lg:gap-6;
            figure {
                @apply w-full lg:w-2/5;
            }
            div{
                @apply w-full lg:w-3/5;
            }
        }
    }
</style>

<style lang="scss">
.search-item{
        &:hover img{
            @apply scale-105;
        }
    }
</style>