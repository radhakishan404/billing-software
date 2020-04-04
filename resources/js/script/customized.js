
jQuery(document).ready(function () {

    $(document).on('change', "#date", function () {
        console.log($("#date").val());
        if ($("#date").val() != ''){
            $.ajax({
                url: baseurl + 'attendance/members_for_attendance',
                type: 'get',
                data: { date: $("#date").val() },
                dataType: 'html',
                success: function (result) {
                    $("#member_add_ajax").html(result);
                },
                error: function (error) {
                }
            });
        }
    });
});
