$(document).ready(function () {
    $("button[type=submit]").on("click", function () {
        var action = $(this).prop("name");
        var str = $("#admin_form").serialize();
        str += '&comproccess=1';
        str += '&action=' + action;
        $.ajax({
            type: "post",
            url: 'controller.php',
			dataType: 'json',
            data: str,
            success: function (json) {
                $(".corporato.sortable.table tbody tr").each(function () {
                    if ($(this).find("input:checked").length) {
                        if (action == "delete") {
                            $(this).fadeOut(400, function () {
                                $(this).remove();
                            });
                        } else {
                            $(this).addClass('warning');
                        }
                    }
                });
                $("#msgholder").html(json.message);
            }
        });
        return false;
    });
	
    $('a.viewcomment').on('click', function () {
		var id = $(this).data('id');
		var title = $(this).data('username');
		var $parent = $(this).closest('tr');
		
        Messi.load('controller.php', {
            loadComment: 1,
			id: id
        }, {
            title: "Editing Comment",
            closeButton: true,
            buttons: [{
                id: 0,
                label: "Update Comment",
                val: "Y",
				class: "positive"
            }],
            callback: function (val) {
                $.ajax({
                    type: 'post',
                    url: 'controller.php',
                    dataType: 'json',
                    data: {
                        processComment: 1,
                        id: id,
                        content: $("#bodyid").val()
                    },
                    beforeSend: function () {},
                    success: function (json) {
						$($parent).addClass('warning');
						console.log($parent)
                        $.sticky(decodeURIComponent(json.message), {
                            type: json.type,
                            title: json.title
                        });
                    }
                });
            }
        });
    });
	
    $('#masterCheckbox').click(function (e) {
        var $checkBoxes = $("input[type=checkbox]");
        $($checkBoxes).prop("checked", $(this).prop("checked"))
    });
});