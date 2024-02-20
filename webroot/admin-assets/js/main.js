/**
 * Main scripts file
 */
(function ($) {
    "use strict";
    /* Define some variables */
    var app = $(".app"),
        searchState = false,
        menuState = false;

    function toggleMenu() {
        if (menuState) {
            app.removeClass("move-left move-right");
            setTimeout(function () {
                app.removeClass("offscreen");
            }, 150);
        } else {
            app.addClass("offscreen move-right");
        }
        menuState = !menuState;
    }

    /******** Open messages ********/
    $("[data-toggle=message]").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        app.toggleClass("message-open");
    });

    /******** Open contact ********/
    $("[data-toggle=contact]").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        app.toggleClass("contact-open");
    });

    /******** Toggle expanding menu ********/
    $("[data-toggle=expanding]").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        app.toggleClass("expanding");
    });

    /******** Card collapse control ********/
    $("[data-toggle=card-collapse]").on("click", function (e) {
        var parent = $(this).parents(".card"),
            body = parent.children(".card-block");
        if (body.is(":visible")) {
            parent.addClass("card-collapsed");
            body.slideUp(200);
        } else if (!body.is(":visible")) {
            parent.removeClass("card-collapsed");
            body.slideDown(200);
        }
        e.preventDefault();
        e.stopPropagation();
    });

    /******** Card refresh control ********/
    $("[data-toggle=card-refresh]").on("click", function (e) {
        var parent = $(this).parents(".card");
        parent.addClass("card-refreshing");
        window.setTimeout(function () {
            parent.removeClass("card-refreshing");
        }, 3000);
        e.preventDefault();
        e.stopPropagation();
    });

    /******** Card remove control ********/
    $("[data-toggle=card-remove]").on("click", function (e) {
        var parent = $(this).parents(".card");
        parent.addClass("animated zoomOut");
        parent.bind(
            "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
            function () {
                parent.remove();
            }
        );
        e.preventDefault();
        e.stopPropagation();
    });

    /******** Search form ********/
    $(".search-form .form-control")
        .focusout(function () {
            $(".header-inner").removeClass("search-focus");
            searchState = false;
        })
        .focusin(function () {
            $(".header-inner").addClass("search-focus");
            searchState = true;
        });

    /******** Sidebar toggle menu ********/
    $("[data-toggle=sidebar]").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });
    $(".main-panel").on("click", function (e) {
        var target = e.target;
        if (
            menuState &&
            target !== $("[data-toggle=sidebar]") &&
            !$(".header-secondary")
        ) {
            toggleMenu();
        }
    });

    /******** Sidebar menu ********/
    $(".sidebar-panel nav a").on("click", function (e) {
        var $this = $(this),
            links = $this.parents("li"),
            parentLink = $this.closest("li"),
            otherLinks = $(".sidebar-panel nav li").not(links),
            subMenu = $this.next();
        if (!subMenu.hasClass("sub-menu")) {
            toggleMenu();
            return;
        }
        otherLinks.removeClass("open");
        if (subMenu.is("ul") && subMenu.height() === 0) {
            parentLink.addClass("open");
        } else if (subMenu.is("ul") && subMenu.height() !== 0) {
            parentLink.removeClass("open");
        }
        if (subMenu.is("ul")) {
            return;
        }
        e.stopPropagation();
        return;
    });
    $(".sidebar-panel")
        .find("> li > .sub-menu")
        .each(function () {
            if ($(this).find("ul.sub-menu").length > 0) {
                $(this).addClass("multi-level");
            }
        });

    /******** Forms ********/

    /******** Select 2 plugin ********/
    window.initSelect2 = function () {
        $(".select2").select2({ language: "es" });
        $("select:not(.default-select):not(.select2)").selectize(/*{
    create: false,
    sortField: false
  }*/);
    };
    window.initSelect2();

    /** Modals */
    window.modalDialog = function (url) {
        if (url == undefined) {
            return;
        }
        if (url.indexOf("#") == 0) {
            $(url).modal();
        } else {
            var id = "modal-" + Math.floor(Math.random() * 1000000);
            $.get(url, function (data) {
                $(
                    '<div id="' +
                        id +
                        '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content">' +
                        data +
                        "</div></div></div>"
                )
                    .modal()
                    .on("shown.bs.modal", function () {
                        window.initSelect2();
                    })
                    .on("hidden.bs.modal", function () {
                        $("#" + id).remove();
                    });
            }).success(function () {
                $("input:text:visible:first").focus();
            });
        }
    };
    window.initModal = (function (s) {
        var selector = '[data-toggle="modal"]';
        if (typeof s == "string") {
            selector = s + " " + selector;
        }
        $(selector).click(function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            modalDialog(url);
        });
    })();

    // enter instead tab
    $("body").on("keydown", "input, select, textarea", function (e) {
        var self = $(this),
            form = self.parents("form:eq(0)"),
            focusable,
            next;
        if (e.keyCode == 13) {
            var currentTabindex = self.attr("tabindex");
            if (currentTabindex) {
                focusable = form
                    .find("input,a,select,button,textarea")
                    .filter(":visible")
                    .filter(
                        '[tabindex^="' + (parseInt(currentTabindex) + 1) + '"]'
                    );
                next = focusable.eq(focusable.index(this) + 1);
            } else {
                focusable = form
                    .find("input,a,select,button,textarea")
                    .filter(":visible");
                next = focusable.eq(focusable.index(this) + 1);
            }
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });
    // Bootstrap table
    // setTimeout(function () {
    //     $(".bootstrap-table").each(function () {
    //         $(this).bootstrapTable({
    //             height: undefined,
    //         });
    //         // console.log($(this).height());
    //     });
    // }, 0);
})(jQuery);

function message(msg, type, position) {
    noty({
        theme: "app-noty",
        text: msg,
        type: type,
        timeout: 100000,
        layout: position,
        closeWith: ["button", "click"],
        animation: {
            open: "animated fadeInDown", // Animate.css class names
            close: "animated fadeOutUp", // Animate.css class names
        },
    });
}

function tableToExcel(selector) {
    $(selector).table2excel({
        exclude: ".no-xls",
        name: "Exportación",
        filename: "descuentos",
    });
}
