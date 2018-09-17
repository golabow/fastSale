<script>
  export default {
    methods: {
      sendAjaxRequest: function (url, options) {
        $.when(
                $.ajax(
                        url,
                        $.extend(true, {}, {
                          method: 'GET',
                          data: {},
                        }, options))
                .done($.proxy(function (response) {
                  this.afterSave(response.actions);
                }, this)));
      },
      afterSave: function (actions) {
        for (var i in actions) {
          var action = actions[i];

          var f = function () {};
          switch (action.action) {
            case 'notification':
              f = $.proxy(function () {
                this.$root.getNotificationComponent().showNotificaiton(action.config.type, action.config.message);
              }, this);
              break;
            case 'refreshPage':
              f = $.proxy(function () {
                window.location.reload()
              }, this);
              break;
            case 'redirect':
              f = $.proxy(function () {
                window.location.replace(action.config.url);
              }, true);
              break;
            case 'updateVariable':
              f = $.proxy(function () {
                this[action.config.variableName] = action.config.variableVal;
              }, this);
              break;
            case 'updateVariableDecodeJson':
              f = $.proxy(function () {
                this[action.config.variableName] = JSON.parse(action.config.variableVal);
              }, this);
              break;
            case 'extendVariable':
              f = $.proxy(function () {
                this[action.config.variableName] = $.extend({}, this[action.config.variableName], action.config.variableVal);
              }, this);
              break;
          }

          if (action.config.hasOwnProperty('sleep') === true) {
            setTimeout(f, action.config.sleep * 1000);
          } else {
            f();
          }
        }
      },
    }
  }
</script>
