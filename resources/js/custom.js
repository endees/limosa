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
        if (window.step === undefined) {
            window.step = 1;
            $('.step-container').hide();
            $(".step-container[data-step-number=1]").show();
        } else {
            $('.step-container').hide();
            $(".step-container[data-step-number=" + stwindow.stepep + "]").show();
        }

        $('.next-step-btn').on('click', function (ev) {
            ev.stopPropagation();
            ev.preventDefault();
            if (formvalidate(window.step)) {
                var nextStepNumber = (parseInt(window.step) + 1);
                // $("#sub").html("<img src='assets/images/loading.gif'>");
                var dataString = new FormData();
                var token = $('input[name="_token"]').attr('value');

                if (window.step === 1) {
                    dataString.append('_token', token);

                    $('#steps #step1 input').each(
                        function(key,element) {
                            dataString.append(element.name, element.value);
                        }
                    );
                    $("#steps").validate({
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
                    });

                    if ($("#steps").valid()) {
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
                                $('.step-container').hide();
                                $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                                window.step = nextStepNumber;
                            }
                        });
                    }

                    return;
                }

                if (window.step === 2) {
                    var firstname = $('#steps #step1 input[name=firstname]').val();
                    var lastname = $('#steps #step1 input[name=lastname]').val();
                    var nip = $('#steps #step2 input[name=nip]').val();
                    var pesel = $('#steps #step2 input[name=pesel]').val();

                    dataString.append('_token', token);
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
                            $('.step-container').hide();
                            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                            window.step = nextStepNumber;
                        }
                    });
                    return;
                }
                if (window.step === 3) {
                    var belgianNip = $('#steps #step3 input[name=belgian_nip]').val();

                    dataString.append('_token', token);
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
                            $(".step-container[data-step-number=" + nextStepNumber + "]").show();
                            window.step = nextStepNumber;
                        }
                    });
                }
            }
        });

        $("#sub").on('click', function () {
            $("#steps").submit();
            window.step = 1;
        });
    });
});
