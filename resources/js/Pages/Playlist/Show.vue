<template>
    <MusicLayout>
        <template #title> Playlists: {{ playlist.title }} </template>

        <template #action>
            <Link
                :href="route('playlists.index')"
                class="bg-blue-500 hover:bg-blue-600 text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                Retour
            </Link>
        </template>

        <template #content>
            <div class="grid grid-cols-4 gap-4">
                <Track
                    v-for="track in playlist.tracks"
                    :key="track.uuid"
                    :track="track"
                    :active="currentTrack === track.uuid"
                    @played="play"
                />
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import Track from "@/Components/Track/Track.vue";
export default {
    components: {
        MusicLayout,
        Track,
    },
    props: {
        playlist: Object,
    },
    data() {
        return {
            audio: null,
            currentTrack: null,
        };
    },
    methods: {
        play(track) {
            const url = "/storage/" + track.music;
            if (!this.currentTrack) {
                this.audio = new Audio(url);
                this.audio.play();
            } else if (this.currentTrack !== track.uuid) {
                this.audio.pause();
                this.audio.src = url;
                this.audio.play();
            } else if (!this.audio.paused) {
                this.audio.pause();
            } else {
                this.audio.play();
            }

            this.currentTrack = track.uuid;
            this.audio.addEventListener("ended", () => {
                this.currentTrack = null;
            });
        },
    },
};
</script>

<style></style>
