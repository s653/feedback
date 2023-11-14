<script setup lang="ts">
import { computed } from '@vue/reactivity';
import WelcomeItem from './WelcomeItem.vue'
import ToolingIcon from './icons/IconTooling.vue'
import HeartOutline from './icons/HeartOutline.vue'
import IconSupport from './icons/IconSupport.vue'
import IconTooling from './icons/IconTooling.vue'
import { useStore } from 'vuex';

const store = useStore();
const feedbacks = computed(() => store.getters.feedbacks)

const vote = (feedbackId: any) => {
  store.dispatch("voteFeedback", feedbackId)
}
</script>

<template>
  <div class="container mt-5">

    <WelcomeItem v-for="feedback in feedbacks" :key="feedback.id">
      <template #icon>
        <ToolingIcon />
      </template>
      <template #heading>{{ feedback.title }}</template>
      <div v-html="feedback.description"></div>
      <div class="count-wrapper d-flex">
      <div class="count" style="margin-right: 10px;">
        <i class="icon">
          <IconSupport v-if="feedback.isVoted" @click="vote(feedback.id)" />
          <HeartOutline v-else-if="!feedback.isVoted" @click="vote(feedback.id)" />
        </i><span style="margin-left: 6px;">
          <RouterLink :to="`/feedbacks/${feedback.id}/voters`" class="voters">{{ feedback.total_votes}} votes</RouterLink>
        </span>
      </div>
      <div style="width: 15%;">
        <i class="icon">
          <IconTooling />
        </i><span style="margin-left: 6px;">
          <RouterLink :to="`/feedbacks/${feedback.id}/voters`" class="voters">{{ feedback.total_comments}} comments</RouterLink>
        </span>
      </div>
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
}

.voters {
  text-decoration: none;
}</style>
