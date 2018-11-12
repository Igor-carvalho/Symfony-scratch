/**
 * Created by dani on 16/10/15.
 */
$(function(){

    var handleScrollers = function () {
        $('.scroller').each(function () {
            var height;
            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }
            $(this).slimScroll({
                allowPageScroll: true, // allow page scroll when the element scroll is ended
                size: '7px',
                color: ($(this).attr("data-handle-color")  ? $(this).attr("data-handle-color") : '#bbb'),
                railColor: ($(this).attr("data-rail-color")  ? $(this).attr("data-rail-color") : '#eaeaea'),
                position: 'right',
                height: height,
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                disableFadeOut: true
            });
        });
    }

    //var createCart = function(){
    //    if($.cookie("besttranscoder-shop-cart")){
    //        $("#shop-cart-container").html(Base64.decode($.cookie("besttranscoder-shop-cart")));
    //    }else{
    //        $("#shop-cart-container").html("");
    //    }
    //}

    var handleDelete = function(){
        $(".del-product").on({
            click: function(e){
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    type: "POST",
                    url: $this.attr("href"),
                    data: {
                        _type:$this.data("type"),
                        _product:$this.data("product")
                    },
                    dataType: "html",
                    success: function(respuesta) {
                        //createCart();
                        $("#shop-cart-container").html(respuesta);
                        handleDelete();
                        handleScrollers();
                        handleClear();
                    },
                    error: function(respuesta) {
                    }
                });

            }
        })
    }

    $(".add2cart").on({
        click: function(e){
            e.preventDefault();
            var cartParent = $($(this).data("parent"));
            cartParent.addClass("zoomOutRight");
            setTimeout(function(){
                cartParent.removeClass("zoomOutRight");
            },700);
            var $this = $(this);
            $.ajax({
                type: "POST",
                url: $this.attr("href"),
                data: {
                    _type:$this.data("type"),
                    _product:$this.data("product"),
                    _name:$this.data("name"),
                    _image:$this.data("image"),
                    _price:$this.data("price")
                },
                dataType: "html",
                success: function(respuesta) {
                    //createCart();
                    $("#shop-cart-container").html(respuesta);
                    handleDelete();
                    handleScrollers();
                    handleClear();
                },
                error: function(respuesta) {
                }
            });

        }
    })


    var handleClear = function(){
        $(".clear-cart").on({
            click: function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr("href"),
                    data: {},
                    dataType: "html",
                    success: function(respuesta) {
                        //createCart();
                        $("#shop-cart-container").html(respuesta);
                    },
                    error: function(respuesta) {
                    }
                });
            }
        })
    }


    handleScrollers();
    handleDelete();
    handleClear();
})