import $ from 'jquery';
import 'jquery-validation';
import * as bootstrap from 'bootstrap'
import * as _ from 'underscore'

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
                belgian_nip: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                },
                belgian_company_telephone: {
                    required: false,
                    digits: true
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
        3: {
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
        5: {
            rules: {
                dataprocessing: {
                    required: true
                }
            },
            errorClass: "invalid"
        }
    };

    function getInputFromStep(stepNumber) {
        var dataString = new FormData();

        var token = $('input[name="_token"]').attr('value');
        dataString.append('_token', token);

        $('#steps #step' + stepNumber + ' input,select').each(
            function(key,element) {
                dataString.append(element.name, element.value);
            }
        );
        return dataString;
    }

    function saveFormData() {
        var formData = new FormData($('#steps')[0]);
        var result = {};
        formData.forEach(function(el, key) {
            result[key] = el;
        });
        localStorage.setItem('limosaFormData', JSON.stringify(result));
        return true;
    }

    function getFormData() {
        return JSON.parse(localStorage.getItem('limosaFormData'));
    }

    function deleteFormData() {
        localStorage.removeItem('limosaFormData');
        return true;
    }

    function restoreFormFromLocalStorage() {
        var formData = getFormData();
        if (!_.isEmpty(formData)) {
            $('#steps input,select').each(function(key, el) {
                $(el).val(formData[el.name]);
            });
        }
    }

    $(document).ready(function () {
        $('#without_declaring_site').prop('checked', true);
        // $('.site-info-group').hide();
        restoreFormFromLocalStorage()
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
    });

    $(document).on('click', '#without_declaring_site', function() {
        if( this.checked === false) {
            $('.site-info-group').show();
            this.value = false;
        } else {
            $('.site-info-group').hide();
            this.value = true;
        }
    });

    $(document).on('click','div.submit button', function (ev) {
        ev.stopPropagation();
        ev.preventDefault();
        const currentStep  = parseInt(window.step);
        var validator = $("#steps").validate(validationRules[currentStep]);

        if ($("#steps").valid()) {
            validator.destroy();
            var nextStepNumber = (currentStep + 1);
            if (currentStep === 1) {
                grecaptcha.ready(function() {
                    grecaptcha.execute('6Ld9RT4pAAAAABCGucbYFiGRY-yElzY884aNMJNY').then(function(captchaCode) {
                        var dataString = getInputFromStep(window.step, captchaCode);
                        dataString.append('g-recaptcha-response', captchaCode);
                        $.ajax({
                            type: "POST",
                            url: "/form/init",
                            cache: false,
                            dataType: false,
                            processData: false,
                            contentType: false,
                            data: dataString,
                            beforeSend: function() {
                                $("div.submit button img").show();
                                $("div.submit button").attr('disabled', 'disabled');
                            },
                            error: function (response) {
                                var toast = new bootstrap.Toast('#error');
                                $('#error').html('<div class="reveal alert alert-danger">' + JSON.parse(response.responseText).message + '</div>');
                                toast.show();
                                $("div.submit button img").hide();
                                $("div.submit button").removeAttr('disabled');
                            },
                            success: function() {
                                $('.step-container').hide();
                                $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                                window.step = nextStepNumber;
                                $("div.submit button img").hide();
                                $("div.submit button").removeAttr('disabled');
                                saveFormData();
                            }
                        });
                    });
                });
            }

            if (currentStep === 2) {
                var dataString = getInputFromStep(currentStep);

                $.ajax({
                    type: "POST",
                    url: "/form/belgianCompany",
                    cache: false,
                    dataType: false,
                    processData: false,
                    contentType: false,
                    data: dataString,
                    beforeSend: function() {
                        $("div.submit button img").show();
                        $("div.submit button").attr('disabled', 'disabled');
                    },
                    error: function (response) {
                        var toast = new bootstrap.Toast('#error');
                        $('#error').html('<div class="reveal alert alert-danger">' + JSON.parse(response.responseText).message + '</div>');
                        toast.show();
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                    },
                    success: function() {
                        $('.step-container').hide();
                        $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                        window.step = nextStepNumber;
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                        saveFormData();
                    }
                });
                return;
            }

            if (currentStep === 3) {
                var dataString = getInputFromStep(currentStep);

                $.ajax({
                    type: "POST",
                    url: "/form/belgianCompany2",
                    cache: false,
                    dataType: false,
                    processData: false,
                    contentType: false,
                    data: dataString,
                    beforeSend: function() {
                        $("div.submit button img").show();
                        $("div.submit button").attr('disabled', 'disabled');
                    },
                    error: function (response) {
                        var toast = new bootstrap.Toast('#error');
                        $('#error').html('<div class="reveal alert alert-danger">' + JSON.parse(response.responseText).message + '</div>');
                        toast.show();
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                    },
                    success: function() {
                        $('.step-container').hide();
                        $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                        window.step = nextStepNumber;
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                        saveFormData();
                    }
                });
                return;
            }

            if (currentStep === 4) {
                var dataString = getInputFromStep(currentStep);

                $.ajax({
                    type: "POST",
                    url: "/form/company",
                    cache: false,
                    dataType: false,
                    processData: false,
                    contentType: false,
                    data: dataString,
                    beforeSend: function() {
                        $("div.submit button img").show();
                        $("div.submit button").attr('disabled', 'disabled');
                    },
                    error: function (response) {
                        var toast = new bootstrap.Toast('#error');
                        $('#error').html('<div class="reveal alert alert-danger">' + JSON.parse(response.responseText).message + '</div>');
                        toast.show();
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                    },
                    success: function() {
                        $('.step-container').hide();
                        $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                        window.step = nextStepNumber;
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                        $("div.submit button").hide();
                        $('#sub').show();
                        saveFormData();
                    }
                });
                return;
            }
            if (currentStep === 5) {
                var dataString = new FormData($('#steps')[0]);
                $.ajax({
                    type: "POST",
                    url: "/form/register",
                    cache: false,
                    dataType: false,
                    processData: false,
                    contentType: false,
                    data: dataString,
                    beforeSend: function() {
                        $("div.submit button img").show();
                        $("div.submit button").attr('disabled', 'disabled');
                    },
                    error: function (response) {
                        var toast = new bootstrap.Toast('#error');
                        $('#error').html('<div class="reveal alert alert-danger">' + JSON.parse(response.responseText).message + '</div>');
                        toast.show();
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                    },
                    success: function() {
                        $("div.submit button img").hide();
                        $("div.submit button").removeAttr('disabled');
                        window.location = 'form/success';
                        deleteFormData();
                    }
                });
            }
        }
        $("div.submit button img").hide();
        $("div.submit button").removeAttr('disabled');
    });
});
