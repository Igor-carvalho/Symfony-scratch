(function ($) {
  'use strict';

  $(document).ready(function() {
    $('.settings-panel__close').on('click', function () {
      $('.settings-panel').removeClass('is-opened');
    });

    $('.settings-panel-control').on('click', function () {
      $('.settings-panel').addClass('is-opened');
    });

    $(document).on('click', function (e) {
      if (!$(e.target).closest('.settings-panel').length && !$(e.target).closest('.settings-panel-control').length) {
        $('.settings-panel').removeClass('is-opened');
      }
    });

    $('.js-settings-color :radio').on('click', function () {
      var parent = $(this).closest('.js-settings-color');
      var name = $(this).attr('name');

      $('.js-settings-color input[name="' + name + '"]').each(function () {
        $(this).closest('.js-settings-color').removeClass('is-checked');
      });

      parent.addClass('is-checked');

      var style = $(this).data('style');
      $('#stylesheet').attr('href', '/xtreamcode/bundles/assets/themes/default/universeadmin/css/' + style + '.min.css');
    });

    $('#collapse-sidebar').on('click', function () {
      if (!$('body').hasClass('sidebar-md')) {
        $(document).trigger('collapse-sidebar');
      }
    });

    $('#hide-sidebar').on('click', function () {
      if (!$('body').hasClass('sidebar-md') && !$('body').hasClass('sidebar-sm')) {
        $('body').toggleClass('sidebar-hidden');
      }
    });

    $('#full-height-sidebar').on('click', function () {
      $('body').toggleClass('sidebar-full-height');
    });

    $('#rounded-form-controls').on('click', function () {
      $('body').toggleClass('form-controls-rounded');
    });
  });
})(jQuery);
