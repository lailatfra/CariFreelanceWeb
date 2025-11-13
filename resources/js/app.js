// resources/js/app.js

import './bootstrap';

// Import Echo & Pusher
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Configure Pusher
window.Pusher = Pusher;

// Initialize Echo dengan Reverb
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
        }
    }
});

console.log('✅ Echo initialized with Reverb');
console.log('📡 Connecting to:', import.meta.env.VITE_REVERB_HOST + ':' + import.meta.env.VITE_REVERB_PORT);