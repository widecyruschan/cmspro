(function($) {
    "use strict";
    $.Shop = function(settings) {
        var config = {
            url: "",
			aurl: "",
            lang: {
                delMsg3: "",
                delMsg8: "",
                canBtn: "",
                trsBtn: "",
                err: "",
                err1: ""
            }
        };
        if (settings) {
            $.extend(config, settings);
        }

        // item history
        if ($.inArray("history", $.url().segment()) !== -1) {
            $("#payment_chart").parent().addClass('loading');
            $.ajax({
                type: 'GET',
                url: config.url,
                data: {
                    action: "itemChart",
                    id: $.url().segment(-1)
                },
                dataType: 'json'
            }).done(function(json) {
                var legend = '';
                json.legend.map(function(val) {
                    legend += val;
                });
                $("#legend").html(legend);
                Morris.Line({
                    element: 'payment_chart',
                    data: json.data,
                    xkey: 'm',
                    ykeys: json.label,
                    labels: json.label,
                    parseTime: false,
                    lineWidth: 4,
                    pointSize: 6,
                    lineColors: json.color,
                    gridTextFamily: "Wojo Sans",
                    gridTextColor: "rgba(0,0,0,0.6)",
                    gridTextSize: 12,
                    fillOpacity: '.75',
                    hideHover: 'auto',
                    preUnits: json.preUnits,
                    hoverCallback: function(index, json, content) {
                        var text = $(content)[1].textContent;
                        return content.replace(text, text.replace(json.preUnits, ""));
                    },
                    smooth: true,
                    resize: true,
                });
                $("#payment_chart").parent().removeClass('loading');
            });
        }

        // payment history
        if ($.inArray("payments", $.url().segment()) !== -1) {
            getStats('all');
            $("#dropdown-timeRange").on('click', '.item', function() {
                $("#payment_chart").html('');
                getStats($(this).data('value'));
            });
        }

        // delete category
        $(document).on('click', 'a.delCategory', function() {
            var dataset = $(this).data("set");
            var $parent = $(this).closest(dataset.parent);

            var btnLabel = config.lang.trsBtn;
            var subtext = '<span class="wojo bold text">' + config.lang.delMsg8 + '</span>';
            var header = config.lang.delMsg3 + " <span class=\"wojo secondary text\">" + dataset.option[0].title + "?</span>";
            var content = "<img src=\"" + config.aurl + "/images/trash.svg\" class=\"wojo basic center notification image\">";

            $('<div class="wojo modal"><div class="dialog" role="document"><div class="content">' +
                '<div class="header"><h5>' + header + '</h5></div>' +
                '<div class="body center aligned">' + content + '<p class="margin top">' + subtext + '</p></div>' +
                '<div class="footer">' +
                '<button type="button" class="wojo small simple button" data="modal:close">' + config.lang.canBtn + '</button>' +
                '<button type="button" class="wojo small positive button" data="modal:ok">' + btnLabel + '</button>' +
                '</div></div></div></div>').modal().on('click', '[data="modal:ok"]', function() {
                $(this).addClass('loading').prop("disabled", true);

                $.ajax({
                    type: 'POST',
                    url: config.url,
                    dataType: 'json',
                    data: dataset.option[0]
                }).done(function(json) {
                    if (json.type === "success") {
                        $($parent).transition("scaleOut", {
                            duration: 300,
                            complete: function() {
                                $($parent).remove();
                            }
                        });
                        $("#parent_id").html(json.menu);
                        $(".wojo.modal").find(".notification.image").attr("src", config.aurl + "/images/checkmark.svg").transition('rollInTop', {
                            duration: 500,
                            complete: function() {
                                $.modal.close();
                                $.wNotice(decodeURIComponent(json.message), {
                                    autoclose: 6000,
                                    type: json.type,
                                    title: json.title
                                });
                            }
                        });
                    }
                });
            });
        });

        // sort categories
        if ($.inArray("category", $.url().segment()) !== -1 || $.inArray("categories", $.url().segment()) !== -1) {
            $('#sortlist').nestable({
                maxDepth: 4
            }).on('change', function() {
                var json_text = $('#sortlist').nestable('serialize');
                $.ajax({
                    cache: false,
                    type: "post",
                    url: config.url,
                    dataType: "json",
                    data: {
                        iaction: "sortCategories",
                        sortlist: JSON.stringify(json_text)
                    }
                });
            }).nestable('collapseAll');
        }

        // sort images
        $("#sortable").sortable({
            ghostClass: "ghost",
            animation: 600,
            onUpdate: function() {
                var order = this.toArray();
                $.post(config.url, {
                    iaction: "sortImages",
                    sorting: order
                }, function() {}, "json");

            }
        });

        // sort variations
        $("#sortable-f").sortable({
            ghostClass: "ghost",
            animation: 600,
            onUpdate: function() {
                var order = this.toArray();
                $.post(config.url, {
                    iaction: "sortFilters",
                    sorting: order
                }, function() {}, "json");

            }
        });

        // shipping options
        $('#addShippOption').on('click', function() {
            var counter = $("#shop-shipping-options").children().length;
            counter++;
            var variant = $("#shop-shipping-option-prototype > ").clone();

            variant.find('h4').text(counter + '.');
            variant.find('input[name="shipping_opt_name"]').attr('name', 'shipping_opt[' + counter + '][name]');
            variant.find('input[name="shipping_opt_desc"]').attr('name', 'shipping_opt[' + counter + '][desc]');
            variant.find('input[name="shipping_opt_active_0"]')
                .attr({
                    'name': 'shipping_opt[' + counter + '][active]',
                    "id": "active_" + counter + "0"
                });

            variant.find('input[name="shipping_opt_active_1"]')
                .attr({
                    'name': 'shipping_opt[' + counter + '][active]',
                    "id": "active_" + counter + "1"
                });

            variant.find('label[for="active_0"]').attr("for", "active_" + counter + "0");
            variant.find('label[for="active_1"]').attr("for", "active_" + counter + "1");
            variant.appendTo($('#shop-shipping-options'));
        });

        $('#shop-shipping-options').on('click', '.removeShipping', function() {
            var $parent = $(this).closest('.shop-shipping-wrapper');
            $parent.transition('scaleOut', {
                duration: 300,
                complete: function() {
                    $parent.remove();
                }
            });
        });

        // variation add/edit
        $('#addOption').on('click', function() {
            var variant = $("#shop-option-clone > ").clone();
            var $parent = ("#varList");
            variant.prependTo($parent).transition("fadeIn", {
                duration: 350
            });
        });

        $('#varList').on('click', '.delOption', function() {
            var $parent = $(this).closest('.columns');
            $parent.transition('scaleOut', {
                duration: 300,
                complete: function() {
                    $parent.remove();
                }
            });
        });

        // variation options
        $('#uVariants').on('click', '.newVariant', function() {
            var parent = $("#uVariants .columns");
            var names = [];
            $('[data-name]', parent).each(function() {
                names.push($(this).attr("data-name"));
            });

            $.get(config.url, {
                action: "getVariants",
                names: names,
            }).done(function(data) {
                var modal =
                    '<div class="wojo normal modal"><div class="dialog" role="document">' +
                    '<div class="content">' + data + '</div>' +
                    '</div></div>';
                $(modal).on($.modal.OPEN, function() {
                    $("#result").on('click', 'a', function() {
                        var parent = $(this).closest(".columns");
                        var id = $(this).data("id");
                        $.ajax({
                            type: 'get',
                            url: config.url,
                            data: {
                                action: "getFreeVariants",
                                id: id
                            }
                        }).done(function(data) {
                            parent.remove();
                            $("#varSets").prepend(data);
                            if (data.type === "success") {}
                        });
                    });
                }).modal();
            });
        });

        $('#uVariants').on('click', '.addOption', function() {
            var counter = $("#uVariants .variantSection").length;
            counter++;
            var $parent = $(this).closest(".columns").find(".wojo.fields:first");
            var title = $(this).data("name");

            var variant = $("#shop-variant-option-prototype > ").clone();

            variant.attr("data-id", counter);
            variant.find('input[name="variant_name"]')
                .attr({
                    'name': 'variant[' + counter + '][value]',
                });
            variant.find('input[name="variant_price"]')
                .attr({
                    'name': 'variant[' + counter + '][price]',
                });

            variant.find('input[name="variant_qty"]')
                .attr({
                    'name': 'variant[' + counter + '][qty]',
                });

            variant.find('input[name="variant_thumb"]')
                .attr({
                    'name': 'variant[' + counter + '][thumb]',
                    "id": "thumb_" + counter
                });

            variant.find('input[name="variant_title"]')
                .attr({
                    'name': 'variant[' + counter + '][title]',
                    'value': title
                });

            variant.find('input[name="variant_id"]')
                .attr({
                    'name': 'variant[' + counter + '][id]',
                    'value': counter,
                });

            variant.insertAfter($parent).transition("fadeIn", {
                duration: 200
            });
        });

        $('#uVariants').on('click', '.removeVariant', function() {
            var $parent = $(this).closest('.variantSection');
            $parent.transition('scaleOut', {
                duration: 200,
                complete: function() {
                    $parent.remove();
                }
            });
        });

        // add images
        $('#images').simpleUpload({
            url: config.url,
            types: ['jpg', 'png', 'JPG', 'PNG'],
            error: function(error) {
                if (error.type === 'fileType') {
                    $.wNotice(config.lang.err1, {
                        autoclose: 12000,
                        type: "error",
                        title: config.lang.err
                    });
                }
            },
            beforeSend: function() {
                $('#sortable').closest('.segment').addClass('loading');
            },
            success: function(data) {
                $('#sortable').prepend(data).sortable();
                $('#sortable').closest('.segment').removeClass('loading');
            }
        });

        /**
         * Description
         * @method getStats
         * @param {} range
         * @return 
         */
        function getStats(range) {
            $("#payment_chart").parent().addClass('loading');
            $.ajax({
                type: 'GET',
                url: config.url,
                data: {
                    action: "salesChart",
                    range: range,
                },
                dataType: 'json'
            }).done(function(json) {
                var legend = '';
                json.legend.map(function(val) {
                    legend += val;
                });
                $("#legend").html(legend);
                Morris.Line({
                    element: 'payment_chart',
                    data: json.data,
                    xkey: 'm',
                    ykeys: json.label,
                    labels: json.label,
                    parseTime: false,
                    lineWidth: 4,
                    pointSize: 6,
                    lineColors: json.color,
                    gridTextFamily: "Nunito Sans",
                    gridTextColor: "rgba(0,0,0,0.6)",
                    gridTextSize: 12,
                    fillOpacity: '.75',
                    hideHover: 'auto',
                    preUnits: json.preUnits,
                    hoverCallback: function(index, json, content) {
                        var text = $(content)[1].textContent;
                        return content.replace(text, text.replace(json.preUnits, ""));
                    },
                    smooth: true,
                    resize: true,
                });
                $("#payment_chart").parent().removeClass('loading');
            });
        }
    };
})(jQuery);