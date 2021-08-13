function ShowErrorMess(mess) {
    bootbox.dialog({
        closeButton: true,
        title: "Thông báo",
        message: "<div class='text-danger'>" + mess + "</div>",
        buttons: {
            success: {
                label: "<span class='glyphicon glyphicon-remove'></span> Đóng",
                className: "btn btn-sm btn-info"
            }
        }
    });
}