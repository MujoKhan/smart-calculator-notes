import { createWebHistory, createRouter } from 'vue-router';
import home from './components/home.vue';
import login from './components/login.vue';
import register from './components/register.vue';
import calender from './components/calender.vue';
import calculator from './components/calculator.vue';
import notepad from './components/notepad.vue';
import showTitle from './components/showTitle.vue';
import adminLogin from './components/admin/adminLogin.vue';
import adminHome from './components/admin/home.vue';
import user from './components/admin/user.vue';



function guardMyroute(to, from, next)
{
    var isAuthenticated= false;
    //this is just an example. You will have to find a better or 
    // centralised way to handle you localstorage data handling 
    if(localStorage.getItem('token'))
        {
            isAuthenticated = true;
        }
    else
        {
            isAuthenticated= false;
        }

    if(isAuthenticated) 
        {
            next(); // allow to enter route
        } 
    else
        {
            next('/'); // go to '/login';
        }
    if(to.name == 'Login' && localStorage.getItem('token'))    
    {
        next({name: 'Home'});
    }
}



const routes = [
    {
        path : '/',
        name : 'Login',
        component : login,
    },
    {
        path : '/register',
        name : 'Register',
        component : register,
    },
    {
        path : '/home',
        name : 'Home',
        beforeEnter : guardMyroute,
        component : home,
        props: true,
        
    },
    {
        path : '/calender',
        name : 'Calender',
        beforeEnter : guardMyroute,
        component : calender,
        // props: true,
        
    },
    {
        path : '/calculator',
        name : 'Calculator',
        beforeEnter : guardMyroute,
        component : calculator,
        // props: true,
        
    },
    {
        path : '/notepad',
        name : 'Notepad',
        beforeEnter : guardMyroute,
        component : notepad,
        // props: true,
        
    },
    {
        path : '/showTitle',
        name : 'showTitle',
        beforeEnter : guardMyroute,
        component : showTitle,
        // props: true,
    },
    {
        path : '/admin/login',
        name : 'adminLogin',
        component : adminLogin,
        // props: true,
    },
    {
        path : '/admin/home',
        name : 'adminHome',
        beforeEnter : guardMyroute,
        component : adminHome,
        // props: true,
    },
    {
        path : '/admin/user',
        name : 'user',
        beforeEnter : guardMyroute,
        component : user,
        // props: true,
    },
   
  
  
];

const router = createRouter({
    history: createWebHistory(),
    routes
});




export default router;