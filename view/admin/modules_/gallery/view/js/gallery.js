(function($) {
    "use strict";
    $.Gallery = function(settings) {
        var config = {
            url: "",
            dir: "",
            grid: '.masonry',
            sortable: '#sortable',
            lang: {
                done: 'Done',
            }
        };
        if (settings) {
            $.extend(config, settings);
        }

        // Resize images
        $('#doResize').on('click', function() {
            var $button = $(this);
            var w = $("input[name=thumb_w]").val();
            var h = $("input[name=thumb_h]").val();
            var method = $('input[name=resize]:checked').val();
            var dir = $("input[name=dir]").val();
            $button.addClass('loader').prop('disabled', true);
            $.post(config.url, {
                action: 'resizeImages',
                resize: method,
                thumb_w: w,
                thumb_h: h,
                dir: dir,
            }, function(json) {
                setTimeout(function() {
                    $($button).removeClass("loader").prop("disabled", false);
                }, 500);
                $.wNotice(json.message, {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });
            }, "json");
        });

        // sort albums/photos
        $('#reorder').on('click', function() {
            if ($(this).children().hasClass('apps')) {
                $(this).children().toggleClass('apps check');
				$("#dragNotice").show();
                $('.content, .center.aligned', config.sortable).hide();
                $(config.sortable).removeClass('mason');
                $(config.sortable).addClass('row grid screen-5 tablet-4 mobile-3 phone-1 gutters');
                $('.item', config.sortable).addClass('columns');
                var type = ($.inArray("photos", $.url().segment()) === -1) ? 'sortAlbums' : 'sortPhotos';
                $(config.sortable).sortable({
                    ghostClass: "ghost",
                    animation: 600,
                    onUpdate: function() {
                        var order = this.toArray();
                        $.post(config.url, {
                            iaction: "sortItems",
							type: type,
                            sorting: order
                        }, function() {}, "json");

                    }
                });
            } else {
                $(config.sortable).addClass('loader');
                $(this).children().toggleClass('check apps');
				$("#dragNotice").hide();
                $('.content, .center.aligned', config.sortable).show();
                $(config.sortable).removeClass('row grid screen-5 tablet-4 mobile-3 phone-1 gutters');
                $(config.sortable).addClass('mason');
                $('.item', config.sortable).removeClass('columns');
                $(config.sortable).removeClass('loader');
            }
        });
		
        // assign poster
        $(config.sortable).on('click', '.poster', function() {
			var $this = $(this);
			var $icon = $(this).children('.icon');
            $.post(config.url, {
                iaction: "setPoster",
				thumb: $(this).data('poster'),
				id: $.url().segment(-1)
            }, function(json) {
                if (json.type === "success") {
					var $item = $(config.sortable).find('.menu .item.disabled');
					$item.children().toggleClass('check photo');
					$item.toggleClass('disabled poster');
					$this.toggleClass('poster disabled');
					$icon.toggleClass('photo check');
                }
            }, "json");
        });
			
        //File Upload
        $('#drag-and-drop-zone').on('click', function() {
            $(this).wojoUpload({
                url: config.url,
                dataType: 'json',
                extraData: {
                    action: "upload",
                    dir: config.dir
                },
                allowedTypes: '*',
                onBeforeUpload: function(id) {
                    update_file_status(id, 'primary', 'Uploading...');
                },
                onNewFile: function(id, file) {
                    add_file(id, file);
                },
                onUploadProgress: function(id, percent) {
                    update_file_progress(id, percent);
                },
                onUploadSuccess: function(id, data) {
                    if (data.type === "error") {
						update_file_status(id, '<i class="icon small negative circular minus"></i>', data.message);
                        update_file_progress(id, 0);
                    } else {
						var icon = '<i class="icon small positive circular check"></i>';
						var btn = '<img src="' + data.filename + '" class="wojo small rounded image">';
						 
                        update_file_status(id, icon, btn);
                        update_file_progress(id, 100);
                    }
                },
                onUploadError: function(id, message) {
                    update_file_status(id, '<i class="icon small negative circular minus"></i>', message);
                },
                onFallbackMode: function(message) {
                    alert('Browser not supported: ' + message);
                },

                onComplete: function() {
					if($("#done").length === 0) {
						$("#fileList").after('<div id="done" class="vertical margin"><a class="wojo small primary button"><i class="icon check"></i>' + config.lang.done + '</a></div>');
					}
                    
                    $("#done").on('click', 'a', function() {
                        buildList($.url().segment(-1));
                        $('#fileList').html('');
                        $("#done").remove();
                    });
                }
            });
        });

        function add_file(id, file) {
            var template = '' +
                '<div class="item progress" id="uploadFile_' + id + '">' +
                '<div class="columns auto" id="bStstus_' + id + '">' +
                '<div class="wojo icon button"><i class="icon white file"></i></div>' +
                '</div>' +
                '<div class="columns id="contentFile_' + id + '">' +
                '<h6 class="basic">' + file.name + '</h6>' +
                '</div>' +
                '<div class="columns auto" id="iStatus_' + id + '"><i class="icon small info circular upload"></i></div>' +
                '<div class="wojo attached bottom tiny progress">' +
                '<div class="bar" data-percent="100"></div>' +
                '</div>' +
                '</div>';

            $('#fileList').prepend(template);
        }

        function update_file_status(id, status, message) {
			$('#bStstus_' + id).html(message);
			$('#iStatus_' + id).html(status);
        }

        function update_file_progress(id, percent) {
            $('#uploadFile_' + id).find('.progress').wProgress();
			$('#uploadFile_' + id).find('.progress .bar').attr("data-percent", percent);
        }

        function buildList(id) {
			$(config.grid).addClass('loading');
            $.get(config.url, {
                action: "loadPhotos",
                id: id,
            }, function(json) {
                if (json.type === "success") {
					$(config.grid).html(json.html);
                }
				$(config.grid).removeClass('loading');
            }, "json");
        }
    };
})(jQuery);