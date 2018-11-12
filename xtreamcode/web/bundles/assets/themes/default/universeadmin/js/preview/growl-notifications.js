(function ($) {
  'use strict';

  require(['GrowlNotification'], function (module) {
    $(document).ready(function () {
      $('#show-notification-default-alert').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        var options = {
          title: 'Hello!',
          description: 'I am a default notification. I am a default notification. I am a default notification. I am a default notification.',
          position: position,
          closeTimeout: closeTimeout,
          closeWith: ['click'],
          animation: animationOptions
        };

        /*(new module.GrowlNotification(options)).show();*/
        module.GrowlNotification.notify(options);
      });

      $('#show-notification-default-success').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Well Done!',
          description: 'You just submit your resume successfully.',
          type: 'success',
          position: position,
          closeTimeout: closeTimeout,
          closeWith: ['button'],
          animation: animationOptions
        })).show();
      });

      $('#show-notification-default-error').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Warning!',
          description: 'The data presentation here can be change.',
          type: 'error',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-default-warning').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Reminder!',
          description: 'You have a meeting at 10:30 АМ',
          type: 'warning',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-default-info').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Sorry!',
          description: 'Could not complete your transaction.',
          image: 'img/notifications/05.png',
          type: 'info',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-icon-alert').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Hello!',
          description: 'I am a default notification.',
          image: 'img/notifications/01.png',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-icon-success').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Well Done!',
          description: 'You just submit your resume successfully.',
          image: 'img/notifications/03.png',
          type: 'success',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-icon-error').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Warning!',
          description: 'The data presentation here can be change.',
          image: 'img/notifications/04.png',
          type: 'error',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-icon-warning').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Reminder!',
          description: 'You have a meeting at 10:30 АМ',
          image: 'img/notifications/02.png',
          type: 'warning',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });

      $('#show-notification-icon-info').on('click', function () {
        var position = $('#notification-position').val();
        var closeTimeout = $('#close-timeout').val();
        var animation = $('#animation').val();
        var animationOptions = {
          open: animation + '-in',
          close: animation + '-out'
        };

        if (animation === 'none') {
          animationOptions = {
            open: false,
            close: false
          };
        }

        (new module.GrowlNotification({
          title: 'Sorry!',
          description: 'Could not complete your transaction.',
          image: 'img/notifications/05.png',
          type: 'info',
          position: position,
          closeTimeout: closeTimeout,
          animation: animationOptions
        })).show();
      });
    });
  });
})(jQuery);
