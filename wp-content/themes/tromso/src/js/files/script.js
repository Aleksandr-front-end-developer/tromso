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

    var currentDomain = window.location.hostname;
    var currentPath = window.location.pathname;

    // Обработка кликов
    $("a[href]")
      .not(".no-track")
      .on("click", function (e) {
        var $link = $(this);
        var href = $link.attr("href");

        // пропускаем, если текущий язык дефолтный
        if (languageData.current_language == languageData.default_language) {
          return;
        }

        // Пропускаем специальные ссылки
        if (!href || href.indexOf("javascript:") === 0 || href.indexOf("mailto:") === 0 || href.indexOf("tel:") === 0) {
          return;
        }

        // ✅ ЯКОРИ НА ТЕКУЩЕЙ СТРАНИЦЕ - ПРОПУСКАЕМ
        // Если ссылка начинается с # - это якорь на этой же странице
        if (href.indexOf("#") === 0) {
          return; // Ничего не делаем, стандартное поведение
        }

        // Проверяем, не внешняя ли ссылка
        if (isExternalLink(href, currentDomain)) {
          return; // Внешние ссылки пропускаем
        }

        // Проверяем, ведёт ли ссылка на текущую страницу (с якорем)
        if (isSamePageWithAnchor(href, currentPath, currentDomain)) {
          return; // Это ссылка на текущую страницу с якорем - пропускаем
        }

        // пропускаем ссылки, которые уже содержат правильный языковой префикс
        if (hasLanguagePrefix(href, languageData.current_language)) {
          return; // Ссылка уже с правильным языком - пропускаем
        }

        // ✅ ТОЛЬКО ДЛЯ ССЫЛОК НА ДРУГИЕ СТРАНИЦЫ
        e.preventDefault();

        var params = {
          //check_for_language: "1",
          //current_language: languageData.current_language,
        };

        var absoluteUrl = $link.prop("href");
        var newUrl = addParamsToUrl(absoluteUrl, params);

        // Если в ссылке был якорь - сохраняем его
        if (href.indexOf("#") !== -1) {
          var anchor = href.split("#")[1];
          if (anchor) {
            newUrl = newUrl.split("#")[0] + "#" + anchor;
          }
        }

        window.location.href = newUrl;
      });

    // ФУНКЦИЯ ПРОВЕРКИ ВНЕШНЕЙ ССЫЛКИ
    function isExternalLink(href, currentDomain) {
      // Относительные ссылки - не внешние
      if (href.indexOf("/") === 0) {
        return false;
      }

      // Если нет протокола - относительная
      if (href.indexOf("http") !== 0 && href.indexOf("//") !== 0) {
        return false;
      }

      try {
        var linkDomain = new URL(href, window.location.origin).hostname;
        return linkDomain.replace(/^www\./, "") !== currentDomain.replace(/^www\./, "");
      } catch (e) {
        return true;
      }
    }

    // ФУНКЦИЯ ПРОВЕРКИ - ССЫЛКА НА ЭТУ ЖЕ СТРАНИЦУ С ЯКОРЕМ
    function isSamePageWithAnchor(href, currentPath, currentDomain) {
      // Если в ссылке нет якоря - это не наш случай
      if (href.indexOf("#") === -1) {
        return false;
      }

      try {
        // Создаём объект URL для анализа
        var url = new URL(href, window.location.origin);
        var linkPath = url.pathname;
        var linkDomain = url.hostname;

        // Проверяем: совпадает ли домен и путь с текущей страницей
        var isSameDomain = linkDomain.replace(/^www\./, "") === currentDomain.replace(/^www\./, "");
        var isSamePath = linkPath === currentPath || linkPath === "" || linkPath === "/";

        return isSameDomain && isSamePath;
      } catch (e) {
        // Если не удалось распарсить URL, используем простую проверку
        // Для относительных ссылок
        if (href.indexOf("/") === 0) {
          var pathWithoutAnchor = href.split("#")[0];
          return pathWithoutAnchor === currentPath || pathWithoutAnchor === "" || pathWithoutAnchor === "/";
        }
        return false;
      }
    }

    // ФУНКЦИЯ ДОБАВЛЕНИЯ ПАРАМЕТРОВ
    function addParamsToUrl(url, params) {
      try {
        var urlObj = new URL(url);
        $.each(params, function (key, value) {
          urlObj.searchParams.set(key, value);
        });
        return urlObj.toString();
      } catch (e) {
        // Fallback
        var separator = url.indexOf("?") !== -1 ? "&" : "?";
        var paramString = $.map(params, function (value, key) {
          return key + "=" + encodeURIComponent(value);
        }).join("&");
        return url + separator + paramString;
      }
    }

    // ✅ НОВАЯ ФУНКЦИЯ: Проверка наличия языкового префикса в ссылке
    function hasLanguagePrefix(href, language) {
      var pattern = new RegExp("^/" + language + "/");

      try {
        // Создаём объект URL для анализа
        var url = new URL(href, window.location.origin);
        var pathname = url.pathname;

        // Проверяем, начинается ли путь с /{language}/
        return pattern.test(pathname);
      } catch (e) {
        // Если не удалось распарсить URL, проверяем как строку
        // Для относительных ссылок
        if (href.indexOf("/") === 0) {
          return pattern.test(href);
        }
        return false;
      }
    }

    //================= селект для переключения языка polylang ===============
    $(".polylang-flags").each(function () {
      const $this = $(this);

      // обгортаємо
      $this.wrap('<div class="select-custom"></div>');

      // вставляємо кастомний селект
      $this.before(`
    <div class="select-styled">
      <span class="select-text"></span>
      <svg class="arrow-icon" viewBox="0 0 20 20" fill="currentColor">
        <path d="M5 7l5 5 5-5H5z"/>
      </svg>
    </div>
  `);

      const $styledSelect = $this.prev(".select-styled");
      const $text = $styledSelect.find(".select-text");

      $text.text($this.find("li.current-lang").text());

      $styledSelect.on("click", function (e) {
        e.stopPropagation();

        $(".select-styled.active").not(this).removeClass("active").next(".polylang-flags").removeClass("open");

        $(this).toggleClass("active");
        $this.toggleClass("open");
      });

      $this.find("li").on("click", function (e) {
        e.stopPropagation();

        $text.text($(this).text());

        $styledSelect.removeClass("active");
        $this.removeClass("open");
      });

      $(document).on("click", function () {
        $styledSelect.removeClass("active");
        $this.removeClass("open");
      });
    });

    //================= END JQUERY ===============
  });
}
