<template>
    <p>{{ message }}</p>
</template>

<script setup>
import { ref } from 'vue';

const message = ref('Hello, Vue 3 with Composition API!');
</script>
