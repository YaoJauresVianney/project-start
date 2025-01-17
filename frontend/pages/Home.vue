<script setup lang="ts">
    import useUserStore from '../stores/useUserStore';

    const userStore = useUserStore();
</script>
<template>
    <div>
        <h1 class="bg-pink-200">
            <v-icon aria-hidden="false">
                mdi-account
            </v-icon>
            Welcome to, {{ userStore.name }}</h1>
    </div>
</template>
