require('./app.css');

import jquery from 'jquery';
window.$ = window.jQuery = jquery;

import 'bootstrap';
import 'bootstrap-notify';

import Vue from 'vue';

import shoppingCart from './components/shoppingCart.vue';
import shoppingCartButton from './components/shoppingCartButton.vue';
import notification from './components/notification.vue';
import countdown from './components/countdown.vue';

Vue.component('shopping-cart', shoppingCart);
Vue.component('shopping-cart-button', shoppingCartButton);
Vue.component('notification', notification);
Vue.component('countdown', countdown);

var app = new Vue({
  el: '#app',
  data: {},
  methods: {
    getShoppingCartComponent: function () {
      return this.$refs.shoppingCartComponent;
    },
    getNotificationComponent: function() {
      return this.$refs.notificaitonComponent;
    }
  }
});