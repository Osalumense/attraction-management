/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
    wsPort: 6001,
    wsHost: window.location.hostname,
});


// console.log('Pusher connection details:', window.Echo.connector, ' ', window.Echo.cluster);

console.log('Pusher connection status:', window.Echo.connector.pusher.connection.state);

// window.Echo.channel('attractions')
//     .listen('.attraction.created', (data) => {
//         console.log('Attraction created:', data);

//         // Display alert
//         const notification = document.createElement('div');
//         notification.className = 'alert alert-success';
//         notification.textContent = `New Attraction Created: ${data.attraction.name}, Location: ${data.attraction.location}`;
        
//         document.body.appendChild(notification);

//         // Automatically remove the notification after 5 seconds
//         setTimeout(() => notification.remove(), 5000);
//     });


// window.Echo.channel('attractions')
//     .listen('AttractionCreated', (event) => {
//         console.log('New Attraction:', event);
//     });

    // window.Echo.channel('attractions')
    // .listen('AttractionCreated', (event) => {
    //     console.log('New Attraction:', event.name, event.location);
    //     alert(`New Attraction: ${event.name} located at ${event.location}`);
    // });

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: window._env.PUSHER_APP_KEY,
//     cluster: window._env.PUSHER_APP_CLUSTER,
//     forceTLS: true,
// });
 
// import Pusher from 'pusher-js';
// window.Pusher = Pusher;
 
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

window.Echo.private('attractions')
    .listen('attraction.created', (e) => {
        console.log(e);
        alert('New Attraction Created: ' + e.name + ', Location: ' + e.location)
    });