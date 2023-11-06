<script setup lang="ts">
import TheWelcome from '../components/TheWelcome.vue'
import { onBeforeMount } from "@vue/runtime-core";
import { useStore } from "vuex";

const store = useStore();
onBeforeMount(() => {
  store.dispatch("getFeedbacks")
})
</script>

<template>
  <main>
    <TheWelcome />
  </main>
</template>
