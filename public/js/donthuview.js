jQuery.fn.NumericOnly = function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 188 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105));
        });
    });
};

function cancelValidate() {
    $("#aspnetForm").validate().cancelSubmit = true;
}

function OpenPopup(path, parameter, popupWith, popupHeight) {
    var left = screen.width / 2 - (popupWith / 2);
    var top = screen.height / 2 - (popupHeight / 2);
    var strFeatures = 'width=' + popupWith +
        'px,height=' + popupHeight +
        'px,top=' + top +
        'px,left=' + left +
        'px,titlebar=1,menubar=0,toolbar=0,resizable=0,status=1,scrollbars=1,dependent=yes';
    if (parameter.length > 0) parameter = "/" + parameter+ "?" +parameter;
    window.open(path + parameter, '_blank', strFeatures);
}
function OpenPopupGetData(path, popupWith, popupHeight) {
    var left = (screen.width / 2) - (popupWith / 2);
    var top = (screen.height / 2) - (popupHeight / 2);
    var strFeatures = 'width=' + popupWith +
        'px,height=' + popupHeight +
        'px,top=' + top +
        'px,left=' + left +
        'px,titlebar=1,menubar=0,toolbar=0,resizable=0,status=1,scrollbars=1,dependent=yes';
    //if (parameter.length > 0) parameter = "?" + parameter;
    window.open(path , '_blank', strFeatures);
}

function CheckInput(objId, messenger) {
    return $('#' + objId).val().length <= 0 ? messenger : "";
}

function ReplaceAll(find, replace, input) {
    var re = new RegExp(find, 'g');
    return input.replace(re, replace);
}

function AnHienPanel(panelId, value) {
    if (value == true)
        $(panelId).show();
    else
        $(panelId).hide();
}

function ShowDatepicker(objId) {
    $('#' + objId).datepicker({ changeMonth: true, changeYear: true });
    $('#' + objId).attr('placeholder', 'dd/mm/yyyy');
    $('#' + objId).css('width', '75px');
}

function checkIsValid(objId, errorMsg) {
    var result = false;
    var getObj = $('#' + objId);
    var value = $.trim(getObj.val());
    getObj.next('label').remove();
    result = value.length > 0;
    if (!result) {
        getObj.css({ 'border': '1px dotted #f00' });
        getObj.after('<label class="error">' + errorMsg + '</label>');
    }
    else {
        getObj.css({ 'border': '1px dotted #ccc' });
    }
    return result;
}

function isValid(objId, min, max, type) {
    var kq = false;
    switch (type) {
        case 0:   // text box
            kq = isTextbox(objId, min, max);
            break;
        case 1: // date
            kq = isDate(objId);
            break;
        case 2: // email
            kq = isEmail(objId);
            break;
    }
    if (kq) {
        $('#' + objId).css({ 'border': '1px solid #ccc' });
    }
    else {
        $('#' + objId).css({ 'border': '1px dotted #f00' });
    }
    return kq;
}

function isTextbox(objId, min, max) {
    var value = $.trim($('#' + objId).val());
    if (max == 0) {
        return value.length >= min;
    }
    else {
        return value.length >= min && value.length <= max;
    }
}

function isDate(objId) {
    var currVal = $.trim($('#' + objId).val());

    if (currVal == '') return false;

    //Declare Regex
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null) return false;

    //Checks for dd/mm/yyyy format.
    dtDay = dtArray[1];
    dtMonth = dtArray[3];
    dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;
    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
        return false;
    else if (dtMonth == 2) {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay > 29 || (dtDay == 29 && !isleap))
            return false;
    }
    return true;
}

function isEmail(objId) {
    var email = $.trim($('#' + objId).val());
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email))
        return false;
    else
        return true;
}

function GetNodeValue(node) {
    //node value
    var nodeValue = "";
    var nodePath = node.href.substring(node.href.indexOf(",") + 2, node.href.length - 2);
    var nodeValues = nodePath.split("\\");
    if (nodeValues.length > 1)
        nodeValue = nodeValues[nodeValues.length - 1];
    else
        nodeValue = nodeValues[0].substr(1);
    return nodeValue;
}

function GetNodeText(node, mEvent) {
    var nodeText = "";
    var nav = navigator.userAgent.toLowerCase();
    if (nav.indexOf('msie') > -1)//IE
        nodeText = node.innerText;
    else if (mEvent.target)
        nodeText = node.text;
    return nodeText;
}

function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('index.html', 14));


    if (baseURL.indexOf('http://localhost/') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("index.html", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }

}

function NumberOnly() {
    $(".numberonly").keydown(function (e) {
        if (e.shiftKey) e.preventDefault();
        else {
            var nKeyCode = e.keyCode;
            //Ignore Backspace, Tab keys, dấu chấm, dấu phẩy
            if (nKeyCode == 8 || nKeyCode == 9 || nKeyCode == 190 || nKeyCode == 188 || nKeyCode == 110) return;
            if (nKeyCode < 95) {
                if (nKeyCode < 48 || nKeyCode > 57) e.preventDefault();
            } else {
                if (nKeyCode < 96 || nKeyCode > 105) e.preventDefault();
            }
        }
    });
}

function collectionHas(a, b) { //helper function (see below)
    for (var i = 0, len = a.length; i < len; i++) {
        if (a[i] == b) return true;
    }
    return false;
}

function findParentBySelector(elm, selector) {
    var all = document.querySelectorAll(selector);
    var cur = elm.parentNode;
    while (cur && !collectionHas(all, cur)) { //keep going up until you find a match
        cur = cur.parentNode; //go up
    }
    return cur; //will return null if not found
}