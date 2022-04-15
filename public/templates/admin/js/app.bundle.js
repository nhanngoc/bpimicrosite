var myapp_config = {
    VERSION: "4.5.1",
    root_: $("body"),
    root_logo: $(".page-sidebar > .page-logo"),
    throttleDelay: 450,
    filterDelay: 150,
    thisDevice: null,
    isMobile: /iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()),
    mobileMenuTrigger: null,
    mobileResolutionTrigger: 992,
    isWebkit: !0 == (!!window.chrome && !!window.chrome.webstore) || 0 < Object.prototype.toString.call(window.HTMLElement).indexOf("Constructor") == !0,
    isChrome: /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()),
    isIE: 0 < window.navigator.userAgent.indexOf("Trident/") == !0,
    debugState: !0,
    rippleEffect: !0,
    mythemeAnchor: "#mytheme",
    activateLastTab: !0,
    navAnchor: $("#js-primary-nav"),
    navHooks: $("#js-nav-menu"),
    navAccordion: !0,
    navInitalized: "js-nav-built",
    navFilterInput: $("#nav_filter_input"),
    navHorizontalWrapperId: "js-nav-menu-wrapper",
    navSpeed: 500,
    mythemeColorProfileID: $("#js-color-profile"),
    navClosedSign: "fal fa-angle-down",
    navOpenedSign: "fal fa-angle-up",
    appIconPrefix: "fal",
    appDateHook: $(".js-get-date"),
    storeLocally: !0,
    jsArray: []
};
!function (i) {
    i.fn.extend({
        navigation: function (e) {
            var n = i.extend({
                accordion: !0,
                animate: "easeOutExpo",
                speed: 200,
                closedSign: "[+]",
                openedSign: "[-]",
                initClass: "js-nav-built"
            }, e), o = i(this);
            o.hasClass(n.initClass) ? myapp_config.debugState && console.log(o.get(0) + " this menu already exists") : (o.addClass(n.initClass), o.find("li").each(function () {
                0 !== i(this).find("ul").length && (i(this).find("a:first").append("<b class='collapse-sign'>" + n.closedSign + "</b>"), "#" == i(this).find("a:first").attr("href") && i(this).find("a:first").click(function () {
                    return !1
                }))
            }), o.find("li.active").each(function () {
                i(this).parents("ul").parent("li").find("a:first").attr("aria-expanded", !0).find("b:first").html(n.openedSign)
            }), o.find("li a").on("mousedown", function (e) {
                0 !== i(this).parent().find("ul").length && (n.accordion && (i(this).parent().find("ul").is(":visible") || (parents = i(this).parent().parents("ul"), visible = o.find("ul:visible"), visible.each(function (o) {
                    var t = !0;
                    parents.each(function (e) {
                        if (parents[e] == visible[o]) return t = !1
                    }), t && i(this).parent().find("ul") != visible[o] && i(visible[o]).slideUp(n.speed + 300, n.animate, function () {
                        i(this).parent("li").removeClass("open").find("a:first").attr("aria-expanded", !1).find("b:first").html(n.closedSign), myapp_config.debugState && console.log("nav item closed")
                    })
                }))), i(this).parent().find("ul:first").is(":visible") && !i(this).parent().find("ul:first").hasClass("active") ? i(this).parent().find("ul:first").slideUp(n.speed + 100, n.animate, function () {
                    i(this).parent("li").removeClass("open").find("a:first").attr("aria-expanded", !1).find("b:first").delay(n.speed).html(n.closedSign), myapp_config.debugState && console.log("nav item closed")
                }) : i(this).parent().find("ul:first").slideDown(n.speed, n.animate, function () {
                    i(this).parent("li").addClass("open").find("a:first").attr("aria-expanded", !0).find("b:first").delay(n.speed).html(n.openedSign), myapp_config.debugState && console.log("nav item opened")
                }))
            }))
        }, navigationDestroy: function () {
            self = i(this), self.hasClass(myapp_config.navInitalized) ? (self.find("li").removeClass("active open"), self.find("li a").off("mousedown").removeClass("active").removeAttr("aria-expanded").find(".collapse-sign").remove(), self.removeClass(myapp_config.navInitalized).find("ul").removeAttr("style"), myapp_config.debugState && console.log(self.get(0) + " destroyed")) : console.log("menu does not exist")
        }
    })
}(jQuery, (window, document)), function (p) {
    var f = "menuSlider";

    function i(e, t) {
        var o, n, i, a, s = p(e), r = e;

        function l(e) {
            void 0 !== t[e] && t[e].call(r)
        }

        function c() {
            o = p("#" + t.wrapperId).outerWidth(), i = p.map(s.children("li:not(.nav-title)"), function (e) {
                return p(e).outerWidth(!0)
            }).reduce(function (e, o) {
                return e + o
            }, 0), n = parseFloat(s.css("margin-left"))
        }

        return t = p.extend({}, p.fn[f].defaults, t), s.css("margin-left", "0px"), s.wrap('<div id="' + t.wrapperId + '" class="nav-menu-wrapper d-flex flex-grow-1 width-0 overflow-hidden"></div>'), p("#" + t.wrapperId).before('<a href="#" id="' + t.wrapperId + '-left-btn" class="d-flex align-items-center justify-content-center width-4 btn mt-1 mb-1 mr-2 ml-1 p-0 fs-xxl text-primary"><i class="fal fa-angle-left"></i></a>'), p("#" + t.wrapperId).after('<a href="#" id="' + t.wrapperId + '-right-btn" class="d-flex align-items-center justify-content-center width-4 btn mt-1 mb-1 mr-1 ml-2 p-0 fs-xxl text-primary"><i class="fal fa-angle-right"></i></a>'), p.map(s.children("li:not(.nav-title)"), function (e) {
            return p(e).outerWidth(!0)
        }), p("#" + t.wrapperId + "-left-btn").click(function (e) {
            c(), n < 0 ? a = Math.min(n + o, 0) : (a = n, console.log("left end")), s.css({marginLeft: a}), e.preventDefault()
        }), p("#" + t.wrapperId + "-right-btn").click(function (e) {
            c(), -n + o < i ? a = Math.max(n - o, -(i - o)) : (a = n, console.log("right end")), s.css({marginLeft: a}), e.preventDefault()
        }), l("onInit"), {
            option: function (e, o) {
                if (!o) return t[e];
                t[e] = o
            }, destroy: function (e) {
                s.each(function () {
                    var e = p(this);
                    e.css("margin-left", "0px"), e.unwrap(parent), e.prev().off().remove(), e.next().off().remove(), l("onDestroy"), e.removeData("plugin_" + f)
                })
            }
        }
    }

    p.fn[f] = function (e) {
        if ("string" == typeof e) {
            var o, t = e, n = Array.prototype.slice.call(arguments, 1);
            return this.each(function () {
                if (!p.data(this, "plugin_" + f) || "function" != typeof p.data(this, "plugin_" + f)[t]) throw new Error("Method " + t + " does not exist on jQuery." + f);
                o = p.data(this, "plugin_" + f)[t].apply(this, n)
            }), void 0 !== o ? o : this
        }
        if ("object" == typeof e || !e) return this.each(function () {
            p.data(this, "plugin_" + f) || p.data(this, "plugin_" + f, new i(this, e))
        })
    }, p.fn[f].defaults = {
        onInit: function () {
        }, onDestroy: function () {
        }, element: myapp_config.navHooks, wrapperId: myapp_config.navHorizontalWrapperId
    }
}(jQuery);
var initApp = function (e) {
    return e.listFilter = function (t, e, o) {
        o ? $(o).addClass("js-list-filter") : $(t).addClass("js-list-filter"), $(e).change(function () {
            var e = $(this).val().toLowerCase(), o = $(t).next().filter(".js-filter-message");
            return 1 < e.length ? ($(t).find($("[data-filter-tags]:not([data-filter-tags*='" + e + "'])")).parentsUntil(t).removeClass("js-filter-show").addClass("js-filter-hide"), $(t).find($("[data-filter-tags*='" + e + "']")).parentsUntil(t).removeClass("js-filter-hide").addClass("js-filter-show"), o && o.text("showing " + $(t).find("li.js-filter-show").length + " from " + $(t).find("[data-filter-tags]").length + " total")) : ($(t).find("[data-filter-tags]").parentsUntil(t).removeClass("js-filter-hide js-filter-show"), o && o.text("")), !1
        }).keyup($.debounce(myapp_config.filterDelay, function (e) {
            $(this).change()
        }))
    }, e.loadScript = function (e, o) {
        var t, n, i;
        myapp_config.jsArray[e] ? myapp_config.debugState && console.log("This script was already loaded: " + e) : (t = jQuery.Deferred(), n = document.getElementsByTagName("body")[0], (i = document.createElement("script")).type = "text/javascript", i.src = e, i.onload = function () {
            t.resolve()
        }, n.appendChild(i), myapp_config.jsArray[e] = t.promise()), myapp_config.jsArray[e].then(function () {
            "function" == typeof o && o()
        })
    }, e.saveSettings = function () {
        "undefined" != typeof saveSettings && $.isFunction(saveSettings) && myapp_config.storeLocally ? (initApp.accessIndicator(), saveSettings(), myapp_config.debugState && console.log("Theme settings: \n" + localStorage.getItem("themeSettings"))) : console.log("save function does not exist")
    }, e.updateTheme = function (e, o) {
        $(myapp_config.mythemeAnchor).length ? $(myapp_config.mythemeAnchor).attr("href", e) : $("head").append($("<link>", {
            id: myapp_config.mythemeAnchor.replace("#", ""),
            rel: "stylesheet",
            href: e
        })), null != o && initApp.saveSettings()
    }, e.resetSettings = function () {
        myapp_config.root_.removeClass(function (e, o) {
            return (o.match(/(^|\s)(nav-|header-|footer-|mod-|display-)\S+/g) || []).join(" ")
        }), $(myapp_config.mythemeAnchor).attr("href", ""), initApp.checkNavigationOrientation(), initApp.saveSettings(), myapp_config.debugState && console.log("App reset successful")
    }, e.factoryReset = function () {
        initApp.playSound("media/sound", "messagebox"), $(".js-modal-settings").modal("hide"), "undefined" != typeof bootbox ? bootbox.confirm({
            title: "<i class='" + myapp_config.appIconPrefix + " fa-exclamation-triangle text-warning mr-2'></i> You are about to reset all of your localStorage settings",
            message: "<span><strong>Warning:</strong> This action is not reversable. You will lose all your layout settings.</span>",
            centerVertical: !0,
            swapButtonOrder: !0,
            buttons: {
                confirm: {label: "Factory Reset", className: "btn-warning shadow-0"},
                cancel: {label: "Cancel", className: "btn-success"}
            },
            className: "modal-alert",
            closeButton: !1,
            callback: function (e) {
                1 == e && (localStorage.clear(), initApp.resetSettings(), location.reload())
            }
        }) : confirm("You are about to reset all of your localStorage to null state. Do you wish to continue?") && (localStorage.clear(), initApp.resetSettings(), location.reload()), myapp_config.debugState && console.log("App reset successful")
    }, e.accessIndicator = function () {
        myapp_config.root_.addClass("saving").delay(600).queue(function () {
            return $(this).removeClass("saving").dequeue(), !0
        })
    }, e.pushSettings = function (e, o) {
        return 0 != o && localStorage.setItem("themeSettings", ""), myapp_config.root_.addClass(e), initApp.checkNavigationOrientation(), 0 != o && initApp.saveSettings(), e
    }, e.removeSettings = function (e) {
        var o;
        null != e ? (o = initApp.getSettings().replace(e, ""), myapp_config.root_.removeClass(function (e, o) {
            return (o.match(/(^|\s)(nav-|header-|footer-|mod-|display-)\S+/g) || []).join(" ")
        }), initApp.pushSettings(o)) : console.log("ERROR: You must specify the class you need to remove")
    }, e.getSettings = function () {
        return myapp_config.root_.attr("class").split(/[^\w-]+/).filter(function (e) {
            return /^(nav|header|footer|mod|display)-/i.test(e)
        }).join(" ")
    }, e.playSound = function (e, o) {
        var t = document.createElement("audio");
        navigator.userAgent.match("Firefox/") ? t.setAttribute("src", e + "/" + o + ".ogg") : t.setAttribute("src", e + "/" + o + ".mp3"), t.addEventListener("load", function () {
            t.play()
        }, !0), t.pause(), t.play()
    }, e.detectBrowserType = function () {
        return myapp_config.isChrome ? (myapp_config.root_.addClass("chrome webkit"), "chrome webkit") : myapp_config.isWebkit ? (myapp_config.root_.addClass("webkit"), "webkit") : myapp_config.isIE ? (myapp_config.root_.addClass("ie"), "ie") : void 0
    }, e.addDeviceType = function () {
        return myapp_config.isMobile ? (myapp_config.root_.addClass("mobile"), myapp_config.thisDevice = "mobile") : (myapp_config.root_.addClass("desktop"), myapp_config.thisDevice = "desktop"), myapp_config.thisDevice
    }, e.windowScrollEvents = function () {
        myapp_config.root_.is(".nav-function-hidden.header-function-fixed:not(.nav-function-top)") && "desktop" === myapp_config.thisDevice ? myapp_config.root_logo.css({top: $(window).scrollTop()}) : myapp_config.root_.is(".header-function-fixed:not(.nav-function-top):not(.nav-function-hidden)") && "desktop" === myapp_config.thisDevice && myapp_config.root_logo.attr("style", "")
    }, e.checkNavigationOrientation = function () {
        switch (!0) {
            case myapp_config.root_.hasClass("nav-function-fixed") && !myapp_config.root_.is(".nav-function-top, .nav-function-minify, .mod-main-boxed") && "desktop" === myapp_config.thisDevice:
                void 0 !== $.fn.slimScroll ? (myapp_config.navAnchor.slimScroll({
                    height: "100%",
                    color: "#fff",
                    size: "4px",
                    distance: "4px",
                    railOpacity: .4,
                    wheelStep: 10
                }), document.getElementById(myapp_config.navHorizontalWrapperId) && (myapp_config.navHooks.menuSlider("destroy"), myapp_config.debugState && console.log("----top controls destroyed")), myapp_config.debugState && console.log("slimScroll created")) : console.log("$.fn.slimScroll...NOT FOUND");
                break;
            case myapp_config.navAnchor.parent().hasClass("slimScrollDiv") && "desktop" === myapp_config.thisDevice && void 0 !== $.fn.slimScroll:
                myapp_config.navAnchor.slimScroll({destroy: !0}), myapp_config.navAnchor.attr("style", ""), events = jQuery._data(myapp_config.navAnchor[0], "events"), events && jQuery._removeData(myapp_config.navAnchor[0], "events"), myapp_config.debugState && console.log("slimScroll destroyed")
        }
        switch (!0) {
            case $.fn.menuSlider && myapp_config.root_.hasClass("nav-function-top") && 0 == $("#js-nav-menu-wrapper").length && !myapp_config.root_.hasClass("mobile-view-activated"):
                myapp_config.navHooks.menuSlider({
                    element: myapp_config.navHooks,
                    wrapperId: myapp_config.navHorizontalWrapperId
                }), myapp_config.debugState && console.log("----top controls created -- case 1");
                break;
            case myapp_config.root_.hasClass("nav-function-top") && 1 == $("#js-nav-menu-wrapper").length && myapp_config.root_.hasClass("mobile-view-activated"):
                myapp_config.navHooks.menuSlider("destroy"), myapp_config.debugState && console.log("----top controls destroyed -- case 2");
                break;
            case!myapp_config.root_.hasClass("nav-function-top") && 1 == $("#js-nav-menu-wrapper").length:
                myapp_config.navHooks.menuSlider("destroy"), myapp_config.debugState && console.log("----top controls destroyed -- case 3")
        }
    }, e.buildNavigation = function (e) {
        if ($.fn.navigation) return $(e).navigation({
            accordion: myapp_config.navAccordion,
            speed: myapp_config.navSpeed,
            closedSign: '<em class="' + myapp_config.navClosedSign + '"></em>',
            openedSign: '<em class="' + myapp_config.navOpenedSign + '"></em>',
            initClass: myapp_config.navInitalized
        }), e;
        myapp_config.debugState && console.log("WARN: navigation plugin missing")
    }, e.destroyNavigation = function (e) {
        if ($.fn.navigation) return $(e).navigationDestroy(), e;
        myapp_config.debugState && console.log("WARN: navigation plugin missing")
    }, e.appForms = function (t, n, e) {
        $(t).each(function () {
            var e = $(this).find(".form-control");
            e.on("focus", function () {
                var e, o;
                e = t, o = n, $(this).parents(e).addClass(o)
            }), e.on("blur", function () {
                var e, o;
                e = t, o = n, $(this).parents(e).removeClass(o)
            })
        })
    }, e.mobileCheckActivation = function () {
        return window.innerWidth < myapp_config.mobileResolutionTrigger ? (myapp_config.root_.addClass("mobile-view-activated"), myapp_config.mobileMenuTrigger = !0) : (myapp_config.root_.removeClass("mobile-view-activated"), myapp_config.mobileMenuTrigger = !1), myapp_config.debugState && console.log("mobileCheckActivation on " + $(window).width() + " | activated: " + myapp_config.mobileMenuTrigger), myapp_config.mobileMenuTrigger
    }, e.toggleVisibility = function (e) {
        var o = document.getElementById(e);
        "block" == o.style.display ? o.style.display = "none" : o.style.display = "block"
    }, e.domReadyMisc = function () {
        var e, o, t, n, i, a;
        $(".custom-file input").change(function (e) {
            for (var o = [], t = 0; t < $(this)[0].files.length; t++) o.push($(this)[0].files[t].name);
            $(this).next(".custom-file-label").html(o.join(", "))
        }), $(".modal-backdrop-transparent").on("show.bs.modal", function (e) {
            setTimeout(function () {
                $(".modal-backdrop").addClass("modal-backdrop-transparent")
            })
        }), myapp_config.appDateHook.length && (o = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][(e = new Date).getDay()] + ", " + ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][e.getMonth()] + " " + e.getDate() + ", " + e.getFullYear(), myapp_config.appDateHook.text(o)), initApp.checkNavigationOrientation(), myapp_config.activateLastTab && (t = localStorage.getItem("lastTab"), $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            localStorage.setItem("lastTab", $(this).attr("href"))
        }), t && $('[href="' + t + '"]').tab("show")), void 0 !== $.fn.slimScroll && "desktop" === myapp_config.thisDevice ? ($(".custom-scroll:not(.disable-slimscroll) >:first-child").slimscroll({
            height: $(this).data("scrollHeight") || "100%",
            size: $(this).data("scrollSize") || "4px",
            position: $(this).data("scrollPosition") || "right",
            color: $(this).data("scrollColor") || "rgba(0,0,0,0.6)",
            alwaysVisible: $(this).data("scrollAlwaysVisible") || !1,
            distance: $(this).data("scrollDistance") || "4px",
            railVisible: $(this).data("scrollRailVisible") || !1,
            railColor: $(this).data("scrollRailColor") || "#fafafa",
            allowPageScroll: !1,
            disableFadeOut: !1
        }), myapp_config.debugState && console.log("%c✔ SlimScroll plugin active", "color: #148f32")) : (console.log("WARN! $.fn.slimScroll not loaded or user is on desktop"), myapp_config.root_.addClass("no-slimscroll")), void 0 !== initApp.listFilter && $.isFunction(initApp.listFilter) && $("[data-listfilter]").length && (n = $("[data-listfilter]").attr("id"), i = $("[data-listfilter]").attr("data-listfilter"), initApp.listFilter(i, "#" + n)), void 0 !== $.fn.tooltip && $('[data-toggle="tooltip"]').length ? $('[data-toggle="tooltip"]').tooltip() : console.log("OOPS! bs.tooltip is not loaded"), void 0 !== $.fn.popover && $('[data-toggle="popover"]').length && ($.fn.tooltip.Constructor.Default.whiteList, $('[data-toggle="popover"]').popover({sanitize: !1})), void 0 !== $.fn.dropdown ? Popper.Defaults.modifiers.computeStyle.gpuAcceleration = !1 : console.log("OOPS! bs.popover is not loaded"), $(document).on("click", ".dropdown-menu:not(.js-auto-close):not(.note-dropdown-menu)", function (e) {
            e.stopPropagation()
        }), window.Waves && myapp_config.rippleEffect ? (Waves.attach(".nav-menu:not(.js-waves-off) a, .btn:not(.js-waves-off):not(.btn-switch), .js-waves-on", ["waves-themed"]), Waves.init(), myapp_config.debugState && console.log("%c✔ Waves plugin active", "color: #148f32")) : myapp_config.debugState && console.log("%c✘ Waves plugin inactive! ", "color: #fd3995"), myapp_config.root_.on("click touchend", "[data-action]", function (e) {
            var o = $(this).data("action");
            switch (!0) {
                case"toggle" === o:
                    var t = $(this).attr("data-target") || myapp_config.root_, n = $(this).attr("data-class"),
                        i = $(this).attr("data-focus");
                    -1 !== n.indexOf("mod-bg-") && $(t).removeClass(function (e, o) {
                        return (o.match(/(^|\s)mod-bg-\S+/g) || []).join(" ")
                    }), $(t).toggleClass(n), $(this).hasClass("dropdown-item") && $(this).toggleClass("active"), null != i && setTimeout(function () {
                        $("#" + i).focus()
                    }, 200), "undefined" == typeof classHolder && null == classHolder || (initApp.checkNavigationOrientation(), initApp.saveSettings());
                    break;
                case"toggle-swap" === o:
                    t = $(this).attr("data-target"), n = $(this).attr("data-class");
                    $(t).removeClass().addClass(n), n.startsWith("root-text") && ($("[data-class]").removeClass("active"), $('[data-class="' + n + '"]').addClass("active"));
                    break;
                case"toggle-replace" === o:
                    var t = $(this).attr("data-target") || myapp_config.root_, a = $(this).attr("data-replaceclass");
                    n = $(this).attr("data-class") || "", savetoLocal = $(this).attr("data-savetolocal") || !0, $(t).removeClass(a).addClass(n), !0 === savetoLocal && initApp.saveSettings();
                    break;
                case"panel-collapse" === o:
                    (r = $(this).closest(".panel")).children(".panel-container").collapse("toggle").on("show.bs.collapse", function () {
                        r.removeClass("panel-collapsed"), myapp_config.debugState && console.log("panel id:" + r.attr("id") + " | action: uncollapsed")
                    }).on("hidden.bs.collapse", function () {
                        r.addClass("panel-collapsed"), myapp_config.debugState && console.log("panel id:" + r.attr("id") + " | action: collapsed")
                    });
                    break;
                case"panel-fullscreen" === o:
                    (r = $(this).closest(".panel")).toggleClass("panel-fullscreen"), myapp_config.root_.toggleClass("panel-fullscreen"), myapp_config.debugState && console.log("panel id:" + r.attr("id") + " | action: fullscreen");
                    break;
                case"panel-close" === o:

                function s() {
                    r.fadeOut(500, function () {
                        $(this).remove(), myapp_config.debugState && console.log("panel id:" + r.attr("id") + " | action: removed")
                    })
                }

                    var r = $(this).closest(".panel");
                    "undefined" != typeof bootbox ? (initApp.playSound("media/sound", "messagebox"), bootbox.confirm({
                        title: "<i class='" + myapp_config.appIconPrefix + " fa-times-circle text-danger mr-2'></i> Do you wish to delete panel <span class='fw-500'>&nbsp;'" + r.children(".panel-hdr").children("h2").text().trim() + "'&nbsp;</span>?",
                        message: "<span><strong>Warning:</strong> This action cannot be undone!</span>",
                        centerVertical: !0,
                        swapButtonOrder: !0,
                        buttons: {
                            confirm: {label: "Yes", className: "btn-danger shadow-0"},
                            cancel: {label: "No", className: "btn-default"}
                        },
                        className: "modal-alert",
                        closeButton: !1,
                        callback: function (e) {
                            1 == e && s()
                        }
                    })) : confirm("Do you wish to delete panel " + r.children(".panel-hdr").children("h2").text().trim() + "?") && s();
                    break;
                case"theme-update" === o:
                    initApp.updateTheme($(this).attr("data-theme"), $(this).attr("data-themesave"));
                    break;
                case"app-reset" === o:
                    initApp.resetSettings();
                    break;
                case"factory-reset" === o:
                    initApp.factoryReset();
                    break;
                case"app-print" === o:
                    window.print();
                    break;
                case"app-loadscript" === o:
                    var l = $(this).attr("data-loadurl"), c = $(this).attr("data-loadfunction");
                    initApp.loadScript(l, c);
                    break;
                case"lang" === o:
                    var p = $(this).attr("data-lang").toString();
                    $.i18n ? i18n.setLng(p, function () {
                        $("[data-i18n]").i18n(), $("[data-lang]").removeClass("active"), $(this).addClass("active")
                    }) : initApp.loadScript("js/i18n/i18n.js", function () {
                        $.i18n.init({
                            resGetPath: "media/data/__lng__.json",
                            load: "unspecific",
                            fallbackLng: !1,
                            lng: p
                        }, function (e) {
                            $("[data-i18n]").i18n(), $("[data-lang]").removeClass("active"), $('[data-lang="' + p + '"]').addClass("active")
                        })
                    });
                    break;
                case"app-fullscreen" === o:
                    document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement ? (document.exitFullscreen ? document.exitFullscreen() : document.msExitFullscreen ? document.msExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen(), myapp_config.debugState && console.log("%capp fullscreen toggle inactive! ", "color: #ed1c24")) : (document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.msRequestFullscreen ? document.documentElement.msRequestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT), myapp_config.debugState && console.log("app fullscreen toggle active"));
                    break;
                case"playsound" === o:
                    var f = $(this).attr("data-soundpath") || "media/sound/", d = $(this).attr("data-soundfile");
                    initApp.playSound(f, d)
            }
            $(this).tooltip("hide"), myapp_config.debugState && console.log("data-action clicked: " + o), e.stopPropagation(), e.preventDefault()
        }), navigator.userAgent.match(/IEMobile\/10\.0/) && ((a = document.createElement("style")).appendChild(document.createTextNode("@-ms-viewport{width:auto!important}")), document.head.appendChild(a)), myapp_config.debugState && console.log("%c✔ Finished app.init() v" + myapp_config.VERSION + "\n---------------------------", "color: #148f32")
    }, e
}({}), layouts = function (e) {
    return e.errorMessage = function (e) {
        console.log("('" + e + "') is not a valid entry, enter 'on' or 'off'")
    }, e.fixedHeader = function (e) {
        "on" === e ? initApp.pushSettings("header-function-fixed") : "off" === e ? initApp.removeSettings("header-function-fixed") : layouts.errorMessage(e)
    }, e.fixedNavigation = function (e) {
        "on" === e ? initApp.pushSettings("nav-function-fixed") : "off" === e ? initApp.removeSettings("nav-function-fixed") : layouts.errorMessage(e)
    }, e.minifyNavigation = function (e) {
        "on" === e ? initApp.pushSettings("nav-function-minify") : "off" === e ? initApp.removeSettings("nav-function-minify") : layouts.errorMessage(e)
    }, e.hideNavigation = function (e) {
        "on" === e ? initApp.pushSettings("nav-function-hidden") : "off" === e ? initApp.removeSettings("nav-function-hidden") : layouts.errorMessage(e)
    }, e.horizontalNavigation = function (e) {
        "on" === e ? initApp.pushSettings("nav-function-top") : "off" === e ? initApp.removeSettings("nav-function-top") : layouts.errorMessage(e)
    }, e.fixedFooter = function (e) {
        "on" === e ? initApp.pushSettings("footer-function-fixed") : "off" === e ? initApp.removeSettings("footer-function-fixed") : layouts.errorMessage(e)
    }, e.boxed = function (e) {
        "on" === e ? initApp.pushSettings("mod-main-boxed") : "off" === e ? initApp.removeSettings("mod-main-boxed") : layouts.errorMessage(e)
    }, e.pushContent = function (e) {
        "on" === e ? initApp.pushSettings("nav-mobile-push") : "off" === e ? initApp.removeSettings("nav-mobile-push") : layouts.errorMessage(e)
    }, e.overlay = function (e) {
        "on" === e ? initApp.pushSettings("nav-mobile-no-overlay") : "off" === e ? initApp.removeSettings("nav-mobile-no-overlay") : layouts.errorMessage(e)
    }, e.offCanvas = function (e) {
        "on" === e ? initApp.pushSettings("nav-mobile-slide-out") : "off" === e ? initApp.removeSettings("nav-mobile-slide-out") : layouts.errorMessage(e)
    }, e.bigFonts = function (e) {
        "on" === e ? initApp.pushSettings("mod-bigger-font") : "off" === e ? initApp.removeSettings("mod-bigger-font") : layouts.errorMessage(e)
    }, e.highContrast = function (e) {
        "on" === e ? initApp.pushSettings("mod-high-contrast") : "off" === e ? initApp.removeSettings("mod-high-contrast") : layouts.errorMessage(e)
    }, e.colorblind = function (e) {
        "on" === e ? initApp.pushSettings("mod-color-blind") : "off" === e ? initApp.removeSettings("mod-color-blind") : layouts.errorMessage(e)
    }, e.preloadInside = function (e) {
        "on" === e ? initApp.pushSettings("mod-pace-custom") : "off" === e ? initApp.removeSettings("mod-pace-custom") : layouts.errorMessage(e)
    }, e.panelIcons = function (e) {
        "on" === e ? initApp.pushSettings("mod-panel-icon") : "off" === e ? initApp.removeSettings("mod-panel-icon") : layouts.errorMessage(e)
    }, e.cleanBackground = function (e) {
        "on" === e ? initApp.pushSettings("mod-clean-page-bg") : "off" === e ? initApp.removeSettings("mod-clean-page-bg") : layouts.errorMessage(e)
    }, e.hideNavIcons = function (e) {
        "on" === e ? initApp.pushSettings("mod-hide-nav-icons") : "off" === e ? initApp.removeSettings("mod-hide-nav-icons") : layouts.errorMessage(e)
    }, e.noAnimation = function (e) {
        "on" === e ? initApp.pushSettings("mod-disable-animation") : "off" === e ? initApp.removeSettings("mod-disable-animation") : layouts.errorMessage(e)
    }, e.hideInfoCard = function (e) {
        "on" === e ? initApp.pushSettings("mod-hide-info-card") : "off" === e ? initApp.removeSettings("mod-hide-info-card") : layouts.errorMessage(e)
    }, e.leanSubheader = function (e) {
        "on" === e ? initApp.pushSettings("mod-lean-subheader") : "off" === e ? initApp.removeSettings("mod-lean-subheader") : layouts.errorMessage(e)
    }, e.hierarchicalNav = function (e) {
        "on" === e ? initApp.pushSettings("mod-nav-link") : "off" === e ? initApp.removeSettings("mod-nav-link") : layouts.errorMessage(e)
    }, e.darkNav = function (e) {
        "on" === e ? initApp.pushSettings("mod-nav-dark") : "off" === e ? initApp.removeSettings("mod-nav-dark") : layouts.errorMessage(e)
    }, e.theme = function (e, o) {
        initApp.updateTheme(e, o)
    }, e.mode = function (e) {
        switch (!0) {
            case"default" === e:
                initApp.removeSettings("mod-skin-light", !1), initApp.removeSettings("mod-skin-dark", !0);
                break;
            case"light" === e:
                initApp.removeSettings("mod-skin-dark", !1), initApp.pushSettings("mod-skin-light", !0);
                break;
            case"dark" === e:
                initApp.removeSettings("mod-skin-light", !1), initApp.pushSettings("mod-skin-dark", !0);
                break;
            default:
                console.log("('" + e + "') is not a valid entry, enter 'default', 'light', or 'dark'")
        }
    }, e
}({});
$(window).resize($.throttle(myapp_config.throttleDelay, function (e) {
    initApp.mobileCheckActivation(), initApp.checkNavigationOrientation()
})), $(window).scroll($.throttle(myapp_config.throttleDelay, function (e) {
})), $(window).on("scroll", initApp.windowScrollEvents), document.addEventListener("DOMContentLoaded", function () {
    initApp.addDeviceType(), initApp.detectBrowserType(), initApp.mobileCheckActivation(), initApp.buildNavigation(myapp_config.navHooks), initApp.listFilter(myapp_config.navHooks, myapp_config.navFilterInput, myapp_config.navAnchor), initApp.domReadyMisc(), initApp.appForms(".input-group", "has-length", "has-disabled")
}), $(window).on("orientationchange", function (e) {
    myapp_config.debugState && console.log("orientationchange event")
}), $(window).on("blur focus", function (e) {
    if ($(this).data("prevType") != e.type) switch (e.type) {
        case"blur":
            myapp_config.root_.toggleClass("blur"), myapp_config.debugState && console.log("blur");
            break;
        case"focus":
            myapp_config.root_.toggleClass("blur"), myapp_config.debugState && console.log("focused")
    }
    $(this).data("prevType", e.type)
});
