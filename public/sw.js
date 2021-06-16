var cacheName = 'rostiquiz-pwa';
var filesToCache = [
  '/websauce/page/offline.html',
];

/* Start the service worker and cache all of the app's content */
this.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheVersion).then(function(cache) {
      return cache.addAll(urlsToPrefetch);
    })
  );
});

/* Serve cached content when offline */

this.addEventListener('fetch', event => {
  let responsePromise = caches.match(event.request).then(response => {
    return response || fetch(event.request)
  });

  event.respondWith(responsePromise);
});

// this.addEventListener('fetch', function (e) {
//   if (!navigator.onLine) {
//     e.respondWith(
//       caches.match('/websauce/page/offline.html').then(function (response) {
//         return response;
//       })
//     )
//   }
// });
