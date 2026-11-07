/*
    Focus PWA Firebase Messaging Service Worker (Compat verzió)
*/

// 1. A Firebase v10 kompatibilitási szkriptek beöltése
importScripts('https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.8.0/firebase-messaging-compat.js');

// Globális jelző, hogy a Firebase sikeresen elindult-e
let isFirebaseReady = false;

try {
    const urlParams = new URL(self.location).searchParams;
    const configRaw = urlParams.get('config');

    if (configRaw) {
        const firebaseConfig = JSON.parse(decodeURIComponent(configRaw));

        // 2. Inicializálás a kompatibilis API-val
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        // Háttérben érkező üzenetek kezelése a Firebase SDK-val
        messaging.onBackgroundMessage((payload) => {
            console.log('[Service Worker] Háttérben érkezett push üzenet (Firebase):', payload);

            const notificationTitle = payload.notification?.title || 'Új értesítés';
            const notificationOptions = {
                body: payload.notification?.body || '',
                icon: payload.notification?.icon || '/favicon.ico'
            };

            self.registration.showNotification(notificationTitle, notificationOptions);
        });

        isFirebaseReady = true;
        console.log('[Service Worker] Firebase Messaging sikeresen inicializálva.');
    } else {
        console.warn('[Service Worker] Nem található Firebase konfiguráció az URL-ben.');
    }
} catch (error) {
    console.error('[Service Worker] Hiba történt a Firebase inicializálása során:', error);
}

// 🚀 BIZTONSÁGI MENTŐÖV FIREFOXHOZ / CHROMIUMHOZ
// Csak akkor avatkozik be manuálisan, ha a Firebase SDK valamiért nem tudta lekezelni az eseményt
self.addEventListener('push', function(event) {
    console.log('[Service Worker] Nyers Push esemény érkezett a böngészőtől.');

    // Ha a Firebase él és fut, rábízzuk a titkosított adat kicsomagolását, nem avatkozunk be
    if (isFirebaseReady) {
        return;
    }

    // Ha a Firebase nem fut, de érkezett adat, megpróbáljuk manuálisan megjeleníteni
    if (event.data) {
        try {
            const payload = event.data.json();
            if (payload && payload.notification) {
                const title = payload.notification.title || 'Új értesítés';
                const options = {
                    body: payload.notification.body || '',
                    icon: payload.notification.icon || '/favicon.ico',
                    data: payload.data || {}
                };
                event.waitUntil(self.registration.showNotification(title, options));
            }
        } catch (e) {
            const rawText = event.data.text();
            if (rawText) {
                event.waitUntil(self.registration.showNotification('Értesítés', {
                    body: rawText,
                    icon: '/favicon.ico'
                }));
            }
        }
    }
});