var nEditing = null;
var oTable = null;
var txtEdit = 'Edit';
var txtSave = 'Save';
var msgError = "Missing the values";
var msgErrorEmptyName = "Missing the name";

function setLiveStream(channel){

        var name = channel.name;
        var live = channel.hasOwnProperty('active') ? 'active' : 'idle';
        // var bw_in = byteToHuman(channel.bw_in);
        // var bw_out = byteToHuman(channel.bw_out);
        // var bytes_in = byteToHuman(channel.bytes_in);
        // var bytes_out = byteToHuman(channel.bytes_out);

        var bw_video = formatBytes(channel.bw_video);
        var time  = getTime(channel.time / 1000);
        // var viewers = numeral(channel.nclients).format('0,0');
        // var resolution = channel.meta.video.width + " X " + channel.meta.video.height;

        var classUrl = md5(channel.urlRtmp);
        var url = channel.urlRtmp;
        if(channel.urlHls != ''){
            url += "<br>" + channel.urlHls;
        }
        var tr = $('.' + classUrl);
        if(tr.length > 0){
            tr.find('.time').html(time);
            tr.find('.live').html('idle');
            tr.find('.live').html(live);
            if((channel.bw_video * 1024) <= 409600){
                tr.addClass('red');
            } else {
                tr.removeClass('red');
            }
        } else {
            var red = (channel.bw_video * 1024) <= 409600 ? 'red' :  '';
            var urlWatch = channel.urlHls ? channel.urlHls : channel.urlRtmp;
            tr = ['<tr class="' + classUrl + ' ' + red + '">',
                    '<td class="name text-align-lf">',
                        name,
                    '</td>',
                    '<td class="category"></td>',
                    '<td class="url text-align-lf">',
                        url,
                    '</td>',
                    '<td class="status">',
                        'Enabled',
                    '</td>',
                    '<td class="time text-align-rg">',
                        time,
                    '</td>',
                    '<td class="bw_video text-align-rg">',
                        bw_video,
                    '</td>',
                    '<td class="live">',
                        live,
                    '</td>',
                    '<td style="width: 151px !important;">',
                        '<a class="btn btn-xs btn-info edit" onclick="clickEdit(this);" data-name="' + name + '">Edit</a>',
                        "<a class=\"btn btn-xs btn-primary\" data-name=\"" + name + "\" id=\"channel-watch-" + name + "\" onclick=\"watchChannel('" + name + "', '"+ urlWatch +"','','' )\">Playback</a>",
                        '<a class="btn btn-xs btn-danger delete" data-href="delete_by_source">Delete</a>',
                    '</td>',
                '</tr>'];
            $('#tabla tr:last').before(tr.join(''));
        }
}

function getTime($time){
    $seg = $time / 1000;
    $d = Math.floor($seg / 86400);
    $h = Math.floor(($seg - ($d * 86400)) / 3600);
    $m = Math.floor(($seg - ($d * 86400) - ($h * 3600)) / 60);
    $s = $seg % 60;
    $result = [];
    if($d > 0){
        $result.push($d +" d");
    }
    if($h > 0){
        $result.push($h +" h");
    }
    if($m > 0){
        $result.push($m +" m");
    }
    if($s > 0){
        $result.push($s.toFixed() +" s");
    }
    return $result.join(' ');
}

function byteToHuman(bytes) {
    if(bytes == 0) return '0 Kb';
    var s = ['bytes', 'Kb', 'MB', 'GB', 'TB', 'PB'];
    var e = Math.floor(Math.log(bytes) / Math.log(1024));
    return (bytes / Math.pow(1024, e)).toFixed(2) + " " + s[e];
}

function formatBytes($bytes, $precision) {
    if(!$precision){
        $precision = 2;
    }
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;


    if (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return Math.round($bytes / $megabyte, $precision) + ' Mb';

    } else if (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return Math.round($bytes / $gigabyte, $precision) + ' Gb';

    } else if ($bytes >= $terabyte) {
        return Math.round($bytes / $terabyte, $precision) + ' Tb';
    } else {
//            return $bytes . ' b';
        return Math.round($bytes / $kilobyte, $precision) + ' Kb';
    }
}

function getHtmlOptions(data) {
    var html = '';
    $.each(data, function (i, item) {
        html += "<option value='" + item.value + "'>" + item.label + "</option>";
    });
    return html;
}
function getCatetegoryFromValue(value) {
    var category = '';
    $.each(caterories_combo, function (i, item) {
        if(item.value == value){
            category = item.label;
        }
    });
    return category;
}

var htmlOptionsCategories = getHtmlOptions(caterories_combo);


function restoreRow(nRow) {
    var aData = oTable.fnGetData(nRow);
    var jqTds = $('>td', nRow);
    for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
        oTable.fnUpdate(aData[i], nRow, i, false);
    }

    oTable.fnDraw();
}


function editRow(nRow) {
    var aData = oTable.fnGetData(nRow);
    var jqTds = $('>td', nRow);
    jqTds.innerHTML = '<input type="text" class="width-100 input-small" value="' + aData + '">';
    jqTds[1].innerHTML = '<input type="text" class="width-100 input-small" value="' + aData[1] + '">';
    console.log(aData);
    jqTds[2].innerHTML = '<select class="" style="padding: 0px;">' + htmlOptionsCategories + '</select>';

//             jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '" style="width: 100% !important;">';
//             jqTds[2].innerHTML = '<select class="form-control"><option value="AUD">Australian Dollar</option><option value="BHD">Bahraini Dinar</option><option value="GBP">British Pound</option><option value="BGN">Bulgarian Leva</option><option value="CAD">Canadian Dollar</option><option value="HRK">Croatian kuna</option><option value="CZK">Czech Koruna</option><option value="DKK">Danish Krone</option><option selected="" value="EUR">Euro</option><option value="HKD">Hong Kong Dollar</option><option value="HUF">Hungarian Forint</option><option value="ISK">Iceland Krona</option><option value="INR">Indian Rupee</option><option value="ILS">Israeli Shekel</option><option value="JPY">Japanese Yen</option><option value="JOD">Jordanian Dinar</option><option value="KWD">Kuwaiti dinar</option><option value="LTL">Lithuanian litas</option><option value="MYR">Malaysian Ringgit</option><option value="MAD">Moroccan Dirham</option><option value="TRY">New Turkish Lira</option><option value="NZD">New Zealand Dollar</option><option value="NOK">Norwegian Krone</option><option value="OMR">Omani Rial</option><option value="PLN">Polish Zloty</option><option value="QAR">Qatari Rial</option><option value="RON">Romanian Leu New</option><option value="SAR">Saudi Riyal</option><option value="RSD">Serbian dinar</option><option value="SGD">Singapore Dollar</option><option value="ZAR">South-African Rand</option><option value="KRW">South-Korean Won</option><option value="SEK">Swedish Krona</option><option value="CHF">Swiss Franc</option><option value="TWD">Taiwan Dollar</option><option value="THB">Thailand Baht</option><option value="TND">Tunisian Dinar</option><option value="USD">U.S. Dollar</option><option value="AED">Utd. Arab Emir. Dirham</option></select>';
//             jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '" style="width: 100% !important;"' + (aData[3] == '-' ? 'disabled' : '') + ' >';
    var status = aData[4] == 'Enabled' ? '1' : '0';
    var valueCheckbox = status == '1' ? 'checked' : '';
    // jqTds[3].innerHTML = '<input type="checkbox" class="form-control input-small" value="' + status + '" ' + valueCheckbox + '>';
    jqTds[4].innerHTML = '<input type="checkbox" onchange="$(this).attr(\'value\',$(this).attr(\'value\')==\'1\'?\'0\':\'1\');console.log(this.value);" value="' + status + '" ' + valueCheckbox + '>';

    // jqTds[3].innerHTML = '<input type="checkbox" onchange="$(this).attr(\'value\',$(this).attr(\'value\')==\'enabled\'?\'disabled\':\'enabled\');" class="" value="' + aData[3] + '"' + (aData[3] == 'enabled' ? 'checked' : '') + '>';
    jqTds[8].innerHTML = '<a class="edit btn btn-xs btn-info" onclick="clickEdit(this);" data-action="Save">' + txtSave + '</a><a class="cancel btn btn-xs btn-danger" onclick="cancelEdit();">Cancel</a>';
    // $(nRow).find('a.cancel').on('click', function(e) {
    //     cancelEdit();
    // });
}


function saveRow(nRow) {

    var jqInputs = $('input,select', nRow);
//                oTable.fnUpdate(jqInputs.value, nRow, 0, false);
//                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
//     oTable.fnUpdate(jqInputs.value, nRow, 1, false);
    oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
    oTable.fnUpdate(getCatetegoryFromValue(jqInputs[1].value), nRow, 2, false);
    // oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
    oTable.fnUpdate(jqInputs[2].value == '1' ? 'Enabled' : 'Disabled', nRow, 4, false);
    var aData = oTable.fnGetData(nRow);
    oTable.fnUpdate(aData[5], nRow, 5, false);
    oTable.fnUpdate(aData[6], nRow, 6, false);
    oTable.fnUpdate(aData[7], nRow, 7, false);
    oTable.fnUpdate(aData[8], nRow, 8, false);
    // oTable.fnUpdate('<a class="edit label label-info label-sm" href="">' + txtEdit + '</a>', nRow, 7, false);
    oTable.fnDraw();
}

function cancelEdit() {
    if(nEditing != null){
        restoreRow(nEditing);
    }
}

function clickEdit(el) {
    var nRow = $(el).parents('tr')[0];

    if (nEditing !== null && nEditing != nRow) {
        /* Currently editing - but not this row - restore the old before continuing to edit mode */
        restoreRow(nEditing);
        editRow(nRow);
        nEditing = nRow;
    } else if (nEditing == nRow && $(el).data("action") == "Save") {
        /* Editing this row and want to save it */
        var jqInputs = $('input,select', nEditing);
        // var method = $(this).parent('td').data('method');
        if (jqInputs.value == '') {
            toastr.error(msgError, 'Error');
            return false;
        }
        if (jqInputs[0].value == '') {
            toastr.error(msgErrorEmptyName, 'Error');
            return false;
        }
        $.ajax({
            type: "POST",
            url: $(el).parent('td').data('href'),
            data: { title: jqInputs[0].value, category_id: jqInputs[1].value, status: jqInputs[2].value},
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.success) {
                    saveRow(nEditing);
                    toastr.success(respuesta.msg);
                    nEditing = null;
                } else {
                    toastr.error(respuesta.msg);
                }
            },
            error: function(respuesta) {
            }
        });
    } else {
        /* No edit in progress - let's start one */
        editRow(nRow);
        nEditing = nRow;
    }
}
function listNumElementShow(cookieName) {
    var num_element_list = $.cookie(cookieName) || 10;
    $('.dataTables_length select').change(function (e) {
        $.cookie(cookieName, $(this).val());
    });
    $('.dataTables_length select').val(num_element_list);
    $('.dataTables_length select').change();
}


// oTable = $("#tabla").dataTable({
//     'aLengthMenu':[[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
//     "bStateSave": true
// });

if($(".datatable").length){
    $(".datatable").each(function(){
        oTable = $(this).dataTable({
            'aLengthMenu':[[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "bStateSave": true
        });

        // show_inner(dtable,$(this),{},"html");
    });

}
$(function () {
    if (typeof io != "undefined") {
        var socket = io.connect('//:' + nodeJsPort);

        socket.on('reconnect',function() {
            // system_success_message('Server is UP!');
        });

        socket.on('disconnect',function() {
            // system_error_message("Server is down. ");
            // system_is_down();
        });

        socket.on('connect',function() {
            // system_is_live();
        });

        socket.on('error', function(data){
            if(data.error)
            {
                // system_error_message("Please wait a little bit or contact technical support. ");
                // system_is_down();
            }else{
                // system_hide_message();
                // system_is_live();
            }
        });


        socket.on('statistics', function(data){
            console.log(data);
            var stat = JSON.parse(data.stat);
            var applications = stat.rtmp.server.application;
            applications.forEach(function (application) {
                var applicationName = application.name;
                if(application.live){
                    if(application.live.stream){
                        var stream = application.live.stream;
                        if(!Array.isArray(stream)){
                            stream = [stream];
                        }
                        stream.forEach(function (channel) {
                            console.log(channel);
                            //Url Rtmp
                            var urlRtmp = data.rtmp_server_address + '/' + applicationName + '/' + channel.name;
                            var urlHls = "";
                            if(applicationName == 'webpanel'){
                                //Url HLS
                                urlHls = data.hls_server_address + '/streamext/' + channel.name + '/index.m3u8';
                            }
                            channel.urlRtmp = urlRtmp;
                            channel.urlHls = urlHls;
                            channel.application = applicationName;
                            setLiveStream(channel);
                        });
                    }
                }
            });
        });
    } else {
        console.log("daemon down")
    }





        // oTable = $('#tabla').dataTable({
        //     "aLengthMenu": [
        //         [10, 25, 50, 100, -1],
        //         [10, 25, 50, 100, "All"] // change per page values here
        //     ],
        //     "aoColumnDefs": [
        //         //{"bSortable": false, "aTargets": [5]}
        //     ],
        //     // set the initial value
        //     // "iDisplayLength": -1,
        //     "sPaginationType": "bootstrap",
        //     "oLanguage": {
        //         "sLengthMenu": "_MENU_ ",
        //         "oPaginate": {
        //             "sPrevious": "Prev",
        //             "sNext": "Next"
        //         }
        //     }
        // });

        // jQuery('#tabla_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
        // jQuery('#tabla_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        // jQuery('#tabla_wrapper .dataTables_length select').select2({
        //     showSearchInput: false //hide search box with special css class
        // }); // initialize select2 dropdown

        // $("#tabla_wrapper .row:first").addClass("hidden");


        // $('#tabla a.cancel').on('click', function(e) {
        //     cancelEdit();
        // });

});
