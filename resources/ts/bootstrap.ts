import Axios, { AxiosStatic } from "axios";

declare global {
    interface Window {
        axios: AxiosStatic;
    }
    interface Element {
        content: string;
    }
}

export default function bootstrap() {
    window.axios = Axios;
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }
}
