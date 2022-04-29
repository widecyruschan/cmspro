(function($) {
    "use strict";
    $.Language = function(settings) {
        var config = {
            url: "",
        };
        if (settings) {
            $.extend(config, settings);
        }

        $("#filter").on("keyup", function() {
            var filter = $(this).val(),
                count = 0;
            $("span[data-editable=true]").each(function() {
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).parents('.item').fadeOut();
                } else {
                    $(this).parents('.item').fadeIn();
                    count++;
                }
            });
        });

        $('#pgroup').on('change', function() {
            var sel = $("#pgroup option:selected").val();
            var type = $("#pgroup option:selected").data('type');
            var abbr = $(this).data('abbr');
            $.get(config.url + "/helper.php", {
                action: "languageSection",
                type: type,
                section: sel,
                abbr: abbr
            }, function(json) {
                $("#editable").html(json.html).fadeIn("slow");
                $('#editable').editableTableWidget();
            }, "json");
        });

        $('#group').on('change', function() {
            var sel = $("#group option:selected").val();
            var type = $("#group option:selected").data('type');
            var abbr = $(this).data('abbr');
            $('#group').parent().addClass('loading');
            $.get(config.url + "/helper.php", {
                action: "languagefile",
                type: type,
                section: sel,
                abbr: abbr
            }, function(json) {
                if (json.type === "success") {
                    $("#editable").html(json.html).fadeIn("slow");
                    $('#editable').editableTableWidget();
                } else {
                    $.wNotice(decodeURIComponent(json.message), {
                        autoclose: 12000,
                        type: json.type,
                        title: json.title
                    });
                }

                $('#group').parent().removeClass('loading');
            }, "json");
        });

        $('.fcpick').spectrum({
            showPaletteOnly: true,
            palette: [
                ["#1abc9c", "#16a085", "#2ecc71", "#27ae60"],
                ["#3498db", "#2980b9", "#9b59b6", "#8e44ad"],
                ["#34495e", "#2c3e50", "#f1c40f", "#f39c12"],
                ["#e67e22", "#d35400", "#e74c3c", "#c0392b"],
                ["#ecf0f1", "#bdc3c7", "#95a5a6", "#7f8c8d"]
            ],
            change: function(color) {
                var newcolor = color.toHexString();
                var id = $(this).data('id');
                $(this).css({
                    "backgroundColor": newcolor,
                    "borderColor": newcolor
                });
				
                var data = {
                    iaction: "langColor",
                    color: newcolor,
                    id: id
                };
                $.post(config.url + "/helper.php", data);
            }
        });
    };
})(jQuery);