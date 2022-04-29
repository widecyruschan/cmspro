(function($) {
    "use strict";
    $.Digishop = function(settings) {
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
                    url: config.url + "/controller.php",
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
                        $(".wojo.modal").find(".notification.image").attr("src", config.url + "/images/checkmark.svg").transition('rollInTop', {
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
					action: "sortImages",
					sorting: order
				}, function() {}, "json");

			}
		});
		
        // add images
		$('#images').simpleUpload({
			url: config.url,
			types: ['jpg', 'png', 'JPG', 'PNG'],
			error: function(error) {
				if (error.type === 'fileType') {
					$.notice(config.lang.err1, {
						autoclose: 12000,
						type: "error",
						title: config.lang.err
					});
				}
			},
			beforeSend: function(){
				$('#sortable').closest('.segment').addClass('loading');
			},
			success: function(data) {
				$('#sortable').prepend(data).sortables();
				$('#sortable').closest('.segment').removeClass('loading');
			}
		});
				
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
    };
})(jQuery);