<template>
    <Transition name="fade" v-if="showing">
        <div
            class="fixed inset-0 w-full h-screen flex items-center justify-center bg-black/80 z-[999999]"
            @click.self="close"
        >
            <div class="max-w-7xl bg-white shadow-lg relative p-10" :class="width">
                <button
                    class="fixed z-50 top-5 right-5 lg:top-10 lg:right-10 btn-close"
                    @click.prevent="close"
                >
                    <svg-vue icon="plus" class="h-8 w-8 text-white"></svg-vue>
                </button>
                <slot />
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    props: {
        showing: {
            required: true,
            type: Boolean,
        },
        width: {
            default: "w-auto",
            type: String,
        },
    },
    watch: {
        showing(value) {
            if (value) {
                return document
                    .querySelector("body")
                    .classList.add("overflow-hidden");
            }

            document.querySelector("body").classList.remove("overflow-hidden");
        },
    },
    methods: {
        close() {
            this.$emit("close");
        },
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.4s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
.btn-close svg path {
    fill: #FFF;
    stroke: #FFF;
}
</style>
