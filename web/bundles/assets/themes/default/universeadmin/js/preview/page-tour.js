(function ($) {
  'use strict';

  $(document).ready(function() {
    setTimeout(function () {
      var driver1 = new Driver({
        opacity: 0.5
      });
      driver1.highlight({
        element: '#page-tour-element',
        popover: {
          title: 'Did you now?',
          description: 'You can add HTML in title or description also!'
        }
      });
    }, 1200);

    $('#run-single-element-with-popover-position').on('click', function (e) {
      e.stopPropagation();

      var driver2 = new Driver({
        opacity: 0.5
      });
      driver2.highlight({
        element: '#popover-position',
        popover: {
          title: 'Did you now?',
          description: 'You can add HTML in title or description also!',
          position: 'top'
        }
      });
    });

    $('#run-single-element-with-popover-position-left').on('click', function (e) {
      e.stopPropagation();
      var driver3 = new Driver({
        opacity: 0.5
      });
      driver3.highlight({
        element: '#run-single-element-with-popover-position-left',
        popover: {
          title: 'Did you now?',
          description: 'You can add HTML in title or description also!',
          position: 'left'
        }
      });
    });

    $('#run-single-element-with-popover-position-top').on('click', function (e) {
      e.stopPropagation();
      var driver4 = new Driver({
        opacity: 0.5
      });
      driver4.highlight({
        element: '#run-single-element-with-popover-position-top',
        popover: {
          title: 'Did you now?',
          description: 'You can add HTML in title or description also!',
          position: 'top'
        }
      });
    });

    $('#run-single-element-with-popover-position-right').on('click', function (e) {
      e.stopPropagation();
      var driver5 = new Driver({
        opacity: 0.5
      });
      driver5.highlight({
        element: '#run-single-element-with-popover-position-right',
        popover: {
          title: 'Did you now?',
          description: 'You can add HTML in title or description also!',
          position: 'right'
        }
      });
    });

    $('#run-single-element-with-popover-position-bottom').on('click', function (e) {
      e.stopPropagation();
      var driver6 = new Driver({
        opacity: 0.5
      });
      driver6.highlight({
        element: '#run-single-element-with-popover-position-bottom',
        popover: {
          title: 'Did you now?',
          description: 'You can add HTML in title or description also!',
          position: 'bottom'
        }
      });
    });

    $('#introduction-demo').on('click', function (e) {
      e.stopPropagation();

      var driver7 = new Driver({
        opacity: 0.5
      });
      driver7.reset();
      // Define the steps for introduction
      driver7.defineSteps([
        {
          element: '#popover-feature-introduction-p1',
          popover: {
            title: 'Title on Popover 1',
            description: 'Body of the popover',
            position: 'top'
          }
        },
        {
          element: '#popover-feature-introduction-p2',
          popover: {
            title: 'Title on Popover 2',
            description: 'This is just use-case, make sure to check out the rest of the docs below',
            position: 'top'
          }
        }
      ]);

      // Start the introduction
      driver7.start();
    });

    $('#html-in-popover').on('click', function (e) {
      e.stopPropagation();

      var driver8 = new Driver({
        opacity: 0.5
      });
      driver8.highlight({
        element: '#html-in-popover-p1',
        popover: {
          title: '<em>An italicized title</em>',
          description: 'Description may also contain <strong>HTML</strong>',
          position: 'top'
        }
      });
    });
  });
})(jQuery);
