/**
 * Created by dani on 16/10/15.
 */
$(function(){

    $("#select-gateway").on({
        change: function(){
            $("#card-container").css({display:"none"})
            if($(this).val()=="creditcard"){
                $("#card-container").css({display:""})
            }
            $("#gateway-logo").attr("src",$("#select-gateway option:selected").data('logo') || "")
        }
    });

    $("#btn-confirm").on({
        click: function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            if ($("#select-gateway").val()=="creditcard" && ($("#cardNumber").val() == "" || $("#fullName").val() == "" || $("#expiry").val() == "" || $("#cvc").val() == "")) {
                toastr.error(creditCardFieldRequired, txtError);
            } else {
                if ($("#select-gateway").val()=="creditcard") {
                    var expiry = $('#expiry').val();
                    expiry = expiry.split("/");
                    var $this = $(this);
                    Stripe.createToken({
                        number: $('#cardNumber').val(),
                        cvc: $('#cvc').val(),
                        exp_month: expiry[0],
                        exp_year: expiry[1],
                        name: $("#fullName").val(),
                        address_line1: $("#address1").val(),
                        address_state: $("#city").val(),
                        address_zip: $("#zip").val()
                    }, function(status, response) {
                        if (response.error) {
                            toastr.error(response.error.message, txtError);
                        } else {
                            var form = $("#payment-form");
                            var token = response['id'];
                            $('#channels-token-' + $this.data('id')).remove();
                            form.append("<input id='channels-token' type='hidden' name='stripeToken' value='" + token + "' />");
                            //$("#payment-form").submit();
                            $("#btn-subbmit-payment-form").click()
                        }
                    });
                } else {
                    $("#btn-subbmit-payment-form").click()
                    //$("#payment-form").submit();
                }
            }
            return false;
        }
    });


})
