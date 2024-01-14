<template>
    <MusicLayout>
        <template #title> ApiKey: </template>

        <template #action>
            <Link
                :href="route('apiKeys.create')"
                class="bg-green-500 hover:bg-green-600 text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                Créer une ApiKey
            </Link>
        </template>

        <template #content>
            <table>
                <thead>
                    <tr>
                        <th>Api Name</th>
                        <th>Api Key</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="apiKey in apiKeys">
                        <td>{{ apiKey.name }}</td>
                        <td>{{ apiKey.key }}</td>
                        <td>
                            <Link
                                :href="
                                    route('apiKeys.destroy', {
                                        apiKey: apiKey,
                                    })
                                "
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-8/12 text-center"
                                method="delete"
                                as="button"
                                style="
                                    margin-left: 50%;
                                    transform: translateX(-50%);
                                "
                            >
                                Delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
export default {
    components: {
        MusicLayout,
    },
    props: {
        apiKeys: Array,
    },
};
</script>

<style></style>
