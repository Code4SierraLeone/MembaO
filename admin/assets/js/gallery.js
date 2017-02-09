(function ($, doc, win) {
    "use strict";

    function CorporatoGrid(el, opts) {
        this.$el = $(el);
        this.defaults = {
            inner: 14,
            outer: 0,
            mask: 0
        };

        this.opts = $.extend(this.defaults, opts);

        this.init();
    }

    CorporatoGrid.prototype.init = function () {

        // Creates and displays the grid
        this.$el.elasticColumns({
            columns: this.getColumnsCount(),
            innerMargin: this.defaults.inner,
            outerMargin: this.defaults.outer,
            hasMask: this.defaults.mask
        });

        this.displayItems();
        this.fileUpload();
        this.onDeleteImage();

        $(window).on('resize', $.proxy(this, 'onResize'));
    };

    CorporatoGrid.prototype.getColumnsCount = function () {
        var grid_width = this.$el.width();
        var column_width = grid_width;
        var columns = 1;
        while (column_width > 400) {
            columns += 1;
            column_width = grid_width / columns;
        }
        return columns;
    };

    CorporatoGrid.prototype.onResize = function () {
        this.$el.elasticColumns('refresh');
        this.$el.elasticColumns('set', 'columns', this.getColumnsCount());
    };

    CorporatoGrid.prototype.onAddNewItems = function (items) {
        this.$el.prepend(items);

        var $images = this.$el.children().find('img');
        if ($images.length > 0) {
            $images.on('load', $.proxy(this, 'onNewContentLoaded'));
            $images.on('error', $.proxy(this, 'onNewContentLoaded'));

            if (this.defaults.mask) {
                this.$el.children().each(function () {
                    $rev = $(this).children(".reveal");
                    $mask = $(this).find(".mask");
                    var height = $rev.height();
                    $($mask).css("height", height)
                })
            }
        } else {
            this.onNewContentLoaded();
        }
    };

    CorporatoGrid.prototype.onNewContentLoaded = function () {
        this.$el.elasticColumns('refresh');
        this.displayItems();
    };

    CorporatoGrid.prototype.displayItems = function () {
        var delay = 0;
		this.$el.waitForImages($.proxy(function (e) {
			this.$el.children().each(function () {
				$(this).delay(delay).hide().fadeIn(600);
				delay += 150;
			});
		}, this));
    };

    $.fn.CorporatoGrid = function (opts) {
        return this.each(function () {
            new CorporatoGrid(this, opts);
        });
    };
    CorporatoGrid.prototype.onDeleteImage = function () {
        $('body').on('click', 'a.corporato.label', $.proxy(function (e) {
            this.$item = e.currentTarget;

            var id = $(this.$item).data('id');
            var name = $(this.$item).data('name');
            var parent = $(this.$item).closest('.item');
            var dir = this.defaults.curDir;

            $.ajax({
                type: 'post',
                url: "controller.php",
                dataType: 'json',
                data: {
                    id: id,
                    delete: 'deleteGalleryImage',
                    title: encodeURIComponent(name)
                },
                beforeSend: function () {
                    parent.animate({
                        'backgroundColor': '#FFBFBF'
                    }, 400);
                },
                success: $.proxy(function (json) {
                    parent.fadeOut(400, function () {
                        parent.remove();
                    });
                    this.$el.elasticColumns('refresh');
                    $.sticky(decodeURIComponent(json.message), {
                        type: json.type,
                        title: json.title
                    });
                }, this)

            });

        }, this));
    };

    CorporatoGrid.prototype.fileUpload = function () {
        var ul = $('#upload ul');
        $('#drop a').click(function () {
            $(this).parent().find('input').click();
        });

        $('#upload').fileupload({
            dropZone: $('#drop'),
            limitMultiFileUploads: 5,
            sequentialUploads: true,
            add: $.proxy(function (e, data) {
                var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48" data-fgColor="#15a5fb" data-readOnly="1" data-bgColor="#eff2f8" /><p><small></small></p><span></span></li>');

                tpl.find('p').text(data.files[0].name)
                    .append('<small></small>')
                    .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                data.context = tpl.appendTo(ul);
                tpl.find('input').knob();
                tpl.find('span').click(function () {

                    if (tpl.hasClass('working')) {
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function () {
                        tpl.remove();
                    });

                });
                var jqXHR = data.submit().success($.proxy(function (result) {
                    var json = JSON.parse(result);
                    var status = json['status'];

                    if (status == 'error') {
                        data.context.addClass('error');
                        data.context.find('span').addClass('ferror');
                        data.context.find('small').append(json['msg']);
                    } else {
                        this.onAddNewItems(json['msg']);
                    }
                    //console.log(json)
                }, this));
            }, this),

            progress: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                data.context.find('input').val(progress).change();
                if (progress == 100) {
                    data.context.removeClass('working');
                }
            },

            fail: function (e, data) {
                data.context.addClass('error');
            },

        });
    };
	
	function formatFileSize(bytes) {
		if (typeof bytes !== 'number') {
			return '';
		}

		if (bytes >= 1000000000) {
			return (bytes / 1000000000).toFixed(2) + ' GB';
		}

		if (bytes >= 1000000) {
			return (bytes / 1000000).toFixed(2) + ' MB';
		}

		return (bytes / 1000).toFixed(2) + ' KB';
	}
})(jQuery, document, window);