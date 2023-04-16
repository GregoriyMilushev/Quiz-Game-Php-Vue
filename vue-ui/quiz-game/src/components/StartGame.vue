<script setup>
import { useRouter } from 'vue-router';
import { useQuoteStore } from '../stores/quote';

const router = useRouter();
const store = useQuoteStore();

const startQuiz = () => {
  store.resetQuiz();
  router.push('/game');
};
</script>

<template>
  <div class="container">
    <button @click="startQuiz">
      Start Quizz
    </button>
  </div>
</template>

<style>
  .container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100%;
  background-color: #2D3E50;
}

button {
  padding: 16px 32px;
  font-size: 1.25rem;
  font-weight: bold;
  text-transform: uppercase;
  color: #fff;
  background-color: #1ABC9C;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
}

button:hover {
  transform: translateY(-3px);
  background-color: #16A085;
  box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
}
</style>
