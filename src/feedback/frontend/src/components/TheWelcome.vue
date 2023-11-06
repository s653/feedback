<script setup lang="ts">
import { computed } from '@vue/reactivity';
import WelcomeItem from './WelcomeItem.vue'
import ToolingIcon from './icons/IconTooling.vue'
import { useStore} from 'vuex';

const store = useStore();
const feedbacks = computed(() => store.getters.feedbacks)
</script>

<template>
<div class="container mt-5">
<WelcomeItem v-for="feedback in feedbacks" :key="feedback.id">
    <template #icon>
      <ToolingIcon />
    </template>
    <template #heading>{{ feedback.title }}</template>
    <div v-html="feedback.description"></div>
  </WelcomeItem>
</div>
</template>
