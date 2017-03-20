(function($) {
    $.Master = function(settings) {
        var config = {
            weekstart: 0,
            contentPlugins: {},
            editor: 1,
            editorCss: '',
            lang: {
                button_text: "Choose file...",
                empty_text: "No file...",
                monthsFull: '',
                monthsShort: '',
                weeksFull: '',
                weeksShort: '',
                today: "Today",
                clear: "Clear",

                delMsg1: "Are you sure you want to delete this record?",
                delMsg2: "This action cannot be undone!",
                working: "working..."
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        var itemid = ($.url(true).param('id')) ? $.url(true).param('id') : 0;
        var plugname = $.url(true).param('plugname');
        var modname = $.url(true).param('modname');
        var posturl = (plugname ? "plugins/" + plugname + "/controller.php" : (modname ? "modules/" + modname + "/controller.php" : "controller.php"));

        /* == Side Menu == */
        $("nav > ul > li > a.collapsed + ul").hide();
        $("nav > ul > li > a").click(function() {
            $(this).toggleClass("expanded").toggleClass("collapsed").find("+ ul").slideToggle(100);
        });

        $("select").chosen({
            disable_search_threshold: 10,
            width: "100%"
        });

        $('.corporato.dropdown').dropdown();
        $('body [data-content]').popover({
            trigger: 'hover',
            placement: 'auto'
        });

        $("table.sortable").tablesort();

        $(".filefield").filestyle({
            buttonText: config.lang.button_text
        });

        $('body [data-datepicker]').pickadate({
            firstDay: config.weekstart,
            formatSubmit: 'yyyy-mm-dd',
            monthsFull: config.lang.monthsFull,
            monthsShort: config.lang.monthsShort,
            weekdaysFull: config.lang.weeksFull,
            weekdaysShort: config.lang.weeksShort,
            today: config.lang.today,
            clear: config.lang.clear,
        });

        $('body [data-timepicker]').pickatime({
            formatSubmit: 'HH:i:00'
        });
        /* == Lightbox == */
        $('.lightbox').swipebox();

        /* == Scrollbox == */
        $(".chosen-results, .scrollbox").enscroll({
            showOnHover: true,
            addPaddingToPane: false,
            verticalTrackClass: 'scrolltrack',
            verticalHandleClass: 'scrollhandle'
        });

        /* == Help Sidebar == */
        $('body').on('click', '.helper', function() {
            var div = $(this).data('help');
            $('#helpbar').sidebar('toggle').addClass('loading');
            setTimeout(function() {
                $('#helpbar').load('help/help.php #' + div + '-help');
                $('#helpbar').removeClass('loading');
            }, 500);
            $('#helpbar').enscroll({
                addPaddingToPane: false
            });
        })

        /* == Close Message == */
        $('body').on('click', '.message i.close.icon', function() {
            var $msgbox = $(this).closest('.message')
            $msgbox.slideUp(500, function() {
                $(this).remove()
            });
        });

        /* == Close Note == */
        $('body').on('click', '.note i.close.icon', function() {
            var $msgbox = $(this).closest('.note')
            $msgbox.slideUp(500, function() {
                $(this).remove()
            });
        });

        /* == Language Switcher == */
        $('.langmenu').on('click', 'a', function() {
            var target = $(this).attr('href');
            $.cookie("LANG_CMSPRO", $(this).data('lang'), {
                expires: 120,
                path: '/'
            });
            $('body').fadeOut(1000, function() {
                window.location.href = target;
            });
            return false
        });

        /* == Tabs == */
        $(".tab_content").hide();
        $("#tabs a:first").addClass("active").show();
        $(".tab_content:first").show();
        $("#tabs a").on('click', function() {
            $("#tabs a").removeClass("active");
            $(this).addClass("active");
            $(".tab_content").hide();
            var activeTab = $(this).data("tab");
            $(activeTab).show();
            //return false;
        });

        /* == Toggle Menu icons == */
        $('#scroll-icons').on('click', 'i', function() {
            var micon = $("input[name=icon]");
            $('#scroll-icons i.active').not(this).removeClass('active');
            $(this).toggleClass("active");
            micon.val($(this).hasClass('active') ? $(this).attr('data-icon-name') : "");
        });

        /* == Single File Picker == */
        $('body').on('click', '.filepicker', function() {
            type = $(this).prev('input').data('ext');
            Messi.load('controller.php', {
                pickFile: 1,
                ext: type
            }, {
                title: config.lang.button_text
            });
        });

        $("body").on("click", ".filelist a", function() {
            var path = $(this).data('path');
            $('input[name=filename], input[name=attr]').val(path);
            $('.messi-modal, .messi').remove();

        });

        /* == Editor == */
        $('.bodypost').redactor({
            observeLinks: true,
            wym: true,
            toolbarFixed: true,
            minHeight: 200,
            maxHeight: 500,
            plugins: ['fullscreen']
        });

        /* == Editor == */
        $('.fullpage').redactor({
            observeLinks: true,
            toolbarFixed: true,
            minHeight: 500,
            maxHeight: 800,
            iframe: true,
            focus: true,
            buttons: ['html', 'formatting', 'bold', 'italic', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'table'],
            plugins: ['fullscreen']
        });

        $('.altpost').redactor({
            observeLinks: true,
            minHeight: 100,
            buttons: ['formatting', 'bold', 'italic', 'unorderedlist', 'orderedlist', 'outdent', 'indent'],
            wym: true,
            plugins: ['fullscreen']
        });
        /* == Submit Search by date == */
        $("#doDates").on('click', function() {
            $("#admin_form").submit();
            return false;
        });

        /* == Master Form == */
        $('body').on('click', 'button[name=dosubmit]', function() {
            function showResponse(json) {
                $(".corporato.form").removeClass("loading");
                $("#msgholder").html(json.message);
            }

            function showLoader() {
                $(".corporato.form").addClass("loading");
            }
            var options = {
                target: "#msgholder",
                beforeSubmit: showLoader,
                success: showResponse,
                type: "post",
                url: posturl,
                dataType: 'json'
            };

            $('#corporato_form').ajaxForm(options).submit();
        });

        

        /* == Check all == */

        $('#masterCheckbox').click(function (e) {
            var $checkBoxes = $("input[type=checkbox]");
            $($checkBoxes).prop("checked",$(this).prop("checked"))
        });

        /* == Delete Multiple == */
        $('body').on('click', 'button[name=mdelete]', function() {
            function showResponse(json) {
                $("button[name='mdelete']").removeClass("loading");
                $('.corporato.table tbody tr').each(function() {
                    if ($(this).find('input:checked').length) {
                        $(this).fadeOut(400, function() {
                            $(this).remove();
                        });
                    }
                });
                $("#msgholder").html(json.message);
            }

            function showLoader() {
                $("button[name='mdelete']").addClass("loading");
                $('.corporato.table tbody tr').each(function() {
                    if ($(this).find('input:checked').length) {
                        $(this).animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    }
                });

            }

            var options = {
                target: "#msgholder",
                beforeSubmit: showLoader,
                success: showResponse,
                type: "post",
                url: posturl,
                dataType: 'json'
            };

            $('#corporato_form').ajaxForm(options).submit();
        });

        /* == Delete Item == */
        $('body').on('click', 'a.delete', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var title = $(this).data('title');
            var option = $(this).data('option');
            var extra = $(this).data('extra');
            var parent = $(this).parent().parent();
            new Messi("<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p>" + config.lang.delMsg1 + "<br><strong>" + config.lang.delMsg2 + "</strong></p></div>", {
                title: title,
                titleClass: '',
                modal: true,
                closeButton: true,
                buttons: [{
                    id: 0,
                    label: 'Delete Record',
                    class: 'negative',
                    val: 'Y'
                }],
                callback: function(val) {
                    $.ajax({
                        type: 'post',
                        url: posturl,
                        dataType: 'json',
                        data: {
                            id: id,
                            delete: option,
                            extra: extra ? extra : null,
                            title: encodeURIComponent(name)
                        },
                        beforeSend: function() {
                            parent.animate({
                                'backgroundColor': '#FFBFBF'
                            }, 400);
                        },
                        success: function(json) {
                            parent.fadeOut(400, function() {
                                parent.remove();
                            });
                            $.sticky(decodeURIComponent(json.message), {
                                type: json.type,
                                title: json.title
                            });
                        }

                    });
                }
            });
        });

        /* == Submit Search by date == */
        $("#doDates").on('click', function() {
            $("#corporato_form").submit();
            return false;
        });

        /* == Inline Edit == */
        $('body').on('focus', 'div[contenteditable=true]:not(.redactor_editor)', function() {
            $(this).data("initialText", $(this).text());
            $('div[contenteditable=true]:not(.redactor_editor)').not(this).removeClass('active');
            $(this).toggleClass("active");
        }).on('blur', 'div[contenteditable=true]:not(.redactor_editor)', function() {
            if ($(this).data("initialText") !== $(this).text()) {
                title = $(this).text();
                type = $(this).data("edit-type");
                id = $(this).data("id")
                key = $(this).data("key")
                path = $(this).data("path")
                $this = $(this);
                $.ajax({
                    type: "POST",
                    url: posturl,
                    data: ({
                        'title': title,
                        'type': type,
                        'key': key,
                        'path': path,
                        'id': id,
                        'quickedit': 1
                    }),
                    beforeSend: function() {
                        $this.text(config.lang.working).animate({
                            opacity: 0.2
                        }, 800);
                    },
                    success: function(res) {
                        $this.animate({
                            opacity: 1
                        }, 800);
                        setTimeout(function() {
                            $this.html(res).fadeIn("slow");
                        }, 1000);
                    }
                })
            }
        });

        $(window).on('resize', function() {
            $(".slrange").ionRangeSlider('update');
        });

        $(document).on('dragover', function(e) {
            var dropZone = $('#drop'),
                timeout = window.dropZoneTimeout;
            if (!timeout) {
                dropZone.addClass('in');
            } else {
                clearTimeout(timeout);
            }
            var found = false,
                node = e.target;
            do {
                if (node === dropZone[0]) {
                    found = true;
                    break;
                }
                node = node.parentNode;
            } while (node != null);
            if (found) {
                dropZone.addClass('hover');
            } else {
                dropZone.removeClass('hover');
            }
            window.dropZoneTimeout = setTimeout(function() {
                window.dropZoneTimeout = null;
                dropZone.removeClass('in hover');
            }, 100);
        });

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
    };
})(jQuery);