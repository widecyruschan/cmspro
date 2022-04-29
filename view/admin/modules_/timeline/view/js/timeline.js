(function($) {
    "use strict";
    $.Timeline = function(settings) {
        var config = {
            url: "",
            upUrl: "",
        };
        if (settings) {
            $.extend(config, settings);
        }

        // select type mode
        $("select[name=type]").on('change', function() {
            switch ($(this).val()) {
                case "facebook":
                    $('#fbconf').show();
                    $('#rssconf').hide();
                    break;
                case "rss":
                    $('#fbconf').hide();
                    $('#rssconf').show();
                    break;
                default:
                    $('#fbconf, #rssconf').hide();
                    break;
            }
        });

        $("#sortable").sortable({
            ghostClass: "ghost",
            draggable: ".columns",
            filter: ".remove",
            animation: 600,
            onFilter: function(ui) {
                $(ui.item).remove();
            }
        });

        //change type
        $('#tmType').change(function() {
            var selected = $(this).val();
            switch (selected) {
                case "iframe":
                    $('#iframe').show();
                    $('#imgfield, #bodyfield').hide();
                    break;

                case "gallery":
                    $('#iframe, #bodyfield').hide();
                    $('#imgfield').show();
                    break;

                default:
                    $('#iframe').hide();
                    $('#bodyfield').show();
                    break;
            }
        });

        //select images
        $('.multipick').on('click', function() {
            $.get(config.url + '/managerBuilder.php', {
                pickFile: 1,
                editor: true
            }, function(data) {
                $('<div class="wojo big modal"><div class="dialog" role="document"><div class="content">' + data + '</div></div></div>').modal();
                    $("#result").on('click', '.is_file', function() {
                        var dataset = $(this).data('set');
                        if (dataset.image === "true") {
                            var iparent = $(this).closest('.selectable');
                            if ($(iparent).hasClass('wojo outline')) {
                                $(iparent).removeClass('wojo outline');
                            } else {
                                $(iparent).addClass('wojo outline');
                            }
                        }
                        if ($("#result .wojo.outline").length > 0) {
                            $("#fInsert").removeClass('hidden');
                        } else {
                            $("#fInsert").addClass('hidden');
                        }
                    });
					
                    $("#fInsert").on('click', function() {
                        var html = '';
                        $("#result .wojo.outline").each(function() {
                            var dataset = $(this).find('.is_file').data('set');
                            html +=
                                '<div class="columns"> ' +
                                '<div class="wojo attached card"> ' +
								'<a class="wojo middle small white icon attached button remove"><i class="icon negative trash"></i></a> ' +
                                '<img src="' + config.upUrl + '/' + dataset.url + '" alt="" class="wojo rounded image"> ' +
                                '<input type="hidden" name="images[]" value="' + dataset.url + '">' +
                                '</div> ' +
                                '</div>';

                        });
                        $("#sortable").prepend(html);
                        $.modal.close();
                    });
            });
        });
    };
})(jQuery);