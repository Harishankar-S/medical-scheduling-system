document.getElementById('searchForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('scripts/search_doctors.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(html => {
    document.getElementById('results').innerHTML = html;
  });
});
