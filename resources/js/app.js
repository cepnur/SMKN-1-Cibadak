window.axios = require("axios");
// window.axios.defaults.headers.common["X-WP-Nonce"] = settings.nonce;
import { createApp } from "vue";
import mixins from "./mixins";
import api from "./api";
import SvgVue from "svg-vue3";
import { createClient } from "villus";

import { ITSHelpers } from "./utils/ITSUtilities";

import LazyLoadDirective from "./directives/LazyLoadDirective";
import ClickOutside from "./directives/ClickOutside";

import MainHeader from "./Layouts/MainHeader.vue";
import MainFooter from "./Layouts/MainFooter.vue";
import LazyImage from "./Components/LazyImage.vue";
import PageNotFound from "./Components/PageNotFound.vue";
import SearchTemplate from "./pages/search/Main.vue";
import Regulations from './pages/Regulations.vue';
import ArchiveGallery from './pages/ArchiveGallery.vue';
import News from './pages/News.vue';
import Home from './pages/Home.vue';
import Program from './pages/Program.vue';
import Tweet from 'vue-tweet';
import VueEasyLightbox from 'vue-easy-lightbox';
import ContactInfo from './Components/ContactInfo.vue';
import MenuLayanan from './Components/MenuLayanan.vue';
import RelatedPosts from './Components/RelatedPosts.vue';
import RegisterUser from './Components/RegisterUser.vue';
import UserLogin from './Components/UserLogin.vue';
import Profile from './Components/Profile.vue';
import PermohonanMagang from './Components/PermohonanMagang.vue';
import PengaduanList from './Components/PengaduanList.vue';
import PermohonanPassport from './Components/PermohonanPassport.vue'


// Page Imported
import MagangRequest from './pages/MagangRequest.vue';
import Pengaduan from './pages/Pengaduan.vue';
import RequestPassport from './pages/RequestPassport.vue';

import Tentang from './pages/Tentang.vue'
import Contact from './pages/Contact.vue'
import Detailnews from './pages/Detailnews.vue'
import Detailprogram from './pages/Detailprogram.vue'
import Info from './pages/Info.vue'
import Studentdata from './pages/Studentdata.vue'
import Organisasi from './pages/Organisasi.vue'
import Gallery1 from './pages/Gallery1.vue'
import Hero from './Components/Hero.vue'
import Data from './Components/Data.vue'
import Pagination from './Components/Pagination.vue'



const client = createClient({
    url: "/graphql", // your endpoint.
});

const vueSelectors = [
    { el: "#vue-header", component: MainHeader },
    { el: "#vue-app", component: "" },
    { el: "#vue-altapp", component: "" },
    { el: "#vue-footer", component: MainFooter },
    { el: "#kontak_info", component: ContactInfo },
];
let i = 0;
let app = [];
for (const selector of vueSelectors) {
    if (document.querySelector(selector.el)) {
        app[i] = createApp({
            beforeCreate() {
                ITSHelpers.vueFixWpPlugins(document.querySelector(selector.el));
                ITSHelpers.forceExternalLinks();
            },
        })
            .use(SvgVue)
            .directive("lazyload", LazyLoadDirective)
            .directive("click-outside", ClickOutside);

        app[i].config.globalProperties.$images = settings.images;
        app[i].config.globalProperties.$settings = settings;
        app[i].config.globalProperties.$api = api;
        app[i].config.globalProperties.$nonce = settings.nonce;
        app[i].use(client);
        app[i].use(VueEasyLightbox)
        app[i].mixin(mixins);
        app[i].component("main-header", MainHeader);
        app[i].component("main-footer", MainFooter);
        app[i].component("contact-info", ContactInfo);
        app[i].component("Tweet", Tweet);
        
        if (selector.el == "#vue-app" || selector.el == "#vue-altapp") {
            app[i].component("tentang", Tentang);
            app[i].component("news", News);
            app[i].component("program", Program);
            app[i].component("home", Home);
            app[i].component("contact", Contact);
            app[i].component("detailnews", Detailnews);
            app[i].component("detailprogram", Detailprogram);
            app[i].component("info", Info);
            app[i].component("studentdata", Studentdata);
            app[i].component("gallery1", Gallery1);
            app[i].component("organisasi", Organisasi);
        }
        app[i].component("LazyImage", LazyImage);
        app[i].component("Hero", Hero);
        app[i].component("Data", Data);
        app[i].component("Pagination", Pagination);
        app[i].mount(selector.el);
        i++;
    }
}

const nodes = document.querySelectorAll(".vue-block");
if (nodes.length > 0) {
    document.addEventListener("DOMContentLoaded", () => {
        const ComponentContext = require.context("./Blocks", true, /\.vue$/i);
        for (let i = 0; i < nodes.length; ++i) {
            let adminApp = createApp({
                    beforeCreate() {
                        ITSHelpers.vueFixWpPlugins(nodes[i]);
                        ITSHelpers.forceExternalLinks();
                    },
                })
                .component("LazyImage", LazyImage)
                .component("Tweet", Tweet)
                .directive("lazyload", LazyLoadDirective)
                .directive("click-outside", ClickOutside);
            
            ComponentContext.keys().map((key) =>
                adminApp.component(key.split("/").pop().split(".")[0], ComponentContext(key).default)
            );
            adminApp.config.globalProperties.$images = settings.images;
            adminApp.config.globalProperties.$settings = settings;
            adminApp.config.globalProperties.$api = api;
            adminApp.config.globalProperties.$nonce = settings.nonce;
            adminApp.use(client)
                    .use(SvgVue)
                    .use(VueEasyLightbox)
                    .mixin(mixins)
                    .mount(nodes[i]);
        }
    });
}


