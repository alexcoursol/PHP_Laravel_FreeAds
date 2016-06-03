/*jslint browser this*/
/*global $ window*/
$(document).on('blur', 'input', function () {
    'use strict';
    if ($(this).val()) {
        $(this).addClass('used');
    } else {
        $(this).removeClass('used');
    }
});
document.addEventListener('DOMContentLoaded', function () {
    'use strict';
    $("input[type='text']").each(function () {
        if ($(this).val()) {
            $(this).addClass('used');
        }
    });
    $("textarea").each(function () {
        if ($(this).val()) {
            $(this).addClass('used');
        }
    });

    $("input[type='file']").change(function () {
        $('#label_file').css({"background-image": "url(upload_valid.png)"});
    });
});