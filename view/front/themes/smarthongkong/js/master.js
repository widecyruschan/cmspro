(function($) {
    "use strict";
    $.Master = function(settings) {
        var config = {
            weekstart: 0,
            ampm: 0,
            url: '',
            lang: {
                monthsFull: '',
                monthsShort: '',
                weeksFull: '',
                weeksShort: '',
                weeksMed: '',
                today: "Today",
                now: "Now",
                button_text: "Choose file...",
                empty_text: "No file...",
                sel_pic: "Choose image...",
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        $('.wojo.progress').wProgress();
        $('.wojo.accordion').wAccordion();
        $('.wojo.input.number').wNumber();

        /* == Tabs == */
        $(".wojo.tabs").wTabs();

        if ($.browser.desktop) {
            $('[data-wanimate]').Aos();
        }

        // sticky menu desktop only
        if ($("#header").length) {
            $(window).on('scroll', function() {
                var scrollTop = $(this).scrollTop();

                if (scrollTop > 120) {
                    $('#header').addClass('sticky');
                } else {
                    $('#header').removeClass('sticky');
                }
            });
            var scrollTop = $(window).scrollTop();
            if (scrollTop > 120) {
                $('#header').addClass('sticky');
            } else {
                $('#header').removeClass('sticky');
            }
        }

        //Lightbox
        $('.lightbox').wlightbox();

        //Paralax
        $('.paralax').paralax({
            speed: 0.6,
            mode: 'background',
            xpos: '50%',
            outer: true,
            offset: 0,
        });

        //Carousel
        $('.wojo.carousel').each(function() {
            var set = $(this).data('wcarousel');
            $(this).owlCarousel(set);
        });

        //Poll
        $('.poll').Poll({
            url: config.url + '/plugins_/poll/controller.php'
        });

        //Comments
        $('#comments').Comments({
            url: config.url + '/modules_/comments/'
        });

        //wojo slider
        $(".wSlider").on("initialized.owl.carousel", function() {
            $(".owl-item.active .ws-layer").each(function() {
                var animation = $(this).data('animation');
                $(this).addClass("animate " + animation);
            });
        });
        $('.wSlider').each(function() {
            var set = $(this).data('wslider');
            $(this).owlCarousel({
                dots: set.buttons,
                nav: set.arrows,
                autoplay: set.autoplay,
                autoplaySpeed: set.autoplaySpeed,
                autoplayHoverPause: set.autoplayHoverPause,
                margin: 0,
                loop: set.autoloop,
                rtl: set.rtl,
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "769": {
                        "items": 1
                    },
                    "1024": {
                        "items": 1
                    }
                }
            });

            $(this).on("translate.owl.carousel", function() {
                $(".ws-layer", this).each(function() {
                    var animation = $(this).data("animation");
                    $(this).removeClass("animate " + animation).css("opacity", 0);
                });
            });

            $(this).on("translated.owl.carousel", function(event) {
                var $active = $(".owl-item", this).eq(event.item.index);
                $active.find(".ws-layer").each(function() {
                    var animation = $(this).data("animation");
                    $(this).addClass("animate " + animation).css("opacity", 1);
                });
            });
        });

        /* == Vertical Menus == */
        $("ul.vertical-menu").find('ul.menu-submenu').parent().prepend('<i class=\"icon chevron down\"></i>');
        $('ul.vertical-menu .chevron.down').click(function() {
            var icon = this;
            $(this).siblings('ul.vertical-menu ul.menu-submenu').slideToggle(200);
            $(icon).toggleClass('vertically flipped');
        });

        /* == Basic color picker == */
        $('[data-color="true"]').spectrum({
            showPaletteOnly: true,
            showPalette: true,
            move: function(color) {
                var newcolor = color.toHexString();
                $(this).children().css('background', newcolor);
                $(this).prev('input').val(newcolor);
            }
        });

        /* == Advanced color picker == */
        $('[data-adv-color="true"]').spectrum({
            showInput: true,
            showAlpha: true,
            move: function(color) {
                var rgba = "transparent";
                if (color) {
                    rgba = color.toRgbString();
                    $(this).children().css('background', rgba);
                    $(this).children('input').val(rgba);
                }
            },
        });

        /* == Datepicker == */
        $('[data-datepicker]').wDate({
            months: config.lang.monthsFull,
            short_months: config.lang.monthsShort,
            days_of_week: config.lang.weeksFull,
            short_days: config.lang.weeksShort,
            days_min: config.lang.weeksSmall,
            selected_format: 'DD, mmmm d',
            month_head_format: 'mmmm yyyy',
            format: 'mm/dd/yyyy',
            clearBtn: true,
            todayBtn: true,
            cancelBtn: true,
            clearBtnLabel: config.lang.clear,
            cancelBtnLabel: config.lang.canBtn,
            okBtnLabel: config.lang.ok,
            todayBtnLabel: config.lang.today,
        }).on('datechanged', function(event) {
            if ($(this).attr("data-element")) {
                var element = $(this).data('element');
                var parent = $(this).data('parent');

                var date = new Date(event.date);
                var day = date.getDate();
                var month = config.lang.monthsFull[date.getMonth()];
                var year = date.getFullYear();
                var formatted = month + ' ' + day + ', ' + year;

                $(parent).html(formatted);
                if ($(element).is(":input")) {
                    $(element).val(event.date).trigger('change');
                } else {
                    $(element).html(formatted);
                }
            }
        });

        /* == Time Picker == */
        $('[data-timepicker]').wTime({
            timeFormat: 'hh:mm:ss.000', // format of the time value (data-time attribute)
            format: 'hh:mm t', // format of the input value
            is24: true, // format 24 hour header
            readOnly: true, // determines if input is readonly
            hourPadding: true, // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
            btnNow: config.lang.now,
            btnOk: config.lang.ok,
            btnCancel: config.lang.canBtn,
        });

        //Main menu
        $('nav.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
        $('nav.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
        //$("nav.menu > ul").before("<a href=\"#\" class=\"menu-mobile\"></a>");
        $("nav.menu > ul > li").hover(function(e) {
            if ($(window).width() > 768) {
                $(this).children("ul").stop(true, false).slideToggle(150);
                e.preventDefault();
            }
        });
        $("nav.menu > ul > li").click(function() {
            if ($(window).width() <= 768) {
                $(this).children("ul").fadeToggle(150);
            }
        });
        $(".menu-mobile").click(function(e) {
            $("nav.menu > ul").toggleClass('show-on-mobile');
            e.preventDefault();
        });

        /* == Input focus == */
        $(document).on("focusout", '.wojo.input input, .wojo.input textarea', function() {
            $('.wojo.input').removeClass('focus');
        });
        $(document).on("focusin", '.wojo.input input, .wojo.input textarea', function() {
            $(this).closest('.input').addClass('focus');
        });

        /* == Membership Select == */
        $(".add-membership").on("click", function() {
            $("#membershipSelect .segment").removeClass('active');
            $(this).closest('.segment').addClass('active');
            var id = $(this).data('id');
            $.post(config.url + "/controller.php", {
                action: "buyMembership",
                id: id
            }, function(json) {
                $("#mResult").html(json.message);
                $("html,body").animate({
                    scrollTop: $("#mResult").offset().top
                }, 1000);
            }, "json");
        });

        /* == Gateway Select == */
        $("#mResult").on("click", ".sGateway", function() {
            var button = $(this);
            $("#mResult .sGateway").removeClass('primary');
            button.addClass('primary loading');
            var id = $(this).data('id');
            $.post(config.url + "/controller.php", {
                action: "selectGateway",
                id: id
            }, function(json) {
                $("#mResult #gdata").html(json.message);
                $("html,body").animate({
                    scrollTop: $("#gdata").offset().top - 40
                }, 500);
                button.removeClass('loading');
            }, "json");
        });

        /* == Coupon Select == */
        $("#mResult").on("click", "#cinput", function() {
            var id = $(this).data('id');
            var $this = $(this);
            var $parent = $(this).parent();
            var $input = $("input[name=coupon]");
            if (!$input.val()) {
                $parent.transition('shake');
            } else {
                $parent.addClass('loading');
                $.post(config.url + "/controller.php", {
                    action: "getCoupon",
                    id: id,
                    code: $input.val()
                }, function(json) {
                    if (json.type === "success") {
                        $parent.removeClass('error');
                        $this.toggleClass('find check');
                        $parent.prop('disabled', true);
                        $(".totaltax").html(json.tax);
                        $(".totalamt").html(json.gtotal);
                        $(".disc").html(json.disc);
                        $(".disc").parent().addClass('highlite');
                        if (json.is_full === 100) {
                            $("#activateCoupon").show();
                            $("#gateList").hide();
                        } else {
                            $("#activateCoupon").hide();
                            $("#gateList").show();
                        }
                    } else {
                        $parent.transition('shake');
                    }
                    $parent.removeClass('loading');
                }, "json");
            }
        });

        /* == Coupon Select == */
        $(document).on("click", ".activateCoupon", function() {
            var $this = $(this);
            $this.addClass('loading');
            $.post(config.url + "/controller.php", {
                action: "activateCoupon",
            }, function(json) {
                if (json.type === "success") {
                    window.location.href = window.location.href;
                }
                $this.removeClass('loading');
            }, "json");
        });

        /* == Scrool to element == */
        $(document).on('click', '[data-scroll="true"]', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var target = $(this).attr('href');
            var offset = $(this).attr('data-offset');

            $("html,body").animate({
                scrollTop: $(target).offset().top - parseInt(offset)
            }, "1000");
            return false;
        });

        // Scroll to top
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#back-to-top').stop(true, true).fadeIn(500);
            } else {
                $('#back-to-top').stop(true, true).fadeOut(300);
            }
        });

        $('#back-to-top').click(function() {
            $("html,body").animate({
                scrollTop: $("body").offset().top
            }, "1000");
            return false;
        });

        /* == Clear Session Debug Queries == */
        $("#debug-panel").on('click', 'a.clear_session', function() {
            $.get(config.url + '/controller.php', {
                ClearSessionQueries: 1
            });
            $(this).css('color', '#222');
        });

        /* == Master Form == */
        $(document).on('click', 'button[name=dosubmit]', function() {
            var $button = $(this);
            var action = $(this).data('action');
            var $form = $(this).closest("form");
            var asseturl = $(this).data('url');
            var hide = $(this).data('hide');

            function showResponse(json) {
                setTimeout(function() {
                    $($button).removeClass("loading").prop("disabled", false);
                }, 500);

                if (json.type === "success" && json.redirect) {
                    setTimeout(function() {
                        $('body').transition('scaleOut', {
                            duration: 600,
                            complete: function() {
                                window.location.href = json.redirect;
                            }
                        });
                    }, 5000);
                }
                if (json.type === "success" && hide) {
                    $form.children().transition('fadeOut', {
                        duration: 5000,
                    });
                }
                $.wNotice(json.message, {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });
            }

            function showLoader() {
                $($button).addClass("loading").prop("disabled", true);
            }
            var options = {
                target: null,
                beforeSubmit: showLoader,
                success: showResponse,
                type: "post",
                url: asseturl ? config.url + "/" + asseturl + "/controller.php" : config.url + "/controller.php",
                data: {
                    action: action
                },
                dataType: 'json'
            };

            $($form).ajaxForm(options).submit();
        });

        /* == Avatar Upload == */
        $('[data-type="image"]').wavatar({
            text: config.lang.sel_pic,
            validators: {
                maxWidth: 1200,
                maxHeight: 1200
            },
            reject: function(file, errors) {
                if (errors.mimeType) {
                    $.wNotice(decodeURIComponent(file.name + ' must be an image.'), {
                        autoclose: 4000,
                        type: "error",
                        title: 'Error'
                    });
                }
                if (errors.maxWidth || errors.maxHeight) {
                    $.wNotice(decodeURIComponent(file.name + ' must be width:1200px, and height:1200px  max.'), {
                        autoclose: 4000,
                        type: "error",
                        title: 'Error'
                    });
                }
            },
            accept: function() {
                if ($(this).data('process')) {
                    var action = $(this).data('action');
                    var data = new FormData();
                    data.append(action, $(this).prop('files')[0]);
                    data.append("action", "avatar");

                    $.ajax({
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: data,
                        url: config.url + "/controller.php",
                        dataType: 'json',
                    });
                }
            }
        });

        /* == Password Reset / Login == */
        $("#backToLogin").on('click', function() {
            $("#loginForm").slideDown();
            $("#passForm").slideUp();
        });
        $("#passreset").on('click', function() {
            $("#loginForm").slideUp();
            $("#passForm").slideDown();

        });

        $("#doLogin").on('click', function() {
            var $btn = $(this);
            $btn.addClass('loading');
            var username = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            $.ajax({
                type: 'post',
                url: config.url + "/controller.php",
                data: {
                    'action': 'userLogin',
                    'username': username,
                    'password': password
                },
                dataType: "json",
                success: function(json) {
                    if (json.type === "error") {
                        $.wNotice(decodeURIComponent(json.message), {
                            autoclose: 6000,
                            type: json.type,
                            title: json.title
                        });
                    } else {
                        window.location.href = config.surl + "/dashboard/";
                    }
                    $btn.removeClass('loading');
                }
            });
        });

        $("#doPassword").on('click', function() {
            var $btn = $(this);
            $btn.addClass('loading');
            var email = $("input[name=pemail]").val();
            $.ajax({
                type: 'post',
                url: config.url + "/controller.php",
                data: {
                    'action': 'uResetPass',
                    'email': email,
                },
                dataType: "json",
                success: function(json) {
                    $.wNotice(decodeURIComponent(json.message), {
                        autoclose: 6000,
                        type: json.type,
                        title: json.title
                    });
                    if (json.type === "success") {
                        $btn.prop("disabled", true);
                    }
                    $btn.removeClass('loading');
                }
            });
        });

        /* == Language Switcher == */
        $('#dropdown-langChange').on('click', 'a', function() {
            Cookies.set("LANG_CMSPRO", $(this).data('value'), {
                expires: 120,
                path: '/'
            });
            $('body').transition("scaleOut", {
                duration: 2000,
                complete: function() {
                    window.location.href = config.surl;
                }
            });
            return false;
        });

        /* == Search == */
        $("#searchButton").on('click', function() {
            var icon = $(this);
            var input = $("#masterSearch").find("input");
            var url = $("#masterSearch").data('url');

            $("#masterSearch").animate({
                "width": "100%",
                "opacity": 1
            }, 300, function() {
                input.focus();
            });
            icon.css('opacity', 0);

            input.blur(function() {
                if (!input.val()) {
                    $("#masterSearch").animate({
                        "width": "0",
                        "opacity": 0
                    }, 200);
                    icon.css('opacity', 1);
                }
            });

            input.keypress(function(e) {
                var key = e.which;
                if (key === 13) {
                    var value = $.trim($(this).val());
                    if (value.length) {
                        window.location.href = url + '?keyword=' + value;
                    }
                }
            });
        });

        /* == Ajax Search == */
        $(document).on('keyup', '[data-search="true"]', function() {
            var $input = $(this).parent();
            var srch_string = $(this).val();
            var url = $(this).data('url');
            var $this = $(this);
            var $search = $input.find('.wojo.ajax.search');
            if (srch_string.length > 3) {
                $search.remove();
                $input.addClass('loading');
                $.get(url, {
                    action: "search",
                    string: srch_string
                }, function(json) {
                    $input.append(json.html);
                    $input.removeClass('loading');
                    $(document).on('click', function(event) {
                        if (!($(event.target).is($this))) {
                            $input.find('.wojo.ajax.search').fadeOut();
                        }
                    });
                }, "json");
            }
            return false;
        });

        // convert logo svg to editable 
        $('.logo img').each(function() {
            var $img = $(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            $.get(imgURL, function(data) {
                var $svg = $(data).find('svg');
                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                $img.replaceWith($svg);
            }, 'xml');

        });
    };
    var activeElement = document.activeElement;
    if (activeElement) {
        activeElement.blur();
    } else if (document.parentElement) {
        document.parentElement.focus();
    } else {
        window.focus();

    }
})(jQuery);