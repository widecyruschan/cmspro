(function($) {
    "use strict";
    $.Page = function(settings) {
        var config = {
            url: "",
            lang: {
                nomemreq: "",
				select: "",

            }
        };
        if (settings) {
            $.extend(config, settings);
        }

        $('#access_id').on('change', function() {
            var type = $(this).val();
            if (type === "Membership") {
                $.get(config.url, {
                    action: "membershiplist",
					type: type,
                }, function(json) {
                    if (json.status === "success") {
						var html = '<a data-wdropdown="#membership_id" class="wojo white right fluid button">' + config.lang.select + '<i class="icon chevron down"></i></a>';
                        html += '<div class="wojo static dropdown small pointing top-left" id="membership_id">';
                        html += '<div class="row grid phone-1 mobile-1 tablet-2 screen-2">';
						html += json.html;
						html += '</div></div>';
                        $("#membership").html(html);
                    }
                }, "json");
            } else {
                $('#membership').html('<input disabled="disabled" type="text" placeholder="' + config.lang.nomemreq + '" name="na">');
            }
        });
        $('.removebg').on('click', function() {
            var parent = $(this).prev('input');
            $(parent).val('');
        });

    };
})(jQuery);