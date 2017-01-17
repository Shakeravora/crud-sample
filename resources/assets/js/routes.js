import VueRouter from 'vue-router';

let routes = [
  {
    path: '/',
    component: require('./components/ContactList.vue')
  },

  {
    path: '/contact/:id',
    component: require('./components/ContactForm.vue')
  }
];

export default new VueRouter({
  routes,
  linkActiveClass: 'is-active'
});
