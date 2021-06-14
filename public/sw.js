var cacheName = 'rostiquiz-pwa';
var filesToCache = [
  'https://pingouin.heig-vd.ch/websauce/page/offline.html',
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
      caches.match('https://pingouin.heig-vd.ch/websauce/page/offline.html').then(function (response) {
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
