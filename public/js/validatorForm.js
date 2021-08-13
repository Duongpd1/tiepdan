function IsValidationFileSize(source, args) {
    arguments.isvalid = false;
    fileupload = document.getElementById(source.controltovalidate);
    file = fileupload.files[0];
    if (file.size < (1048576 * 10)) {  // 10 MB
        args.IsValid = true;
    }
    else {
        args.IsValid = false;
    }
    return;
}

function ValidatorUpdateDisplay(val) {
    if (typeof (val.display) == "string") {
        if (val.display == "None") {
            return;
        }
        if (val.display == "Dynamic") {
            val.style.display = val.isvalid ? "none" : "block";

            var parent = findParentBySelector(val, ".form-group");

            if (val.isvalid) {
                if (parent != null) {
                    parent.classList.remove("has-error");
                }
                val.className = "";
            }
            else {
                if (parent != null) {
                    parent.classList.add("has-error");
                }
                val.className = "text-danger";
            }

            return;
        }

    }
    val.style.visibility = val.isvalid ? "hidden" : "visible";
}