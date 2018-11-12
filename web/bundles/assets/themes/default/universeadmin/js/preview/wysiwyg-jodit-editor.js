(function ($) {
  'use strict';

  $(document).ready(function() {
    var editor = new Jodit('#editor', {
      height: '94%',
      uploader: {
        url: 'https://xdsoft.net/jodit/connector/index.php?action=fileUpload'
      },
      filebrowser: {
        ajax: {
          url: 'https://xdsoft.net/jodit/connector/index.php'
        }
      }
    });
  });
})(jQuery);
