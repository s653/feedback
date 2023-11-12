<script setup lang="ts">
import { computed } from '@vue/reactivity';
import WelcomeItem from './WelcomeItem.vue'
import ToolingIcon from './icons/IconTooling.vue'
import HeartOutline from './icons/HeartOutline.vue'
import IconSupport from './icons/IconSupport.vue'
import { useStore } from 'vuex';

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
      <div class="count">
        <i class="icon">
          <IconSupport v-if="1 == 1"/>
          <HeartOutline v-else-if="1 == 0"/>
        </i><span><RouterLink :to="`/feedbacks/${feedback.id}/voters`" class="voters">21 votes</RouterLink></span>
      </div>
    </WelcomeItem>
  </div>
</template>

<style>
.icon {
  cursor: pointer;
}
.count {
  width: 7%;
  display: flex;
  justify-content: space-between;
}
.voters {
  text-decoration: none;
}
</style>
