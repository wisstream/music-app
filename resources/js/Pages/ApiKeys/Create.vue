<template>
    <MusicLayout>
        <template #title> ApiKey: </template>

        <template #action> </template>

        <template #content>
            <!-- api key name -->
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Name
                    </label>
                    <input
                        id="name"
                        v-model="form.name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-red-500"
                        :class="{ 'border-red-500': form.errors.name }"
                        type="text"
                        placeholder="Name"
                    />
                    <p class="text-red-500 text-xs italic">
                        {{ form.errors.name }}
                    </p>
                </div>
                <input
                    type="submit"
                    value="Submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer"
                />
            </form>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
export default {
    components: {
        MusicLayout,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route("apiKeys.store"));
        },
    },
};
</script>

<style></style>
