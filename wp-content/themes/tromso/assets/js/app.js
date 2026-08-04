(() => {
    "use strict";
    let _slideUp = (target, duration = 500, showmore = 0) => {
        if (!target.classList.contains("_slide")) {
            target.classList.add("_slide");
            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + "ms";
            target.style.height = `${target.offsetHeight}px`;
            target.offsetHeight;
            target.style.overflow = "hidden";
            target.style.height = showmore ? `${showmore}px` : `0px`;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            window.setTimeout((() => {
                target.hidden = !showmore ? true : false;
                !showmore ? target.style.removeProperty("height") : null;
                target.style.removeProperty("padding-top");
                target.style.removeProperty("padding-bottom");
                target.style.removeProperty("margin-top");
                target.style.removeProperty("margin-bottom");
                !showmore ? target.style.removeProperty("overflow") : null;
                target.style.removeProperty("transition-duration");
                target.style.removeProperty("transition-property");
                target.classList.remove("_slide");
                document.dispatchEvent(new CustomEvent("slideUpDone", {
                    detail: {
                        target
                    }
                }));
            }), duration);
        }
    };
    let _slideDown = (target, duration = 500, showmore = 0) => {
        if (!target.classList.contains("_slide")) {
            target.classList.add("_slide");
            target.hidden = target.hidden ? false : null;
            showmore ? target.style.removeProperty("height") : null;
            let height = target.offsetHeight;
            target.style.overflow = "hidden";
            target.style.height = showmore ? `${showmore}px` : `0px`;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            target.offsetHeight;
            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + "ms";
            target.style.height = height + "px";
            target.style.removeProperty("padding-top");
            target.style.removeProperty("padding-bottom");
            target.style.removeProperty("margin-top");
            target.style.removeProperty("margin-bottom");
            window.setTimeout((() => {
                target.style.removeProperty("height");
                target.style.removeProperty("overflow");
                target.style.removeProperty("transition-duration");
                target.style.removeProperty("transition-property");
                target.classList.remove("_slide");
                document.dispatchEvent(new CustomEvent("slideDownDone", {
                    detail: {
                        target
                    }
                }));
            }), duration);
        }
    };
    let _slideToggle = (target, duration = 500) => {
        if (target.hidden) return _slideDown(target, duration); else return _slideUp(target, duration);
    };
    function spollers() {
        const spollersArray = document.querySelectorAll("[data-spollers]");
        if (spollersArray.length > 0) {
            const spollersRegular = Array.from(spollersArray).filter((function(item, index, self) {
                return !item.dataset.spollers.split(",")[0];
            }));
            if (spollersRegular.length) initSpollers(spollersRegular);
            let mdQueriesArray = dataMediaQueries(spollersArray, "spollers");
            if (mdQueriesArray && mdQueriesArray.length) mdQueriesArray.forEach((mdQueriesItem => {
                mdQueriesItem.matchMedia.addEventListener("change", (function() {
                    initSpollers(mdQueriesItem.itemsArray, mdQueriesItem.matchMedia);
                }));
                initSpollers(mdQueriesItem.itemsArray, mdQueriesItem.matchMedia);
            }));
            function initSpollers(spollersArray, matchMedia = false) {
                spollersArray.forEach((spollersBlock => {
                    spollersBlock = matchMedia ? spollersBlock.item : spollersBlock;
                    if (matchMedia.matches || !matchMedia) {
                        spollersBlock.classList.add("_spoller-init");
                        initSpollerBody(spollersBlock);
                        spollersBlock.addEventListener("click", setSpollerAction);
                    } else {
                        spollersBlock.classList.remove("_spoller-init");
                        initSpollerBody(spollersBlock, false);
                        spollersBlock.removeEventListener("click", setSpollerAction);
                    }
                }));
            }
            function initSpollerBody(spollersBlock, hideSpollerBody = true) {
                let spollerTitles = spollersBlock.querySelectorAll("[data-spoller]");
                if (spollerTitles.length) {
                    spollerTitles = Array.from(spollerTitles).filter((item => item.closest("[data-spollers]") === spollersBlock));
                    spollerTitles.forEach((spollerTitle => {
                        if (hideSpollerBody) {
                            spollerTitle.removeAttribute("tabindex");
                            if (!spollerTitle.classList.contains("_spoller-active")) spollerTitle.nextElementSibling.hidden = true;
                        } else {
                            spollerTitle.setAttribute("tabindex", "-1");
                            spollerTitle.nextElementSibling.hidden = false;
                        }
                    }));
                }
            }
            function setSpollerAction(e) {
                const el = e.target;
                if (el.closest("[data-spoller]")) {
                    const spollerTitle = el.closest("[data-spoller]");
                    const spollersBlock = spollerTitle.closest("[data-spollers]");
                    const oneSpoller = spollersBlock.hasAttribute("data-one-spoller");
                    const spollerSpeed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                    if (!spollersBlock.querySelectorAll("._slide").length) {
                        if (oneSpoller && !spollerTitle.classList.contains("_spoller-active")) hideSpollersBody(spollersBlock);
                        spollerTitle.classList.toggle("_spoller-active");
                        _slideToggle(spollerTitle.nextElementSibling, spollerSpeed);
                    }
                    e.preventDefault();
                }
            }
            function hideSpollersBody(spollersBlock) {
                const spollerActiveTitle = spollersBlock.querySelector("[data-spoller]._spoller-active");
                const spollerSpeed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                if (spollerActiveTitle && !spollersBlock.querySelectorAll("._slide").length) {
                    spollerActiveTitle.classList.remove("_spoller-active");
                    _slideUp(spollerActiveTitle.nextElementSibling, spollerSpeed);
                }
            }
            const spollersClose = document.querySelectorAll("[data-spoller-close]");
            if (spollersClose.length) document.addEventListener("click", (function(e) {
                const el = e.target;
                if (!el.closest("[data-spollers]")) spollersClose.forEach((spollerClose => {
                    const spollersBlock = spollerClose.closest("[data-spollers]");
                    if (spollersBlock.classList.contains("_spoller-init")) {
                        const spollerSpeed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                        spollerClose.classList.remove("_spoller-active");
                        _slideUp(spollerClose.nextElementSibling, spollerSpeed);
                    }
                }));
            }));
        }
    }
    function uniqArray(array) {
        return array.filter((function(item, index, self) {
            return self.indexOf(item) === index;
        }));
    }
    function dataMediaQueries(array, dataSetValue) {
        const media = Array.from(array).filter((function(item, index, self) {
            if (item.dataset[dataSetValue]) return item.dataset[dataSetValue].split(",")[0];
        }));
        if (media.length) {
            const breakpointsArray = [];
            media.forEach((item => {
                const params = item.dataset[dataSetValue];
                const breakpoint = {};
                const paramsArray = params.split(",");
                breakpoint.value = paramsArray[0];
                breakpoint.type = paramsArray[1] ? paramsArray[1].trim() : "max";
                breakpoint.item = item;
                breakpointsArray.push(breakpoint);
            }));
            let mdQueries = breakpointsArray.map((function(item) {
                return "(" + item.type + "-width: " + item.value + "px)," + item.value + "," + item.type;
            }));
            mdQueries = uniqArray(mdQueries);
            const mdQueriesArray = [];
            if (mdQueries.length) {
                mdQueries.forEach((breakpoint => {
                    const paramsArray = breakpoint.split(",");
                    const mediaBreakpoint = paramsArray[1];
                    const mediaType = paramsArray[2];
                    const matchMedia = window.matchMedia(paramsArray[0]);
                    const itemsArray = breakpointsArray.filter((function(item) {
                        if (item.value === mediaBreakpoint && item.type === mediaType) return true;
                    }));
                    mdQueriesArray.push({
                        itemsArray,
                        matchMedia
                    });
                }));
                console.log("mdQueriesArray", mdQueriesArray);
                return mdQueriesArray;
            }
        }
    }
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
        var currentDomain = window.location.hostname;
        var currentPath = window.location.pathname;
        $("a[href]").not(".no-track").on("click", (function(e) {
            var $link = $(this);
            var href = $link.attr("href");
            if (languageData.current_language == languageData.default_language) return;
            if (!href || href.indexOf("javascript:") === 0 || href.indexOf("mailto:") === 0 || href.indexOf("tel:") === 0) return;
            if (href.indexOf("#") === 0) return;
            if (isExternalLink(href, currentDomain)) return;
            if (isSamePageWithAnchor(href, currentPath, currentDomain)) return;
            if (hasLanguagePrefix(href, languageData.current_language)) return;
            e.preventDefault();
            var params = {
                check_for_language: "1",
                current_language: languageData.current_language
            };
            var absoluteUrl = $link.prop("href");
            var newUrl = addParamsToUrl(absoluteUrl, params);
            if (href.indexOf("#") !== -1) {
                var anchor = href.split("#")[1];
                if (anchor) newUrl = newUrl.split("#")[0] + "#" + anchor;
            }
            window.location.href = newUrl;
        }));
        function isExternalLink(href, currentDomain) {
            if (href.indexOf("/") === 0) return false;
            if (href.indexOf("http") !== 0 && href.indexOf("//") !== 0) return false;
            try {
                var linkDomain = new URL(href, window.location.origin).hostname;
                return linkDomain.replace(/^www\./, "") !== currentDomain.replace(/^www\./, "");
            } catch (e) {
                return true;
            }
        }
        function isSamePageWithAnchor(href, currentPath, currentDomain) {
            if (href.indexOf("#") === -1) return false;
            try {
                var url = new URL(href, window.location.origin);
                var linkPath = url.pathname;
                var linkDomain = url.hostname;
                var isSameDomain = linkDomain.replace(/^www\./, "") === currentDomain.replace(/^www\./, "");
                var isSamePath = linkPath === currentPath || linkPath === "" || linkPath === "/";
                return isSameDomain && isSamePath;
            } catch (e) {
                if (href.indexOf("/") === 0) {
                    var pathWithoutAnchor = href.split("#")[0];
                    return pathWithoutAnchor === currentPath || pathWithoutAnchor === "" || pathWithoutAnchor === "/";
                }
                return false;
            }
        }
        function addParamsToUrl(url, params) {
            try {
                var urlObj = new URL(url);
                $.each(params, (function(key, value) {
                    urlObj.searchParams.set(key, value);
                }));
                return urlObj.toString();
            } catch (e) {
                var separator = url.indexOf("?") !== -1 ? "&" : "?";
                var paramString = $.map(params, (function(value, key) {
                    return key + "=" + encodeURIComponent(value);
                })).join("&");
                return url + separator + paramString;
            }
        }
        function hasLanguagePrefix(href, language) {
            var pattern = new RegExp("^/" + language + "/");
            try {
                var url = new URL(href, window.location.origin);
                var pathname = url.pathname;
                return pattern.test(pathname);
            } catch (e) {
                if (href.indexOf("/") === 0) return pattern.test(href);
                return false;
            }
        }
        $(".custom-lang-dropdown .dropdown-toggle").on("click", (function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $dropdown = $(this).closest(".custom-lang-dropdown");
            var $menu = $dropdown.find(".dropdown-menu");
            var $arrow = $dropdown.find(".arrow-icon");
            $(".custom-lang-dropdown .dropdown-menu").not($menu).addClass("hidden");
            $(".custom-lang-dropdown .arrow-icon").not($arrow).removeClass("rotate-180");
            $menu.toggleClass("hidden");
            $arrow.toggleClass("rotate-180");
        }));
        $(document).on("click", (function(e) {
            if (!$(e.target).closest(".custom-lang-dropdown").length) {
                $(".custom-lang-dropdown .dropdown-menu").addClass("hidden");
                $(".custom-lang-dropdown .arrow-icon").removeClass("rotate-180");
            }
        }));
    }));
    spollers();
})();