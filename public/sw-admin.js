const CACHE_NAME = 'cial-admin-v2';

self.addEventListener('install', (event) => {
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => Promise.all(
      keys
        .filter((key) => key !== CACHE_NAME)
        .map((key) => caches.delete(key))
    ))
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') return;

  const requestUrl = new URL(event.request.url);
  const isStaticAsset = requestUrl.origin === self.location.origin
    && /\.(?:css|js|png|jpg|jpeg|gif|svg|ico|webp|woff2?)$/i.test(requestUrl.pathname);

  // HTML must always come from Laravel so forms receive a current CSRF token.
  if (! isStaticAsset) return;

  event.respondWith(
    caches.match(event.request).then((cached) => {
      if (cached) return cached;

      return fetch(event.request).then((response) => {
        if (! response.ok) return response;

        const cloned = response.clone();
        caches.open(CACHE_NAME).then((cache) => cache.put(event.request, cloned));
        return response;
      }).catch(() => Response.error());
    })
  );
});
