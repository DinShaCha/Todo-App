import { reactive } from 'vue';
import router from './router';
import axios from 'axios';


// Pinia is unnecessary for this project—keeping it simple. :)  
// Conventions:  
// - Props are read-only (public get only)  
// - State mutations occur exclusively through methods  
const store = reactive({
    isLoggedIn: false,

    user: null,

    /**
     * Login the user.
     * 
     * @param {{ email: string, password: string }} data
     * @returns {Promise<void>}
     */
    async login(data) {
        await axios.post('/login', data);

        this.isLoggedIn = true;
        this.user = null;

        router.push({ name: 'Dashboard' });
    },

    /**
     * Logout the user.
     * 
     * @returns {Promise<void>}
     */
    async logout() {
        await axios.post('/logout');

        this.isLoggedIn = false;
        this.user = null;

        router.push({ name: 'Home' });
    },

    /**  
     * Logs out the user forcibly. This method should be triggered when the server  
     * responds with a 401 or 419 status code.  
     */
    sessionExpired() {
        this.isLoggedIn = false;
        router.push({ name: 'Login' });
    },

    /**
     * Register the user.
     * 
     * @param {{ name: string, email: string, password: string, password_confirmation: string }} data
     * @returns {Promise<void>}
     */
    async register(data) {
        await axios.post('/register', data);

        this.isLoggedIn = true;
        this.user = null;

        router.push({ name: 'Dashboard' });
    },

    /**
     * Populate the store with the provided data
     *
     * @param {{ user: object? }} data
     */
    hydrate(data) {
        this.isLoggedIn = data.user !== null;
        this.user = data.user;
    },
});

export default store;