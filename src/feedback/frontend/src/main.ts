import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

import 'bootstrap/dist/css/bootstrap.css'

axios.defaults.baseURL = 'http://api.feedback.local.com';
axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem("TOKEN");

const app = createApp(App)

app.use(router)
app.use(store)
app.mount('#app')

import 'bootstrap/dist/js/bootstrap.js'

