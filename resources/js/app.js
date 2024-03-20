import { createApp, ref, toRaw, triggerRef, computed } from 'vue'

import './custom';
import './build-combined';
import { aliases, mdi } from 'vuetify/iconsets/mdi'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import * as _ from 'underscore'
import {siteFormRules} from "./validation/rules.js";
import {forEach} from "underscore";

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
})

createApp({
    setup() {
        let limosaFormData = !_.isUndefined(localStorage.getItem('limosaFormData')) ? JSON.parse(localStorage.getItem('limosaFormData'))  : null;
        const dialog = ref(false)
        const addressDialog = ref(false)
        const count = computed(function () {
            var address = toRaw(formData.value.addresses);
            var nip = toRaw(formData.value.nips);
            return address.length + nip.length;
        })

        const selectedAgreements = ref([])
        const allSelected = ref(false);
        const dataagreement = ref([
            {
                title: 'Zgoda na przetwarzanie danych osobowych do celów wygenerowania limosy *',
                value: 'rodo',
            },
            {
                title: 'Zgoda na przetwarzanie danych do celów marketingowych',
                value: 'marketing',
            },
            {
                title: 'Newsletter',
                value: 'newsletter',
            }
        ]);

        const formData = ref({
            firstname: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['firstname']) ? limosaFormData['firstname'] : '',
            lastname: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['lastname']) ? limosaFormData['lastname'] : '',
            customer_email: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['customer_email']) ? limosaFormData['customer_email'] : '',
            customer_telephone: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['customer_telephone']) ? limosaFormData['customer_telephone'] : '',
            belgian_nip: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['belgian_nip']) ? limosaFormData['belgian_nip'] : '',
            belgian_company_telephone: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['belgian_company_telephone']) ? limosaFormData['belgian_company_telephone'] : '',
            belgian_company_email: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['belgian_company_email']) ? limosaFormData['belgian_company_email'] : '',
            sector: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['sector']) ? limosaFormData['sector'] : '',
            sector_construction: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['sector_construction']) ? limosaFormData['sector_construction'] : '',
            start_date: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['start_date']) ? limosaFormData['start_date'] : '',
            end_date: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['end_date']) ? limosaFormData['end_date'] : '',
            nips: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['nips']) ? limosaFormData['nips'] : [],
            addresses: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['addresses']) ? limosaFormData['addresses'] : [],
            nip: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['nip']) ? limosaFormData['nip'] : '',
            pesel: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['pesel']) ? limosaFormData['pesel'] : '',
            street: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['street']) ? limosaFormData['street'] : '',
            house_number: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['house_number']) ? limosaFormData['house_number'] : '',
            apartment_number: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['apartment_number']) ? limosaFormData['apartment_number'] : '',
            postcode: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['postcode']) ? limosaFormData['postcode'] : '',
            city: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['city']) ? limosaFormData['city'] : '',
        });

        function toggleAllDataAgreement() {
            selectedAgreements.value = [];

            if (!allSelected.value) {
                _.each( toRaw(dataagreement.value), function(agreement) {
                    selectedAgreements.value.push(agreement.value);
                });
            }
        }

        function addForm() {
            if (count.value < 5) {
                var data = toRaw(formData.value);
                data.nips.push({title: '', postcode: ''});
                dialog.value = true;
            }
        }

        function newAddressForm() {
            if (count.value < 5) {
                var data = toRaw(formData.value);
                data.addresses.push({
                    name: '',
                    street: '',
                    city: '',
                    house_number: '',
                    apartment_number: '',
                    postcode: ''
                });
                addressDialog.value = true;
            }
        }

        function paginate() {
            localStorage.setItem('limosaFormData', JSON.stringify(toRaw(formData.value)));
        }

        function storeNip() {
            var nipFormSelector = $('#nip_place_of_work_form');
            nipFormSelector.validate(siteFormRules);
            if (nipFormSelector.valid()) {
                dialog.value = false
                count.value++
                triggerRef(formData);
            }
        }

        function cancelNipEdit() {
            var nips = toRaw(formData.value)['nips'];
            nips.pop();
            dialog.value = false;
            triggerRef(formData);
        }

        function cancelAddressEdit() {
            var addresses = toRaw(formData.value)['addresses'];
            addresses.pop();
            addressDialog.value = false;
            triggerRef(formData);
        }

        function storeAddress() {
            var addressFormSelector = $('#site_address_form');
            addressFormSelector.validate(siteFormRules);
            if (addressFormSelector.valid()) {
                addressDialog.value = false;
                count.value++;
                triggerRef(formData);
            }
        }

        function deleteNip(index) {
            formData.value.nips.splice(index,1);
            triggerRef(formData);
        }

        function deleteAddress(index) {
            formData.value.addresses.splice(index,1);
            triggerRef(formData);
        }

        return {
            dialog,
            addressDialog,
            count,
            addForm,
            newAddressForm,
            storeNip,
            cancelNipEdit,
            deleteNip,
            storeAddress,
            cancelAddressEdit,
            deleteAddress,
            paginate,
            formData,
            toggleAllDataAgreement,
            selectedAgreements,
            allSelected,
            dataagreement
        }
    },
    data: () => ({
        items: [
            {
                title: 'Wybierz branżę',
                value: '',
            },
            {
                title: 'Mięso',
                value: 'meat',
            },
            {
                title: 'Budownictwo',
                value: 'construction',
            },
            {
                title: 'Sprzątanie',
                value: 'cleaning',
            },
            {
                title: 'Inna',
                value: 'other',
            }
        ],
        construction_items: [
            {
                title: 'Oszklenie',
                value: 'glass',
            },
            {
                title: 'Hydraulika',
                value: 'plumbing',
            },
            {
                title: 'Brukarstwo',
                value: 'pavement',
            },
            {
                title: 'Murowanie',
                value: 'masonry',
            },
            {
                title: 'Inna',
                value: 'other',
            }
        ],

    }),
}).use(vuetify).mount('#app');
