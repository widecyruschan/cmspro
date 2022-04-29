(function($, window, document, undefined) {
    "use strict";
    var pluginName = 'Manager';

    function Plugin(element, options) {
        this.element = element;
        this._name = pluginName;
        this._defaults = $.fn.Manager.defaults;
        this.options = $.extend({}, this._defaults, options);
        this.init();
    }

    $.extend(Plugin.prototype, {
        init: function() {
            this.buildList();
            this.bindEvents();
        },

        buildList: function(dirname, type, ext, sorting) {
            var plugin = this;
            var element = this.element;

            type = Cookies.get('CMS_FLAYOUT') === 'undefined' ? "table" : Cookies.set('CMS_FLAYOUT');

            $.ajax({
                type: 'GET',
                url: this.options.url + "/helper.php",
                dataType: 'json',
                async: true,
                data: {
                    action: "getFiles",
                    layout: type,
                    dir: dirname,
					exts: ext,
                    sorting: sorting
                }
            }).done(function(json) {
                var template = plugin.renderTemplate(type, json);
                $(element).html(template).transition('scaleIn', {
                    duration: 150
                });
                $("#tsizeDir span").html(json.dirsize);
                $("#tsizeFile span").html(json.filesize);

                if ($("#fileModal:visible").length > 0) {
                    $("#fileModal").modal('refresh');
                }
            });
        },

        // Bind events that trigger methods
        bindEvents: function() {
            var plugin = this;
            var element = this.element;
            var lang = plugin.options.lang;

            $('#togglePreview').on('click', function() {
                var icon = $(this).children();
                $(icon).toggleClass('expand compress');
                $("#preview").toggle();
            });

            $('#fm').on('click', 'a.is_file', function() {
                var dataset = $(this).data('set');
                var url = plugin.options.dirurl + '/' + dataset.url;
                var murl = plugin.options.url + '/images/mime/' + dataset.ext + '.png';

                var is_image = (dataset.image === "true") ? url : murl;
                if (dataset.name) {
                    var template = '' +
                        '<img src="' + is_image + '" class="wojo medium basic inline center image" alt=""> ' +
                        '<div class="wojo small relaxed celled fluid list vertical margin"> ' +
                        '<div class="item"><div class="header">' + plugin.maxLength(dataset.name, 20) + '</div></div> ' +
                        '<div class="item">' + lang.size + ': ' + dataset.size + '</div> ' +
                        '<div class="item">' + lang.lastm + ': ' + dataset.ftime + '</div> ' +
                        '<a href="' + url + '" class="wojo small positive fluid button item">' + lang.download + ' </a> ' +
                        '';
                    if (dataset.ext === "zip") {
                        template += '' +
                            '<a data-url="' + dataset.url + '/" class="wojo small fluid positive button unzip"> ' + lang.unzip + '</a>';
                    }
                    template += '' +
                        '<a data-url="' + dataset.url + '" data-name="' + dataset.name + '" data-type="file" class="wojo small negative button item delSingle">' + lang.delete + '</a>' +
                        '</div>';

                    if (plugin.options.is_mce) {
                        template += '' +
                            '<div class="content-center"><a class="wojo small primary button insertMCE" data-url="' + url + '"> ' + lang.insert + ' </a></div>';
                    }
                    $("#preview").html(template);
                }
            });

            //Browse directories
            $('#fm').on('click', 'a.is_dir', function() {
                var dataset = $(this).data('set');
                var items = plugin.filterDisplay();
                var folder = (dataset.files > 0) ? 'open' : 'closed';
                plugin.buildList(dataset.url, items.layout, items.filter, items.sorting);
                $("#fcrumbs").html('<a class="is_dir" data-set=\'{"url":""}\'>' + lang.home + '</a>  / ' + plugin.getCrumbs(dataset.url));
                if (dataset.name) {
                    var template = '' +
                        '<img src="' + plugin.options.url + '/images/mime/' + folder + '_folder.png" class="wojo basic medium image" alt=""> ' +
                        '<div class="wojo small relaxed celled fluid list vertical margin"> ' +
                        '<div class="item"><div class="header">' + plugin.maxLength(dataset.name, 20) + '</div></div> ' +
                        '<div class="item"><div class="header">' + lang.items + ': ' + dataset.files + '</div></div> ' +
                        '<a data-url="' + dataset.url + '" data-name="' + dataset.name + '" data-type="dir" class="wojo small negative fluid button item delSingle"> ' + lang.delete + '</a> ' +
                        '</div>';
                    $("#preview").html(template);
                    $("input[name=dir]").val(dataset.url);
                }
            });

            //Delete multiple files/folders
            $('#fm').on('click', '.is_delete', function() {
                var $this = $(this);
                var checkedValues = $('#listView input:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                if (!$.isEmptyObject(checkedValues)) {
                    $this.addClass('loading');
                    $.post(plugin.options.url + "/helper.php", {
                        action: "deleteFiles",
                        items: checkedValues,
                    }, function(json) {
                        if (json.type === "success") {
                            $('#listView tr').each(function() {
                                if ($(this).find('input:checked').length) {
                                    $(this).fadeOut(400, function() {
                                        $(this).remove();
                                    });
                                    $this.removeClass('loading');
                                }
                            });

                        }
                    }, "json");
                }
            });

            //Delete single files/folders
            $('#fm').on('click', '.delSingle', function() {
                var dir = $(this).data('url');
                var type = $(this).data('type');
                $.post(plugin.options.url + "/helper.php", {
                    action: "deleteFiles",
                    items: [dir],
                }, function(json) {
                    if (json.type === "success") {
                        if (type === "dir") {
                            $(element).html('<div class="wojo basic centered image"><img src="' + plugin.options.url + '/images/search_empty.png" alt=""></div>').transition('fadeIn');
                            $("#preview").html('');
                        } else {
                            $(element).find("[data-id='" + dir + "']").remove();
                            $("#preview").html('<img class="wojo medium basic image" src="' + plugin.options.url + '/images/search_empty.png" alt="">');
                        }

                    }
                }, "json");
            });

            //New Folder
            $('#fm').on('click', '#addFolder', function() {
                var $parent = $(this).parent('.input');
                var $field = $("input[name=foldername]");
                var items = plugin.filterDisplay();

                if ($field.val().length > 0) {
                    $parent.addClass('loading');
                    $.post(plugin.options.url + "/helper.php", {
                        action: "newFolder",
                        name: $field.val(),
                        dir: items.dir
                    }, function(json) {
                        if (json.type === "success") {
                            plugin.buildList(items.dir, items.layout, items.filter, items.sorting);
                            $parent.removeClass('loading');
                        }
                    }, "json");
                }

            });

            /* == Unzip == */
            $('#fm').on('click', '.unzip', function() {
                var url = $(this).data('url');
                $.post(plugin.options.url + "/helper.php", {
                    action: "unzipFile",
                    item: url,
                }, function(json) {
                    if (json.type === "success") {
                        var items = plugin.filterDisplay();
                        plugin.buildList(items.dir, items.layout, items.filter, items.sorting);
                    }
                }, "json");
            });

            /* == Check All == */
            $('#fm').on('change', '#selectAll', function() {
                var $checkbox = $("#listView").find(':checkbox');
                $checkbox.prop('checked', !$checkbox.prop('checked'));
                if ($checkbox.is(':checked')) {
                    $(".is_delete").removeClass("disabled");
                } else {
                    $(".is_delete").addClass("disabled");
                }
            });

            $('#result').on('change', 'input[type="checkbox"]', function() {
                if ($("#listView").find(':checkbox').is(':checked')) {
                    $(".is_delete").removeClass("disabled");
                } else {
                    $(".is_delete").addClass("disabled");
                }
            });

            //Type filter
            $('#ftype').on('click', 'a', function() {
                $('#ftype a').removeClass('active');
                var filter = $(this).data('type');
                $(this).addClass('active');
                var items = plugin.filterDisplay();
                plugin.buildList(items.dir, items.layout, filter, items.sorting);
            });

            //Sorting type
            $('.fileSort').on('change', function() {
                var sorting = $(this).val();
                var items = plugin.filterDisplay();
                plugin.buildList(items.dir, items.layout, items.filter, sorting);
            });

            //Display type
            $('#displayType').on('click', 'a', function() {
                $('#displayType a').removeClass('active');
                var layout = $(this).data('type');
                $(this).addClass('active');
                var items = plugin.filterDisplay();

                Cookies.set("CMS_FLAYOUT", layout, {
                    expires: 365,
                    path: '/'
                });
                plugin.buildList(items.dir, layout, items.filter, items.sorting);
            });

            //File Upload
            $('#drag-and-drop-zone').on('click', function() {
                var items = plugin.filterDisplay();
                $(this).wojoUpload({
                    url: plugin.options.url + "/helper.php",
                    dataType: 'json',
                    extraData: {
                        action: "uploadFile",
                        dir: items.dir
                    },
                    allowedTypes: '*',
                    onBeforeUpload: function(id) {
                        plugin.update_file_status(id, 'primary', 'Uploading...');
                    },
                    onNewFile: function(id, file) {
                        plugin.add_file(id, file);
                    },
                    onUploadProgress: function(id, percent) {
                        plugin.update_file_progress(id, percent);
                    },
                    onUploadSuccess: function(id, data) {
                        if (data.type === "error") {
                            plugin.update_file_status(id, '<i class="icon small negative circular minus"></i>', data.message);
                            plugin.update_file_progress(id, 0);
                        } else {
                            var icon = '<i class="icon small positive circular check"></i>';
                            var btn = '<img src="' + data.filename + '" class="wojo small rounded image">';

                            plugin.update_file_status(id, icon, btn);
                            plugin.update_file_progress(id, 100);
                        }
                    },
                    onUploadError: function(id, message) {
                        plugin.update_file_status(id, 'negative', message);
                    },
                    onFallbackMode: function(message) {
                        alert('Browser not supported: ' + message);
                    },

                    onComplete: function() {
                        $("#done").append('<a class="wojo small button">' + lang.done + '</a>');
                        $("#done").on('click', 'a', function() {
                            plugin.buildList(items.dir, items.layout, items.filter, items.sorting);
                            $('#fileList').html('');
                            $("#done a").remove();
                        });
                    }
                });
            });
        },

        add_file: function(id, file) {
            var template = '' +
                '<div class="item align middle" id="uploadFile_' + id + '">' +
                '<div class="columns auto" id="bStstus_' + id + '">' +
                '<div class="wojo icon button"><i class="icon white file"></i></div>' +
                '</div>' +
                '<div class="columns margin left" id="contentFile_' + id + '">' +
                '<h6 class="basic">' + file.name + '</h6>' +
                '</div>' +
                '<div class="columns auto" id="iStatus_' + id + '"><i class="icon small info circular upload"></i></div>' +
                '<div class="wojo attached bottom tiny positive progress">' +
                '<div class="bar" data-percent="100"></div>' +
                '</div>' +
                '</div>';

            $('#fileList').prepend(template);
        },

        update_file_status: function(id, status, message) {
            $('#bStstus_' + id).html(message);
            $('#iStatus_' + id).html(status);
        },

        update_file_progress: function(id, percent) {
            $('#uploadFile_' + id).find('.progress').wProgress();
            $('#uploadFile_' + id).find('.progress').attr("data-percent", percent);
        },

        // trim long filenames
        maxLength: function(title, chars) {
            return (title.length > chars) ? title.substr(0, (chars - 3)) + '...' : title;
        },

        // display filter
        filterDisplay: function() {
            var layout = $('#displayType a.active').data('type');
            var filter = $('#ftype a.active').data('type');
            var dir = $("input[name=dir]").val();
            var sorting = $(".fileSort option:selected").val();
            return {
                "dir": dir,
                "layout": layout,
                "filter": filter,
                "sorting": sorting
            };
        },

        //do crumbs
        getCrumbs: function(dir) {
			var here = dir.split('/').slice(1);
			var parts = [];
			for (var i = 0; i < here.length; i++) {
				var part = here[i];
				var text = part;
				var link = here.slice(0, i + 1).join("/");
				parts.push({
					"text": text,
					"link": link
				});
			}
		
			var crumbs = '';
			$.each(parts, function(index, value) {
				if ((parts.length - 1) !== index) {
					crumbs += '<a class="is_dir" data-set=\'{"url":"/' + value.link + '"}\'>' + value.text.substr(0, 1).toUpperCase() + value.text.substr(1) + '</a> / ';
				} else {
					crumbs += value.text.substr(0, 1).toUpperCase() + value.text.substr(1);
				}
			});
			
			return crumbs;
        },

        //Template
        renderTemplate: function(type, obj) {
            var plugin = this;
            var template = '';
            switch (type) {
                case "list":
                    template += '<div class="row grid small horizontal gutters phone-1 mobile-1 tablet-2 screen-2">';
                    if (obj.directory) {
                        $.each(obj.directory, function() {
                            var folder = (this.total > 0) ? 'folder open' : 'folder';
                            template += '<div class="columns" data-id="' + this.name + '">' +
                                '<a class="wojo simple icon message align middle is_dir" data-set=\'{"name":"' + this.name + '", "files":"' + this.total + '", "url":"' + this.path + '"}\'> ' +
                                '<i class="icon large ' + folder + '"></i> ' +
                                '<div class="content"> ' +
                                '' + this.name + '' +
                                '<p>' + this.total + ' files</p>' +
                                '</div> ' +
                                '</a>' +
                                '</div>';
                        });
                    }
                    if (obj.files) {
                        $.each(obj.files, function() {
                            var is_image = (this.is_image) ? plugin.options.dirurl + '/thumbs/' + this.name : plugin.options.url + '/images/mime/' + this.extension + '.png';
                            var is_svg = this.extension === "svg" ? plugin.options.dirurl + this.path : is_image;

                            template += '<div class="columns" data-id="' + this.name + '">' +
                                '<div class="selectable"> ' +
                                '<a class="wojo simple icon message align middle is_file" data-set=\'{"name":"' + this.name + '", "image":"' + this.is_image + '", "ext":"' + this.extension + '", "ftime":"' + this.ftime + '", "size":"' + this.size + '", "url":"' + this.url + '"}\'> ' +
                                '<img src="' + is_svg + '" alt="" class="wojo mini image">' +
                                '<div class="content"> ' +
								'' + this.name + '' +
                                '<p>' + this.size + '</p>' +
                                '</div> ' +
                                '</div></a>' +
                                '</div>';

                        });
                    }
                    template += '</div>';
                    break;

                case "grid":
                    template += '<div class="wojo mason">';
                    if (obj.directory) {
                        $.each(obj.directory, function() {
                            var folder = (this.total > 0) ? 'open' : 'closed';
                            template += '<div class="item" data-id="' + this.name + '">' +
                                '<div class="wojo attached segment"> ' +
                                '<div class="center aligned">' +
                                '<a data-set=\'{"name":"' + this.name + '", "files":"' + this.total + '", "url":"' + this.path + '"}\' class="is_dir"> ' +
                                '<img alt="" src="' + plugin.options.url + '/images/mime/' + folder + '_folder.png" class="wojo basic inline image"> ' +
                                '</a> ' +
                                '</div> ' +
                                '<div class="wojo divider"></div>' +
                                '<span class="wojo semi text">' + this.name + '</span>' +
                                '<p class="wojo semi text">' + this.total + ' files</p>' +
                                '</div> ' +
                                '</div>';
                        });
                    }

                    if (obj.files) {
                        $.each(obj.files, function() {
                            var dir = (this.extension === "svg") ? this.dir + "/" : "/thumbs/";
                            var is_image = (this.is_image) ? plugin.options.dirurl + dir + this.name : plugin.options.url + '/images/mime/' + this.extension + '.png';
                            var is_svg = this.extension === "svg" ? plugin.options.dirurl + this.path : is_image;

                            template += '<div class="item" data-id="' + this.name + '">' +
                                '<div class="wojo attached segment selectable">' +
                                '<div class="center aligned">' +
                                '<a class="is_file" data-set=\'{"name":"' + this.name + '", "image":"' + this.is_image + '", "ext":"' + this.extension + '", "ftime":"' + this.ftime + '", "size":"' + this.size + '", "url":"' + this.url + '"}\'>' +
                                '<img alt="" src="' + is_svg + '" class="wojo basic medium inline image"></a>' +
                                '</div>' +
                                '<div class="wojo divider"></div>' +
                                '<span class="wojo semi text">' + this.name + '</span>' +
                                '<p class="wojo semi text">' + this.size + '</p>' +
                                '</div>' +
                                '</div>';

                        });
                    }

                    template += '</div>';
                    break;

                default:
                    template += '<table class="wojo basic striped table">';
                    if (!plugin.options.is_editor) {
                        template += '' +
                            '<thead> ' +
                            ' <tr> ' +
                            '<th colspan="4" class="auto"><div class="wojo toggle checkbox fitted"> ' +
                            '<input type="checkbox" name="master" value="1" id="selectAll"> ' +
                            '<label for="selectAll">&nbsp;</label> ' +
                            '</div></th> ' +
                            '</tr> ' +
                            '</thead>';
                    }
                    template += '<tbody id="listView">';
                    if (obj.directory) {
                        $.each(obj.directory, function(key) {
                            var folder = (this.total > 0) ? 'folder open' : 'folder';
                            template += '<tr data-id="' + this.name + '">';
                            if (!plugin.options.is_editor) {
                                template += '' +
                                    '<td class="auto"><div class="wojo small checkbox fitted">' +
                                    '<input type="checkbox" name="' + this.name + '" value="' + this.path + '" id="dirView_' + key + '">' +
                                    '<label for="dirView_' + key + '"></label>' +
                                    '</div>' +
                                    '</td>';
                            }
                            template += '' +
                                '<td class="auto"><i class="icon primary ' + folder + '"></i></td> ' +
                                '<td><a class="black is_dir" data-set=\'{"name":"' + this.name + '", "files":"' + this.total + '", "url":"' + this.path + '"}\'>' + this.name + '</a></td> ' +
                                '<td class="auto">' + this.total + ' <small>(items)</small></td>';
                            template += '</tr>';
                        });
                    }

                    if (obj.files) {
                        $.each(obj.files, function(key) {
                            var mime = this.mime.split('/');
                            var icon = '';
                            switch (mime[0]) {
                                case "image":
                                    icon = '<i class="icon photo"></i>';
                                    break;
                                case "video":
                                    icon = '<i class="icon camera retro"></i>';
                                    break;
                                case "audio":
                                    icon = '<i class="icon volume"></i>';
                                    break;
                                default:
                                    icon = '<i class="icon file"></i>';
                                    break;
                            }

                            template += '<tr data-id="' + this.name + '" class="selectable">';
                            if (!plugin.options.is_editor) {
                                template += '' +
                                    '<td class="auto"><div class="wojo small checkbox fitted inline">' +
                                    '<input type="checkbox" name="' + this.name + '" value="' + this.url + '" id="fileView_' + key + '">' +
                                    '<label for="fileView_' + key + '"></label>' +
                                    '</div>' +
                                    '</td>';
                            }
                            template += '' +
                                '<td class="auto">' + icon + '</td>' +
                                '<td><a class="black is_file" data-set=\'{"name":"' + this.name + '", "image":"' + this.is_image + '", "ext":"' + this.extension + '", "ftime":"' + this.ftime + '", "size":"' + this.size + '", "url":"' + this.url + '"}\'>' + this.name + '</a></td>' +
                                '<td class="auto">' + this.size + '</td>';
                            template += '</tr>';
                        });
                    }

                    template += '</tbody>';
                    template += '</table>';
                    break;

            }

            return template;
        }

    });

    $.fn.Manager = function(options) {
        this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });

        return this;
    };

    $.fn.Manager.defaults = {
        url: "",
        dirurl: "",
        is_editor: false,
        is_mce: false,
        lang: {
            delete: "Delete",
            insert: "Insert",
            download: "Download",
            unzip: "Unzip",
            size: "Size",
            lastm: "Last Modified",
            items: "items",
            done: "Done",
            home: "Home",
        }
    };

})(jQuery, window, document);