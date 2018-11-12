(function ($) {
  'use strict';

  $(document).ready(function() {
    $('#radial-progress-ex1').circleProgress({
      value: 0.61,
      size: 120,
      startAngle: 1.5 * Math.PI,
      thickness: 4,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: {
        gradient: ['#ad7cf9', '#269af1']
      }
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .61) {
        progress = .61;
        $(this).find('.statistic-widget-f__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex2').circleProgress({
      value: 0.48,
      size: 120,
      startAngle: 1.5 * Math.PI,
      thickness: 4,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: {
        gradient: ['#ff6384', '#ffcd56']
      }
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .48) {
        progress = .48;
        $(this).find('.statistic-widget-f__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex3').circleProgress({
      value: 0.66,
      size: 120,
      thickness: 4,
      startAngle: 1.5 * Math.PI,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: {
        gradient: ['#7ecc2f', '#ffcd56']
      }
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .66) {
        progress = .66;
        $(this).find('.statistic-widget-f__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex4').circleProgress({
      value: 0.73,
      size: 120,
      thickness: 4,
      startAngle: 1.5 * Math.PI,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: {
        gradient: ['#4fc0e8', '#ffcd56']
      }
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .73) {
        progress = .73;
        $(this).find('.statistic-widget-f__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex5').circleProgress({
      value: 0.75,
      size: 90,
      thickness: 3,
      startAngle: 1.5 * Math.PI,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: '#4fc0e8'
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .75) {
        progress = .75;
        $(this).find('.statistic-widget-g__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex6').circleProgress({
      value: 0.75,
      size: 90,
      thickness: 3,
      startAngle: 1.5 * Math.PI,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: '#fb836f'
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .75) {
        progress = .75;
        $(this).find('.statistic-widget-g__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex7').circleProgress({
      value: 0.75,
      size: 90,
      thickness: 3,
      startAngle: 1.5 * Math.PI,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: '#ac92ea'
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .75) {
        progress = .75;
        $(this).find('.statistic-widget-g__chart-text').text(Math.round(100 * progress) + '%');
      }
    });

    $('#radial-progress-ex8').circleProgress({
      value: 0.75,
      size: 90,
      thickness: 3,
      startAngle: 1.5 * Math.PI,
      lineCap: 'round',
      emptyFill: '#e8ebef',
      fill: '#7ecc2f'
    }).on('circle-animation-progress', function(event, progress, stepValue) {
      if (progress >= .75) {
        progress = .75;
        $(this).find('.statistic-widget-g__chart-text').text(Math.round(100 * progress) + '%');
      }
    });
  });
})(jQuery);
