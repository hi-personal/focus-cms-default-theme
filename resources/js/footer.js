document.addEventListener('DOMContentLoaded', async () => {
  $('#scrollTopBtn').on('click', function (e) {
    e.preventDefault();
    $('html, body').stop().animate({ scrollTop: 0 }, 500, 'swing');
  });
});