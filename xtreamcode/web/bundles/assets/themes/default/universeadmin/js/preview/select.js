(function ($) {
  'use strict';

  $(document).ready(function() {
    $('#selectbox-ex1').SumoSelect();
    $('#selectbox-ex2').SumoSelect();
    $('#selectbox-ex3').SumoSelect({
      okCancelInMulti: true
    });
    $('#selectbox-ex4').SumoSelect({
      selectAll: true
    });
  });
})(jQuery);
