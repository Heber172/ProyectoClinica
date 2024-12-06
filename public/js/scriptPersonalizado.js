$(document).ready(function () {
    /**
     * Muestra o esconde menú de cabecera
     **/
    function toggleDropdown($dropdown) {
        if ($dropdown.hasClass("show")) {
            $dropdown.removeClass("show");
            $dropdown.removeAttr("data-bs-popper");
        } else {
            $(".dropdown-menu.show").removeClass("show");
            $(".dropdown-menu.show").removeAttr("data-bs-popper");
            $dropdown.addClass("show");
            $dropdown.attr("data-bs-popper", "static");
        }
    }
    // Sucursales
    $("body").on("click", ".dropdown-shortcuts .dropdown-toggle", function (e) {
        e.stopPropagation();
        var $dropdown = $(this).next(".dropdown-menu");
        toggleDropdown($dropdown);
    });
    // Notificaciones
    $("body").on("click", ".dropdown-notifications .dropdown-toggle", function (e) {
        e.stopPropagation();
        var $dropdown = $(this).next(".dropdown-menu");
        toggleDropdown($dropdown);
    });
    // Usuario
    $("body").on("click", ".dropdown-user .dropdown-toggle", function (e) {
        e.stopPropagation();
        var $dropdown = $(this).next(".dropdown-menu");
        toggleDropdown($dropdown);
    });
    /**
     * En caso de seleccionar cualquier otra AREA, muestra o esconde menú de cabecera
     **/
    $(document).on("click", function (e) {
        if (!$(".dropdown-toggle").is(e.target) && $(".dropdown-menu.show").has(e.target).length === 0) {
            $(".dropdown-menu.show").removeClass("show");
            $(".dropdown-menu.show").removeAttr("data-bs-popper");
        }
    });
});