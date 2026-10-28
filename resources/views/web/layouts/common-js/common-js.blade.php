<script>
    // reveal-on-scroll, kept dependency free so no animation library is needed
    (function () {
        let revealItems = document.querySelectorAll('[data-reveal]');

        if (!revealItems.length) {
            return;
        }

        if (!('IntersectionObserver' in window)) {
            revealItems.forEach(function (item) {
                item.classList.add('is-revealed');
            });
            return;
        }

        // whatever has not been reached is shown anyway, so content can never be
        // left invisible if the observer does not fire
        setTimeout(function () {
            revealItems.forEach(function (item) {
                item.classList.add('is-revealed');
            });
        }, 1400);

        let observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        revealItems.forEach(function (item) {
            observer.observe(item);
        });
    })();
</script>
