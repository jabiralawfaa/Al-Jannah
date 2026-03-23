// Service Worker untuk Image Caching
const CACHE_NAME = 'rkm-al-jannah-v1';
const IMAGE_CACHE_NAME = 'rkm-images-v1';

// URLs yang akan di-cache saat install
const STATIC_ASSETS = [
    '/',
    '/images/logo-al-jannah.png',
    '/images/ranting.png',
    '/images/pohon.png',
    '/images/bottom-ornament.png',
];

// Install Event - Cache static assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('Service Worker: Caching static assets');
            return cache.addAll(STATIC_ASSETS);
        })
    );
    self.skipWaiting();
});

// Activate Event - Clean old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME && cacheName !== IMAGE_CACHE_NAME) {
                        console.log('Service Worker: Clearing old cache', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Fetch Event - Serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // SKIP: Ignore non-HTTP/HTTPS requests (chrome-extension, moz-extension, etc.)
    if (!request.url.startsWith('http://') && !request.url.startsWith('https://')) {
        return;
    }

    // SKIP: Ignore requests from browser extensions
    // Check if request is from a different origin (extensions, external sites, etc.)
    const isSameOrigin = url.origin === self.location.origin;
    
    if (!isSameOrigin) {
        // Allow images from trusted CDNs (Unsplash, etc.)
        const allowedImageDomains = ['images.unsplash.com', 'unsplash.com'];
        const isAllowedImage = allowedImageDomains.includes(url.hostname) && isImageRequest(request);
        
        if (!isAllowedImage) {
            return; // Skip caching for other external requests
        }
    }

    // Only cache image requests
    if (isImageRequest(request)) {
        event.respondWith(
            caches.open(IMAGE_CACHE_NAME).then((cache) => {
                return cache.match(request).then((cachedResponse) => {
                    if (cachedResponse) {
                        console.log('Service Worker: Serving from cache', request.url);
                        // Return cached image immediately
                        return cachedResponse;
                    }
                    
                    // Not in cache, fetch from network
                    return fetch(request).then((networkResponse) => {
                        // Only cache successful responses
                        if (networkResponse.ok) {
                            cache.put(request, networkResponse.clone());
                            console.log('Service Worker: Caching new image', request.url);
                        }
                        return networkResponse;
                    });
                });
            })
        );
    }
    // For non-image requests, use network first
    else {
        event.respondWith(
            fetch(request).catch(() => {
                return caches.match(request);
            })
        );
    }
});

// Helper function to check if request is for an image
function isImageRequest(request) {
    const url = new URL(request.url);
    const pathname = url.pathname.toLowerCase();
    
    // Check if it's an image file extension
    const imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.svg', '.ico'];
    const isImageExtension = imageExtensions.some(ext => pathname.endsWith(ext));
    
    // Check if it's from Unsplash or other image CDN
    const isImageCDN = url.hostname.includes('unsplash.com') || 
                       url.hostname.includes('images.unsplash.com');
    
    return isImageExtension || isImageCDN;
}
