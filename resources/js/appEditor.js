/**
 * This file will be loaded in the guthenberg editor
 */
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
import { createApp } from "vue";
window.axios = require("axios");
import mixins from "./mixins";
import api from "./api";
import SvgVue from "svg-vue3";
import { createClient } from "villus";
import { ITSHelpers } from "./utils/ITSUtilities";

import LazyLoadDirective from "./directives/LazyLoadDirective";
import ClickOutside from "./directives/ClickOutside";
import LazyImage from "./Components/LazyImage.vue";
import Tweet from 'vue-tweet';
import VueEasyLightbox from 'vue-easy-lightbox'

ITSHelpers.wpEditorOnUpdate(() => {
    const nodes = document.querySelectorAll(".vue-block");
    const ComponentContext = require.context("./Blocks", true, /\.vue$/i);
    const client = createClient({
        url: "/graphql", // your endpoint.
    });
    for (let i = 0; i < nodes.length; ++i) {
        let adminApp = createApp({
            beforeCreate() {
                ITSHelpers.vueFixWpPlugins(nodes[i]);
            },
            mounted() {
                ITSHelpers.vueFixWpPlugins(nodes[i]);
            },
        })
            .use(SvgVue)
            .use(VueEasyLightbox)
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
            .use(VueEasyLightbox)
            .mixin(mixins)
            .mount(nodes[i]);
    }
});

