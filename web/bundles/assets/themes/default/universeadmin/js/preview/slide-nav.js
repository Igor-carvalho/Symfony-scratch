(function ($) {
  'use strict';

  $(document).ready(function() {
    var slideNav = $('.slide-nav');

    $('.slide-nav__back').on('click', function () {
      slideNav.removeClass('is-opened');

      return false;
    });

    $('.slide-nav-toggle').on('click', function (e) {
      slideNav.toggleClass('is-opened');
    });

    $(document).on('click', function (e) {
      if (!$(e.target).closest('.slide-nav').length && !$(e.target).hasClass('slide-nav-toggle')) {
        $('.slide-nav').removeClass('is-opened');
      }
    });
  });
})(jQuery);
