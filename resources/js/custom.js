import $ from 'jquery';
import 'jquery-validation';
import * as bootstrap from 'bootstrap'
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

    var validationRules = {
        1: {
            rules: {
                firstname: {
                    required: true,
                    maxlength: 20,
                },
                lastname: {
                    required: true,
                    maxlength: 20,
                },
                customer_email: {
                    required: true,
                    email: true
                },
                customer_telephone: {
                    required: true,
                    digits: true,
                    minlength: 9,
                    maxlength: 9
                }
            },
            errorClass: "invalid"
        },
        2: {
            rules: {
                nip: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                },
                pesel: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
                street: {
                    required: true
                },
                house_number: {
                    required: true,
                    maxlength: 5
                },
                flat_number: {
                    required: true,
                    maxlength: 5
                },
                city: {
                    required: true,
                    maxlength: 25
                },
                postcode: {
                    required: true,
                    maxlength: 6,
                    postcode: true
                }
            },
            errorClass: "invalid"
        },
        3: {
            rules: {
                belgian_nip: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                },
                sector: {
                    required: true
                },
                start_date: {
                    required: true,
                    date: true
                },
                end_date: {
                    required: true,
                    date: true
                },
            },
            errorClass: "invalid"
        },
        4: {
            rules: {
                dataprocessing: {
                    required: true
                }
            },
            errorClass: "invalid"
        }
    };

    $(document).ready(function () {
        jQuery.validator.addMethod("postcode", function(value) {
            return /^\d{2}-\d{3}$/.test(value);
        }, 'Please enter a valid postcode.');

        if (window.step === undefined) {
            window.step = 1;
            $('.step-container').hide();
            $(".step-container[data-step-number=1]").show();
        } else {
            $('.step-container').hide();
            $(".step-container[data-step-number=" + window.step + "]").show();
        }

        $('div.submit button').on('click', function (ev) {
            $("div.submit button img").show();
            $("div.submit button").attr('disabled', 'disabled');
            ev.stopPropagation();
            ev.preventDefault();
            const currentStep  = parseInt(window.step);
            var validator = $("#steps").validate(validationRules[currentStep]);
            if ($("#steps").valid()) {
                validator.destroy();
                var nextStepNumber = (currentStep + 1);

                var dataString = new FormData();
                var token = $('input[name="_token"]').attr('value');
                dataString.append('_token', token);

                if (currentStep === 1) {
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
                        error: function (response) {
                            var toast = new bootstrap.Toast('#error');
                            $('#error').html('<div class="reveal alert alert-danger">' + response.message + '</div>');
                            toast.show();
                        },
                        success: function() {
                            $("div.submit button img").hide();
                            $('.step-container').hide();
                            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                            window.step = nextStepNumber;
                            $("div.submit button").removeAttr('disabled');
                        }
                    });
                }

                if (currentStep === 2) {
                    var firstname = $('#steps #step1 input[name=firstname]').val();
                    var lastname = $('#steps #step1 input[name=lastname]').val();
                    var nip = $('#steps #step2 input[name=nip]').val();
                    var pesel = $('#steps #step2 input[name=pesel]').val();

                    dataString.append('firstname', firstname);
                    dataString.append('lastname', lastname);
                    dataString.append('nip', nip);
                    dataString.append('pesel', pesel);

                    $.ajax({
                        type: "POST",
                        url: "/form/company",
                        cache:false,
                        dataType: false,
                        processData: false,
                        contentType: false,
                        async: false,
                        data: dataString,
                        error: function (response) {
                            var toast = new bootstrap.Toast('#error');
                            $('#error').html('<div class="reveal alert alert-danger">' + response.message + '</div>');
                            toast.show();
                        },
                        success: function() {
                            $("div.submit button img").hide();
                            $('.step-container').hide();
                            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                            window.step = nextStepNumber;
                            $("div.submit button").removeAttr('disabled');
                        }
                    });
                    return;
                }
                if (currentStep === 3) {
                    var belgianNip = $('#steps #step3 input[name=belgian_nip]').val();

                    dataString.append('belgian_nip', belgianNip);

                    $.ajax({
                        type: "POST",
                        url: "/form/belgianCompany",
                        cache:false,
                        dataType: false,
                        processData: false,
                        contentType: false,
                        async: false,
                        data: dataString,
                        error: function (response) {
                            var toast = new bootstrap.Toast('#error');
                            $('#error').html('<div class="reveal alert alert-danger">' + response.message + '</div>');
                            toast.show();
                        },
                        success: function() {
                            $('.step-container').hide();
                            $("div.submit button").hide();
                            $("div.submit button img").hide();
                            $("div.submit button").removeAttr('disabled');
                            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                            window.step = nextStepNumber;
                            $('#sub').show();
                        }
                    });
                    return;
                }
                if (currentStep === 4) {
                    $("#steps").submit();
                    window.step = 1;
                    return;
                }
            }
            $("div.submit button img").hide();
            $("div.submit button").removeAttr('disabled');
        });
    });
});
