import PlusMinus from './components/PlusMinus.vue';
Vue.component('PlusMinus', PlusMinus);
import { AlertPlugin } from 'bootstrap-vue'
Vue.use(AlertPlugin);
import { BadgePlugin } from 'bootstrap-vue';
Vue.use(BadgePlugin);
import { Validator } from 'vee-validate';
import VeeValidate from 'vee-validate';

// Provide localized error messages for Polish and Hungarian.
const dictionary = {
    pl: {
        messages: {
            required: () => 'To pole jest wymagane.',
            max: (i, j) => 'To pole może mieć maksymalnie ' + j + ' znaków.'
        }
    },
    hu: {
        messages: {
            required: () => 'A mező kitöltése kötelező.',
            max: (i, j) => 'A mező értéke legfeljebb ' + j + ' karakter hosszú lehet.'
        }
    }
};
Validator.localize(dictionary);
Vue.use(VeeValidate);

new Vue({
    el: '#idea',
    created() {
        this.$root.$validator.localize('hu');
    },
    methods: {
        saveComment() {
            this.$root.$validator.validate('new-comment.*').then(valid => {
                if (valid) {
                    this.$refs['new-comment'].submit();
                }
            });
        }
    }
});
