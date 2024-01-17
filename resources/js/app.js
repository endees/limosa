import './custom';

import { createApp, ref, toRaw, triggerRef } from 'vue'
import { aliases, mdi } from 'vuetify/iconsets/mdi'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import * as _ from 'underscore'

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
        const count = ref(0)
        const formData = ref({
            firstname: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['firstname']) ? limosaFormData['firstname'] : '',
            lastname: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['lastname']) ? limosaFormData['lastname'] : '',
            customer_email: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['customer_email']) ? limosaFormData['customer_email'] : '',
            customer_telephone: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['customer_telephone']) ? limosaFormData['customer_telephone'] : '',
            belgian_nip: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['belgian_nip']) ? limosaFormData['belgian_nip'] : '',
            belgian_company_telephone: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['belgian_company_telephone']) ? limosaFormData['belgian_company_telephone'] : '',
            belgian_company_email: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['belgian_company_email']) ? limosaFormData['belgian_company_email'] : '',
            sector: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['sector']) ? limosaFormData['sector'] : '',
            start_date: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['start_date']) ? limosaFormData['start_date'] : '',
            end_date: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['end_date']) ? limosaFormData['end_date'] : '',
            nips: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['nips']) ? limosaFormData['nips'] : [],
            addresses: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['addresses']) ? limosaFormData['addresses'] : [],
            nip: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['nip']) ? limosaFormData['nip'] : '',
            pesel: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['pesel']) ? limosaFormData['pesel'] : '',
            street: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['street']) ? limosaFormData['street'] : '',
            house_number: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['house_number']) ? limosaFormData['house_number'] : '',
            flat_number: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['flat_number']) ? limosaFormData['flat_number'] : '',
            postcode: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['postcode']) ? limosaFormData['postcode'] : '',
            city: !_.isEmpty(limosaFormData) && !_.isEmpty(limosaFormData['city']) ? limosaFormData['city'] : '',
        })
        function addForm() {
            if (count.value < 5) {
                var data = toRaw(formData.value);
                data.nips.push({title: ''});
            }
            dialog.value = true;
        }

        function newAddressForm() {
            if (count.value < 5) {
                var data = toRaw(formData.value);
                data.addresses.push({
                    name: '',
                    subtitle: ''
                });
            }
            addressDialog.value = true;
        }

        function storenewAddress() {
            count.value++;
            addressDialog.value = false;
        }

        function paginate() {
            localStorage.setItem('limosaFormData', JSON.stringify(toRaw(formData.value)));
        }

        function storeNip() {
            dialog.value = false
            triggerRef(formData);
            count.value++
        }

        function storeAddress() {
            addressDialog.value = false
            triggerRef(formData);
            count.value++
        }

        function deleteNip() {

        }

        return {
            dialog,
            addressDialog,
            count,
            addForm,
            newAddressForm,
            storeNip,
            storeAddress,
            paginate,
            formData,
        }
    },
}).use(vuetify).mount('#app');
