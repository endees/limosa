import $ from 'jquery';
import 'jquery-validation';
import * as bootstrap from 'bootstrap'
import * as _ from 'underscore'
import {validationRules} from "./validation/rules.js";
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
                if (el.name !== '_token') {
                    // $(el).val(formData[el.name]);
                }
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
                    }
                });
                return;
            }

            if (currentStep === 3) {
                var dataString = getInputFromStep(currentStep);

                $.ajax({
                    type: "POST",
                    url: "/form/worksites",
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
                    }
                });
                return;
            }
            if (currentStep === 5) {
                var dataString = new FormData($('#steps')[0]);
                var dataString2 = $('#nip_place_of_work_form').serializeArray();
                var dataString3 = $('#site_address_form').serializeArray();

                for (var i=0; i<dataString2.length; i++) {
                    dataString.append(dataString2[i].name, dataString2[i].value);
                }
                for (var j=0; j<dataString3.length; j++) {
                    dataString.append(dataString3[i].name, dataString3[i].value);
                }

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
                        // deleteFormData();
                    }
                });
            }
        }
        $("div.submit button img").hide();
        $("div.submit button").removeAttr('disabled');
    });
});
