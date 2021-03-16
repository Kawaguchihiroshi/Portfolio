import VueScrollTo from 'vue-scrollto'
Vue.use(VueScrollTo)

new Vue({
  el: '#app',
  methods: {
    scrollTop: function(){
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    }
  }
})