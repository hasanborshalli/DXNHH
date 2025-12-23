(function () {
    // Mobile nav toggle
    const btn = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-nav]");
    if (btn && nav) {
        btn.addEventListener("click", () => {
            nav.classList.toggle("is-open");
        });
    }

    // IntersectionObserver animations
    const animated = Array.from(document.querySelectorAll("[data-animate]"));
    if ("IntersectionObserver" in window) {
        const io = new IntersectionObserver(
            (entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) {
                        e.target.classList.add("is-visible");
                        io.unobserve(e.target);
                    }
                });
            },
            { threshold: 0.12 }
        );

        animated.forEach((el) => io.observe(el));
    } else {
        animated.forEach((el) => el.classList.add("is-visible"));
    }
})();
document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.querySelector(".admin-nav-toggle");
    const navAdmin = document.getElementById("adminNav");

    if (!toggle || !navAdmin) return;

    toggle.addEventListener("click", () => {
        const open = navAdmin.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });

    // Close menu when clicking outside
    document.addEventListener("click", (e) => {
        if (!navAdmin.classList.contains("is-open")) return;
        if (navAdmin.contains(e.target) || toggle.contains(e.target)) return;
        navAdmin.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
    });
});
