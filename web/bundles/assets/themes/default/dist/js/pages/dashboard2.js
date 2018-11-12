$(function () {

    'use strict';

    setInterval(function () {     
        $.ajax({
            type: "POST",
            url: playbackword,
            data: {},
            dataType: "json",
            success: function(map_data) {
                $("#loading").remove()
                $('#world-map').empty();
                $('.jqvmap-label').remove();
                jQuery('#world-map').vectorMap({
                    map: 'world_en',
                    backgroundColor: '#E2E9E6',
                    color: '#ffffff',
                    hoverOpacity: 0.7,
                    selectedColor: '#666666',
                    enableZoom: false,
                    showTooltip: true,
                    values: map_data,
                    scaleColors: ['#C8EEFF', '#E02222'],
                    normalizeFunction: 'polynomial',                   
                    onLabelShow: function(element, label, country){
                        var countryText = label.text();
                        countryText = countryText.split(" ");
                        label.text('');
                        label.text(countryText[0] + " " + (map_data[country] || 0 ) + " playback");
                    }
                });
            },
            error: function(respuesta) {
            }
        });
    }, 10000);

    function channels() {
        $.ajax({type: "POST", url: 'dashboard/channels', dataType: "json", success: function(response) {
            var ffmpeg = response.data.total;
            $('#ffmpeg-running .chart').html('<div class="number ffmpeg-channels-running centrar" data-percent="' + ffmpeg.running + '"><span>' + ffmpeg.total.running + "/" + ffmpeg.total.total + '</span></div>');
            $('#ffmpeg-stop .chart').html('<div class="number ffmpeg-channels-stop centrar" data-percent="' + ffmpeg.stop + '"><span>' + ffmpeg.total.stop + "/" + ffmpeg.total.total + '</span></div>');
            $('#ffmpeg-error .chart').html('<div class="number ffmpeg-channels-error centrar" data-percent="' + ffmpeg.error + '"><span>' + ffmpeg.total.error + "/" + ffmpeg.total.total + '</span></div>');

            initMiniCharts();

            var e = 3000;
            var d = true;

            setInterval(function() {
                if (d) {
                    d = false;
                    channels();
                }
            }, e)
        }, error: function(f) {
        }});
    }

    function initMiniCharts() {
//VLC
        $('.easy-pie-chart .number.vlc-channels-running').easyPieChart({
            // animate: 1000, size: 150, lineWidth: 3, barColor: App.getLayoutColorCode("green")
            animate: 1000, size: 150, lineWidth: 3, barColor: '#3c763d'
        });

        $('.easy-pie-chart .number.vlc-channels-stop').easyPieChart({
            // animate: 100, size: 150, lineWidth: 3, barColor: App.getLayoutColorCode("red")
            animate: 100, size: 150, lineWidth: 3, barColor: '#843534'
        });
        $('.easy-pie-chart .number.vlc-channels-error').easyPieChart({
            animate: 100, size: 150, lineWidth: 3, barColor: "#fcb322"
        });
//FFMPEG
        $('.easy-pie-chart .number.ffmpeg-channels-running').easyPieChart({
            // animate: 100, size: 150, lineWidth: 3, barColor: App.getLayoutColorCode("green")
            animate: 100, size: 150, lineWidth: 3, barColor: '#3c763d'
        });

        $('.easy-pie-chart .number.ffmpeg-channels-stop').easyPieChart({
            // animate: 100, size: 150, lineWidth: 3, barColor: App.getLayoutColorCode("red")
            animate: 100, size: 150, lineWidth: 3, barColor: '#843534'
        });
        $('.easy-pie-chart .number.ffmpeg-channels-error').easyPieChart({
            animate: 100, size: 150, lineWidth: 3, barColor: "#fcb322"
        });
    }

    initMiniCharts();
    //todo -- descomentar antes de enviar
    channels();    
});
