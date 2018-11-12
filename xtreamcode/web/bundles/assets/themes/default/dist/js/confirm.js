/**
 * Created by dani on 1/10/15.
 */
var confirm = {
    ini: function(message, callback,type) {
        var type = type || "error";
        var colors = {
            error: "#bd362f",
            warnning: "#f89406",
            info: "#2f96b4",
            success: "#51a351"
        };

        $("#modal-confirm").remove();

        var modal = '<div id="modal-confirm" class="modal fade custom-modal custom-modal-confirm">\
                        <div class="modal-dialog" role="document">\
                        <button type="button" class="close custom-modal__close" data-dismiss="modal" aria-label="Close">\
                            <span aria-hidden="true" class="ua-icon-modal-close"></span>\
                        </button>\
                        <div class="modal-content">\
                            <div class="modal-header custom-modal__image">\
                            <img src="/xtreamcode/imgModal/delete.png" alt="" class="">\
                            </div>\
                            <div class="modal-body custom-modal__body">\
                            <h4 class="custom-modal__body-heading">'+message+'</h4>\
                            <div class="custom-modal__body-desc">This action cannot be undone</div>\
                            </div>\
                            <div class="modal-footer">\
                            <div class="custom-modal__buttons">\
                                <button id="delete-confirm" class="btn btn-info iconfont icon-left custom-modal__icon-btn" type="button">\
                                Confirm <span class="btn-icon ua-icon-check"></span>\
                                </button>\
                                <button id="delete-cancel" type="button" class="btn btn-outline-info iconfont icon-left custom-modal__icon-btn">\
                                Cancel <span class="btn-icon ua-icon-alert-close"></span>\
                                </button>\
                            </div>\
                            </div>\
                        </div>\
                        </div>\
                    </div>';

        if(! $('#modal-confirm').length>0){
            $("body").append(modal)
        }

        $('#modal-confirm').modal("show");

        $("#delete-cancel").on({
            click: function() {
                $('#modal-confirm').modal("hide");
                $("#_msg_").val("");
                $('#modal-confirm').remove();
                $('.modal-backdrop').remove();
            }
        });

        $("#delete-confirm").on({
            click: function() {
                $('#modal-confirm').modal("hide");
                $('#modal-confirm').remove();
                callback( $("#_msg_").val());
                $("#_msg_").val("");
            }
        });
    }};