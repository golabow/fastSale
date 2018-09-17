<template>
  <span>
    <button v-if="buttonAction === 'addToCart'" v-on:click.prevent="addProductToCart" v-bind:disabled="isProductAlreadyInCart" class="btn btn-success">
      <span v-if="isProductAlreadyInCart === false"><i class="fas fa-cart-plus"></i> Add to cart</span>
      <span v-if="isProductAlreadyInCart === true"><i class="fas fa-cart-arrow-down"></i> In cart</span>
    </button>
    <button v-if="buttonAction === 'removeFromCart'" v-on:click.prevent="removeProductFromCart" class="btn btn-sm btn-info">
      <i class="far fa-trash-alt"></i> Remove from cart
    </button>
  </span>
</template>

<script>
  export default {
    props: {
      buttonAction: {
        type: String,
        default: 'addToCart'
      },
      productId: {
        type: Number
      }
    },
    data: function () {
      return {
        shoppingCartComponent: this.$root.getShoppingCartComponent(),
      };
    },
    created: function () {
    },
    methods: {
      addProductToCart: function () {
        this.shoppingCartComponent.addProductToCart(this.productId);
      },
      removeProductFromCart: function () {
        this.shoppingCartComponent.removeProductFromCart(this.productId);
      }
    },
    computed: {
      isProductAlreadyInCart: function () {
        return this.shoppingCartComponent.isProductAlreadyInCart(this.productId);
      }
    }
  }
</script>
