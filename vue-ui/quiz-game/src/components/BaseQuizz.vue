<script setup>
    import { useQuoteStore } from '../stores/quote';
    import { computed } from 'vue';
    
    const props =defineProps({
      quote: {
        type: Object,
        required: true
      },
      authors: {
        type: Array,
        required: true
      }
    });
    const store = useQuoteStore();

    const quoteText = computed(() => `${store.stage}. ${props.quote?.text}`)

    const onButtonClick = async (quoteId, answerId) => {
        await store.checkAnswer(quoteId, answerId);
    }

</script>

<template>
    <div class="container">
        <h1>Choose the right author</h1>
        <h3>{{ quoteText || 'No Quiz' }}</h3>
        <div class="buttons-conatiner">
            <button v-for="(author,i) in props.authors" :key="i" @click="onButtonClick(quote.id, author.id)"> {{ author.author }}</button>
        </div>
    </div>
</template>

<style scoped>
.container {
    flex-direction: column;
}
.buttons-conatiner {
    display: flex;
    width: 70%;
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
  margin: 8px;
  width: calc(100% / 3 - 16px);
}

button:hover {
  background-color: #16A085;
  transform: translateY(-3px);
  box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
}

h3 {
  margin-bottom: 5%;
  font-size: 2rem;
  text-align: center;
  color: #FFF;
}

h1 {
  margin-bottom: 7%;
  font-size: 2.5rem;
  text-align: center;
  color: #FFF;
}

@media screen and (max-width: 768px) {
  .buttons-conatiner {
    width: 90%;
  }

  button {
    width: calc(50% - 16px);
    margin: 8px;
  }
}

@media screen and (max-width: 480px) {
  h1 {
    font-size: 2rem;
  }

  h3 {
    font-size: 1.5rem;
  }

  .buttons-conatiner {
    width: 90%;
    margin-top: 10%;
    flex-direction: column;
  }

  button {
    width: calc(100% - 16px);
    margin: 8px;
  }
}
</style>
