/**
 * We will load the Axios HTTP library, which enables us to easily make requests
 * to our Laravel back-end. This library automatically includes the CSRF token 
 * in the request headers based on the "XSRF" token stored in the cookie.
 */

import axios from 'axios';
import store from './store';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';

// Set up a handler for 401 responses. A 401 response from the server indicates that the user is not logged in.

window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.isAxiosError) {
            const status = error.response.status;
            if (status === 401 || status === 419) {
                store.sessionExpired();
            }
        }

        return Promise.reject(error);
    },
);

