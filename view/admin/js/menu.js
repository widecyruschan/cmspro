(function($) {
    "use strict";
    $.Menu = function(settings) {
        var config = {
            url: "",
            lang: {
                delMsg3: "Trash",
                delMsg8: "The item will remain in Trash for 30 days. To remove it permanently, go to Trash and empty it.",
                canBtn: "Cancel",
				nonBtn: "None",
                trsBtn: "Move to Trash",
            }
        };
        if (settings) {
            $.extend(config, settings);
        }
        
		$('#mIcons').find('i[class="' + $("input[name=icon]").val() + '"]').parent('.button').addClass('primary');
		
        $('#contenttype').on('change', function() {
            var $icon = $(this).parent();
            var option = $(this).val();
			if(option === "") {
				$("#contentid").show();
				$("#webid").hide();
				$('#page_id').html('<option value="0">' + config.lang.nonBtn + '</option>');
				$('#page_id').prop('name', 'page_id');
			} else {
				$icon.addClass('loading');
				$.get(config.url + "/helper.php", {
					action : "contenttype",
					type: option,
				}, function(json) {
					switch (json.type) {
						case "page":
							$("#contentid").show();
							$("#webid").hide();
							$('#page_id').html(json.message);
							$('#page_id').prop('name', 'page_id');
							break;
	
						case "module":
							$("#contentid").show();
							$("#webid").hide();
							$('#page_id').html(json.message);
							$('#page_id').prop('name', 'mod_id');
							break;
	
						default:
							$("#contentid").hide();
							$("#webid").show();
							$('#page_id').prop('name', 'web_id');
							break;
					}
	
					$icon.removeClass('loading');
				}, "json");
			}
        });

        /* == Toggle Menu icons == */
        $('#mIcons').on('click', '.button', function() {
            var micon = $("input[name=icon]");
            $('#mIcons .button.primary').not(this).removeClass('primary').toggleClass("simple");
            $(this).toggleClass("primary simple");
            micon.val($(this).hasClass('primary') ? $(this).children().attr('class') : "");
        });

        $('#sortlist').nestable({
            maxDepth: 4
        }).on('change', function() {
            var json_text = $('#sortlist').nestable('serialize');
            $.ajax({
                cache: false,
                type: "post",
                url: config.url + "/helper.php",
                dataType: "json",
                data: {
                    iaction: "sortMenus",
                    sortlist: JSON.stringify(json_text)
                }
            });
        }).nestable('collapseAll');
    };
})(jQuery);