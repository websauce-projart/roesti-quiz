var cacheName = 'rostiquiz-pwa';
var filesToCache = [
  '/websauce/',
  '/websauce/page/offline.html',
  '/websauce/css/style.css',
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
      caches.match('/websauce/page/offline.html').then(function (response) {
        return response;
      })
    )
  }
});
