/**
 * Created by dani on 6/10/15.
 */
$(function () {
    var updatestatus = function (channel) {
       
        var id = channel.id;
        var statusSource = channel.statusSource;
        var statusTarget = channel.statusTarget;
        var snapshot = channel.snapshot;
        var indicators = $(".channel-indicator-" + id);
        
        indicators.removeClass("text-on");
        indicators.removeClass("text-off");
        indicators.removeClass("text-error");

        var indicatorIn = $("#channel-indicator-in-" + id);
        var indicatorOut = $("#channel-indicator-out-" + id);
        var channelWatch = $("#channel-watch-" + id);
        
        indicatorIn.addClass("text-" + statusSource);
        indicatorOut.addClass("text-" + statusTarget);

        //btn-off si statusTarget off y btn-on  si on o error.
        if (statusTarget == "on" || statusTarget == "error") {
            if (channelWatch.hasClass("hidden"))
                channelWatch.removeClass('hidden');
        } else {
            if (!channelWatch.hasClass("hidden"))
                channelWatch.addClass('hidden');
        }

        var control = $("#" + id);
        if (statusTarget == "on" || statusTarget == "error") {
            if (!control.hasClass("proccessing")) {
                control.html(stop);
                control.addClass("btn-off");
                control.addClass("stop");
                control.removeClass("start");
                control.removeClass("btn-on");
            }
        } else {
            if (!control.hasClass("proccessing")) {
                control.html(start);
                control.addClass("start");
                control.addClass("btn-on");
                control.removeClass("stop");
                control.removeClass("btn-off");
            }
        }
    };

    var updateSnapshot = function (channel) {
        console.info('logo del canal ' + channel.name + ': ' + channel.logo);
        src = 'http://'+serverAddress+'/iptvtranscoderclient/uploads/' + channel.logo;
        $('#channel-'+channel.id).prop('src', src);
    };

    if (typeof io != "undefined") {
        var socket = io.connect('//:' + nodeJsPort);

        socket.on("status", function (data) {            
            data.channels.forEach(function (channel) {
                updatestatus(channel);
            });
        });
        
        socket.on("snapshot", function (data) {
            updateSnapshot(data);
        });
        
        socket.on("channel", function (data) {
            updatestatus(data);
        })
    } else {
        console.log("daemon down")
    }

    $(document).on("click", ".trascoder-control", function (e) {
        var $this = $(this);
        var url = "";
        if ($this.hasClass("start")) {
            url = $this.data("start");
            $this.html(starting)
        } else {
            $this.html(stopping);
            url = $this.data("stop")
        }
        if (!$this.hasClass("proccessing")) {
            $this.addClass("proccessing");
            $.ajax({
                type: "POST",
                url: url,
                data: {},
                dataType: "json",
                success: function (respuesta) {
                    $this.removeClass("btn-on");
                    $this.removeClass("btn-off");
                    $this.removeClass("btn-error");
                    $this.removeClass("proccessing");
                    
                    var indicators = $("#channel-indicator-out-" + $this.data("id"));
                    var channelWatch = $("#channel-watch-" + $this.data("id"));
                    
                    indicators.removeClass("text-on");
                    indicators.removeClass("text-off");
                    indicators.removeClass("text-error");
                    
                    if (respuesta.code == 200 || respuesta.code == 226) {
                        if ($this.hasClass("start")) {
                            $this.html(stop);
                            $this.addClass("btn-off");
                            $this.addClass("stop");
                            $this.removeClass("start");
                            indicators.addClass("text-on");
                            channelWatch.removeClass("hidden");
                        } else {
                            indicators.addClass("text-off");
                            channelWatch.addClass("hidden");
                            $this.addClass("start");
                            $this.removeClass("stop");
                            $this.html(start);
                            $this.addClass("btn-on");

                            $("#bitrate-video-" + $this.data("name")).html('0 Mb/s'); 
                            $("#bitrate-audio-" + $this.data("name")).html('0 Mb/s'); 
                        }
                        
                        toastr.success(respuesta.msg);
                        
                    } else {
                        if ($this.hasClass("start")) {
                            $this.html(start);
                            $this.addClass("btn-on");
                            indicators.addClass("text-off");
                            channelWatch.addClass("hidden");

                            $("#bitrate-video-" + $this.data("name")).html('0 Mb/s'); 
                            $("#bitrate-audio-" + $this.data("name")).html('0 Mb/s');
                        } else {
                            $this.addClass("btn-off");
                            indicators.addClass("text-on");
                            channelWatch.removeClass("hidden");
                            $this.html(stop)
                        }
                        if (respuesta.code == 400) {
                            indicators.addClass("text-off");
                            channelWatch.addClass("hidden");
                            $this.html(start);
                            $this.addClass("btn-on");
                            $this.removeClass("btn-off");
                            $this.removeClass("stop");
                            $this.addClass("start");
                        }

                        toastr.error(respuesta.msg);
                    }
                },
                error: function (respuesta) {
                    $this.removeClass("btn-on");
                    $this.removeClass("btn-off");
                    $this.removeClass("btn-error");
                    $this.removeClass("proccessing");

                    if ($this.hasClass("start")) {
                        $this.html(start);
                        $this.addClass("btn-on");
                    } else {
                        $this.addClass("btn-off");
                        $this.html(stop)
                    }
                    
                    toastr.error("", "Error");
                }
            });
        }
    });

    $(document).on("click", ".edit", function (e) {
        if ($("#" + $(this).data("id")).hasClass("stop")) {
            toastr.warning(warningStop);
            return false;
        }
        return true;
    });

});
