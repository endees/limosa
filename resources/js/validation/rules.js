const validationRules = {
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
                apartment_number: {
                    required: false,
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
            lang: 'pl',
            rules: {
                dataprocessing: {
                    required: true
                }
            },
            errorClass: "invalid"
        }
};
const siteFormRules = {
    rules: {
        "nip_place_of_work[0]": {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
        },
        "nip_place_of_work[1]": {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
        },
        "nip_place_of_work[2]": {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
        },
        "nip_place_of_work[3]": {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
        },
        "nip_place_of_work[4]": {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
        },
        "site_address[0][name]": {
            required: true,
        },
        "site_address[0][street]": {
            required: true,
        },
        "site_address[0][house_number]": {
            required: true,
            maxlength: 10
        },
        "site_address[0][apartment_number]": {
            required: false,
            maxlength: 10
        },
        "site_address[0][postcode]": {
            required: true,
        },
        "site_address[1][name]": {
            required: true,
        },
        "site_address[1][street]": {
            required: true,
        },
        "site_address[1][house_number]": {
            required: true,
            maxlength: 10
        },
        "site_address[1][apartment_number]": {
            required: false,
            maxlength: 10
        },
        "site_address[1][postcode]": {
            required: true,
        },
        "site_address[2][name]": {
            required: true,
        },
        "site_address[2][street]": {
            required: true,
        },
        "site_address[2][house_number]": {
            required: true,
            maxlength: 10
        },
        "site_address[2][apartment_number]": {
            required: false,
            maxlength: 10
        },
        "site_address[2][postcode]": {
            required: true,
        },
        "site_address[3][name]": {
            required: true,
        },
        "site_address[3][street]": {
            required: true,
        },
        "site_address[3][house_number]": {
            required: true,
            maxlength: 10
        },
        "site_address[3][apartment_number]": {
            required: false,
            maxlength: 10
        },
        "site_address[3][postcode]": {
            required: true,
        },
        "site_address[4][name]": {
            required: true,
        },
        "site_address[4][street]": {
            required: true,
        },
        "site_address[4][house_number]": {
            required: true,
            maxlength: 10
        },
        "site_address[4][apartment_number]": {
            required: false,
            maxlength: 10
        },
        "site_address[4][postcode]": {
            required: true,
        }
    }
};

function messagesPl() {
    $.extend( $.validator.messages, {
        required: "To pole jest wymagane.",
        remote: "Proszę o wypełnienie tego pola.",
        email: "Proszę o podanie prawidłowego adresu email.",
        url: "Proszę o podanie prawidłowego URL.",
        date: "Proszę o podanie prawidłowej daty.",
        dateISO: "Proszę o podanie prawidłowej daty (ISO).",
        number: "Proszę o podanie prawidłowej liczby.",
        digits: "Proszę o podanie samych cyfr.",
        creditcard: "Proszę o podanie prawidłowej karty kredytowej.",
        equalTo: "Proszę o podanie tej samej wartości ponownie.",
        extension: "Proszę o podanie wartości z prawidłowym rozszerzeniem.",
        nipPL: "Proszę o podanie prawidłowego numeru NIP.",
        phonePL: "Proszę o podanie prawidłowego numeru telefonu.",
        maxlength: $.validator.format( "Proszę o podanie nie więcej niż {0} znaków." ),
        minlength: $.validator.format( "Proszę o podanie przynajmniej {0} znaków." ),
        rangelength: $.validator.format( "Proszę o podanie wartości o długości od {0} do {1} znaków." ),
        range: $.validator.format( "Proszę o podanie wartości z przedziału od {0} do {1}." ),
        max: $.validator.format( "Proszę o podanie wartości mniejszej bądź równej {0}." ),
        min: $.validator.format( "Proszę o podanie wartości większej bądź równej {0}." ),
        pattern: $.validator.format( "Pole zawiera niedozwolone znaki." )
    } );
}

export {validationRules, siteFormRules, messagesPl};
