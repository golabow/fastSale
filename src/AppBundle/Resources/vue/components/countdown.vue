<template>
  <span v-bind:id="id"></span>
</template>

<script>
  import 'jquery-countdown';
  export default {
    props: {
      id: {
        type: String
      }
    },
    created: function () {
      var i = '#' + this.id;
      var d = new Date();
      var y = d.getFullYear();
      var m = d.getMonth() + 1;
      m = m > 10 ? '0' + m : m;
      var d = d.getDate() + 1;
      $('document').ready(function () {
        $(i).countdown(y+'/'+m+'/'+d, function (event) {
          $(this).html(event.strftime('%H:%M:%S'));
        });
      })
    }
  }
</script>
