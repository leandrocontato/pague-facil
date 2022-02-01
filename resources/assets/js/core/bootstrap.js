window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.$ = window.jQuery = require('jquery');

require('bootstrap');
require('jquery-mask-plugin');

import swal from 'sweetalert2';
import 'select2';

window.swal    = require('sweetalert2');
window.select2 = require('select2');

require('./theme');