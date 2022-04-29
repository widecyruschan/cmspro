(function($, window, document, undefined) {
    "use strict";
    var pluginName = 'Forms';

    // Create the plugin constructor
    function Plugin(element, options) {
        this.element = element;
        this._name = pluginName;
        this._defaults = $.fn.Forms.defaults;
        this.options = $.extend({}, this._defaults, options);

        document.ontouchmove = function() {
            return true;
        };

        this.elements = {
            design: $("#fDesign"),
            fields: $("#fItems"),
            props: $("#fProperty"),
        };

        this.init();
    }

    $.extend(Plugin.prototype, {
        init: function() {
            this.runForms();
            this.bindEvents();
            this.updateField();

        },

        runForms: function() {
            var plugin = this;
            //load form
            $.get(this.options.url, {
                action: "loadForm",
                id: $.url().segment(-1)
            }, function(json) {
                if (json.type === "success") {
                    $(plugin.elements.design).html(json.html);
                    $(".filefield").filestyle();
					$('input[type="range"]').wRange();
                }
				$(plugin.elements.design).removeClass('loading');
            }, "json");

            $(this.elements.design).sortable({
                name: 'layout',
                ghostClass: "ghost",
                draggable: ".fields",
                handle: ".handle",
                filter: ".remove",
                animation: 600,
                dataIdAttr: 'data-sort',
                onFilter: function(ui) {
                    var id = $(ui.item).data('id');
                    $(ui.item).remove();
                    $('[data-prop=' + id + ']', plugin.elements.props).remove();
                    $.post(plugin.options.url, {
                        action: "deleteField",
                        name: id
                    });
                },
                onUpdate: function() {
                    var order = this.toArray();
                    $.post(plugin.options.url, {
                        iaction: "sortItems",
                        id: $.url().segment(-1),
                        sorting: order
                    }, function() {}, "json");
                }
            });
        },

        bindEvents: function() {
            var plugin = this;
            var element = this.element;

            //add Field
            $(this.elements.fields).on('click', '.item', function() {
                plugin.addField(this);
                $('.item', plugin.elements.fields).removeClass('active');
                $(this).addClass('active');
            });

            //edit Field
            $(this.elements.design).on('click', '.wojo.fields > .item', function() {
                var name = $(this).data('name');
                $('.wojo.fields', element).removeClass('active');
                var active = $(this).parent().addClass('active');
                var type = $(active).data('type');

                $('.item', plugin.elements.fields).removeClass('active');
                $('.item[data-type=' + type + ']', plugin.elements.fields).addClass('active');

                if ($('[data-prop=' + name + ']', plugin.elements.props).length) {
                    plugin.saveField();
                }
                plugin.editField(name);
            });
        },

        addField: function(el) {
            var plugin = this;
            var name = $(el).data('type');
            $.get(plugin.options.url, {
                action: "addField",
                name: name,
                id: $.url().segment(-1),
                labeltype: this.options.ltype
            }, function(json) {
                if (json.type === "success") {
                    $(plugin.elements.design).append(json.html);
                    $(".filefield").filestyle();

                    $(plugin.elements.design).last('.wojo.fields');
                }
            }, "json");
        },

        editField: function(name) {
            var plugin = this;
            $.get(plugin.options.url, {
                action: "editField",
                name: name,
            }, function(json) {
                if (json.type === "success") {
                    $('form', plugin.elements.props).html(json.html);
                    $('.wojo.accordion').find("section").removeClass('active');
					$('.wojo.accordion').find(".details").fadeOut();
                }
            }, "json");
        },

        updateField: function() {
            var plugin = this;
            var lastTval = '';

            //label
            $(this.elements.props).on('change', 'textarea[name=label]', function() {
                var id = $("input:hidden[name=id]").val();
                var type = $("input:hidden[name=type]", plugin.elements.props).val();
                var value = $(this).val();
                $('label[data-id=' + id + ']', plugin.elements.design).text(value);
                $('input[name=' + id + ']', plugin.elements.design).attr('placeholder', value);
                if (type === "heading") {
                    $('.item[data-name=' + id + ']', plugin.elements.design).children().text(value);
                }
                plugin.saveField();

            });

            //instructions
            $(this.elements.props).on('change', 'textarea[name=tooltip]', function() {
                var id = $("input:hidden[name=id]").val();
                $('p[data-id=' + id + ']', plugin.elements.design).text($(this).val());
                plugin.saveField();
            });

            //default value
            $(this.elements.props).on('change', 'textarea[name=dvalue]', function() {
                var id = $("input:hidden[name=id]").val();
                $('input[name=' + id + ']', plugin.elements.design).val($(this).val());
                plugin.saveField();
            });

            $(this.elements.props).on('change', 'select[name=dvalue]', function() {
                var id = $("input:hidden[name=id]").val();
                var type = $("input:hidden[name=type]", plugin.elements.props).val();
                switch (type) {
                    case "heading":
                        var heading = $('.item[data-name=' + id + ']', plugin.elements.design).children();
                        $(heading).removeClass("small large big huge normal");
                        $(heading).addClass($(this).val());
                        break;

                    case "image":
                        var child = $('.item[data-name=' + id + ']', plugin.elements.design).find('.wojo.image');
                        $(child).removeClass("small large big huge normal");
                        $(child).addClass((($(this).val() === "normal") ? "" : $(this).val()));
                        break;
                }
                plugin.saveField();
            });

            //required
            $(this.elements.props).on('change', 'input[name=required]', function() {
                var id = $("input:hidden[name=id]").val();
                var label = $('label[data-id=' + id + ']', plugin.elements.design);
                if ($(this).prop("checked") === true) {
                    $(label).append(' <i class="icon asterisk"></i>');
                    plugin.saveField();
                } else if ($(this).prop("checked") === false) {
                    $(label).find('i').remove();
                    plugin.saveField();
                }
            });

            //multiple
            $(this.elements.props).on('change', 'input[name=multiple]', function() {
                plugin.saveField();
            });

            //inline
            $(this.elements.props).on('change', 'input[name=inline]', function() {
                var id = $("input:hidden[name=id]").val();
                if ($(this).prop("checked") === true) {
                    $('.field.item[data-name=' + id + ']', plugin.elements.design).children().addClass('inline fitted');
                } else {
                    $('.field.item[data-name=' + id + ']', plugin.elements.design).children().removeClass('fitted inline');
                }
                plugin.saveField();
            });

            //min length
            $(this.elements.props).on('change', 'input[name=min_len]', function() {
                plugin.saveField();
            });

            //max length
            $(this.elements.props).on('change', 'input[name=max_len]', function() {
                plugin.saveField();
            });

            //validation
            $(this.elements.props).on('change', 'select[name=validation]', function() {
                plugin.saveField();
            });

            //filesize
            $(this.elements.props).on('change', 'input[name=filesize]', function() {
                plugin.saveField();
            });

            //html
            $(this.elements.props).on('click', 'a#editHtml', function() {
                var id = $("input:hidden[name=id]").val();
                $(this).replaceWith('<a class="wojo small basic positive button" id="saveHtml">' + plugin.options.lang.saveHtml + '</a>');
                $('.field.item[data-name=' + id + ']', plugin.elements.design).redactor({
					air: true,
					minHeight: "200px",
					plugins: ['alignment', 'fontcolor', 'definedlinks', 'fullscreen'],
                });
            });

            //image
			$(this.elements.props).on('click', '#imgpicker', function() {
				var id = $("input:hidden[name=id]").val();
				$.get(plugin.options.aurl + '/managerBuilder.php', {
					pickFile: 1,
					editor: true
				}, function(data) {
					$('<div class="wojo big modal"><div class="dialog" role="document"><div class="content">' + data + '</div></div></div>').modal();
					$("#result").on('click', '.is_file', function() {
						var dataset = $(this).data('set');
						if (dataset.image === "true") {
							$('input[name=validation]', plugin.elements.props).val(dataset.url);
							$('#' + id).attr('src', plugin.options.surl + '/uploads/' + dataset.url);
							plugin.saveField();
							$.modal.close();
						}
					});
				});
			});

            $(this.elements.props).on('click', 'a#saveHtml', function() {
                var id = $("input:hidden[name=id]").val();
                var value = $('.field.item[data-name=' + id + ']', plugin.elements.design);
                $(value).redactor('destroy');
                $('input[name=dvalue]', plugin.elements.props).val($(value).html());
                plugin.saveField();
                $('.fields[data-id=' + id + ']', plugin.elements.design).removeClass('active');
                $("#item_form").empty();
            });

            //expend textarea
            $(this.elements.props).on('focus', 'textarea.grow', function() {
                lastTval = $(this).val();
            });
            $(this.elements.props).on('blur', 'textarea.grow', function() {
                if ($(this).val().trim().length > 0) {
                    $(this).removeClass('error');
                    if (lastTval !== $(this).val()) {
                        plugin.updateList(this);
                        plugin.saveField();
                    }
                } else {
                    $(this).addClass('error');
                }
            });

            //import select values
            $(this.elements.props).on('click', 'a#importSelect', function() {
                var id = $("input:hidden[name=id]").val();
                $.get(plugin.options.url, {
                    action: "importSelect",
                    items: $("textarea.grow", plugin.elements.props).val(),
                }).done(function(data) {

				var actions = '' +
					'<div class="footer">' +
					'<button type="button" class="wojo small simple button" data="modal:close">' + plugin.options.lang.cancel + '</button>' +
					'<button type="button" class="wojo small positive button" data="modal:ok">' + plugin.options.lang.insert + '</button>' +
					'</div>';
					
                $('<div id="selectModal" class="wojo big modal"><div class="dialog" role="document"><div class="content">' +
                    '' + data + '' +
                    '' + actions + '' +
                    '</div></div></div>').on($.modal.OPEN, function() {
                        $("#selectModal").on('click', 'a.item', function() {
                            var id = $(this).data('id');
                            var results = '';
                            var array = [];
                            switch (id) {
                                case "dow":
                                    results += plugin.options.days.join("\n");
                                    array = plugin.options.days;
                                    break;
                                case "moy":
                                    results += plugin.options.months.join("\n");
                                    break;
                                case "age":
                                    var age = [plugin.options.lang.under + " 18", "18-24", "25-34", "25-44", "45-54", "55-64", "65 " + plugin.options.lang.orOver];
                                    results += age.join("\n");
                                    break;
                                case "years":
                                    results += plugin.yearRange().join("\n");
                                    break;
                                case "con":
                                    results += plugin.parseJson("continents").join("\n");
                                    break;
                                case "us":
                                    results += plugin.parseJson("us").join("\n");
                                    break;
                                case "ca":
                                    results += plugin.parseJson("ca").join("\n");
                                    break;
                                case "eu":
                                    results += plugin.parseJson("eu").join("\n");
                                    break;
                                case "uk":
                                    results += plugin.parseJson("uk").join("\n");
                                    break;
                                case "cn":
                                    results += plugin.parseJson("countries").join("\n");
                                    break;
                                case "nu":
                                    results += plugin.numberRange().join("\n");
                                    break;
                            }

                            $("#selectModal textarea").val(results);
                        });
							
					}).modal().on('click', '[data="modal:ok"]', function() {
                        var results = $("#selectModal textarea");
                        $("textarea.grow", plugin.elements.props).val(results.val());
                        plugin.updateList(results);
                        plugin.saveField();

                        var type = $("input:hidden[name=type]").val();
                        var html = '';
                        if (type === "checkbox" || type === "radio") {
                            var lines = $(results).val().split(/\n/);
                            for (var i = 0; i < lines.length; i++) {
                                if (/\S/.test(lines[i])) {
                                    html += '<div class="wojo checkbox' + (type === "radio" ? " radio" : "") + ' field"> ' +
                                        '<input name="items" type="' + type + '" value="' + lines[i] + '"> ' +
                                        '<label>' + lines[i] + '</label> ' +
                                        '</div>';
                                }
                            }
                        }
                        $('.field.item[data-name=' + id + ']', plugin.elements.design).children().first().html(html);
						$.modal.close();
						
					});
                });
            });
        },

        saveField: function() {
            var options = {
                target: null,
                type: "post",
                url: this.options.url,
                data: {
                    action: "saveField"
                },
                dataType: 'json'
            };

            $("#item_form").ajaxForm(options).submit();
        },

        updateList: function(items) {
            var lines = $(items).val().split(/\n/);
            var opts = "";
            for (var i = 0; i < lines.length; i++) {
                if (/\S/.test(lines[i])) {
                    opts += '<option value="' + lines[i] + '">' + lines[i] + '</option>';
                }
            }
			$('select[name=dvalue]', this.elements.props).html(opts);
        },

        yearRange: function() {
            var d = new Date("01 " + "January 1930");
            var start = d.getFullYear();

            var s = new Date();
            var end = s.getFullYear();
            var arr = [];

            for (var i = start; i <= end; i++) {
                arr.push(i);
            }

            return arr;
        },

        numberRange: function() {
            var start = 1;
            var end = 50;
            var arr = [];

            for (var i = start; i <= end; i++) {
                arr.push(i);
            }

            return arr;
        },

        parseJson: function(data) {
            var arr = [];
            $.ajax({
                type: "get",
                url: this.options.murl + "snippets/lists.json",
                dataType: "json",
                async: false,
                success: function(json) {
                    $.each(json[data], function() {
                        arr.push(this.name);
                    });
                }
            });
            return arr;
        }

    });

    $.fn.Forms = function(options) {
        this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });

        return this;
    };

    $.fn.Forms.defaults = {
        url: '',
        aurl: '',
        surl: '',
        murl: '',
        ltype: 0,
        days: [],
        months: [],
        lang: {
            cancel: 'Cancel',
            insert: 'Insert',
            optEditor: 'Options Editor',
            under: 'under',
            orOver: 'or Over',
            saveHtml: 'Save HTML',

        }

    };

})(jQuery, window, document);