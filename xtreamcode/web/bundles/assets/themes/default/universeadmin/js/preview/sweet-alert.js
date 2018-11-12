(function ($) {
  'use strict';

  $(document).ready(function() {
    $('#preview-example1').on('click', function() {
      swal({
        title: "Hello world!"
      });
    });

    $('#preview-example2').on('click', function() {
      swal("Here's the title!", "...and here's the text!");
    });

    $('#preview-example3').on('click', function() {
      swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        buttons: true
      });
    });

    $('#preview-example4').on('click', function() {
      swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "warning",
        buttons: true
      });
    });

    $('#preview-example5').on('click', function() {
      swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "error",
        buttons: true
      });
    });

    $('#preview-example6').on('click', function() {
      swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "info",
        buttons: true
      });
    });

    $('#preview-example7').on('click', function() {
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(function (willDelete) {
        if (willDelete) {
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success"
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    });

    $('#preview-example8').on('click', function() {
      swal({
        text: 'Search for a movie. e.g. "La La Land".',
        content: "input",
        button: {
          text: "Search!",
          closeModal: false
        }
      }).then(function (willDelete) {
        if (willDelete) {
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success"
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    });
  });
})(jQuery);
