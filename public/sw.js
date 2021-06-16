var cacheName = 'rostiquiz-pwa';
var filesToCache = [
  '/public/page/offline.html',
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function (e) {

  e.waitUntil(
    caches.open(cacheName).then(function (cache) {
      return cache.addAll(filesToCache);
    })
  );
});

/* Serve cached content when offline */
self.addEventListener('fetch', function (e) {
  if (!navigator.onLine) {
    e.respondWith(
      caches.match('/public/page/offline.html').then(function (response) {
        return response;
      })
    )
  }
});
