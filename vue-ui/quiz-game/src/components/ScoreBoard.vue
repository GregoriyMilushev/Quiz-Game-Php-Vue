<script setup>
import { useQuoteStore } from '../stores/quote';
import { computed } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const store = useQuoteStore();

const onNewGameClick = () => {
    store.resetQuiz();
    router.push('/game')
}

const score = computed(() => store.score)

</script>

<template>
    <div class="score-board">
        <div class="score">
            Your Score is: {{ score }} of 10
        </div>
        <button class="new-game" @click="onNewGameClick">
            New Game
        </button>
    </div>
</template>

<style scoped>
.score-board {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
  font-size: 1.5rem;
}

.score {
  margin-bottom: 20px;
}

.new-game {
  padding: 12px 24px;
  font-size: 1rem;
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

.new-game:hover {
  background-color: #16A085;
  transform: translateY(-3px);
  box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
}
</style>
