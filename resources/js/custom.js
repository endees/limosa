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

        return inputschecked = inputvalue.every(Boolean);
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

        $('.next-step-btn').on('click', function (ev) {
            var stepNumber = sessionStorage.getItem('currentStep');

            if (formvalidate(stepNumber)) {
                var nextStepNumber = (parseInt(stepNumber) + 1);
                // $("#sub").html("<img src='assets/images/loading.gif'>");
                if (stepNumber === "1") {
                    var dataString = new FormData();
                    var token = $('input[name="_token"]').attr('value');
                    dataString.append('_token', token);

                    $('#steps #step1 input').each(
                        function(key,element) {
                            dataString.append(element.name, element.value);
                        }
                    );

                    $.ajax({
                        type: "POST",
                        url: "/form/init",
                        cache:false,
                        dataType: false,
                        processData: false,
                        contentType: false,
                        async: false,
                        data: dataString,
                        success: function () {
                            sessionStorage.setItem('currentStep', nextStepNumber);
                            $('.step-container').hide();
                            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                            alert('General error');
                        }
                    });
                } else {
                    sessionStorage.setItem('currentStep', nextStepNumber);
                    $('.step-container').hide();
                    $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                }
            }
        });

        $("#sub").on('click', function () {
            // get input value
            var email = $("#mail-email").val();

            //email validiation
            var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            var emailFormat = re.test(email);

            //number validiation
            var numbers = /^[0-9]+$/;

            if (emailFormat == false) {
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
            }
        });
    });
});
