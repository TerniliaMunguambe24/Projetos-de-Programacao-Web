// script.js
// Pequenas interações: play do vídeo embutido e preenchimento do ano no footer.

document.addEventListener('DOMContentLoaded', function () {
  // ano no footer
  const yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  const videoWrap = document.getElementById('video-wrap');
  const playBtn = document.getElementById('play-btn');

  function playVideo() {
    if (!videoWrap) return;
    const src = videoWrap.dataset.youtube;
    // cria iframe
    const iframe = document.createElement('iframe');
    iframe.setAttribute('src', src + '?autoplay=1&rel=0');
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture');
    iframe.setAttribute('allowfullscreen', '1');
    iframe.style.width = '100%';
    iframe.style.height = '400px';
    iframe.style.borderRadius = '8px';

    // substituir o conteúdo
    videoWrap.innerHTML = '';
    videoWrap.appendChild(iframe);
  }

  if (playBtn) {
    playBtn.addEventListener('click', playVideo);
  }
  if (videoWrap) {
    videoWrap.addEventListener('click', function (e) {
      // evita disparar duas vezes caso use o botão
      if (e.target === videoWrap || e.target === playBtn) {
        playVideo();
      }
    });
  }
});
