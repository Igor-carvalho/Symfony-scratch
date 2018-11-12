(function ($) {
  'use strict';

  $(document).ready(function() {
    $('textarea.js-auto-size').textareaAutoSize();

    var map = L.map('m-social-feed-item-map').setView([51.505, -0.09], 13);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
  });
})(jQuery);
