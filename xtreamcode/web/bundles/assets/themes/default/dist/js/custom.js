/**
 * Created by dani on 28/09/15.
 */
$(function() {
    var c = $(".content .box .col-md-6.col-md-offset-3.col-sm-8.col-sm-offset-2.col-xs-12");
    c.removeClass("col-md-6")
    c.removeClass("col-md-offset-3")
    c.addClass("col-md-8 col-md-offset-2")

    $("a.locale").on({
        click: function (e) {
            e.preventDefault();
            var _locale = $(this).data("locale");

            window.location = window.location.toString().replace("/" + locale + "/", "/" + _locale + "/")
        }
    })

    var pathname = window.location.pathname;
    var menu_active = $('a[href="' + pathname + '"]');
    
    if (menu_active.length === 0) {
        menu_active = $('a[data-uri*="' + pathname + '"]')
    }
    
    if (menu_active.length > 0) {
        var parent_li = menu_active.parents("li.sidebar-section-nav__item");
        var parent_ul = menu_active.parents("ul.sidebar-section-subnav");

        parent_li.addClass("is-active");
        menu_active.addClass("is-active");

        if($('body') != undefined && !$('body').hasClass('sidebar-sm'))
            parent_ul.show();
    }

    if ($(".select2").length) {
        $(".select2").select2();
    }
    if($(".select2-tag").length) {
        $(".select2-tag").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    }


    $("[data-mask]").inputmask();

    if ($(".colorpicker").length) {
        $(".colorpicker").colorpicker();
    }    

    //TICKETS
    /*if ($(".compose-textarea").length > 0) {
        $(".compose-textarea").wysihtml5();
        $($('a[data-wysihtml5-command="insertImage"]').parent("li")).remove()
        //CKEDITOR.replace('appbundle_resellersblocked_reason');
    }*/

    $(".checkbox-ticket").on({
        change: function () {
            if ($(this).prop("checked")) {
                console.log("si")
            } else {
                console.log("si")
            }
        }
    })
    $(".ticket-trash").on({
        click: function (e) {
            e.preventDefault();
            if ($(".checkbox-ticket:checked").length) {
                $("#tickets-form").submit();
            }
        }
    })

//    END TICKETS
    if ($('.datepicker').length){
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            format: "YYYY-MM-DD"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    }
//    DETELE
	$( document ).on( "click", ".delete", function(e) {
		e.preventDefault();
            var $this = $(this);
            confirm.ini($this.data("msg-delete")||msgDelete, function(_msg_) {
                if($this.parents("form").length>0){
                    $this.parents("form")[0].submit();
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: $this.data('href'),
                    dataType: "json",
                    success: function(respuesta) {
                        if (respuesta.status == 200) {
                            toastr.success(respuesta.msg, txtSuccess);
                            window.location.reload(true);
                        } else {
                            toastr.error(respuesta.msg, txtError);
                        }
                    },
                    error: function(respuesta) {

                    }
                });
            })
	});

   
    if($(".restore_backup").length>0){
        $(".restore_backup").on({
            click: function(e){
                e.preventDefault();
                var $this= $(this);
                confirm.ini(restoreMsg, function(_msg_) {
                    window.location = $this.attr("href");
                },"warnning");
            }
        })
    }


    if($("#form_restore_backup_btn").length>0){
        $("#form_restore_backup_btn").on({
            click: function(e){
                if($("#input_file").val()==""){
                    return;
                }
                e.preventDefault();
                var $this= $(this);
                confirm.ini(restoreMsg, function(_msg_) {
                    $("#form_restore_backup").submit();
                },"warnning");
            }
        })
    }



//    Mail Configuration
    $("#appbundle_settings_emailServiceType").on({
        change: function(){
            $(".email-config").removeAttr("readonly")
            if($(this).val()=="local"){
                $(".email-config").attr("readonly","readonly")
            }
        }
    }).change()

    $('form[name="appbundle_blockipcountry"]').on({
        submit: function(e) {
            if ($("#appbundle_blockipcountry_ip").val() == "" && $("#appbundle_blockipcountry_country").val() == "" && $("#appbundle_blockipcountry_ipRange").val() == "") {
                toastr.error(msg_no_empty,txtError);
                return false;
            }
            return true;
        }
    })
});

function block_screen() {
    var height = $('body').height() + "px";
    var height ='100%';
    $('div.bloqueo').css({'height' :  height});
    $('div.bloqueo').show();
}


function unblock_screen() {
    $('div.bloqueo').hide();
}