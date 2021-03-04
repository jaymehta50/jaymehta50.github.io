var CACHE_NAME = 'rfg-epr-guide-cache-v1';
var urlsToCache = [
  '/',
  '/manifest.json',
  '/assets/css/materialize.min.css',
  '/assets/css/style.css',
  '/assets/favicon.ico',
  '/assets/site_favicon/apple-touch-icon-57x57.png',
  '/assets/site_favicon/apple-touch-icon-114x114.png',
  '/assets/site_favicon/apple-touch-icon-72x72.png',
  '/assets/site_favicon/apple-touch-icon-144x144.png',
  '/assets/site_favicon/apple-touch-icon-60x60.png',
  '/assets/site_favicon/apple-touch-icon-120x120.png',
  '/assets/site_favicon/apple-touch-icon-76x76.png',
  '/assets/site_favicon/apple-touch-icon-152x152.png',
  '/assets/site_favicon/favicon-196x196.png',
  '/assets/site_favicon/favicon-160x160.png',
  '/assets/site_favicon/favicon-96x96.png',
  '/assets/site_favicon/favicon-16x16.png',
  '/assets/site_favicon/favicon-32x32.png',
  '/assets/site_favicon/mstile-70x70.png',
  '/assets/site_favicon/mstile-144x144.png',
  '/assets/site_favicon/browserconfig.xml',
  '/assets/js/materialize.min.js',
  '/assets/js/init.js',
  '/assets/img/ahp.png',
  '/assets/img/clinicallyled.png',
  '/assets/img/clinicalprocess.png',
  '/assets/img/consultant.png',
  '/assets/img/juniordoc.png',
  '/assets/img/matron.png',
  '/assets/img/midwife.png',
  '/assets/img/nurse.png',
  '/assets/img/nursingassistant.png',
  '/assets/img/pharmacist.png',
  '/assets/img/ios-share.svg',
  '/assets/img/ios_add_to_hs.jpeg',
  '/assets/img/passport.jpg',
  'https://fonts.googleapis.com/icon?family=Material+Icons'
];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Cache hit - return response
        if (response) {
          return response;
        }
        return fetch(event.request);
      }
    )
  );
});