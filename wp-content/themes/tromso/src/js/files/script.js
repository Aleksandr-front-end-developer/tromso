if ("undefined" !== typeof jQuery) {
  jQuery(function ($) {
    //================= START JQUERY ===============

    // Стани (аналог useState)
    let isOpen = false;
    let isScrolled = false;
    let showToursDropdown = false;

    // Обробник скролу (аналог useEffect)
    $(window).on("scroll", function () {
      isScrolled = $(window).scrollTop() > 50;
      $("header").toggleClass("scrolled", isScrolled);
    });

    // Функція скролу до верху
    function scrollToTop() {
      $("html, body").animate({ scrollTop: 0 }, 300);
      isOpen = false;
      $(".mobile-menu").hide();
      $("header").removeClass("menu-open");
    }

    // Функція скролу до секції
    function scrollToSection(id) {
      const element = $("#" + id);
      if (element.length) {
        const offset = 80;
        const elementPosition = element.offset().top - offset;

        $("html, body").animate(
          {
            scrollTop: elementPosition,
          },
          300,
        );
      }
      isOpen = false;
      showToursDropdown = false;
      $(".mobile-menu").hide();
      $(".tours-dropdown").hide();
      $("header").removeClass("menu-open");
    }

    // Перемикач мобільного меню
    $(".mobile-toggle").on("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      isOpen = !isOpen;
      $(".mobile-menu").toggle(isOpen);
      $("header").toggleClass("menu-open", isOpen);
    });

    // Ховер для десктопного dropdown
    $(".tours-trigger").on("mouseenter", function () {
      showToursDropdown = true;
      $(".tours-dropdown").show();
    });

    $(".tours-trigger, .tours-dropdown").on("mouseleave", function () {
      // Додаємо невелику затримку для кращого UX
      setTimeout(() => {
        if (!$(".tours-trigger").is(":hover") && !$(".tours-dropdown").is(":hover")) {
          showToursDropdown = false;
          $(".tours-dropdown").hide();
        }
      }, 100);
    });

    // Кліки по пунктах меню туров
    $(".tour-item").on("click", function (e) {
      e.preventDefault();
      const sectionId = $(this).data("section");
      handleTourClick(sectionId);
    });

    // Кліки по мобільних пунктах меню
    $(".mobile-tour-item").on("click", function (e) {
      e.preventDefault();
      const sectionId = $(this).data("section");
      handleTourClick(sectionId);
    });

    // Закриття меню при кліку на посилання
    $(".nav-link").on("click", function (e) {
      // Дозволяємо стандартну поведінку для посилань
      if ($(this).attr("href") && $(this).attr("href").startsWith("#")) {
        e.preventDefault();
        const targetId = $(this).attr("href").substring(1);
        scrollToSection(targetId);
      }

      isOpen = false;
      $(".mobile-menu").hide();
      $("header").removeClass("menu-open");
    });

    // Закриття меню при кліку поза ним
    $(document).on("click", function (e) {
      if (!$(e.target).closest("header, .mobile-toggle").length) {
        isOpen = false;
        $(".mobile-menu").hide();
        $("header").removeClass("menu-open");
      }
    });

    // Функція для обробки кліку по туру
    function handleTourClick(sectionId) {
      const currentPage = window.location.pathname;
      const isHomePage = currentPage === "/" || currentPage === "/index.html" || currentPage.endsWith("/") || currentPage === "";

      if (!isHomePage) {
        // Якщо не головна сторінка - переходимо на головну з хешем
        window.location.href = "/" + "#" + sectionId;
      } else {
        // Якщо головна сторінка - скролимо до секції
        scrollToSection(sectionId);

        // Оновлюємо URL без перезавантаження сторінки
        if (history.pushState) {
          history.pushState(null, null, "#" + sectionId);
        } else {
          window.location.hash = "#" + sectionId;
        }
      }
    }

    // Обробка завантаження сторінки з хешем
    $(document).ready(function () {
      if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        setTimeout(() => {
          scrollToSection(hash);
        }, 100);
      }
    });

    //================= END JQUERY ===============
  });
}
