$(function(){
    $(".table-container").css({display:"none"})
    var itv = {};
    var record = {};
    var server = "";
    
    $("#form_update").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: {channels:itv,record:record},
            dataType: "json",
            success: function(respuesta) {
                if(respuesta.code == 200){
                    toastr.success(respuesta.msg, txtSuccess);
                    window.location = respuesta.url
                }else{
                    $("#modal-epg-1").remove();
                    $("#modal-epg-2").remove();
                    toastr.error(respuesta.msg, txtError);
                }
            },
            error: function(respuesta) {
            }
        });
    });

    var TableEpgAjax = function () {

        var dtableProgrammes = null,EPG = null;
        var programmes_url = null;

        var handleOn1 = function(){

            $("#table-channels ._programmes").on({
                click: function() {
                    $("#table-channels tr.active").removeClass("active")
                    $($(this).parents('tr')[0]).addClass("active")
                    if(dtableProgrammes){
                        //console.log(dtableProgrammes.getDataTable())
                        dtableProgrammes.getDataTable().fnDestroy();
                    }
                    programmes_url = $(this).data("href");
                    handleProgrammsRecords();
                }
            });

            $("#table-channels a.delete").on('click', function(e) {
                e.preventDefault();
                _delete(this,msgDelete,EPG)
            });


            $(".itv-select").on('change', function(e) {
                e.preventDefault();
                var name =$(this).attr("name");
                var val =$(this).val();
                itv[name] = val;
            });

            $(".record").on('change', function(e) {
                e.preventDefault();
                if($(this).prop("checked")){
                    record[$(this).attr("name")] =$(this).val()
                }else{
                    delete record[$(this).attr("name")];
                }
            });

            $("#server").on('change', function(e) {
                e.preventDefault();
                server =$(this).val();
            });
        };

        var handleOn2 = function(){
            $("#programmes_epg a.delete").on('click', function(e) {
                e.preventDefault();
                _delete(this,msgDelete2,dtableProgrammes)
            });
        };

        var handleRecords = function() {
            var grid = EPG = new Datatable();
            grid.init({
                src: $("#table-channels"),
                onSuccess: function(grid) {
                    setTimeout(function(){
                        handleOn1();
                        $(".select2").select2();
                        $("#table-channels ._programmes:first").click();
                        $(".itv-select").change()
                        $(".record").change()
                    },300)
                },
                onError: function(grid) {
                    // execute some code on network or other general error
                },
                dataTable: {  // here you can define a typical datatable settings from http://datatables.net/usage/options
                    /*
                     By default the ajax datatable's layout is horizontally scrollable and this can cause an issue of dropdown menu is used in the table rows which.
                     Use below "sDom" value for the datatable layout if you want to have a dropdown menu for each row in the datatable. But this disables the horizontal scroll.
                     */
                    //"sDom" : "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>r>>",

                    "aLengthMenu": [
                        [20],
                        [20] // change per page values here
                    ],
                    "iDisplayLength": 20, // default record count per page
                    "bServerSide": true, // server side processing
                    "sAjaxSource": $("#table-channels").data("url"), // ajax source
                    "aaSorting": [[ 1, "asc" ]] // set first column as a default sort by asc
                }
            });
        };

        var handleProgrammsRecords = function() {
            dtableProgrammes = new Datatable();
            dtableProgrammes.init({
                src: $("#programmes_epg"),
                onSuccess: function(dtableProgrammes) {
                    setTimeout(function(){
                        handleOn2();
                    },300)
                },
                onError: function(dtableProgrammes) {
                    // execute some code on network or other general error
                },
                dataTable: {  // here you can define a typical datatable settings from http://datatables.net/usage/options
                    /*
                     By default the ajax datatable's layout is horizontally scrollable and this can cause an issue of dropdown menu is used in the table rows which.
                     Use below "sDom" value for the datatable layout if you want to have a dropdown menu for each row in the datatable. But this disables the horizontal scroll.
                     */
                    //"sDom" : "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>r>>",

                    "aLengthMenu": [
                        [20],
                        [20] // change per page values here
                    ],
                    "iDisplayLength": 15, // default record count per page
                    "bServerSide": true, // server side processing
                    "sAjaxSource": programmes_url, // ajax source
                    "aaSorting": [[ 1, "asc" ]] // set first column as a default sort by asc
                }
            });
        };

        var _delete =function(_this,msg,tbl){
            $("#modal-confirm").remove();
            var nRow = $(_this).parents('tr')[0];
            var $this = $(_this);
            if(!$("#modal-confirm").length){
                confirm.ini(msg, function(_msg_) {
                    $.ajax({
                        type: "POST",
                        url: $this.data('href'),
                        dataType: "json",
                        success: function(respuesta) {
                            if (respuesta.code == 200) {
                                tbl.getDataTable().fnDeleteRow(nRow);
                                toastr.success(respuesta.msg, txtSuccess);
                            } else {
                                toastr.error(respuesta.msg,txtError);
                            }
                        },
                        error: function(respuesta) {
                        }
                    });
                })
            }
        };

        return {

            //main function to initiate the module
            init: function () {
                //handleOn();
                handleRecords();
            }

        };
    }();

    var status = function (){
        $.ajax({
            type: "GET",
            url: urlStatus,
            data: {},
            dataType: "json",
            success: function(respuesta) {
                var response = JSON.parse(respuesta.response);
                
                switch(response.code){
                    case 200:
                        clearInterval(time);
                        TableEpgAjax.init();
                        setTimeout(function(){
                            $(".table-container").css({display:""})
                            $("#loading").remove()
                        },300)
                        $("#portlet-body").css({
                            opacity: 1
                        })
                    break;

                    case 423:
                    case 424:
                        //$("#progress").html(response.msg);    
                    break;
                } 
            },
            error: function(respuesta) {
            }
        });
    };

    status();

    var time= setInterval(function(){
        status()
    },10000);

    //TableEpgAjax.init();
});
