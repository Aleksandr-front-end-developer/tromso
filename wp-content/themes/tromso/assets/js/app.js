(() => {
    "use strict";
    if ("undefined" !== typeof jQuery) jQuery((function($) {
        let isOpen = false;
        let isScrolled = false;
        let showToursDropdown = false;
        $(window).on("scroll", (function() {
            isScrolled = $(window).scrollTop() > 50;
            $("header").toggleClass("scrolled", isScrolled);
        }));
        function scrollToSection(id) {
            const element = $("#" + id);
            if (element.length) {
                const offset = 80;
                const elementPosition = element.offset().top - offset;
                $("html, body").animate({
                    scrollTop: elementPosition
                }, 300);
            }
            isOpen = false;
            showToursDropdown = false;
            $(".mobile-menu").hide();
            $(".tours-dropdown").hide();
            $("header").removeClass("menu-open");
        }
        $(".mobile-toggle").on("click", (function() {
            isOpen = !isOpen;
            $(".mobile-menu").toggle(isOpen);
            $("header").toggleClass("menu-open", isOpen);
        }));
        $(".tours-trigger").on("mouseenter", (function() {
            showToursDropdown = true;
            $(".tours-dropdown").show();
        }));
        $(".tours-dropdown").on("mouseleave", (function() {
            showToursDropdown = false;
            $(this).hide();
        }));
        $(".tour-item").on("click", (function() {
            const sectionId = $(this).data("section");
            handleTourClick(sectionId);
        }));
        $(".mobile-tour-item").on("click", (function() {
            const sectionId = $(this).data("section");
            handleTourClick(sectionId);
        }));
        $(".nav-link").on("click", (function() {
            isOpen = false;
            $(".mobile-menu").hide();
            $("header").removeClass("menu-open");
        }));
        function handleTourClick(sectionId) {
            const currentPage = window.location.pathname;
            const isHomePage = currentPage === "/" || currentPage === "/index.html" || currentPage.endsWith("/");
            if (!isHomePage) window.location.href = "/" + "#" + sectionId; else scrollToSection(sectionId);
        }
    }));
})();