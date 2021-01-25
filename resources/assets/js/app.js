
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import Toastr
import Toastr from 'vue-toastr';
// import toastr scss file: need webpack sass-loader
require('vue-toastr/src/vue-toastr.scss');

Vue.use(Toastr);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('vuetable-pagination', Vuetable.VuetablePagination)
import voterstable from './components/votersDatatable.vue';
import votestable from './components/votesDatatable.vue';
import positionsDatatable from './components/positionsDatatable.vue';
import CandidatesTable from './components/CandidatesTable.vue';
import ballot from './components/ballot.vue';
import election_title from './components/election_title.vue';
import dash_stat from './components/dash_stat.vue';
import votestally from './components/votestally.vue';


// Vue.component('voterstable', require('./components/votersDatatable.vue'));ExampleComponent.vue
Vue.component('voterstable', voterstable);
Vue.component('votestable', votestable);
Vue.component('positionstable', positionsDatatable);
Vue.component('candidatestable', CandidatesTable);
Vue.component('ballotposition', ballot);
Vue.component('electiontitle', election_title);
Vue.component('stat', dash_stat);
Vue.component('votestally', votestally);

import election_voters_title from './components/election_voters_title.vue';
import voters_ballot from './components/voters_ballot.vue';
Vue.component('electiontitle2', election_voters_title);
Vue.component('voters_ballot', voters_ballot);

const app = new Vue({
    el: '#app',
});
