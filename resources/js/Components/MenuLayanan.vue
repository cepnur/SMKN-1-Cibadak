<template>
    <div class="menu-layanan menu-show h-full">
        <!-- <h3 class="paragraph font-bold text-[#1A1A1A]" style="margin-bottom: 0!important">Prosedur Layanan</h3> -->
        <!-- <h3 class="paragraph">{{ currentpage.post_title }}</h3> -->
        <div class="menu-list h-full opacity-0 p-3 lg:p-6 bg-white min-w-[320px] -z-10">
            <p class="paragraph font-bold text-[#001F22] pb-6 px-2">Prosedur Layanan</p>
            <p class="paragraph-2 font-bold text-[#001F22] px-2">Categories</p>
            <ul>
                <template v-if="childs">
                    <li >
                        <div class="menu-button"
                            :class="{'curent-page__active' : parent.post_name == currentpage.post_name }">
                            <a :href="$settings.site.url+ '/' + parent.post_name">{{ parent.post_title }}</a>
                        </div>
                    </li>
                    <li :class="{
                        'has-subs-menu' : checkSubmenuChildren(child.subChildren)
                        }" 
                        v-for="child in childs" :key="child">
                        <div class="menu-button"
                            :class="{'curent-page__active' : checkCurrentPageActive(child.children),
                                'curent-page__active' : child.children.ID === currentpage.post_parent || child.children.ID === currentpage.ID
                            }"
                            @click="clickSubMenu($event)">
                            <a :href="$settings.site.url+ '/' + parent.post_name + '/' + child.children.post_name">{{ child.children.post_title }}</a>
                            <svg class="rotate-180 transition-transform duration-300 ease-in" v-if="checkSubmenuChildren(child.subChildren)"
                                width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.872 11.6048L13.6097 11.8689C13.5275 11.9507 13.4162 11.9966 13.3002 11.9966C13.1842 11.9966 13.0729 11.9507 12.9907 11.8689L10.0016 8.87934L7.00958 11.8723C6.92732 11.9541 6.81605 12 6.70006 12C6.58407 12 6.47279 11.9541 6.39053 11.8723L6.12759 11.61C6.04587 11.5278 6 11.4165 6 11.3006C6 11.1846 6.04587 11.0734 6.12759 10.9911L9.69085 7.41488C9.77313 7.3326 9.88289 7.27455 10.0011 7.27455H10.0026C10.1198 7.27455 10.2302 7.3326 10.3115 7.41488L13.872 10.9814C13.9543 11.0646 14.0003 11.177 14 11.2941C14.0002 11.3518 13.989 11.4089 13.967 11.4622C13.9451 11.5156 13.9128 11.564 13.872 11.6048Z" fill="#005046"/>
                            </svg>
                        </div>

                        <ul class="sub-menu-list" v-if="checkSubmenuChildren(child.subChildren)">
                            <li v-for="sub in child.subChildren" :key="sub">
                                <a :href="$settings.site.url+ '/' + parent.post_name + '/' + child.children.post_name + '/' + sub.post_name"
                                    :class="{'sub-menu-item__active' : checkCurrentPageActive(sub) }">
                                    {{ sub. post_title}}
                                </a>
                            </li>
                        </ul>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    name:"MenuLayanan",
    props:{
        parent:{
            type: Object,
            default: {}
        },
        childs: {
            type: Array,
            default: []
        },
        currentpage: {
            type : Object,
            default : {}
        }
    },
    data() {
        return {
            menuShow: true
        }
    },
    methods: {
        clickSubMenu(e) {
            e.target.classList.toggle("menu-button__active");
            e.target.nextElementSibling.classList.toggle("sub-menu-list__active");
        },
        checkSubmenuChildren(value){
            if (value.length > 0) {
                return true;
            }

            return false;
        },
        checkCurrentPageActive(value){
            if (value.post_name === this.currentpage.post_name) {
                return true;
            }
            return false;
        },
        closeMenuList(){
            this.menuShow = false;
        }
    },
}
</script>
<style lang="scss" scoped>
    .menu-layanan {
        ul, li {
            @apply list-none;
        }
        &.menu-show {
            .menu-list{
                @apply max-h-[1000px] opacity-100 max-w-[400px] z-10;
            }
            svg.icon-menu {
                @apply transform rotate-180;
            }
        }
        button {
            svg.icon-menu{
                @apply rotate-0;
            }
            &:hover{
                svg {
                    path {
                       @apply fill-white;
                    }
                }
            }
        }
        .menu-list{
            @apply transition-all duration-300 ease-linear;
            box-shadow: 0px 4px 30px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            ul {
                @apply mb-0;
                li {
                    @apply mb-3;
                    &.has-subs-menu{
                        svg{
                            @apply inline-block;
                        }
                        ul.sub-menu-list{
                            @apply transition-all ease-in duration-300 delay-100 mb-0 max-h-0 overflow-hidden opacity-0;
                            li{
                                @apply transition-colors duration-300 px-2 border-b-2 mb-3 border-b-transparent;
                                &:hover{
                                    @apply border-primary;
                                }
                                a{
                                    @apply paragraph-2 text-softlight;
                                }
                            }
                            &__active {
                                @apply max-h-[1000px] opacity-100 mt-3;
                            }
                            :nth-last-child(1){
                                @apply mb-0;
                            }
                        }
                    }
                    .menu-button{
                        @apply transition-all duration-300 ease-linear flex justify-between gap-4 items-center transform px-2 py-1;
                        &:hover{
                            @apply cursor-pointer shadow-sm drop-shadow-sm;
                        }
                        a {
                            @apply transition-all duration-300 ease-linear text-primary font-bold paragraph-2 border-b-2 border-b-transparent;
                        }
                        &__active {
                            @apply relative shadow-sm drop-shadow-sm;
                            svg {
                                @apply transform rotate-0 shadow-none drop-shadow-none;
                            }
                        }
                        &.curent-page__active{
                            @apply shadow-sm drop-shadow-sm;
                        }
                    }
                    &:nth-last-child(1){
                        @apply mb-0
                    }
                }
            }
        }
    .sub-menu-item__active{
        @apply font-bold;
    }
    }
</style>