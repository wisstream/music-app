<template>
    <div
        class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer"
        :class="{ 'border-2 border-blue-500': active }"
        @click="play(track)"
    >
        <div class="w-full h-1/2">
            <img class="w-full h-full" :src="`/storage/${track.image}`" />
        </div>
        <div style="height: 120px" class="px-6 py-4">
            <div class="font-bold text-xl mb-2">
                {{ track.title }}
            </div>
            <small class="text-gray-700 text-base">
                {{ track.artist }}
            </small>
        </div>
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-8/12"
            style="margin-left: 50%; transform: translateX(-50%)"
            @click="play()"
        >
            Play
        </button>
        <div
            style="
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: 16px;
            "
        >
            <div class="w-full flex justify-content-between">
                <Link
                    v-if="$page.props.isAdmin"
                    :href="route('tracks.edit', { track: track })"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-8/12 text-center"
                    style="margin-left: 50%; transform: translateX(-50%)"
                >
                    Edit
                </Link>
            </div>
            <div class="w-full flex justify-content-between">
                <Link
                    v-if="$page.props.isAdmin"
                    :href="route('tracks.delete', { track: track })"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-8/12 text-center"
                    method="delete"
                    as="button"
                    style="margin-left: 50%; transform: translateX(-50%)"
                >
                    Delete
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    emits: ["played"],
    props: {
        track: Object,
        active: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        play() {
            this.$emit("played", this.track);
        },
    },
};
</script>
