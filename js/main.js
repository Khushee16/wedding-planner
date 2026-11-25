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

/* Polish upgrade: reduced-motion-safe reveals, back-to-top, stagger */
(function () {
  var reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  document.addEventListener("DOMContentLoaded", function () {
    var els = document.querySelectorAll(".reveal-left,.reveal-right,.reveal-zoom");
    if (reduced || !("IntersectionObserver" in window)) {
      els.forEach(function (el) { el.classList.add("visible"); });
      document.querySelectorAll(".reveal").forEach(function (el) { el.classList.add("visible"); });
    } else {
      var io2 = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add("visible"); io2.unobserve(e.target); } });
      }, { threshold: 0.12 });
      els.forEach(function (el) { io2.observe(el); });
    }
    var btn = document.createElement("button");
    btn.id = "back-to-top"; btn.type = "button";
    btn.setAttribute("aria-label", "Back to top");
    btn.textContent = "\u2191";
    btn.addEventListener("click", function () { window.scrollTo({ top: 0, behavior: reduced ? "auto" : "smooth" }); });
    document.body.appendChild(btn);
    window.addEventListener("scroll", function () { btn.classList.toggle("show", window.scrollY > 600); }, { passive: true });
  });
})();
