<script setup>
import BaseQuizz from './BaseQuizz.vue'
import { useQuoteStore } from '../stores/quote';
import { computed, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const store = useQuoteStore();

const stage = computed(() => store.stage);

const quizz = computed(() => store.quizz);
const quoteText = computed(() => quizz.value?.quote)
const authors = computed(() => quizz.value?.authors);

watch(stage, (newValue) => {
  console.log(newValue);
  if (newValue > 10) {
    router.push('/score');
  }
});

onMounted( async() => {
  await store.fetchRandomQuote();
});
</script>

<template>
  <BaseQuizz :quote="quoteText" :authors="authors" />
</template>

<style scoped>

</style>
