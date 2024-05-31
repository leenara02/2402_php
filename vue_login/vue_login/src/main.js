import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { GoogleLoginProvider } from 'vue3-google-login';

const app = createApp(App);

app.use(router);

app.use(GoogleLoginProvider, {
    clientId: '467563356632-tinsoo9nuv8ihoa1nk64f1rnl15h15ap.apps.googleusercontent.com'
});

app.mount('#app');