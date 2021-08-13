
document.addEventListener("click", function (e) {
    console.log('claer');
    $("#suggesstion-box").empty();
});
var objAutoComplete = {
    do_suggest: function (elementId, url) {

        $("#" + elementId).keyup(function () {

            if ($(this).val().length > 0) {
                $.ajax({
                    type: "get",
                    url: url,
                    data: {

                        key_word: $(this).val(),
                        id: elementId
                    },
                    beforeSend: function (xhr) {
                        //
                        // if (Boilerplate) {
                        //     return xhr.setRequestHeader('X-CSRF-TOKEN', Boilerplate);
                        // }
                    },
                    success: function (data) {
                        console.log(data);
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#" + elementId).css("background", "#FFF");

                    }
                });
            } else {
                $("#suggesstion-box").hide();
                $('.autocomplete-items').hide();
                $("#hide_" + elementId).val(null);
            }



        });
    },
    close_all_list:function (elemt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elemt != x[i]) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
};