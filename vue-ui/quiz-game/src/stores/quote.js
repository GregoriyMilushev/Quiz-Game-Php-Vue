import { defineStore } from 'pinia';
import { api } from '../../api/apiFactory';


const RESOURCE_NAME = 'quote';

export const useQuoteStore = defineStore(RESOURCE_NAME, {
  
  state: () => ({
    quotes: [],
    quizz: [],
    passedQuotesIds: [],
    score: 0,
    stage: 1
  }),
  actions: {
    async fetchQuotes() {
      const {data} = await api(RESOURCE_NAME).all();
      this.setQuotes(data);
    },

    async fetchRandomQuote() {
      const {data} = await api(RESOURCE_NAME).random(this.passedQuotesIds.join(', ') || null);
      this.setQuizz(data);
      this.addPassedQuotesIds(data);
    },

    async checkAnswer (quoteId, answerId) {
      const {data} = await api(RESOURCE_NAME).check(quoteId, answerId);
      console.log(data,'checkkk');
      if (data.answer) {
        console.log('HEree');
        this.addScore()
        console.log(this.score, 'Score');
      }
      this.nextStage();
      return data;
    },

    nextStage() {
      this.stage += 1;
      this.fetchRandomQuote()
    },

    addScore() {
      this.score += 1;
    },

    setQuotes(quotes) {
      this.quotes = quotes;
    },

    setQuizz(quizz) {
      this.quizz = quizz;
    },

    addPassedQuotesIds(data) {
      this.passedQuotesIds.push(data.quote.id);
    },

    resetQuiz() {
      this.score = 0;
      this.stage = 1;
      this.quizz = [];
      this.passedQuotesIds = [];
    }
  }
});
