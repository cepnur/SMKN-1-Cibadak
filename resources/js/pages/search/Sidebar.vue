<template>
    <aside class="w-full flex flex-col gap-6 px-5">
        <!-- Aside -->
        <div class=" flex flex-col items-start text-sm gap-4 bg-gray-100 rounded-lg py-4 px-4 ">
            <div class="flex justify-between w-full">
                <p class="font-bold">Filter Us</p>
                <button type="button"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-[#005046]">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                </button>
            </div>
            
            <div class="w-full flex flex-col items-start text-sm gap-4">
                <label for="" class="font-bold">Search</label>
                <form @submit.prevent="submited" class="flex relative w-full">
                    <input type="text" class="py-3 px-3 rounded-full w-full" placeholder="Search" v-model="keywords" >
                    <button class="">
                        <svg class="w-5 h-5 absolute right-3 top-3 " viewBox="0 0 19 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8.48247" cy="8.48223" r="6.82988" stroke="#969696" stroke-width="1.94209" />
                            <rect x="13.8402" y="12.9844" width="6.37456" height="1.21403" rx="0.607014"
                                transform="rotate(45 13.8402 12.9844)" fill="#969696" />
                        </svg>
                    </button>
                </form>
            </div>
            <label for="" class="font-bold">Categories</label>
            <div class="relative flex w-full bg-white py-3 px-3 rounded-full justify-between gap-20">

                <button id="dropdownDefaultButton" @click="filterShow = !filterShow"
                    class="w-full hover:text-softlight text-sm text-start inline-flex items-center text-gray-400 "
                    >
                    <span>{{ activeTerm !== '' ? activeTerm : 'Categories' }}</span>
                    <svg class="h-4 w-4 absolute right-3 top-4" viewBox="0 0 16 10" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.744 0.790327L15.2195 0.262172C15.0549 0.0986267 14.8324 0.00682956 14.6004 0.00682956C14.3684 0.00682956 14.1459 0.0986267 13.9814 0.262172L8.00319 6.24132L2.01917 0.255342C1.85465 0.0917971 1.63209 0 1.40011 0C1.16813 0 0.945581 0.0917971 0.781059 0.255342L0.255181 0.77992C0.0917345 0.944428 0 1.16691 0 1.39881C0 1.63071 0.0917345 1.8532 0.255181 2.0177L7.3817 9.17024C7.54626 9.3348 7.76578 9.4509 8.00222 9.4509H8.00514C8.23963 9.4509 8.46045 9.3348 8.62306 9.17024L15.744 2.03722C15.9087 1.87077 16.0007 1.64592 16 1.41182C16.0004 1.29647 15.978 1.18218 15.9341 1.07552C15.8901 0.968864 15.8256 0.871941 15.744 0.790327Z"
                            fill="#969696" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown-category"
                    class="bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute top-0 right-full transform translate-x-full translate-y-[25%]"
                    :class="filterShow === false ? 'opacity-0 max-h-0 -z-10' : 'opacity-100 max-h-[500px] z-10'">
                    <ul class="py-2 px-3 text-sm text-gray-700 ">
                        <div class="flex justify-between mb-4">
                            <p class="font-bold">Filter</p>
                        </div>
                        <p class="mb-4">Categories</p>

                        <div class="flex items-center mb-4" v-for="category in categories" :key="category">
                            <input :id="category.term_id" type="radio" :value="category"
                                class="w-4 h-4 text-[#005046] bg-gray-100 border-gray-300 rounded "
                                v-model="selectedCategories" :checked ="category.slug == activeTerm ? true : false" @click="filterShow = !filterShow">
                            <label :for="category.term_id"
                                class="ml-2 text-sm font-medium text-gray-900 ">{{category.name}}</label>
                        </div>
                    </ul>
                </div>

            </div>
        </div>
    </aside>
</template>

<script>
    export default {
        props: {
            terms: {
                type: Object,
                default: {}
            },
            s: {
                type: String,
                default: ''
            },
            activeTerm: {
                type: String,
                default: ''
            }
        },
        components: {},
        data() {
            return {
                filterShow: false,
                categories: [],
                selectedCategories: {},
                keywords: ''
            };
        },
        created() {
            this.keywords = this.s;
        },
        mounted() {
            if (this.terms) {
                this.categories = this.terms ?? [];
            }
        },
        watch: {
            selectedCategories: {
                handler(value){
                    this.$emit('selectedTerms' , value);
                }
            },

            keywords: {
                handler(){
                    this.$emit('updateKeyword' , this.keywords);
                }
            }
        },
        methods: {
            submited(){
                this.$emit('submitedSearch');
            }
        }
    };
</script>

<style lang="scss" scoped>

</style>