// No seu sw.js
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      // Se estivermos em modo offline (podemos controlar isso via query string ou header)
      // O Service Worker entrega o que está no cache e NÃO tenta a rede.
      if (response) {
        return response; 
      }
      
      // Se não tiver no cache e a rede falhar (ou for bloqueada)
      return fetch(event.request).catch(() => {
        // Retorna uma página ou mensagem de erro customizada do seu PWA
        return new Response("<h1>Sistema operando em modo Local (PWA)</h1>", {
          headers: {'Content-Type': 'text/html'}
        });
      });
    })
  );
});