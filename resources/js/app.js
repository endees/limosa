import './custom';

import { createApp, ref } from 'vue'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})

createApp({
    setup() {
        const dialog = ref(false)
        // expose the ref to the template
        return {
            dialog
        }
    }
}).use(vuetify).mount('#app')
