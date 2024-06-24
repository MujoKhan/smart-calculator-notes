import { createApp } from 'vue'
import App from './App.vue'
import router from './router.js'
import setAuthHeder from './setAuthHeader.js';
import './assets/css/bootstrap.min.css'
import './assets/css/style.css'
import './assets/css/tempusdominus-bootstrap-4.min.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';



// if(localStorage.jwtToken)
if(localStorage.getItem('token'))
{
    // setAuthHeder(localStorage.jwtToken);
    setAuthHeder(localStorage.getItem('token'));
}
else
{
    setAuthHeder(false); 
}

// createApp(App).mount('#app')
createApp(App)
    .use(router)
    .use(VueSweetalert2)
    .mount("#app")