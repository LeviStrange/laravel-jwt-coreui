import Http from '../Http'
import * as action from '../store/actions'
import { Config } from '../config'

export function login(credentials) {
    return dispatch => (
        new Promise((resolve, reject) => {
            Http.post(Config.apiURL + '/api/auth/login', credentials)
                .then(res => {
                    dispatch(action.authLogin(res.data));
                    console.log(res.data);
                    return resolve();

                })
                .catch(err => {
                    console.log(err);
                    const statusCode = err.response.status;
                    const data = {
                        error: null,
                        statusCode,
                    };
                    if (statusCode === 401 || statusCode === 422) {
                        // status 401 means unauthorized
                        // status 422 means unprocessable entity
                        data.error = err.response.data.message;
                    }
                    return reject(data);
                })
        })
    )
}

export function logout() {
    return dispatch => (
        new Promise((resolve, reject) => {
            Http.get(Config.apiURL + '/api/auth/logout', {})
                .then(res => {
                    dispatch(action.authLogout());
                    return resolve({
                        success: true
                    });
                })
                .catch(err => {
                    console.log(err);
                    const statusCode = err.response.status;
                    const data = {
                        error: null,
                        statusCode,
                    };
                    if (statusCode === 422) {
                        Object.values(err.response.data.message).forEach((value,i) => {
                            data.error = value
                        });

                    }else if (statusCode === 400) {
                        data.error = err.response.data.message;
                    }
                    return reject(data);
                })
        })
    )
}

export function socialLogin(data) {
    return dispatch => (
        new Promise((resolve, reject) => {
            Http.post( Config.apiURL + `/api/auth/login/${data.social}/callback${data.params}` )
                .then(res => {
                    dispatch( action.authLogin(res.data) );
                    return resolve();
                })
                .catch(err => {
                    const statusCode = err.response.status;
                    const data = {
                        error: null,
                        statusCode,
                    };
                    if (statusCode === 401 || statusCode === 422) {
                        // status 401 means unauthorized
                        // status 422 means unprocessable entity
                        data.error = err.response.data.message;
                    }
                    return reject(data);
                })
        })
    )
}

export function resetPassword(credentials) {
    return dispatch => (
        new Promise((resolve, reject) => {
            Http.post(Config.apiURL + '/api/password/email', credentials)
                .then(res => {
                    return resolve(res.data);
                })
                .catch(err => {
                    const statusCode = err.response.status;
                    const data = {
                        error: null,
                        statusCode,
                    };
                    if (statusCode === 401 || statusCode === 422) {
                        // status 401 means unauthorized
                        // status 422 means unprocessable entity
                        data.error = err.response.data.message;
                    }
                    return reject(data);
                })
        })
    )
}

export function updatePassword(credentials) {
    return dispatch => (
        new Promise((resolve, reject) => {
            Http.post(Config.apiURL + '/api/password/reset', credentials)
                .then(res => {
                    const statusCode = res.data.status;
                    if ( parseInt( statusCode, 10 ) === 202 ) {
                        const data = {
                            error: res.data.message,
                            statusCode,
                        }
                        return reject(data)
                    }
                    return resolve(res);
                })
                .catch(err => {
                    const statusCode = err.response.status;
                    const data = {
                        error: null,
                        statusCode,
                    };
                    if (statusCode === 401 || statusCode === 422) {
                        // status 401 means unauthorized
                        // status 422 means unprocessable entity
                        data.error = err.response.data.message;
                    }
                    return reject(data);
                })
        })
    )
}

export function register(credentials) {
    return dispatch => (
        new Promise((resolve, reject) => {
            Http.post( Config.apiURL + '/api/auth/register', credentials )
                .then(res => {
                    return resolve(res.data);
                })
                .catch(err => {
                    console.log(err);
                    const statusCode = err.response.status;
                    const data = {
                        error: null,
                        statusCode,
                    };
                    if (statusCode === 422) {
                        Object.values(err.response.data.message).forEach((value,i) => {
                            data.error = value
                        });

                    } else if (statusCode === 400) {
                        data.error = err.response.data.message;
                    }
                    return reject(data);
                })
        })
    )
}
