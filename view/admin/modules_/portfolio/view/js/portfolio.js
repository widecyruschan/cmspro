(function($) {
    "use strict";
    $.Portfolio = function(settings) {
        var config = {
            url: "",
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

        // select layout item
		$("#layoutMode").on('click', 'a', function() {
			$("#layoutMode .segment").removeClass('active');
			$(this).parent().addClass('active');
			$("input[name=layout]").val($(this).data('type'));
		});
		
        // sort categories
        if ($.inArray("category", $.url().segment()) !== -1 || $.inArray("categories", $.url().segment()) !== -1) {
            $('#sortlist').nestable({
                maxDepth: 1
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
			beforeSend: function(){
				$('#sortable').closest('.segment').addClass('loading');
			},
			success: function(data) {
				$('#sortable').prepend(data).sortable();
				$('#sortable').closest('.segment').removeClass('loading');
			}
		});
    };
})(jQuery);