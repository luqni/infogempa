const CACHE_NAME = 'infogempa-v1';
const urlsToCache = [
  '/infogempa/',
  '/infogempa/index.php',
  '/infogempa/assets/css/styles.css',
  '/infogempa/assets/js/scripts.js',
  '/infogempa/assets/icon-192.png',
  '/infogempa/assets/icon-512.png'
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
