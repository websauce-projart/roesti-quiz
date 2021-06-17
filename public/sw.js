var cacheName = 'rostiquiz-pwa';
var filesToCache = [
    '/websauce/offline.html',
];

/* Start the service worker and cache all of the app's content */
this.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(cacheName).then(function (cache) {
            return cache.addAll(filesToCache);
        })
    );
});

/* Serve cached content when offline */

this.addEventListener('fetch', event => {
    let responsePromise = caches.match(event.request)
        .then(() => {
            return fetch(filesToCache)
        });
    if(!navigator.onLine){
        event.respondWith(responsePromise);
    }
});
