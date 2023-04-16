import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import GameView from '../views/GameView.vue'
import ScoreView from '../views/ScoreView.vue'
import { useQuoteStore } from '../stores/quote';



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/game',
      name: 'game',
      component: GameView
    },
    {
      path: '/score',
      name: 'score',
      component: ScoreView,
      beforeEnter: (to, from, next) => {
        const store = useQuoteStore();
        if (store.stage < 11) {
          next('/');
        } else {
          next();
        }
      },
    }
  ]
})

export default router
