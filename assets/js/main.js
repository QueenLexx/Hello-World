document.addEventListener('DOMContentLoaded', function () {

    // Mobile menu toggle
    var toggle = document.querySelector('.mobile-menu-toggle');
    var mobileNav = document.getElementById('mobile-nav');
    if (toggle && mobileNav) {
        toggle.addEventListener('click', function () {
            var isOpen = mobileNav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen);
        });
    }

    // Sticky header shadow on scroll
    var header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 20) {
                header.style.boxShadow = '0 4px 30px rgba(0,0,0,0.5)';
            } else {
                header.style.boxShadow = 'none';
            }
        }, { passive: true });
    }

    // Newsletter form
    var newsletterForm = document.getElementById('newsletter-form');
    var newsletterMsg  = document.getElementById('newsletter-message');
    if (newsletterForm && newsletterMsg) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var email = newsletterForm.querySelector('input[name="email"]').value.trim();
            if (!email) return;

            var body = new FormData();
            body.append('action', 'pr_newsletter');
            body.append('nonce', (typeof prData !== 'undefined') ? prData.nonce : '');
            body.append('email', email);

            fetch((typeof prData !== 'undefined') ? prData.ajaxUrl : '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: body,
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                newsletterMsg.textContent = data.data ? data.data.message : 'Thank you!';
                newsletterMsg.style.display = 'block';
                newsletterMsg.style.color = data.success ? 'var(--gold)' : '#ff6b6b';
                if (data.success) newsletterForm.reset();
            })
            .catch(function () {
                newsletterMsg.textContent = 'Something went wrong. Please try again.';
                newsletterMsg.style.display = 'block';
                newsletterMsg.style.color = '#ff6b6b';
            });
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Animate elements into view
    var observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.product, .feature-card, .testimonial-card').forEach(function (el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});
