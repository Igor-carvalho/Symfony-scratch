(function ($) {
  'use strict';

  $(document).ready(function() {
    var sortable = new Sortable.default(document.querySelectorAll('.kanban-board__column-items'), {
      draggable: '.kanban-board__column-item',
      swapAnimation: {
        duration: 200,
        easingFunction: 'ease-in-out'
      },
      plugins: [Plugins.SwapAnimation]
    });
  });
})(jQuery);
