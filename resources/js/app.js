import './custom';

import { createApp, ref } from 'vue'
import { aliases, mdi } from 'vuetify/iconsets/mdi'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

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
        const dialog = ref(false)
        const count = ref(0)
        const nips = ref([])
        function addForm() {
            if (count.value <= 5) {
                dialog.value = true;
            }
        }
        function storeNip() {
            dialog.value = false
            nips.value[count.value] =  { title: $('#nip_place_of_work').val() };
            count.value++
        }
        function storeAddress() {
            dialog.value = false
            count.value++
        }
        return {
            dialog,
            count,
            addForm,
            storeNip,
            storeAddress,
            nips
        }
    },
    data: () => ({
        addresses: [
            {
                color: 'blue',
                icon: 'mdi-clipboard-text',
                subtitle: 'Jan 20, 2014',
                title: 'Vacation itinerary',
            },
            {
                color: 'amber',
                icon: 'mdi-gesture-tap-button',
                subtitle: 'Jan 10, 2014',
                title: 'Kitchen remodel',
            },
        ]
    }),
}).use(vuetify).mount('#app');
