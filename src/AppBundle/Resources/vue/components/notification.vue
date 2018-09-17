<template>

</template>

<script>
  export default {
    methods: {
      showNotificaiton(type, message) {
        $.notify({
          message: message
        }, {
          type: type,
          delay: 1,
          placement: {
            from: "top",
            align: "center"
          },
        });
      },
      showNotificationSuccess(message) {
        this.showNotificaiton('success', message);
      },
      showNotificationError(message) {
        this.showNotificaiton('danger', message);
      },
      showNotificationInfo(message) {
        this.showNotificaiton('info', message);
      }
    }
  }
</script>
