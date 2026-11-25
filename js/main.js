// EverAfter Events — static demo interactions (scroll reveals + enquiry demo mode)
document.addEventListener('DOMContentLoaded', function () {
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });

  var form = document.getElementById('enquiry-form');
  if (form) {
    form.addEventListener('submit', function (ev) {
      ev.preventDefault();
      if (!form.checkValidity()) { form.classList.add('was-validated'); return; }
      var name = document.getElementById('eq-name').value.trim();
      var summary = document.getElementById('enquiry-summary');
      var ref = 'EA-' + new Date().getFullYear() + '-' + String(Math.floor(1000 + Math.random() * 9000));
      document.getElementById('enquiry-ref').textContent = ref;
      document.getElementById('enquiry-name').textContent = name;
      form.classList.add('d-none');
      summary.classList.remove('d-none');
      summary.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }
});
