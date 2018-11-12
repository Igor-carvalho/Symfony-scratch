$(function () {
    var container = $(".for-transcoder");
    var keepOriginal = "transcoder"; 

    $(prefix + "rtmp").on({
        ifChecked: function () {
            updateStream(true);
        },

        ifUnchecked: function () {
            updateStream(true);
        }
    });
    
    $(prefix + "http").on({
        ifChecked: function () {
            updateStream(true);
        },

        ifUnchecked: function () {
            updateStream(true);
        }
    });

    $(prefix + "dash").on({
        ifChecked: function () {
            updateStream(true);
        },

        ifUnchecked: function () {
            updateStream(true);
        }
    });

    $(prefix + "hls").on({
        ifChecked: function () {
            if ($(prefix + "hlsVariant").prop("checked"))
                $(prefix + "hlsVariant").iCheck('toggle', function (node) { });

            updateStream(true);
        },

        ifUnchecked: function () {
            updateStream(true);
        }
    });

    $(prefix + "hlsVariant").on({
        ifChecked: function () {
            if ($(prefix + "hls").prop("checked"))
                $(prefix + "hls").iCheck('toggle', function (node) { });

            updateStream(true);
        },

        ifUnchecked: function () {
            updateStream(true);
        }
    });   

    $(prefix + "protocol").on({
        change: function () {
            updateStream(true);
        }
    });  

    $(prefix + "videoCodec").on({
        change: function () {
            console.info($(this).val());
            if($(this).val() == 'h264')            
              $(prefix + "profile").removeAttr("disabled");
            else
                $(prefix + "profile").attr("disabled", "");
        }
    });

    var a = Date.now();

    function updateStream(update) {
        var app_nginx = 'rtmp';
        var protocol = 'rtmp';
        var livehttp = '';

        if (view != 'import') {
            $.ajax({
                type: "POST", url: pre_add, dataType: "json", success: function (g) {
                    a = g.id;
                }, error: function (g) {
                    return 0
                }
            });
        }

        $(prefix + "rtmp")[0].checked = true;
       
        if ($(prefix + "rtmp")[0].checked && $(prefix + "dash")[0].checked)
            app_nginx = 'livedash';

        if ($(prefix + "rtmp")[0].checked && $(prefix + "hls")[0].checked)
            app_nginx = 'livehls';

        if (($(prefix + "rtmp")[0].checked && $(prefix + "hls")[0].checked && $(prefix + "dash")[0].checked) || ($(prefix + "hls")[0].checked && $(prefix + "dash")[0].checked))
            app_nginx = 'streams';

        if (($(prefix + "rtmp")[0].checked && $(prefix + "hlsVariant")[0].checked && $(prefix + "dash")[0].checked) || ($(prefix + "rtmp")[0].checked && $(prefix + "hlsVariant")[0].checked) || ($(prefix + "hlsVariant")[0].checked && $(prefix + "dash")[0].checked) || $(prefix + "hlsVariant")[0].checked)
            app_nginx = 'live';        

        if($(prefix + "http")[0].checked)
            protocol = 'http';       

        switch(protocol){
            case 'http':               
                livehttp = 'http://' + serverAddress + ':' + httpPort + '/publish';
            case 'rtmp':
                live = 'rtmp://' + serverAddress + ':' + rtmpPort + '/' + app_nginx;
            break;
        }
            
        if (view == 'import'){
            switch(protocol){
                case 'http':               
                    livehttp = livehttp + '/';
                case 'rtmp':
                    live = live + '/';
                break;
            }
        }                
        else if(view == 'new' || view == 'edit'){
            switch(protocol){
                case 'http':               
                    livehttp = livehttp + "/channel_" + a;
                case 'rtmp':
                    live = live + "/channel_" + a;      
                break;
            }
        }     
               
        if(view == 'new' || view == 'import' || update){
            protocol=='http'?$(".live_manage").val(live+'&'+livehttp):$(".live_manage").val(live);

            $("#app_nginx").val(app_nginx);
        }
    }

    var ini_prot = false;
    function protocol() {
        var e = $(this).val();

        update_option_audio_video(e);

        $(".live_manage").removeAttr("readonly");
        //        var lib = $('.lib:checked').val();
        var lib = (e === "rtmp" || e === "udp") ? "ffmpeg" : "vlc";

        if (e === "hls") {
            lib = $(".libs_manage").val();
        }

        $(".video_audio_codec_manage option").css({ display: "none" });
        $(".video_audio_codec_manage option." + e + "." + lib).css({ display: "block" });

        if (!editing || (editing && ini_prot)) {
            $(".video_audio_codec_manage option:selected").removeAttr("selected");
            $(".video_audio_codec_manage option." + e + "." + lib + ":first").attr("selected", "");
        }

        ini_prot = true;
        $(".lib-container").css({ display: "none" });

        if ($(this).val() === "hls") {
            if (!$(".only_audio_manager").prop("checked") && $(prefix + "allowTranscoder").prop("checked")) {
                $(".lib-container").css({ display: "" });
            }
        }

        $('.profile_manage option').each(function () {
            $(this).css({ display: "block" });
            $(this).removeAttr("selected");
        });

        $(".profile_manage option:first").attr("selected", "");

        if (view != 'import') {
            $.ajax({
                type: "POST", url: pre_add, dataType: "json", success: function (g) {
                    a = g.id;
                }, error: function (g) {
                    return 0
                }
            });
        }

        var d = servers[e];

        if (e == "http" || e == "rtsp") {
            $.ajax({
                type: "POST",
                url: http_next_port,
                data: { _type: e },
                dataType: "json",
                success: function (respuesta) {
                    if (e != real_protocol) {
                        if (view == 'import') {
                            $(".live_manage").val(respuesta.http);
                        } else {
                            $(".live_manage").val(respuesta.http + "channel_" + a);
                        }
                    } else {
                        $(".live_manage").val(real_live);
                    }
                },
                error: function (respuesta) {
                }
            });
        } else {
            if (e != real_protocol) {
                if (view == 'import') {
                    $(".live_manage").val(d);
                } else {
                    $(".live_manage").val(d + "channel_" + a + (e == "hls" ? "/index.m3u8" : (e == "udp" ? ".ts" : "")));
                }
            } else {
                $(".live_manage").val(real_live);
            }
        }

    }

    $(prefix + "keepOriginalType").on({
        change: function (e) {
            disable_all_edit_config();
            if ($(this).val() == 'transcoder') {
                enable_audio_edit_config();
                enable_video_edit_config();
                changeWaterManager();
                changeTextOverlayManager();
            } else if ($(this).val() == 'both') {
            } else if ($(this).val() == 'only_video') {
                enable_audio_edit_config();
            } else if ($(this).val() == 'only_audio') {
                enable_video_edit_config();
                changeWaterManager();
                changeTextOverlayManager();
            }
        }
    });

    $("#predefined_presets").on({
        change: function (e) {
            if($(this).val() == 'custom')
                $(prefix + "keepOriginalType").val(keepOriginal);
            else{
                keepOriginal = $(prefix + "keepOriginalType").val();
                $(prefix + "keepOriginalType").val("transcoder");
            }

            $(prefix + "keepOriginalType").change();
        }
    });

    var onlya_init = false
    var onlyAudio = function () {
        $(".only_audio_manager").on({
            ifChecked: function () {
                if (!editing || (editing && onlya_init)) {
                }
                onlya_init = true;
                $(".no-only-audio").css({ display: "none" });
                $(prefix + "keepOriginalType").attr('disabled', true);
            },
            ifUnchecked: function () {
                $(".no-only-audio").css({ display: "" });
                $(prefix + "keepOriginalType").removeAttr("disabled");
                $(prefix + "keepOriginalType").change();
            }
        });

        changeOnlyAudioManager();
    }

    function changeOnlyAudioManager() {
        $(".only_audio_manager").iCheck('toggle', function (node) { });
        $(".only_audio_manager").iCheck('toggle', function (node) { });
    }

    var water = function () {
        $(".water_manager").on({
            ifChecked: function () {
                enable_watermar_edit_config();
            },
            ifUnchecked: function () {
                disable_watermar_edit_config();
            }
        });
        
        changeWaterManager();
    }

    function changeWaterManager() {
        $(".water_manager").iCheck('toggle', function (node) { });
        $(".water_manager").iCheck('toggle', function (node) { });
    }

    var textOverlay = function () {
        $(".text_overlay_manager").on({
            ifChecked: function () {
                enable_overlaytext_edit_config();
            },
            ifUnchecked: function () {
                disable_overlaytext_edit_config();
            }
        });

        changeTextOverlayManager();
    }

    function changeTextOverlayManager() {
        $(".text_overlay_manager").iCheck('toggle', function (node) { });
        $(".text_overlay_manager").iCheck('toggle', function (node) { });
    }

    onlyAudio();
    updateStream(false);
    water();
    textOverlay();

    $(prefix + "keepOriginalType").change();

    changeAllowTrancoder();

    function changeAllowTrancoder() {
        $(prefix + "allowTranscoder").iCheck('toggle', function (node) { });
        $(prefix + "allowTranscoder").iCheck('toggle', function (node) { });
    }

    function change_status_video_edit_config(enable) {
        if (enable) {
            $(prefix + "videoCodec").removeAttr("disabled");
            $(prefix + "fps").removeAttr("readonly");
            $(prefix + "bitRate").removeAttr("disabled");
            $(prefix + "deinterlace").removeAttr("disabled");
            $(prefix + "timeShitf").removeAttr("disabled");
            $(prefix + "width").removeAttr("disabled");
            $(prefix + "height").removeAttr("disabled");
            $(prefix + "profile").removeAttr("disabled");
            $(prefix + "preset").removeAttr("disabled");
            $(prefix + "allowWaterMark").removeAttr("disabled");
            $(prefix + "allowTextOverlay").removeAttr("disabled");
        } else {
            $(prefix + "videoCodec").attr("disabled", "");
            $(prefix + "fps").attr("readonly", "");
            $(prefix + "bitRate").attr("disabled", "");
            $(prefix + "deinterlace").attr("disabled", "");
            $(prefix + "timeShitf").attr("disabled", "");
            $(prefix + "width").attr("disabled", "");
            $(prefix + "height").attr("disabled", "");
            $(prefix + "profile").attr("disabled", "");
            $(prefix + "preset").attr("disabled", "");
            $(prefix + "allowWaterMark").attr("disabled", "");
            $(prefix + "allowTextOverlay").attr("disabled", "");
        }
    }
    function enable_video_edit_config() {
        change_status_video_edit_config(true);
    }
    function change_status_audio_edit_config(enable) {
        if (enable) {
            $(prefix + "audioCodec").removeAttr("disabled");
            $(prefix + "audioMode").removeAttr("disabled");
            $(prefix + "audioSamplerate").removeAttr("disabled");
            $(prefix + "audioPids").removeAttr("disabled");
        } else {
            $(prefix + "audioCodec").attr("disabled", "");
            $(prefix + "audioMode").attr("disabled", "");
            $(prefix + "audioSamplerate").attr("disabled", "");
            $(prefix + "audioPids").attr("disabled", "");
        }
    }
    function enable_audio_edit_config() {
        change_status_audio_edit_config(true);
    }
    function change_status_watermark_edit_config(enable) {
        if (enable) {
             $( prefix + "waterPosition").removeAttr("disabled");            
             $( prefix + "waterPosition").attr("required","");           
             $( prefix + "fileWater").removeAttr("disabled");
             $( prefix + "fileWater").removeAttr("required");
        } else {
             $( prefix + "waterPosition").attr("disabled","");
             $( prefix + "waterPosition").removeAttr("required");
             $( prefix + "fileWater").attr("disabled","");            
             $( prefix + "fileWater").attr("required","");           
        }

    }
    function enable_watermar_edit_config() {
        change_status_watermark_edit_config(true);
    }
    function disable_watermar_edit_config() {
        change_status_watermark_edit_config(false);
    }
    function change_status_overlaytext_edit_config(enable) {
        if (enable) {
             $( prefix + "textOverlaySource").removeAttr("disabled");
             $( prefix + "textOverlaySize").removeAttr("disabled");
             $( prefix + "textOverlayColor").removeAttr("disabled");
             $( prefix + "textOverlayTop").removeAttr("disabled");
             $( prefix + "textOverlayLeft").removeAttr("disabled");
        } else {
             $( prefix + "textOverlaySource").attr("disabled","");
             $( prefix + "textOverlaySize").attr("disabled","");
             $( prefix + "textOverlayColor").attr("disabled","");
             $( prefix + "textOverlayTop").attr("disabled","");
             $( prefix + "textOverlayLeft").attr("disabled","");
        }

    }
    function enable_overlaytext_edit_config() {
        change_status_overlaytext_edit_config(true);
    }
    function disable_overlaytext_edit_config() {
        change_status_overlaytext_edit_config(false);
    }
    function change_status_logo_edit_config(enable) {
        if (enable) {
            $(prefix + "file").removeAttr("disabled");
        } else {
            $(prefix + "file").attr("disabled", "");
        }
    }
    function enable_logo_edit_config() {
        change_status_logo_edit_config(true);
    }
    function enable_all_edit_config() {
        change_status_video_edit_config(true);
        change_status_audio_edit_config(true);
        change_status_watermark_edit_config(true);
        change_status_overlaytext_edit_config(true);
    }
    function disable_all_edit_config() {
        change_status_video_edit_config(false);
        change_status_audio_edit_config(false);
        change_status_watermark_edit_config(false);
        change_status_overlaytext_edit_config(false);
    }

    $('#import_filem3u').change(function () {
        $('#show-file-selected').val($(this).val());
    });

    function update_option_audio_video(protocol) {
        var audio_codecs = codecs_audio[protocol];
        var video_codecs = codecs_video[protocol];

        populate_select($(prefix + "videoCodec"), video_codecs);
        populate_select($(prefix + "audioCodec"), audio_codecs);

        if (video_codec_edit != '') 
            $(prefix + "videoCodec").val(video_codec_edit);

        if (audio_codec_edit != '') 
            $(prefix + "audioCodec").val(audio_codec_edit);
    }

    function populate_select(select, options) {
        select.empty();

        $.each(options, function (i, item) {
            select.append("<option value='" + item.toLowerCase() + "'>" + item + "</option>");
        });
    }
});