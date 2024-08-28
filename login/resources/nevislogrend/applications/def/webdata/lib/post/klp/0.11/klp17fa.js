//
if (window.console === undefined) {
    window.console = {
        log: function () {
        }
    };
}


var klp = klp || {};
$ = jQuery;

(function (jq) {
    var oldFunc = $.fn.focus;
    $.fn.focus = function () {
        // Workaround for KOM-191
        // KLPD-4989: fixed issue related to error overlay message on IOS devices -> focus on overlay message must not be prevented.
        if (/iphone|ipad|ipod/i.test(navigator.userAgent) && (this.filter('#overlayMessage').length === 0)) {
            return;
        }

        // Fix for KLPD-4762
        // When a globalmessage is shown and the elem to be focused is not visible, we don't focus
        if ($('div.u_global_error > div.u_global_content, div.u_global_warning > div.u_global_content, div.u_global_confirmation > div.u_global_content').length > 0) {

            var $window = $(window);
            var windowTop = $window.scrollTop();
            var windowLeft = $window.scrollLeft();
            var windowBottom = windowTop + $window.height();
            var windowRight = windowLeft + $window.width();

            var isCompletelyInsideWindow = function () {
                var elemTop = $(this).offset().top;
                var elemLeft = $(this).offset().left;
                var elemBottom = elemTop + $(this).height();
                var elemRight = elemLeft + $(this).width();

                return windowTop <= elemTop && windowLeft <= elemLeft && windowBottom >= elemBottom && windowRight >= elemRight;
            }

            oldFunc.apply(this.filter(isCompletelyInsideWindow));
            return;
        }

        oldFunc.apply(this);
    }
})($);

klp.changeLanguage = function (language) {
    document.getElementById('lang').value = language.toLowerCase();
    document.getElementById('lang').checked = true;
    document.getElementById('mainForm').submit();
};

/**
 * Taken from http://shaiekh.com/home/prevent-double-form-submission/
 * jQuery plugin to prevent double submission of forms
 */
$.fn.preventDoubleSubmission = function () {
    $(this).on('submit', function (e) {
        var $form = $(this);

        if ($form.data('submitted') === true) {
            // Previously submitted - don't submit again
            e.preventDefault();
        } else {
            // Mark it so that the next submit can be ignored
            $form.data('submitted', true);
        }
    });

    // Keep chainability
    return this;
};

$(function () {

    // "Maximize" window if it's a popup and the preventMaximize variable is not defined or not equal to "true"
    if (window.opener && (typeof preventMaximize === 'undefined' || preventMaximize !== 'true') && ((typeof Storage) === 'undefined' || !sessionStorage.preventMaximize)) {
        if ((typeof Storage) !== 'undefined') {
            sessionStorage.preventMaximize = true;
        }
        var bigWindowToScreenRatio = 0.8;
        var width = bigWindowToScreenRatio * screen.availWidth;
        var height = bigWindowToScreenRatio * screen.availHeight;
        var left = (screen.availWidth - width) / 2;
        var top = (screen.availHeight - height) / 2;
        window.moveTo(left, top);
        window.resizeTo(width, height);
    }

    // Handle focus on logrend pages. Use setTimeout workaround to let focus() be correctly set on firefox
    window.setTimeout(function () {

        // first, we try to find an active overlayError to focus on.
        var overlayErrors = [$("#overlayMessage"), $("#overlayAllMessage")];
        for (var idx in overlayErrors) {
            if (overlayErrors[idx].length && overlayErrors[idx].is(':visible')) {
                overlayErrors[idx].focus();
                return;
            }
        }


        var inputElement = $("#main_content").find("input,select,button")
            .filter(":not(:hidden):not(:disabled):not([data-klp-noautofocus=true]):first");
        if (inputElement.length) {
            inputElement.focus();
        } else {
            // Find the first <a> element that doesn't have the data-klp-noautofocus attribute
            var hyperlinkElement = $("#main_content").find('a[href]').filter(':not([data-klp-noautofocus=true])').filter(":first");
            if (hyperlinkElement.length) {
                hyperlinkElement.focus();
            }
        }
    }, 0);

    $('form').preventDoubleSubmission();

    //add capability to make validation rule using regexp
    jq = $;
    jq.validator.addMethod('regex', function (value, element, param) {
        return this.optional(element) || value.match(typeof param == 'string' ? new RegExp(param) : param);
    }, '${text.get("error_invalid_password")}');
    jq.validator.addMethod('minlengthaftertrim', function (value, element, param) {
        return this.optional(element) || ((typeof value === 'string') && value.trim().length >= param);
    });
    jq.validator.addMethod('maxlengthaftertrim', function (value, element, param) {
        return this.optional(element) || ((typeof value === 'string') && value.trim().length <= param);
    });

    $("#mainForm").validate({
        onkeyup: false,
        onclick: false,
        onfocusout: false,
        errorClass: "is-invalid",
        validClass: "is-valid",
        unhighlight: function (element) {
            var parent = $(element).parents('div .form-group').filter(':first');
            parent.find("input").attr('aria-invalid', 'false');
            parent.find(".fm_fielderror").not("#err_global").remove();
            parent.find("input").removeClass("is-invalid");
        },
        errorElement: "div",
        wrapper: "div",
        errorPlacement: errorPlacementValidatio,
        rules: {
            "isiwebuserid": {
                required: true,
                email: false
            },
            "isiwebpasswd": {required: true},
            // isiwebnewpw1 rules should be applied either on password_text (see specific "add" method)
            "isiwebnewpw": {required: true, minlengthaftertrim: 12, maxlengthaftertrim: 256},
            "isiwebnewpw1": {required: true, minlengthaftertrim: 12, maxlengthaftertrim: 256},
            "password_text": {required: true},
            "agb": {required: true}
        },
        messages: {
            "isiwebuserid": {
                required: MESSAGES.required,
                //required: MESSAGES.email,
                email: MESSAGES.email
            },
            "isiwebpasswd": {
                //required: MESSAGES.pwdformat
                required: MESSAGES.required
            },
            "isiwebnewpw": {
                required: MESSAGES.migPwdformat,
                minlengthaftertrim: MESSAGES.migPwdformat,
                maxlengthaftertrim: MESSAGES.migPwdformat
            },
            "isiwebnewpw1": {
                required: MESSAGES.pwdformat,
                minlengthaftertrim: MESSAGES.pwdformat,
                maxlengthaftertrim: MESSAGES.pwdformat
            },
            "password_text": {
                required: MESSAGES.required,
                minlengthaftertrim: MESSAGES.minlength,
                maxlengthaftertrim: MESSAGES.maxlength
            },
            "agb": {
                required: MESSAGES.must_accept_agb
            }
        },
        invalidHandler: function (event, validator) {

            // Display an overlay with the generic error message
            displayOverlayMessage(MESSAGES.generic);

            // Reset the form (because the showpassword checkbox doesn't reset)
            var reinitall = function () {
                jqueryUnic(document).trigger('reinit_ALL', jqueryUnic('#os_content'));
            };
            window.setTimeout(reinitall, 0); // reinit has to be done after the execution of all current code...

            $(this).data('submitted', false);
        }
    });

    // Retrieves all input errors in the page
    function getFieldErrors() {
        var txt = "";

        // Find all elements marked with the .fm_fielderror class
        $(".is-invalid").each(function () {
            // Check the text content of the element and add it
            // to the text buffer if not blank
            var t = $.trim($(this).text());

            if (t.length > 0) {
                txt += $(this).text() + "<br/>";
            }
        });
        return txt;
    }

    function hasFieldErrors() {
        // If getFieldErrors returns a non-empty string, so there's
        // at least one error on page
        return (getFieldErrors().length > 0);
    }

    // Run a form error check once the document is ready
    $(document).ready(function () {
        if (hasFieldErrors()) {
            displayOverlayMessage(MESSAGES.generic);
        }
        var showMoreButton = $("#more");
        showMoreButton.bind("click", function () {
            $(".custom-radio.d-none").removeClass("d-none");
            $(".custom-label.d-none").removeClass("d-none");
            showMoreButton.hide();
            $(".absoluteCenter").attr("style", "height: 100vh;");
        });
    });
    // If isiwebnewpw1 is on GUI, we add some additional validation rules on #password_text
    if ($("#isiwebnewpw1").length) {
        $("#password_text").rules("add", {
            minlengthaftertrim: 8,
            maxlengthaftertrim: 100
        });
    }
    $('#linkForgotLogin').attr('href', $('#linkForgotLogin').attr('href') + location.search);

    $('input').keypress(function () {
        $('#loginFailedMessage').text("");
        $('div .control-group').removeClass("error");
    });

    $('[formnovalidate]').click(function () {
        $('[name=agb]').attr('name', 'notrequired');
        $('[name=isiwebuserid2]').attr('name', 'notrequired2');
        $('[name=isiwebpwd2]').attr('name', 'notrequired3');
    });

    // Custom tabs management
    var updateTabsVisibility = function () {
        $('.tab_header').each(function () {
            var isSelected = $(this).hasClass('tab_selected');
            var controls = $(this).attr('aria-controls');
            $('#' + controls).toggleClass('tab_section_hidden', !isSelected);
        });
    };

    updateTabsVisibility();
    $('.tab_header').click(function () {
        $('.tab_header.tab_selected').removeClass('tab_selected');
        $(this).addClass('tab_selected');
        updateTabsVisibility();
    });

    $('#isiwebuserid, #isiwebpasswd').keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#actionLogin').click();
        }
    });

});

// Displays an overlay with a message.
// By omitting the 'text' attribute the overlay will display all
// fields errors.
function displayOverlayMessage(text) {
    /*
            if (typeof layoutType !== 'undefined' && layoutType == 'light') {
                return;
            }
    */
    if (text === undefined || text.length === 0) {
        // Retrieve all input errors in the page
        text = getFieldErrors();
    }

    if ($.trim(text.length) > 0) {
        $("#overlayMessageCloseButton").click(function () {
            $("#overlayMessage").fadeOut();
        });
        // Set the overlay message text and display it
        $("#overlayMessageText").html(text);
        $("#overlayMessageType").addClass("toast-error");
        $("#overlayMessageType").removeClass("toast-success");

        setTimeout(function () {
            $("#overlayMessage").fadeOut();
        }, 8000);
        $("#overlayMessage").fadeIn();
        $("#overlayMessage").focus();
    }
};

function changeInputType(oldIn, newType) {
    var oldInId = oldIn.attr("id");
    var newEMin = oldIn.clone();
    newEMin.attr("type", newType);
    newEMin.attr("id", "tmpID");
    newEMin.insertBefore(oldIn);
    oldIn.remove();
    newEMin.attr("id", oldInId);
}


function setInvalidInput(idInput, idErrBlock, idErrText) {
    $('#' + idInput).addClass('ng-invalid is-invalid');
    errText = $('#' + idErrText);
    errText.attr("for", idInput);
    errText.addClass("is-invalid");
    errBlock = $('#' + idErrBlock);
    errBlock.attr("role", "alert");
    errBlock.attr("id", "err_1");
    errBlock.addClass("invalid-feedback");
    errBlock.css('display', 'block');
    errBlock.removeClass("d-none");
}

function displayAllOverlayMessage(text, msgCode, errorNo, POPUP_TEXT) {
    $("#overlayAllMessageText").removeClass("bg-danger bg-warning bg-info bg-info2");
    var needButtonClick = true;
    var popupCase = "error_";
    if (!errorNo || errorNo == "") {
        popupCase = "msg_" + msgCode;
    } else {
        popupCase = popupCase + errorNo;
    }

    switch (popupCase) {
        case "error_1":
            setInvalidInput('isiwebuserid', 'likeValidationErrorUser', 'likeValidationErrorUserText');
            setInvalidInput('isiwebpasswd', 'likeValidationErrorPwd', 'likeValidationErrorUserPwd');
            displayOverlayMessage(text);
            return;

        case "msg_824": //confirm
        case "msg_825": //confirm
        case "msg_826": //confirm
        case "msg_830": //confirm
        case "msg_831": //confirm
            $("#overlayMessageType").removeClass("toast-error");
            $("#overlayMessageType").addClass("toast-success");
            $("#overlayMessageCloseButton").click(function () {
                $("#overlayMessage").fadeOut();
                return false;
            });
            // Set the overlay message text and display it
            $("#overlayMessageText").html(text);
            $("#overlayMessage").fadeIn();
            setTimeout(function () {
                $("#overlayMessage").fadeOut();
            }, 8000);
            return;

        case "msg_827":
            $("#overlayAllMessageType").addClass("bg-warning")
            $("#overlayAllMessageCloseButton").html('<div class="bg-button-txcrop">' + POPUP_TEXT.btn_recpwd + '</div>');
            $("#overlayAllMessageCloseButton").attr('title', POPUP_TEXT.btn_recpwd);
            //update button action to link action
            needButtonClick = false;
            $("#overlayAllMessageCloseButton").click(function (e) {
                e.preventDefault();
                location.href = $("#forgotPwd-link").attr("href");
                return false;
            });
            break;

        case "error_18":
            $("#overlayAllMessageType").addClass("bg-info")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            break;
        case "error_110":
            $("#overlayAllMessageType").addClass("bg-info2")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            break;
        case "error_tmp2FALocked":
            $("#overlayAllMessageType").addClass("bg-info3")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            break;

        case "msg_840":
            $("#overlayAllMessageType").addClass("bg-info4")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            //bg-info4
            break;

        case "msg_802":
        case "msg_807":
        case "error_820":
            $("#overlayAllMessageType").addClass("bg-danger")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            break;

        case "msg_801":
        case "msg_804":
        case "msg_805":
            $("#overlayAllMessageType").addClass("bg-warning")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            break;

        case "msg_8":
        case "error_8":
        case "error_19":
        case "error_20":
            $("#overlayAllMessageType").addClass("bg-danger");
            $("#overlayAllMessageCloseButton").html('<div class="bg-button-txcrop">' + POPUP_TEXT.btn_recpwd + '</div>');
            $("#overlayAllMessageCloseButton").attr('title', POPUP_TEXT.btn_recpwd);
            //update button action to link action
            needButtonClick = false;
            $("#overlayAllMessageCloseButton").click(function (e) {
                e.preventDefault();
                location.href = $("#forgotPwd-link").attr("href");
                return false;
            });
            break;

        case "error_2FALocked":
            $("#overlayAllMessageType").addClass("bg-danger");
            $("#overlayAllMessageCloseButton").addClass('d-none');
            $("#overlayMsgContact").removeClass('d-none');
            //update button action to link action
            needButtonClick = false;
            break;
        case "error_802":
        case "msg_810":
        case "msg_820":
            //SuissID
            $("#overlayAllMessageType").addClass("bg-info");
            $("#overlayAllMessageCloseButton").html(
                '<span class="connect" aria-hidden="true"></span>' + POPUP_TEXT.btn_suissid + '');
            $("#overlayAllMessageCloseButton").addClass("swissid-btn swissid-btn-primary swissid-btn-connect swissid-btn-connect-light float-right");
            $("#overlayAllMessageCloseButton").removeClass("col-12 btn btn-primary");
            $("#overlayAllMessageCloseButton").parent().removeClass("px-large");
            $("#overlayAllMessageCloseButton").parent().addClass("px-small-regular");
            //$("#overlayAllMessageCloseButton").prop("type", "submit");
            $("#overlayAllMessageCloseButton").prop("name", "externalIDP");
            $("#overlayAllMessageCloseButton").prop("value", "externalIDP");
            needButtonClick = false;
            $("#overlayAllMessageCloseButton").click(function (e) {
                e.preventDefault();
                $("#externalIDP").trigger("click");
                return false;
            });
            break;
        default:
            $("#overlayAllMessageType").addClass("bg-danger")
            $("#overlayAllMessageCloseButton").html('<span>' + POPUP_TEXT.btn_close + '</span>')
            break;

    }

    if ($.trim(text.length) > 0) {
        if (needButtonClick) {
            $("#overlayAllMessageCloseButton").click(function () {
                $("#overlayAllMessage").fadeOut();
                return false;
            });
        }

        $(".modal,.modal-close-button").click(function () {
            $("#overlayAllMessage").fadeOut();
            return false;
        });
        // Set the overlay message text and display it
        $("#overlayAllMessageText").html(text);
        $("#overlayAllMessage").fadeIn();

        const focusableElements =
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        const modal = document.querySelector('#overlayAllMessage');


        // TAB handling for accessibility
        const focusableContent = modal.querySelectorAll(focusableElements);
        const firstFocusableElement = focusableContent[0];
        const lastFocusableElement = focusableContent[focusableContent.length - 1];


        document.addEventListener('keydown', function (e) {
            let isTabPressed = e.key === 'Tab';
            let isEscPressed = e.key === "Escape";


            if (isTabPressed) {
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusableElement) {
                        lastFocusableElement.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusableElement) {
                        firstFocusableElement.focus();
                        e.preventDefault();
                    }
                }
            } else if (isEscPressed) {
                $("#overlayAllMessage").fadeOut();
            }
        });

        $("#overlayAllMessageCloseButton").focus();
    }
}

function errorPlacementValidatio(error, element) {
    error.attr('role', 'alert');
    error.attr('id', 'err_required');// +element.attr('id'));
    error.attr('class', 'invalid-feedback');// +element.attr('id'));
    //error.attr('class', 'invalid-feedback');// is on container
    //remove all global msg error
    //$('ul').find("#err_global").remove();
    var parent = element.parents('div .form-group').filter(':first');
    parent.find("input").attr('aria-invalid', 'true');
    parent.find("input").addClass('is-invalid');
    //exist anymore ???
    //parent.find(".fm_fielderror").not("#err_global").remove();
    //parent.find("label").append($("<span class='visuallyhidden'>" + error.text() + "</span>"));
    if (parent.find(".info-button-next-to-input").length > 0) {
        error.insertAfter(parent.find(".info-button-next-to-input"));
    } else {
        error.insertAfter(element);
    }
    $('#isiwebnewpw1').val("");
    $('#isiwebnewpw').val("");
}

