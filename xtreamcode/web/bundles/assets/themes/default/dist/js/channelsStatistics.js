/**
 * Created by dani on 6/10/15.
 */
$(function () {
    var formatBytes = function(bytes, precision = 2){
        var kilobyte = 1024;
        var megabyte = kilobyte * 1024;
        var gigabyte = megabyte * 1024;
        var terabyte = gigabyte * 1024;

        if ((bytes >= megabyte) && (bytes < gigabyte)) {
            return Math.round(bytes / megabyte, precision) + ' Mb';
        } else if ((bytes >= gigabyte) && (bytes < terabyte)) {
            return Math.round(bytes / gigabyte, precision) + ' Gb';
        } else if (bytes >= terabyte) {
            return Math.round(bytes / terabyte, precision) + ' Tb';
        } else {
            return Math.round(bytes / kilobyte, precision) + ' Kb';
        }
    }

    // var listRowsChannelsStats = function (applicationName, channel) {
    //     var tags = '';
    //     var classCSS = "red";
    //     var bgColor = channel.active?"#cccccc":"#dddddd";
    //     var active = channel.active?"active":"idle";
    //     var audioProfile = '';
        
    //     if(channel.bw_video <= 204800)
    //         classCSS = "red";
        
    //     if(channel.bw_video <= 614400)
    //         classCSS = "yellow";

    //     if(channel.meta.audio.profile)
    //         audioProfile = channel.meta.audio.profile;

    //     tags = '<tr valign="top" class="'+classCSS+'" bgcolor="'+bgColor+'">\
    //                 <td>\
    //                     <a onclick="var d=document.getElementById("'+applicationName+'-'+channel.name+'");\
    //                             d.style.display=d.style.display=="none"?"":"none";return false" style="cursor: pointer;">\
    //                         '+channel.name+'\
    //                     </a>\
    //                 </td>\
    //                 <td align="middle">'+channel.nclients+'</td>\
    //                 <td>'+channel.meta.video.codec + ' ' +  channel.meta.video.profile  + ' ' +  channel.meta.video.level+'</td>\
    //                 <td>\
    //                     '+formatBytes(channel.bw_video)+'/s\
    //                 </td>\
    //                 <td>'+channel.meta.video.width+'x'+channel.meta.video.height+'</td>\
    //                 <td>'+channel.meta.video.frame_rate+'</td>\
    //                 <td>\
    //                     '+channel.meta.audio.codec + ' ' + audioProfile+'\
    //                 </td>\
    //                 <td>'+formatBytes(channel.bw_audio)+'/s</td>\
    //                 <td>'+formatBytes(channel.meta.audio.sample_rate)+'</td>\
    //                 <td>'+formatBytes(channel.meta.audio.channels)+'</td>\
    //                 <td>'+formatBytes(channel.bytes_in)+'</td>\
    //                 <td>'+formatBytes(channel.bytes_out)+'</td>\
    //                 <td>'+formatBytes(channel.bw_in)+'/s</td>\
    //                 <td>'+formatBytes(channel.bw_out)+'/s</td>\
    //                 <td>'+active+'</td>\
    //                 <td>'+channel.time+'</td>\
    //             </tr>\
    //             <tr id="'+applicationName+'-'+channel.name+'" style="display:none">\
    //                 <td colspan="16" ngcolor="#eeeeee">\
    //                     <table cellspacing="1" cellpadding="5" width="85%">\
    //                         <tr>\
    //                             <th>Id</th>\
    //                             <th>State</th>\
    //                             <th>Address</th>\
    //                             <th>Flash version</th>\
    //                             <th>Page URL</th>\
    //                             <th>SWF URL</th>\
    //                             <th>Dropped</th>\
    //                             <th>Timestamp</th>\
    //                             <th>A-V</th>\
    //                             <th>Time</th>\
    //                         </tr>\
    //                     </table>\
    //                 </td>\
    //             </tr>';

    //     return tags;
    // }

    var showStatistic = function (datas) {
        for(var i = 0; i < datas.length; i++){
            if(datas[i].error)
                $("#panel-body-"+datas['id']).html(
                    '<div class="alert alert-error" style="padding: 3px 5px;text-align: center">\
                        <button style="padding-left: 10px" type="button" class="close" data-dismiss="alert">&times;</button>'
                        +datas[i].data+
                    '</div>'
                );
            else{
                var data = datas[i].data;
                var application = data.server.application;
                var id = datas[i].id;
               
                $("#nameServer-" + id).html(datas[i].server.name + '( ' + datas[i].server.ip + ' )');
                $(".naccepted-" + id).html(data.naccepted);

                $("#bytes_in-" + id).html(formatBytes(data.bytes_in));
                $("#bytes_out-" + id).html(formatBytes(data.bytes_out));
                $("#bw_in-" + id).html(formatBytes(data.bw_in) + '/s');
                $("#bw_out-" + id).html(formatBytes(data.bw_out) + '/s');
                $("#uptime-" + id).html(data.uptime);

                for(var j = 0; j < application.length; j++){
                    $(".applicationName-" + id).html(application[j].name);
                            
                    if(application[j].live != undefined){
                        $("#appNclients-" + id).html(application[j].live.nclients);
                                    
                        if(application[j].live.stream != undefined){
                            var channels = application[j].live.stream;

                            if(channels.length > 1){
                                for(var k = 0; k < channels.length; k++){
                                    var bgColor = channels[k].active?"#cccccc":"#dddddd";
                                    var active = channels[k].active?"active":"idle";
                                    var audioProfile = '';
                                    
                                    if(channels[k].bw_video <= 204800){
                                        $("#channelsRow-" + id).addClass('red');
                                        $("#channelsRow-" + id).removeClass('yellow');
                                    }
                                        
                                    if(channels[k].bw_video <= 614400){
                                        $("#channelsRow-" + id).addClass('yellow');
                                        $("#channelsRow-" + id).removeClass('red');
                                    }
                                    
                                    if(channels[k].meta.audio.profile)
                                        audioProfile = channels[k].meta.audio.profile;

                                    $("#channelsRow-" + id).attr("bgcolor", bgColor);

                                    $("#nclients-" + id).html(channels[k].nclients);
                                    $("#vCodecPL-" + id).html(channels[k].meta.video.codec + channels[k].meta.video.profile + channels[k].meta.video.level);
                                    $("#bw_video-" + id).html(formatBytes(channels[k].bw_video));
                                    $("#wh-" + id).html(channels[k].meta.video.width+'x'+channels[k].meta.video.height);
                                    $("#frame_rate-" + id).html(channels[k].meta.video.frame_rate);
                                    $("#aCodecP-" + id).html(channels[k].meta.audio.codec+' '+ audioProfile);

                                    $("#channelBw_audio-" + id).html(formatBytes(channels[k].bw_audio) + '/s');
                                    $("#sample_rate-" + id).html(channels[k].meta.audio.sample_rate);
                                    $("#channels-" + id).html(channels[k].meta.audio.channels);

                                    $("#channelBytes_in-" + id).html(formatBytes(channels[k].bytes_in));
                                    $("#channelBw_out-" + id).html(formatBytes(channels[k].bytes_out));
                                    $("#channelBw_in-" + id).html(formatBytes(channels[k].bw_in) + '/s');
                                    $("#channelBw_out-" + id).html(formatBytes(channels[k].bw_out) + '/s');
                                    
                                    $("#active-" + id).html(active);
                                    $("#time-" + id).html(channels[k].time);

                                    if(channels[k].client.length > 1){
                                        var clients = channels[k].client;

                                        for(var l = 0; l < clients.length; l++){
                                            var bgColorClient = clients[l].publishing!=undefined?"#cccccc":"#eeeeee";
                                            var publishing = clients[l].publishing!=undefined?"publishing":"playing";
                                            var address = clients[l].address!=undefined?'<a target="_blank" title="whois" href="http://apps.db.ripe.net/search/query.html&#63;searchtext='+clients[l].address+'">'+clients[l].address+'</a>':"";
                                            var flashver = clients[l].flashver!=undefined?clients[l].flashver:"";
                                            var pageurl = clients[l].pageurl!=undefined?clients[l].pageurl:"";
                                            var swfurl = clients[l].swfurl!=undefined?clients[l].swfurl:"";
                                            var dropped = clients[l].dropped!=undefined?clients[l].dropped:"";
                                            var timestamp = clients[l].timestamp!=undefined?clients[l].timestamp:"";
                                            var avsync = clients[l].avsync!=undefined?clients[l].avsync:"";
                                            var time = clients[l].time!=undefined?clients[l].time:"";
                                            
                                            $("#channelClients-" + id).attr("bgcolor", bgColor);
                                            $("#publishing-" + id).html(publishing);
                                            $("#address-" + id).html(address);
                                            $("#flashver-" + id).html(flashver);
                                            $("#pageurl-" + id).html(pageurl);
                                            $("#swfurl-" + id).html(swfurl);
                                            $("#dropped-" + id).html(dropped);
                                            $("#timestamp-" + id).html(timestamp);
                                            $("#avsync-" + id).html(avsync);
                                            $("#time-" + id).html(time);
                                        }
                                    }
                                    else{
                                        var clients = channels[k].client;

                                        var bgColorClient = clients.publishing!=undefined?"#cccccc":"#eeeeee";
                                        var publishing = clients.publishing!=undefined?"publishing":"playing";
                                        var address = clients.address!=undefined?'<a target="_blank" title="whois" href="http://apps.db.ripe.net/search/query.html&#63;searchtext='+clients.address+'">'+clients.address+'</a>':"";
                                        var flashver = clients.flashver!=undefined?clients.flashver:"";
                                        var pageurl = clients.pageurl!=undefined?clients.pageurl:"";
                                        var swfurl = clients.swfurl!=undefined?clients.swfurl:"";
                                        var dropped = clients.dropped!=undefined?clients.dropped:"";
                                        var timestamp = clients.timestamp!=undefined?clients.timestamp:"";
                                        var avsync = clients.avsync!=undefined?clients.avsync:"";
                                        var time = clients.time!=undefined?clients.time:"";
                                        
                                        $("#channelClients-" + id).attr("bgcolor", bgColor);
                                        $("#publishing-" + id).html(publishing);
                                        $("#address-" + id).html(address);
                                        $("#flashver-" + id).html(flashver);
                                        $("#pageurl-" + id).html(pageurl);
                                        $("#swfurl-" + id).html(swfurl);
                                        $("#dropped-" + id).html(dropped);
                                        $("#timestamp-" + id).html(timestamp);
                                        $("#avsync-" + id).html(avsync);
                                        $("#time-" + id).html(time);
                                    }
                                }
                            }
                            else{
                                var channel = channels;

                                var bgColor = channel.active?"#cccccc":"#dddddd";
                                var active = channel.active?"active":"idle";
                                var audioProfile = '';
                                
                                if(channel.bw_video <= 204800){
                                    $("#channelsRow-" + id).addClass('red');
                                    $("#channelsRow-" + id).removeClass('yellow');
                                }
                                    
                                if(channel.bw_video <= 614400){
                                    $("#channelsRow-" + id).addClass('yellow');
                                    $("#channelsRow-" + id).removeClass('red');
                                }
                                
                                if(channel.meta.audio.profile)
                                    audioProfile = channel.meta.audio.profile;

                                $("#channelsRow-" + id).attr("bgcolor", bgColor);

                                $("#nclients-" + id).html(channel.nclients);
                                $("#vCodecPL-" + id).html(channel.meta.video.codec + channel.meta.video.profile + channel.meta.video.level);
                                $("#bw_video-" + id).html(formatBytes(channel.bw_video));
                                $("#wh-" + id).html(channel.meta.video.width+'x'+channel.meta.video.height);
                                $("#frame_rate-" + id).html(channel.meta.video.frame_rate);
                                $("#aCodecP-" + id).html(channel.meta.audio.codec+' '+ audioProfile);

                                $("#channelBw_audio-" + id).html(formatBytes(channel.bw_audio) + '/s');
                                $("#sample_rate-" + id).html(channel.meta.audio.sample_rate);
                                $("#channels-" + id).html(channel.meta.audio.channels);

                                $("#channelBytes_in-" + id).html(formatBytes(channel.bytes_in));
                                $("#channelBw_out-" + id).html(formatBytes(channel.bytes_out));
                                $("#channelBw_in-" + id).html(formatBytes(channel.bw_in) + '/s');
                                $("#channelBw_out-" + id).html(formatBytes(channel.bw_out) + '/s');
                                
                                $("#active-" + id).html(active);
                                $("#time-" + id).html(channel.time);

                                if(channel.client.length > 1){
                                    var clients = channel.client;

                                    for(var l = 0; l < clients.length; l++){
                                        var bgColorClient = clients[l].publishing!=undefined?"#cccccc":"#eeeeee";
                                        var publishing = clients[l].publishing!=undefined?"publishing":"playing";
                                        var address = clients[l].address!=undefined?'<a target="_blank" title="whois" href="http://apps.db.ripe.net/search/query.html&#63;searchtext='+clients[l].address+'">'+clients[l].address+'</a>':"";
                                        var flashver = clients[l].flashver!=undefined?clients[l].flashver:"";
                                        var pageurl = clients[l].pageurl!=undefined?clients[l].pageurl:"";
                                        var swfurl = clients[l].swfurl!=undefined?clients[l].swfurl:"";
                                        var dropped = clients[l].dropped!=undefined?clients[l].dropped:"";
                                        var timestamp = clients[l].timestamp!=undefined?clients[l].timestamp:"";
                                        var avsync = clients[l].avsync!=undefined?clients[l].avsync:"";
                                        var time = clients[l].time!=undefined?clients[l].time:"";
                                        
                                        $("#channelClients-" + id).attr("bgcolor", bgColorClient);
                                        $("#publishing-" + id).html(publishing);
                                        $("#address-" + id).html(address);
                                        $("#flashver-" + id).html(flashver);
                                        $("#pageurl-" + id).html(pageurl);
                                        $("#swfurl-" + id).html(swfurl);
                                        $("#dropped-" + id).html(dropped);
                                        $("#timestamp-" + id).html(timestamp);
                                        $("#avsync-" + id).html(avsync);
                                        $("#time-" + id).html(time);
                                    }
                                }
                                else{
                                    var clients = channel.client; 

                                    var bgColorClient = clients.publishing!=undefined?"#cccccc":"#eeeeee";
                                    var publishing = clients.publishing!=undefined?"publishing":"playing";
                                    var address = clients.address!=undefined?'<a target="_blank" title="whois" href="http://apps.db.ripe.net/search/query.html&#63;searchtext='+clients.address+'">'+clients.address+'</a>':"";
                                    var flashver = clients.flashver!=undefined?clients.flashver:"";
                                    var pageurl = clients.pageurl!=undefined?clients.pageurl:"";
                                    var swfurl = clients.swfurl!=undefined?clients.swfurl:"";
                                    var dropped = clients.dropped!=undefined?clients.dropped:"";
                                    var timestamp = clients.timestamp!=undefined?clients.timestamp:"";
                                    var avsync = clients.avsync!=undefined?clients.avsync:"";
                                    var time = clients.time!=undefined?clients.time:"";
                                    
                                    $("#channelClients-" + id).attr("bgcolor", bgColorClient);
                                    $("#publishing-" + id).html(publishing);
                                    $("#address-" + id).html(address);
                                    $("#flashver-" + id).html(flashver);
                                    $("#pageurl-" + id).html(pageurl);
                                    $("#swfurl-" + id).html(swfurl);
                                    $("#dropped-" + id).html(dropped);
                                    $("#timestamp-" + id).html(timestamp);
                                    $("#avsync-" + id).html(avsync);
                                    $("#time-" + id).html(time);
                                }
                            }
                        }
                    }       
                }   
            }
        }
    }
    
    // var showStatistic = function (datas) {
    //     var parentTag = $("#table-container");
    //     var trTag = '';

    //     for(var i = 0; i < datas.length; i++){
    //         if(datas[i].error)
    //             parentTag.html(
    //                 '<div class="alert alert-error" style="padding: 3px 5px;text-align: center">\
    //                     <button style="padding-left: 10px" type="button" class="close" data-dismiss="alert">&times;</button>'
    //                     +datas[i].data+
    //                 '</div>'
    //             );
    //         else{
    //             var data = datas[i].data;
    //             var application = data.server.application;

    //             for(var j = 0; j < application.length; j++){
    //                 trTag = '<tr bgcolor="#999999">\
    //                             <td>\
    //                                 <b>'+application[j].name+'</b>\
    //                             </td>\
    //                         </tr>';
                            
    //                 if(application[j].live != undefined){
    //                     trTag += '<tr bgcolor="#aaaaaa">\
    //                                 <td>\
    //                                     <i>live streams</i>\
    //                                 </td>\
    //                                 <td align="middle">\
    //                                     '+application[j].live.nclients+'\
    //                                 </td>\
    //                               </tr>';
                                 
    //                     if(application[j].live.stream != undefined){
    //                         var channels = application[j].live.stream;

    //                         if(channels.length > 1){
    //                             for(var k = 0; k < channels.length; k++)
    //                                 trTag += listRowsChannelsStats(application[j].name, channels[k]);
    //                         }
    //                         else
    //                            trTag += listRowsChannelsStats(application[j].name, channels);
    //                     }
    //                 }       
    //             }   
                
                
                
    //             parentTag.html(
    //                 '<div class="panel-group" id="accordion-'+i+'" role="tablist" aria-multiselectable="true">\
    //                     <div class="panel panel-default">\
    //                         <div class="panel-heading" role="tab" id="heading-'+i+'">\
    //                         <h4 class="panel-title">\
    //                             <a data-toggle="collapse" data-parent="#accordion-'+i+'" href="#collapse-'+i+'" aria-expanded="false" aria-controls="collapse-'+i+'">\
    //                                 <span class="fa fa-calendar pull-left"></span>'
    //                                     + datas[i].server.name + '(' + datas[i].server.ip + ')\
    //                                 <span class="badge pull-right">' + data.naccepted +'</span>\
    //                             </a>\
    //                         </h4>\
    //                         </div>\
    //                         <div id="collapse-'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-'+i+'">\
    //                         <div class="panel-body">\
    //                             <table  cellspacing="'+i+'" cellpadding="5" width="100%">\
    //                                 <tr bgcolor="#999999">\
    //                                     <th>RTMP</th>\
    //                                     <th>'+num_clients+'</th>\
    //                                     <th colspan="4">'+video+'</th>\
    //                                     <th colspan="4">'+audio+'</th>\
    //                                     <th>'+in_bytes+'</th>\
    //                                     <th>'+out_bytes+'</th>\
    //                                     <th>'+in_bitss+'</th>\
    //                                     <th>'+out_bitss+'</th>\
    //                                     <th>'+state+'</th>\
    //                                     <th>'+time+'</th>\
    //                                 </tr>\
    //                                 <tr>\
    //                                     <td colspan="2">'+accepted+': ' + data.naccepted + '</td>\
    //                                     <th bgcolor="#999999">codec</th>\
    //                                     <th bgcolor="#999999">bits/s</th>\
    //                                     <th bgcolor="#999999">size</th>\
    //                                     <th bgcolor="#999999">fps</th>\
    //                                     <th bgcolor="#999999">codec</th>\
    //                                     <th bgcolor="#999999">bits/s</th>\
    //                                     <th bgcolor="#999999">freq</th>\
    //                                     <th bgcolor="#999999">chan</th>\
    //                                     <td >'+formatBytes(data.bytes_in)+'</td>\
    //                                     <td >'+formatBytes(data.bytes_out)+'</td>\
    //                                     <td >'+formatBytes(data.bytes_out)+'/s</td>\
    //                                     <td >'+formatBytes(data.bytes_out)+'/s</td>\
    //                                     <td ></td>\
    //                                     <td >'+data.uptime * 1000+'</td>\
    //                                 </tr>\
    //                                 '+trTag+'\
    //                             </table>\
    //                         </div>\
    //                         </div>\
    //                     </div>\
    //                 </div>'
    //             );
    //         }    
    //     }
    // };

    var refreshInterval = '5000';
    var enabledRefresh = true;
    var interval;

    var start = function(){
        $.ajax({
            type: "POST",
            url: url,
            data: {},
            dataType: "json",
            success: function (response) {
                console.info(response.datas);
                showStatistic(response.datas);
            },
            error: function (respuesta) {
                toastr.error("", "Error");
            }
        });
    };

    var cron = function(){
        interval = setInterval(function () {
            if(enabledRefresh)
                start();
        }, refreshInterval); 
    };

    $("#enabledRefresh").on({
        ifChecked: function () {
            enabledRefresh = true;
        },

        ifUnchecked: function () {
            enabledRefresh = false;
        }
    });

    $("#refreshInterval").on({
        change: function () {
            refreshInterval = $(this).val();
            console.info(refreshInterval);
            clearInterval(interval);

            cron();
        }
    });
   
    $(document).on("ready", function (e) {
        cron();
    });
});