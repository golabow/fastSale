<template>
  <span>
    <i class="fas fa-shopping-cart mr-1"></i> Your cart  <span class="ml-2 badge badge-primary badge-pill">{{ this.itemsCount }}</span>
  </span>
</template>

<script>
  import baseComponent from './base.vue';
  export default {
    mixins: [baseComponent],
    props: {
      initItems: {
        type: Array,
        default: function () {
          return [];
        }
      }
    },
    data: function () {
      return {
        items: this.initItems,
        notificationComponent: this.$root.getNotificationComponent()
      };
    },
    methods: {
      addProductToCart: function (productId) {
        this.sendAjaxRequest('/cart/add/' + productId);
      },
      removeProductFromCart: function (productId) {
        this.sendAjaxRequest('/cart/remove/' + productId);
      },
      isProductAlreadyInCart: function (productId) {
        return this.items.indexOf(productId) >= 0;
      }
    },
    computed: {
      itemsCount: function () {
        return this.items.length;
      }
    }
  }
</script>
