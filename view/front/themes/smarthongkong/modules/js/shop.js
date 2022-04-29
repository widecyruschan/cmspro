$(function() {
    "use strict";
    //add to cart
    $("#shop").on('click', 'a.add-shop', function() {
        var set = $(this).data('option');
        var id = set.id;
        var type = set.type;
        var button = $(this);
        var url = $("#shop").attr('action');
        button.addClass('loading');

        $.post(url + 'shop/controller.php', {
            action: "add",
            id: id,
            type: type,
        }, function(json) {
            if (json.status === "success") {
                if (type === "simple") {
                    $("#simpleCart span").html(json.html);
                    $("#simpleCart").transition('shake');
                } else {
                    $("#scartList").html(json.html);
                }
            } else {
                $.wNotice(decodeURIComponent(json.message), {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });
            }
            setTimeout(function() {
                button.removeClass('loading');
            }, 1200);
        }, 'json');

    });

    //add to cart variant
    $("#shop").on('click', 'a.add-shopv', function() {
        var set = $(this).data('option');
        var id = set.id;
        var type = set.type;
        var variant = set.variant;
        var url = $("#shop").attr('action');

        $.get(url + 'shop/controller.php', {
            action: "getVariants",
            id: id,
            variant: variant
        }, function(json) {

            var $wmodal = $(
                '<div class="wojo big modal" id="cartModal"><div class="dialog" role="document"><div class="content">' +
                '<div class="body">' + json.html + '</div>' +
                '<div class="footer">' +
                '<button type="button" class="wojo small simple button" data="modal:close">Cancel</button>' +
                '<button type="button" class="wojo small positive button" data="modal:ok">OK</button>' +
                '</div></div></div>').on($.modal.OPEN, function() {
                $("#cartModal").on('click', '.add-var', function() {
                    var variant = $(this);
                    var parent = $(this).closest('.wojo.list');
                    parent.find('.add-var').removeClass('active');
                    variant.toggleClass('active');
                });
            }).modal().on('click', '[data="modal:ok"]', function() {
                $(this).addClass('loading').prop("disabled", true);
                var active = $("#cartModal").find('.add-var.active').length;
                var ids = [];

                $("#cartModal .add-var.active").each(function() {
                    ids.push($(this).attr("data-id"));
                });
                $.post(url + 'shop/controller.php', {
                    action: "addVariants",
                    ids: ids,
                    id: id,
                    type: type,
                    active: active
                }, function(jsonr) {
                    if (jsonr.status === "success") {
                        if (type === "simple") {
                            $("#simpleCart span").html(jsonr.html);
                        } else {
                            $("#scartList").html(jsonr.html);
                        }
                        $("#cartModal").modal('hide');
                    }

                    $.wNotice(decodeURIComponent(jsonr.message), {
                        autoclose: 12000,
                        type: jsonr.status,
                        title: jsonr.title
                    });
                    setTimeout(function() {
                        $('[data="modal:ok"]', $wmodal).removeClass('loading').prop("disabled", false);
                    }, 1200);
                }, 'json');

                $.modal.close();
            }).on($.modal.AFTER_CLOSE, function() {
                $("#cartModal").remove();
            });
        }, 'json');
    });

    //delete from cart
    $("#scartList").on('click', 'a.deleteItem', function() {
        var id = $(this).data('id');
        var parent = $(this).closest('.item');
        var url = $("#scartList").attr('action');

        $.post(url + 'shop/controller.php', {
            action: "remove",
            id: id,
        }, function(json) {
            if (json.status === "success") {
                parent.transition('swoopOutTop', {
                    duration: 400,
                    complete: function() {
                        $("#scartList").html(json.html);
                    }
                });
            }
        }, 'json');
    });

    //delete from big cart
    $("#shop").on('click', 'a.deleteCartItem', function() {
        var id = $(this).data('id');
        var url = $("#shop").attr('action');

        $.post(url + 'shop/controller.php', {
            action: "removeBig",
            id: id,
        }, function(json) {
            if (json.status === "success") {
                window.location.href = json.redirect;
            }
        }, 'json');
    });

    //checkout
    $("#checkout").on('click', function() {
        if ($("input[name='shipping']").is(':checked')) {
            var url = $(this).data("url");
            window.location.href = url;
        } else {
            $('#sid .item').transition('shake');
        }
    });

    //shipping
    $("#shop").on('change', 'input[name="shipping"]', function() {
        var val = $(this).val();
        var id = $(this).attr("id").split('_').pop();
        var url = $("#shop").attr('action');
        //$("#sCheckout").html(' ');
        $('input[name=gateway]:checked').prop('checked', false);
        $.post(url + 'shop/controller.php', {
            action: "shipping",
            value: val,
            id: id,
        }, function(json) {
            if (json.status === "success") {
                $("#shipping_c").text(json.shipping);
                $("#grand_c").text(json.grand);
            }

        }, 'json');
    });

    //change qty
    $("#shop").on('change', 'select[name=qty]', function() {
        var id = $(this).data('id');
        var value = $(this).val();
        var parent = $(this).closest('.wojo.item');
        var url = $("#shop").attr('action');
        parent.addClass("loading");

        $.post(url + 'shop/controller.php', {
            action: "qty",
            id: id,
            value: value,
        }, function(json) {
            if (json.status === "success") {
                setTimeout(function() {
                    $("body").transition({
                        animation: 'scaleOut'
                    });
                    window.location.href = json.redirect;
                }, 800);
            } else {
                $.wNotice(decodeURIComponent(json.message), {
                    autoclose: 12000,
                    type: json.status,
                    title: json.title
                });
            }

        }, 'json');

    });

    //like item
    $('#shop').on('click', '.shopLike', function() {
        var id = $(this).attr('data-shop-like');
        var total = $(this).attr('data-shop-total');
        var score = $(this).parent().find('.likeTotal');
        var url = $("#shop").attr('action');
        var $this = $(this);
        score.html(parseInt(total) + 1);

        $(this).transition('scaleOut', {
            duration: 500,
            complete: function() {
                $this.replaceWith('<i class="icon check"></i>');
                $.post(url + 'shop/controller.php', {
                    action: "like",
                    id: id
                });
            }
        });
    });

    //Wishlist
    $("#shop").on('click', '.add-shop-wish', function() {
        var $btn = $(this);
        var id = $btn.data('id');
        var url = $("#shop").attr('action');

        switch ($btn.data('layout')) {
            case "list":
                $btn.children().addClass('positive spin spinner circles');
                break;

            default:
                $btn.children().addClass('spin spinner circles');
                break;
        }

        $.post(url + 'shop/controller.php', {
            action: 'wishlist',
            id: id,
        }, function(json) {
            if (json.type === "error") {
                console.log("Invalid ID");
            }
            setTimeout(function() {
                $btn.removeClass('add-shop-wish');
                $btn.children().removeClass('inverted spin spinner circles heart files');

                switch ($btn.data('layout')) {
                    case "list":
                        $btn.children().addClass('positive check');
                        break;

                    default:
                        $btn.children().addClass('check');
                        break;
                }
            }, 500);

        }, "json");
    });

    //remove wishlist
    $("#shop").on('click', '.removeWish', function() {
        var id = $(this).data("id");
        var url = $("#shop").attr('action');
        var parent = $("#shop").find("tr#wishlist_" + id);
        $.post(url + 'shop/controller.php', {
            action: "removeWish",
            id: id,
        }, function(json) {
            if (json.status === "success") {
                parent.transition('scaleOut', {
                    duration: 300,
					complete: function() {
						parent.remove();
					}
                });
            }

        }, 'json');
    });

    //load gateway
    $('#shop').on('change', 'input[name=gateway]', function() {
        var id = $(this).val();
        var url = $("#shop").attr('action');
        var isValid = true;

        $("#sCheckout input").each(function() {
            if ($.trim($(this).val()).length === 0) {
                isValid = false;
                $(this).closest(".fields").transition('shake');
            }
        });
        if (isValid) {
            $.get(url + 'shop/controller.php', {
                action: "gateway",
                id: id,
                address: $('#wojo_form').serialize()
            }, function(json) {
                $("#shCheckout").html(json.message);
                $("html,body").animate({
                    scrollTop: $("#shCheckout").offset().top
                }, 1000);
            }, "json");
        } else {
            $("html,body").animate({
                scrollTop: $("#shop").offset().top
            }, 500);
            $('input[name=gateway]:checked').prop('checked', false);
        }
    });
});