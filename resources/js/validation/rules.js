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
}
export {validationRules};
