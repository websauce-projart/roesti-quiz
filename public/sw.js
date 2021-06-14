var cacheName = 'rostiquiz-pwa';
var filesToCache = [
  '/page/offline.html',
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
  console.log(e, navigator.onLine);
  if (!navigator.onLine) {
    e.respondWith(
      caches.match('/page/offline.html').then(function (response) {
        return response;
      })
    )
  }

  // return fetch(e.request);
  e.respondWith(
    caches.match(e.request).then(function (response) {
      return response || fetch(e.request);
    })
  );
});
