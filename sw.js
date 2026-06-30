const CACHE_NAME = 'infogempa-v1';
const urlsToCache = [
  './',
  './index.php',
  './assets/css/styles.css',
  './assets/js/scripts.js',
  './assets/icon-192.png',
  './assets/icon-512.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});

// Dengarkan event 'push' dari server backend
self.addEventListener('push', function(event) {
    if (event.data) {
        const payload = event.data.json();
        const options = {
            body: payload.body,
            icon: payload.icon || 'assets/icon-192.png',
            vibrate: [200, 100, 200, 100, 200, 100, 200],
            data: { url: payload.url || '/' }
        };
        
        event.waitUntil(
            self.registration.showNotification(payload.title, options)
        );
    }
});

// Tangani saat pengguna mengklik notifikasi (buka aplikasi)
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.matchAll({ type: 'window' }).then(windowClients => {
            for (let i = 0; i < windowClients.length; i++) {
                const client = windowClients[i];
                if (client.url.indexOf('/') !== -1 && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow('/');
            }
        })
    );
});
