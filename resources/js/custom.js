import $ from 'jquery';

window.$ = $;
window.jQuery = $;

$(function () {
    // disable on enter
    $('form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

// form validiation
    var inputschecked = false;

    function formvalidate(stepnumber) {
        // check if the required fields are empty
        var inputvalue = $("#step" + stepnumber + " :input").not("button").map(function () {
            if (this.value.length > 0) {
                $(this).removeClass('invalid');
                return true;

            } else {
                if ($(this).prop('required')) {
                    $(this).addClass('invalid');
                    return false
                } else {
                    return true;
                }

            }
        }).get();

        inputschecked = inputvalue.every(Boolean);
    }

    $(document).ready(function () {
        var currentStep = sessionStorage.getItem('currentStep');

        if (currentStep === null) {
            sessionStorage.setItem('currentStep', 1);
            $('.step-container').hide();
            $(".step-container[data-step-number=1]").show();
        } else {
            $('.step-container').hide();
            $(".step-container[data-step-number=" + currentStep + "]").show();
        }

        $('.previous-step-btn').on('click', function () {
            var stepNumber = sessionStorage.getItem('currentStep');
            var previousStepNumber = (parseInt(stepNumber) - 1);
            sessionStorage.setItem('currentStep', previousStepNumber);
            $('.step-container').hide();
            $(".step-container[data-step-number=" + previousStepNumber + "]").show();
        });

        $('.next-step-btn').on('click', function () {
            var stepNumber = sessionStorage.getItem('currentStep');
            var nextStepNumber = (parseInt(stepNumber) + 1);
            sessionStorage.setItem('currentStep', nextStepNumber);
            $('.step-container').hide();
            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
        });

        $("#sub").on('click', function () {
            // get input value
            var email = $("#mail-email").val();

            //email validiation
            var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            var emailFormat = re.test(email);

            //number validiation
            var numbers = /^[0-9]+$/;

            formvalidate(1);

            if (inputschecked == false) {
                formvalidate(1);
            } else if (emailFormat == false) {
                // console.log("enter valid email address");
                (function (el) {
                    setTimeout(function () {
                        el.children().remove('.reveal');
                    }, 3000);
                }($('#error').append('<div class="reveal alert alert-danger">Enter Valid email address!</div>')));
                if (emailFormat == true) {
                    $("#mail-email").removeClass('invalid');
                } else {
                    $("#mail-email").addClass('invalid');
                }
            } else {
                $("#sub").html("<img src='assets/images/loading.gif'>");
                // var attachment = {cv: $("#step3 input[type=file]").val()};
                // var dataString = $("#step1, #step2, #step3").serialize() + '&' + $.param(attachment);

                var dataString = new FormData(document.getElementById("steps"));

                // send form to send.php
                $.ajax({
                    type: "POST",
                    url: "form handling/send.php",
                    data: dataString,
                    processData: false,
                    contentType: false,
                    success: function (data, status) {
                        $("#sub").html("Success!");
                        window.location = "thankyou.html";
                    },
                    error: function (data, status) {
                        $("#sub").html("failed!");
                    }
                });
            }

        });
    });
});
