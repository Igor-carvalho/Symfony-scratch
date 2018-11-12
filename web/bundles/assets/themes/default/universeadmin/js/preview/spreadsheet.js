(function ($) {
  'use strict';

  $(document).ready(function() {
    var data = [
      ['Mazda', 2001, 2000],
      ['Pegeout', 2010, 5000],
      ['Honda Fit', 2009, 3000],
      ['Honda CRV', 2010, 6000]
    ];

    $('#spreadsheet-ex1').jexcel({
      data: data,
      colHeaders: ['Model', 'Price', 'Price' ],
      colWidths: [ 300, 80, 100 ],
      minDimensions: [10, 35]
    });
  });
})(jQuery);
