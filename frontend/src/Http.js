import axios from 'axios'
import store from './store'
import * as actions from './store/actions'

let token = "x";
if (document.head.querySelector('meta[name="csrf-token"]') != null) {
	token = document.head.querySelector('meta[name="csrf-token"]');
	axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.interceptors.response.use(
    response => response,
    (error) => {
        if(error.response.status === 401 ) {
            store.dispatch(actions.authLogout())
        }
        return Promise.reject(error);
    }
);
export default axios;
