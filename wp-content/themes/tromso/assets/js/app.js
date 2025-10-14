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
        $(".mobile-toggle").on("click", (function(e) {
            e.preventDefault();
            e.stopPropagation();
            isOpen = !isOpen;
            $(".mobile-menu").toggle(isOpen);
            $("header").toggleClass("menu-open", isOpen);
        }));
        $(".tours-trigger").on("mouseenter", (function() {
            showToursDropdown = true;
            $(".tours-dropdown").show();
        }));
        $(".tours-trigger, .tours-dropdown").on("mouseleave", (function() {
            setTimeout((() => {
                if (!$(".tours-trigger").is(":hover") && !$(".tours-dropdown").is(":hover")) {
                    showToursDropdown = false;
                    $(".tours-dropdown").hide();
                }
            }), 100);
        }));
        $(".tour-item").on("click", (function(e) {
            e.preventDefault();
            const sectionId = $(this).data("section");
            handleTourClick(sectionId);
        }));
        $(".mobile-tour-item").on("click", (function(e) {
            e.preventDefault();
            const sectionId = $(this).data("section");
            handleTourClick(sectionId);
        }));
        $(".nav-link").on("click", (function(e) {
            if ($(this).attr("href") && $(this).attr("href").startsWith("#")) {
                e.preventDefault();
                const targetId = $(this).attr("href").substring(1);
                scrollToSection(targetId);
            }
            isOpen = false;
            $(".mobile-menu").hide();
            $("header").removeClass("menu-open");
        }));
        $(document).on("click", (function(e) {
            if (!$(e.target).closest("header, .mobile-toggle").length) {
                isOpen = false;
                $(".mobile-menu").hide();
                $("header").removeClass("menu-open");
            }
        }));
        function handleTourClick(sectionId) {
            const currentPage = window.location.pathname;
            const isHomePage = currentPage === "/" || currentPage === "/index.html" || currentPage.endsWith("/") || currentPage === "";
            if (!isHomePage) window.location.href = "/" + "#" + sectionId; else {
                scrollToSection(sectionId);
                if (history.pushState) history.pushState(null, null, "#" + sectionId); else window.location.hash = "#" + sectionId;
            }
        }
        $(document).ready((function() {
            if (window.location.hash) {
                const hash = window.location.hash.substring(1);
                setTimeout((() => {
                    scrollToSection(hash);
                }), 100);
            }
        }));
    }));
})();