import axios from 'axios';

const baseURL = `${window.location.protocol}//${window.location.host}/api/`;
const instance = axios.create({
    baseURL: baseURL,
})

instance.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

const $get = <T>(uri: string, params?: any) => instance.get(uri, { params }).then(({data}) => data);
const $post = <T>(uri: string, data?: any) => instance.post(uri, data).then(({data}) => data);

const $put = <T>(uri: string, data?: any) => instance.put(uri, data).then(({data}) => data);
const $delete = <T>(uri: string, data?: any) => instance.delete(uri).then(({data}) => data);

export default $post;