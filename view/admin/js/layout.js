(function($) {
    "use strict";
    $.Layout = function(settings) {
        var config = {
            url: "",
            lurl: "",
            page_id: 0,
            mod_id: 0,
            type: '',
            lang: {
                edit: "Edit",
                delete: "Delete",
                insert: "Insert",
                cancel: "Cancel",
            }
        };
        if (settings) {
            $.extend(config, settings);
        }

        document.ontouchmove = function() {
            return true;
        };

        $(".sortable.celled").sortable({
            ghostClass: "ghost",
            group: "name",
            handle: ".handle",
            animation: 600,
            onStart: function(ui) {
                $(ui.item).css({
                    "width": "auto"
                });
            },
            onUpdate: function(ui) {
                var items = this.toArray();
                var position = $(ui.item).parent().attr('data-position');

                $.post(config.url + "/helper.php", {
                    iaction: "sortLayout",
                    position: position,
                    items: items,
                    type: config.type,
                    page: config.page_id,
                    mod: config.mod_id
                });

            },
            onAdd: function(ui) {
                var position = $(ui.item).parent().data('position');
                var items = [];
                $('[data-position=' + position + ']').children().each(function() {
                    items.push($(this).data("id"));
                });

                $.post(config.url + "/helper.php", {
                    iaction: "sortLayout",
                    position: position,
                    items: items,
                    type: config.type,
                    page: config.page_id,
                    mod: config.mod_id
                });
            }
        });

        // change module
        $("select[name=mod_id]").on('change', function() {
            var id = $(this).val();
            var page = (id === "0") ? '' : '?mod_id=' + id;
            window.location.href = config.lurl + page;

        });

        // Add plugins
        $(".pAdd").on('click', function() {
            var $this = $(this);
            var section = $this.data('section');

            var idin = [];
            $('.sortable.celled li').each(function() {
                idin.push($(this).attr("data-id"));
            });

            var data = {
                action: "getFreePlugins",
                section: section,
                ids: idin,
            };

            $.get(config.url + "/helper.php", data, function(json) {
                var actions = '' +
                    '<div class="footer">' +
                    '<button type="button" class="wojo small simple button" data="modal:close">' + config.lang.cancel + '</button>' +
                    '<button type="button" class="wojo small positive button" data="modal:ok">' + config.lang.insert + '</button>' +
                    '</div>';

                $('<div class="wojo normal modal"><div class="dialog" role="document"><div class="content">' +
                    '' + json.html + '' +
                    '' + actions + '' +
                    '</div></div></div>').modal().on('click', '[data="modal:ok"]', function() {

                    var items = '';
                    var allitems = [];
                    $('.wojo.modal .wojo.list div.active').each(function() {
                        var id = $(this).data('id');
                        var text = $(this).text();
                        allitems.push($(this).data("id"));
                        items +=

                            '<li class="item" data-id="' + id + '" id="item_' + id + '">' +
                            '<div class="handle"><i class="icon reorder"></i></div>' +
                            '<div class="content">' + text + '</div>' +
                            '<a class="actions"><i class="icon negative trash"></i></a>' +
                            '</li>';
                    });
                    if (items) {
                        $('ol[data-position="' + section + '"]').append(items);
                        $.post(config.url + "/helper.php", {
                            iaction: "insertLayout",
                            position: section,
                            items: allitems,
                            type: config.type,
                            page: config.page_id,
                            mod: config.mod_id
                        });
                    }

                    $('.wojo.modal .wojo.list div.active').remove();
                });

                $(".wojo.modal .wojo.list").on('click', 'a', function() {
                    if ($(this).parent().hasClass('active')) {
                        $(this).parent().removeClass('active');
                    } else {
                        $(this).parent().addClass('active');
                    }
                });

            }, 'json');
        });

        // Edit plugin spaces
        $(".pEdit").on('click', function() {
            var $this = $(this);
            var section = $this.data('section');

            var idin = [];
            $('ol[data-position=' + section + ']').children().each(function() {
                idin.push($(this).attr("data-id"));
            });

            var data = {
                action: "getPluginLayout",
                section: section,
                ids: idin,
            };
            if (idin.length > 0) {
                $.get(config.url + "/helper.php", data, function(json) {
                    setTimeout(function() {
                        $("#dropdown-" + section).html(json.html);
                        $('.rangeslider').wRange();
                    }, 500);

                    $("#dropdown-" + section).on('click', '.update', function() {
                        var items = $('.layform').serializeArray();
                        $.post(config.url + "/helper.php", {
                            iaction: "updateLayout",
                            position: section,
                            items: items,
                            type: config.type,
                            page: config.page_id,
                            mod: config.mod_id
                        });
                    });
                }, 'json');
            } else {
                $("#dropdown-" + section).html(' ');
            }
        });

        $(".sortable.celled.simple").on('click', '.actions', function() {
            var parent = $(this).parent('li');
            var data = {
                iaction: "deleteLayout",
                id: $(this).parent().data('id'),

                type: config.type,
                page: config.page_id,
                mod: config.mod_id
            };

            $.post(config.url + "/helper.php", data, function(json) {
                if (json.type === "success") {
                    $(parent).remove();
                }
            }, 'json');

        });
    };
})(jQuery);