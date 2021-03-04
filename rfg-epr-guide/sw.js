importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.6.1/workbox-sw.js');

workbox.core.setCacheNameDetails({
  prefix: 'rfg-epr-guide',
  suffix: 'v1'
});

workbox.routing.registerRoute(/index\.php$|\/$|#.*$/, workbox.strategies.networkFirst());
//   args=>{
//   // Empty string or
//   // just a slash or
//   // any url ending in #*
//   return workbox.strategies.networkFirst().handle(args).then(response=>{
//     if (!response) {
//       return caches.match('index.php', {
//         ignoreSearch:true
//       });
//     }
//     return response;
//   });
// });

workbox.routing.registerRoute(
  /.*\.(?:css|js|xml|json|png|jpg|jpeg|svg|ico)/,
  workbox.strategies.staleWhileRevalidate()
);

// Cache the Google Fonts stylesheets with a stale-while-revalidate strategy.
workbox.routing.registerRoute(
  /^https:\/\/fonts\.googleapis\.com/,
  workbox.strategies.staleWhileRevalidate({
    cacheName: 'google-fonts-stylesheets',
  })
);

// Cache the underlying font files with a cache-first strategy for 1 year.
workbox.routing.registerRoute(
  /^https:\/\/fonts\.gstatic\.com/,
  workbox.strategies.cacheFirst({
    cacheName: 'google-fonts-webfonts',
    plugins: [
      new workbox.cacheableResponse.Plugin({
        statuses: [0, 200],
      }),
      new workbox.expiration.Plugin({
        maxAgeSeconds: 60 * 60 * 24 * 365,
        maxEntries: 30,
      }),
    ],
  })
);

workbox.googleAnalytics.initialize();