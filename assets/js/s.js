/*!
 * Version: 81
 * 
 */
!function (t) {
    var e = {};

    function n(o) {
        if (e[o])
            return e[o].exports;
        var r = e[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return t[o].call(r.exports, r, r.exports, n), r.l = !0, r.exports
    }
    n.m = t, n.c = e, n.d = function (t, e, o) {
        n.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: o
        })
    }, n.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, n.t = function (t, e) {
        if (1 & e && (t = n(t)), 8 & e)
            return t;
        if (4 & e && "object" == typeof t && t && t.__esModule)
            return t;
        var o = Object.create(null);
        if (n.r(o), Object.defineProperty(o, "default", {
            enumerable: !0,
            value: t
        }), 2 & e && "string" != typeof t)
            for (var r in t)
                n.d(o, r, function (e) {
                    return t[e]
                }.bind(null, r));
        return o
    }, n.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return n.d(e, "a", e), e
    }, n.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, n.p = "", n(n.s = 28)
}([function (t, e, n) {
        "use strict";
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.enumType = e.oneOf = e.array = e.object = e.boolean = e.number = e.string = e.setLocale = void 0;
        var o = n(19),
                r = n(20),
                i = n(21),
                a = n(22),
                s = n(23),
                l = n(24),
                c = n(2),
                u = n(25);
        e.setLocale = function (t) {
            c.Base.locale = t
        }, e.string = function () {
            return new r.StringType({
                type: "string"
            })
        }, e.number = function () {
            return new i.NumberType({
                type: "number"
            })
        }, e.boolean = function () {
            return new l.BooleanType({
                type: "boolean"
            })
        }, e.object = function (t) {
            return new o.ObjectType({
                type: "object",
                schema: t
            })
        }, e.array = function (t) {
            return new a.ArrayType({
                type: "array",
                childType: t
            })
        }, e.oneOf = function () {
            for (var t = [], e = 0; e < arguments.length; e++)
                t[e] = arguments[e];
            return new s.OneOfType({
                type: "oneOf",
                items: t
            })
        }, e.enumType = function () {
            for (var t = [], e = 0; e < arguments.length; e++)
                t[e] = arguments[e];
            return new u.EnumType({
                type: "enum",
                items: t
            })
        }
    }, function (t, e, n) {
        var o = n(3),
                r = n(18);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [
            [t.i, r, ""]
        ]);
        var i = {
            insert: "head",
            singleton: !1
        },
                a = (o(t.i, r, i), r.locals ? r.locals : {});
        t.exports = a
    }, function (t, e, n) {
        "use strict";
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.Base = void 0;
        var o = function () {
            function t(t) {
                this.isRequired = !1;
                var e = t.type;
                this.type = e
            }
            return t.prototype.required = function () {
                return this.isRequired = !0, this
            }, t.prototype.validate = function (e) {
                if (!t.locale)
                    throw new Error("You must set localization by `setLocale` function: https://github.com/qostya/client-json-validation");
                return !this.isRequired || null != e && "" !== e ? null : t.locale.main.required()
            }, t
        }();
        e.Base = o
    }, function (t, e, n) {
        "use strict";
        var o, r = function () {
            return void 0 === o && (o = Boolean(window && document && document.all && !window.atob)), o
        },
                i = function () {
                    var t = {};
                    return function (e) {
                        if (void 0 === t[e]) {
                            var n = document.querySelector(e);
                            if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement)
                                try {
                                    n = n.contentDocument.head
                                } catch (t) {
                                    n = null
                                }
                            t[e] = n
                        }
                        return t[e]
                    }
                }(),
                a = {};

        function s(t, e, n) {
            for (var o = 0; o < e.length; o++) {
                var r = {
                    css: e[o][1],
                    media: e[o][2],
                    sourceMap: e[o][3]
                };
                a[t][o] ? a[t][o](r) : a[t].push(m(r, n))
            }
        }

        function l(t) {
            var e = document.createElement("style"),
                    o = t.attributes || {};
            if (void 0 === o.nonce) {
                var r = n.nc;
                r && (o.nonce = r)
            }
            if (Object.keys(o).forEach((function (t) {
                e.setAttribute(t, o[t])
            })), "function" == typeof t.insert)
                t.insert(e);
            else {
                var a = i(t.insert || "head");
                if (!a)
                    throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
                a.appendChild(e)
            }
            return e
        }
        var c, u = (c = [], function (t, e) {
            return c[t] = e, c.filter(Boolean).join("\n")
        });

        function d(t, e, n, o) {
            var r = n ? "" : o.css;
            if (t.styleSheet)
                t.styleSheet.cssText = u(e, r);
            else {
                var i = document.createTextNode(r),
                        a = t.childNodes;
                a[e] && t.removeChild(a[e]), a.length ? t.insertBefore(i, a[e]) : t.appendChild(i)
            }
        }

        function p(t, e, n) {
            var o = n.css,
                    r = n.media,
                    i = n.sourceMap;
            if (r ? t.setAttribute("media", r) : t.removeAttribute("media"), i && btoa && (o += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i)))), " */")), t.styleSheet)
                t.styleSheet.cssText = o;
            else {
                for (; t.firstChild; )
                    t.removeChild(t.firstChild);
                t.appendChild(document.createTextNode(o))
            }
        }
        var f = null,
                h = 0;

        function m(t, e) {
            var n, o, r;
            if (e.singleton) {
                var i = h++;
                n = f || (f = l(e)), o = d.bind(null, n, i, !1), r = d.bind(null, n, i, !0)
            } else
                n = l(e), o = p.bind(null, n, e), r = function () {
                    !function (t) {
                        if (null === t.parentNode)
                            return !1;
                        t.parentNode.removeChild(t)
                    }(n)
                };
            return o(t),
                    function (e) {
                        if (e) {
                            if (e.css === t.css && e.media === t.media && e.sourceMap === t.sourceMap)
                                return;
                            o(t = e)
                        } else
                            r()
                    }
        }
        t.exports = function (t, e, n) {
            return (n = n || {}).singleton || "boolean" == typeof n.singleton || (n.singleton = r()), t = n.base ? t + n.base : t, e = e || [], a[t] || (a[t] = []), s(t, e, n),
                    function (e) {
                        if (e = e || [], "[object Array]" === Object.prototype.toString.call(e)) {
                            a[t] || (a[t] = []), s(t, e, n);
                            for (var o = e.length; o < a[t].length; o++)
                                a[t][o]();
                            a[t].length = e.length, 0 === a[t].length && delete a[t]
                        }
                    }
        }
    }, function (t, e, n) {
        "use strict";
        t.exports = function (t) {
            var e = [];
            return e.toString = function () {
                return this.map((function (e) {
                    var n = function (t, e) {
                        var n = t[1] || "",
                                o = t[3];
                        if (!o)
                            return n;
                        if (e && "function" == typeof btoa) {
                            var r = (a = o, s = btoa(unescape(encodeURIComponent(JSON.stringify(a)))), l = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(s), "/*# ".concat(l, " */")),
                                    i = o.sources.map((function (t) {
                                        return "/*# sourceURL=".concat(o.sourceRoot || "").concat(t, " */")
                                    }));
                            return [n].concat(i).concat([r]).join("\n")
                        }
                        var a, s, l;
                        return [n].join("\n")
                    }(e, t);
                    return e[2] ? "@media ".concat(e[2], " {").concat(n, "}") : n
                })).join("")
            }, e.i = function (t, n, o) {
                "string" == typeof t && (t = [
                    [null, t, ""]
                ]);
                var r = {};
                if (o)
                    for (var i = 0; i < this.length; i++) {
                        var a = this[i][0];
                        null != a && (r[a] = !0)
                    }
                for (var s = 0; s < t.length; s++) {
                    var l = [].concat(t[s]);
                    o && r[l[0]] || (n && (l[2] ? l[2] = "".concat(n, " and ").concat(l[2]) : l[2] = n), e.push(l))
                }
            }, e
        }
    }, function (t, e, n) {
        "use strict";
        (function (t) {
            n.d(e, "a", (function () {
                return o
            })), n.d(e, "b", (function () {
                return r
            }));
            var o = "https://forma.tinkoff.ru/api",
                    r = "https://forma.tinkoff.ru/sentry/api/120/store/?sentry_key=244f8b69a5454da8a1581126634f470b&sentry_version=7";
            t.env.COBROKER_SENTRY_ROOT
        }).call(this, n(13))
    }, function (t, e, n) {
        var o = n(3),
                r = n(14);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [
            [t.i, r, ""]
        ]);
        var i = {
            insert: "head",
            singleton: !1
        },
                a = (o(t.i, r, i), r.locals ? r.locals : {});
        t.exports = a
    }, function (t, e, n) {
        "use strict";
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.deepEquals = e.isArray = e.isObject = void 0, e.isObject = function (t) {
            return "object" == typeof t && null !== t
        }, e.isArray = function (t) {
            return Boolean(t) && t.constructor === Array
        }, e.deepEquals = function t(e, n) {
            if (e === n)
                return !0;
            if (!e || !n)
                return !1;
            var o = typeof e;
            if (o !== typeof n)
                return !1;
            if (function (t) {
                return "number" === t || "string" === t || "boolean" === t
            }(o))
                return !1;
            var r = Object.keys(e);
            if (r.length !== Object.keys(n).length)
                return !1;
            for (var i = 0; i < r.length; i++) {
                var a = e[r[i]],
                        s = n[r[i]];
                if (a !== s) {
                    var l = typeof a;
                    if (l !== typeof s || "object" !== l)
                        return !1;
                    if (!t(a, s))
                        return !1
                }
            }
            return !0
        }
    }, function (t, e, n) {
        var o = n(3),
                r = n(17);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [
            [t.i, r, ""]
        ]);
        var i = {
            insert: "head",
            singleton: !1
        },
                a = (o(t.i, r, i), r.locals ? r.locals : {});
        t.exports = a
    }, function (t, e, n) {
        "use strict";
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.default = function () {
            if ("undefined" == typeof window)
                return null;
            var t = window.navigator || {},
                    e = t.userAgent,
                    n = void 0 === e ? "" : e,
                    o = t.language,
                    r = void 0 === o ? "" : o,
                    i = t.userLanguage,
                    a = void 0 === i ? "" : i,
                    s = window.screen || {},
                    l = s.width,
                    c = void 0 === l ? 0 : l,
                    u = s.height,
                    d = void 0 === u ? 0 : u,
                    p = s.colorDepth;
            return {
                userAgent: n,
                language: r || a,
                screen: {
                    width: c,
                    height: d,
                    colorDepth: void 0 === p ? 0 : p
                },
                timezoneOffset: (new Date).getTimezoneOffset()
            }
        }
    }, function (t, e, n) {
        var o = n(3),
                r = n(15);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [
            [t.i, r, ""]
        ]);
        var i = {
            insert: "head",
            singleton: !1
        },
                a = (o(t.i, r, i), r.locals ? r.locals : {});
        t.exports = a
    }, function (t, e, n) {
        var o = n(3),
                r = n(16);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [
            [t.i, r, ""]
        ]);
        var i = {
            insert: "head",
            singleton: !1
        },
                a = (o(t.i, r, i), r.locals ? r.locals : {});
        t.exports = a
    }, function (t, e, n) {
        "use strict";
        Object.defineProperty(e, "__esModule", {
            value: !0
        });
        var o = {
            main: {
                required: function () {
                    return "РџРѕР»Рµ РѕР±СЏР·Р°С‚РµР»СЊРЅРѕ"
                }
            },
            string: {
                not: function () {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ СЃС‚СЂРѕРєРѕР№"
                },
                max: function (t, e) {
                    return "Р”Р»РёРЅР° Р·РЅР°С‡РµРЅРёСЏ " + t + " РґРѕР»Р¶РЅР° Р±С‹С‚СЊ РЅРµ Р±РѕР»СЊС€Рµ " + e
                },
                min: function (t, e) {
                    return "Р”Р»РёРЅР° Р·РЅР°С‡РµРЅРёСЏ " + t + " РґРѕР»Р¶РЅР° Р±С‹С‚СЊ РЅРµ РјРµРЅСЊС€Рµ " + e
                },
                match: function (t, e) {
                    return "Р—РЅР°С‡РµРЅРёРµ " + t + " РЅРµ РїРѕРґС…РѕРґРёС‚ РїРѕ РїР°С‚С‚РµСЂРЅСѓ " + e.toString()
                }
            },
            number: {
                not: function () {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ С‡РёСЃР»РѕРј"
                },
                isNaN: function () {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ С‡РёСЃР»РѕРј"
                },
                min: function (t, e) {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ Р±РѕР»СЊС€Рµ " + e + ", Р° РЅРµ " + t + " "
                },
                max: function (t, e) {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ РјРµРЅСЊС€Рµ " + e + ", Р° РЅРµ " + t + " "
                }
            },
            boolean: {
                not: function () {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ С‚РёРїР° Boolean"
                }
            },
            array: {
                not: function () {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ РјР°СЃСЃРёРІРѕРј"
                },
                min: function (t, e) {
                    return "Р”Р»РёРЅР° РјР°СЃСЃРёРІР° РґРѕР»Р¶РЅР° Р±С‹С‚СЊ Р±РѕР»СЊС€Рµ " + e
                },
                max: function (t, e) {
                    return "Р”Р»РёРЅР° РјР°СЃСЃРёРІР° РґРѕР»Р¶РЅР° Р±С‹С‚СЊ РјРµРЅСЊС€Рµ " + e
                }
            },
            object: {
                not: function () {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ РѕР±СЉРµРєС‚РѕРј"
                }
            },
            oneOf: {
                invalid: function (t, e) {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ РѕРґРЅРёРј РёР· С‚РёРїРѕРІ: " + e.map((function (t) {
                        return t.type
                    })).join(", ") + ", Р° РЅРµ " + JSON.stringify(t)
                }
            },
            enum: {
                invalid: function (t, e) {
                    return "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ РѕРґРЅРёРј РёР· " + JSON.stringify(e) + ", Р° РЅРµ " + JSON.stringify(t)
                }
            }
        };
        e.default = o
    }, function (t, e) {
        var n, o, r = t.exports = {};

        function i() {
            throw new Error("setTimeout has not been defined")
        }

        function a() {
            throw new Error("clearTimeout has not been defined")
        }

        function s(t) {
            if (n === setTimeout)
                return setTimeout(t, 0);
            if ((n === i || !n) && setTimeout)
                return n = setTimeout, setTimeout(t, 0);
            try {
                return n(t, 0)
            } catch (e) {
                try {
                    return n.call(null, t, 0)
                } catch (e) {
                    return n.call(this, t, 0)
                }
            }
        }
        !function () {
            try {
                n = "function" == typeof setTimeout ? setTimeout : i
            } catch (t) {
                n = i
            }
            try {
                o = "function" == typeof clearTimeout ? clearTimeout : a
            } catch (t) {
                o = a
            }
        }();
        var l, c = [],
                u = !1,
                d = -1;

        function p() {
            u && l && (u = !1, l.length ? c = l.concat(c) : d = -1, c.length && f())
        }

        function f() {
            if (!u) {
                var t = s(p);
                u = !0;
                for (var e = c.length; e; ) {
                    for (l = c, c = []; ++d < e; )
                        l && l[d].run();
                    d = -1, e = c.length
                }
                l = null, u = !1,
                        function (t) {
                            if (o === clearTimeout)
                                return clearTimeout(t);
                            if ((o === a || !o) && clearTimeout)
                                return o = clearTimeout, clearTimeout(t);
                            try {
                                o(t)
                            } catch (e) {
                                try {
                                    return o.call(null, t)
                                } catch (e) {
                                    return o.call(this, t)
                                }
                            }
                        }(t)
            }
        }

        function h(t, e) {
            this.fun = t, this.array = e
        }

        function m() {}
        r.nextTick = function (t) {
            var e = new Array(arguments.length - 1);
            if (arguments.length > 1)
                for (var n = 1; n < arguments.length; n++)
                    e[n - 1] = arguments[n];
            c.push(new h(t, e)), 1 !== c.length || u || s(f)
        }, h.prototype.run = function () {
            this.fun.apply(null, this.array)
        }, r.title = "browser", r.browser = !0, r.env = {}, r.argv = [], r.version = "", r.versions = {}, r.on = m, r.addListener = m, r.once = m, r.off = m, r.removeListener = m, r.removeAllListeners = m, r.emit = m, r.prependListener = m, r.prependOnceListener = m, r.listeners = function (t) {
            return []
        }, r.binding = function (t) {
            throw new Error("process.binding is not supported")
        }, r.cwd = function () {
            return "/"
        }, r.chdir = function (t) {
            throw new Error("process.chdir is not supported")
        }, r.umask = function () {
            return 0
        }
    }, function (t, e, n) {
        (e = n(4)(!1)).push([t.i, ".modal-root--3RoMz {\n  overflow-x: hidden;\n  overflow-y: scroll;\n  margin: 0;\n  padding: 0;\n  position: fixed;\n  left: 0;\n  top: 0;\n  z-index: 1000;\n  width: 100%;\n  height: 100%;\n  background-color: rgba(0, 0, 0, 0.75);\n}\n\n.modal-root--3RoMz * {\n  box-sizing: border-box;\n  line-height: 1.4;\n}\n\n.modal-content--SXZqu {\n  position: relative;\n  max-width: 680px;\n  border-radius: 4px;\n  margin: 40px auto;\n  background-color: #fff;\n  box-shadow: 0px 18px 30px rgba(51, 51, 51, 0.64);\n  overflow: hidden;\n}\n\n.modal-cross--3jQx9 {\n  position: fixed;\n  top: 16px;\n  right: 16px;\n  width: 32px;\n  height: 32px;\n  background-color: rgba(104, 104, 104, 0.96);\n  cursor: pointer;\n  border-radius: 50%;\n  background-image: url(\"data:image/svg+xml,%3Csvg width='10' height='10' viewBox='0 0 10 10' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.0976311 8.68342 -0.0976311 9.31658 0.292893 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5 6.41421L8.29289 9.70711C8.68342 10.0976 9.31658 10.0976 9.70711 9.70711C10.0976 9.31658 10.0976 8.68342 9.70711 8.29289L6.41421 5L9.70711 1.70711C10.0976 1.31658 10.0976 0.683417 9.70711 0.292893C9.31658 -0.0976311 8.68342 -0.0976311 8.29289 0.292893L5 3.58579L1.70711 0.292893Z' fill='white'/%3E%3C/svg%3E%0A\");\n  background-position: center;\n  background-repeat: no-repeat;\n}\n\n@media screen and (max-width: 820px) {\n  .modal-root--3RoMz,\n  .modal-content--SXZqu {\n    min-height: 100%;\n  }\n\n  .modal-content--SXZqu {\n    min-width: 100%;\n    padding: 0 40px;\n    border-radius: 0;\n    margin: 0;\n  }\n\n  .modal-cross--3jQx9 {\n    position: absolute;\n    top: 4px;\n    right: 4px;\n    width: 24px;\n    height: 24px;\n    background-color: transparent;\n    background-image: url(\"data:image/svg+xml,%3Csvg width='10' height='10' viewBox='0 0 10 10' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.0976311 8.68342 -0.0976311 9.31658 0.292893 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5 6.41421L8.29289 9.70711C8.68342 10.0976 9.31658 10.0976 9.70711 9.70711C10.0976 9.31658 10.0976 8.68342 9.70711 8.29289L6.41421 5L9.70711 1.70711C10.0976 1.31658 10.0976 0.683417 9.70711 0.292893C9.31658 -0.0976311 8.68342 -0.0976311 8.29289 0.292893L5 3.58579L1.70711 0.292893Z' fill='black' fill-opacity='0.4'/%3E%3C/svg%3E%0A\");\n    background-position: center;\n    background-repeat: no-repeat;\n  }\n}\n\n@media screen and (max-width: 600px) {\n  .modal-content--SXZqu {\n    padding: 0 32px;\n  }\n}\n", ""]), e.locals = {
            root: "modal-root--3RoMz",
            content: "modal-content--SXZqu",
            cross: "modal-cross--3jQx9"
        }, t.exports = e
    }, function (t, e, n) {
        (e = n(4)(!1)).push([t.i, '.typography-root--ovnFY {\n  position: relative;\n  margin: 0 auto;\n  font-family: haas,pragmatica,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif;\n}\n\n.typography-root--ovnFY::selection {\n  background: #ffdd2d;\n  color: #333;\n}\n\n.typography-root--ovnFY ul {\n  list-style: none;\n  padding: 0;\n  margin-top: 12px;\n}\n\n.typography-root--ovnFY li {\n  position: relative;\n  padding-left: 24px;\n}\n\n.typography-root--ovnFY li::before {\n  display: inline-block;\n  margin: 0 16px 1px -24px;\n  border: 4px solid #ffdd2d;\n  border-radius: 50%;\n  content: "";\n}\n', ""]), e.locals = {
            root: "typography-root--ovnFY"
        }, t.exports = e
    }, function (t, e, n) {
        (e = n(4)(!1)).push([t.i, ".ShowErrors-content--cHLgc {\n  padding: 32px 40px;\n}\n\n.ShowErrors-content--cHLgc h3 {\n  font-size: 24px;\n  font-weight: 500;\n  margin-top: 0;\n}\n\n.ShowErrors-content--cHLgc * + h3 {\n  margin-top: 36px;\n}\n\n.ShowErrors-content--cHLgc > * + a {\n  display: inline-block;\n  margin-top: 24px;\n}\n\n@media screen and (max-width: 680px) {\n  .ShowErrors-content--cHLgc {\n    height: 100vh;\n    padding: 40px;\n  }\n}\n", ""]), e.locals = {
            content: "ShowErrors-content--cHLgc"
        }, t.exports = e
    }, function (t, e, n) {
        (e = n(4)(!1)).push([t.i, ".iframe-root--2WcPD {\n  width: 100%;\n  border: 0;\n  display: block;\n  overflow: hidden;\n}\n\n.iframe-loaded--2iNzp {\n  transition: height .15s ease-out;\n}\n", ""]), e.locals = {
            root: "iframe-root--2WcPD",
            loaded: "iframe-loaded--2iNzp"
        }, t.exports = e
    }, function (t, e, n) {
        (e = n(4)(!1)).push([t.i, ".skeleton-root--18Qz4 {\n  max-width: 600px;\n  margin: 0 auto;\n  padding: 40px 0;\n}\n\n.skeleton-root--18Qz4.skeleton-mobile--3I8vJ {\n  padding-top: 32px;\n}\n\n.skeleton-root--18Qz4 *:empty {\n  max-width: 100%;\n  box-sizing: border-box;\n  background-color: rgba(51, 51, 51, .08);\n  animation: skeleton-skeletonBgVibe--YqXdG 1s ease-in-out infinite alternate;\n}\n\n.skeleton-logo--2Wp0p {\n  width: 154px;\n  height: 34px;\n  margin: 0 auto 38px;\n}\n\n.skeleton-gamification--UTPfs {\n  margin-bottom: 32px;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-gamification--UTPfs {\n  margin-bottom: 20px;\n}\n\n.skeleton-gamification--UTPfs > *:not(:first-child) {\n  margin-top: 8px;\n}\n\n.skeleton-gamificationHeader--27Nss {\n  display: block;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-gamificationHeader--27Nss {\n  display: flex;\n  align-items: baseline;\n  justify-content: space-between;\n}\n\n.skeleton-gamificationTitle--1mfd1 {\n  width: 148px;\n  height: 20px;\n  border-top: 3px solid white;\n  border-bottom: 3px solid white;\n}\n\n.skeleton-gamificationScore--2PNfY {\n  width: 40px;\n  height: 28px;\n  border-top: 2px solid white;\n  border-bottom: 2px solid white;\n  margin-top: 8px;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-gamificationScore--2PNfY {\n  height: 24px;\n  border-top: 2px solid white;\n  border-bottom: 2px solid white;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-gamificationScore--2PNfY {\n  margin-top: 0;\n}\n\n.skeleton-gamificationProgress--2itLM {\n  height: 8px;\n  border-radius: 4px;\n}\n\n.skeleton-gamificationFooter--25Beb {\n  display: flex;\n  align-items: baseline;\n  justify-content: space-between;\n}\n\n.skeleton-gamificationProgressValue--iHSoL {\n  display: none;\n  width: 62px;\n  height: 20px;\n  border-top: 3px solid white;\n  border-bottom: 3px solid white;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-gamificationProgressValue--iHSoL {\n  display: block;\n}\n\n.skeleton-gamificationProgressLabel--1-Lx0 {\n  width: 98px;\n  height: 20px;\n  border-top: 3px solid white;\n  border-bottom: 3px solid white;\n}\n\n.skeleton-title--hl4k0 {\n  width: 150px;\n  height: 28px;\n  border-top: 2px solid white;\n  border-bottom: 2px solid white;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-title--hl4k0 {\n  width: 170px;\n  height: 24px;\n  border-top: 3px solid white;\n  border-bottom: 3px solid white;\n}\n\n.skeleton-row--1Qyfa {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n\n.skeleton-pageCount--38ju7 {\n  width: 75px;\n  height: 26px;\n  border-top: 5px solid white;\n  border-bottom: 5px solid white;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-pageCount--38ju7 {\n  height: 18px;\n  border-top: 2px solid white;\n  border-bottom: 2px solid white;\n}\n\n.skeleton-form--2szM7 > * {\n  margin-top: 20px;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-form--2szM7 > *,\n.skeleton-mobile--3I8vJ .skeleton-form--2szM7 .skeleton-fieldRow--UM4Zi > *:not(:first-child) {\n  margin-top: 16px;\n}\n\n.skeleton-form--2szM7 > .skeleton-title--hl4k0 {\n  margin-top: 32px;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-form--2szM7 > .skeleton-title--hl4k0 {\n  margin-top: 24px;\n}\n\n.skeleton-fieldRow--UM4Zi {\n  display: flex;\n  flex-direction: row;\n  justify-content: space-between;\n  align-items: center;\n}\n\n.skeleton-root--18Qz4:not(.skeleton-mobile--3I8vJ) .skeleton-fieldRow--UM4Zi > *:not(:first-child) {\n  margin-left: 20px;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-fieldRow--UM4Zi {\n  flex-direction: column;\n}\n\n.skeleton-inputSlider--175Rh {\n  width: 100%;\n  height: 88px;\n}\n\n.skeleton-input--3rnI3 {\n  width: 100%;\n  height: 56px;\n}\n\n.skeleton-paymentInfo--2vX11 {\n  height: 24px;\n  margin-top: 20px !important;\n}\n\n.skeleton-actions--19ebN {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n  margin-top: 32px !important;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-actions--19ebN {\n  flex-direction: column;\n  align-items: stretch;\n}\n\n.skeleton-userAgreement--2qoGU {\n  width: 355px;\n  height: 56px;\n  margin-bottom: 8px;\n  border-top: 16px solid white;\n  border-bottom: 16px solid white;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-userAgreement--2qoGU {\n  height: 28px;\n  margin-bottom: 16px;\n  border-top: none;\n  border-bottom: 4px solid white;\n}\n\n.skeleton-button--1XwpT {\n  width: 115px;\n  height: 56px;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-button--1XwpT {\n  width: 100%;\n}\n\n.skeleton-island--yTEYa {\n  margin-top: 32px;\n  padding: 16px;\n  border-radius: 8px;\n  box-shadow: inset 0 0 0 1px #e7e8ea;\n}\n\n.skeleton-mobile--3I8vJ .skeleton-island--yTEYa {\n  margin-top: 24px;\n}\n\n.skeleton-islandHeader--3Q4nV {\n  width: 82px;\n  height: 24px;\n  border-top: 2px solid white;\n  border-bottom: 2px solid white;\n}\n\n.skeleton-islandContent--3a_oi {\n  height: 186px;\n  margin-top: 12px;\n}\n\n@keyframes skeleton-skeletonBgVibe--YqXdG {\n  from {\n    background-color: rgba(51, 51, 51, .08);\n  }\n  to {\n    background-color: rgba(51, 51, 51, .16);\n  }\n}\n", ""]), e.locals = {
            root: "skeleton-root--18Qz4",
            mobile: "skeleton-mobile--3I8vJ",
            skeletonBgVibe: "skeleton-skeletonBgVibe--YqXdG",
            logo: "skeleton-logo--2Wp0p",
            gamification: "skeleton-gamification--UTPfs",
            gamificationHeader: "skeleton-gamificationHeader--27Nss",
            gamificationTitle: "skeleton-gamificationTitle--1mfd1",
            gamificationScore: "skeleton-gamificationScore--2PNfY",
            gamificationProgress: "skeleton-gamificationProgress--2itLM",
            gamificationFooter: "skeleton-gamificationFooter--25Beb",
            gamificationProgressValue: "skeleton-gamificationProgressValue--iHSoL",
            gamificationProgressLabel: "skeleton-gamificationProgressLabel--1-Lx0",
            title: "skeleton-title--hl4k0",
            row: "skeleton-row--1Qyfa",
            pageCount: "skeleton-pageCount--38ju7",
            form: "skeleton-form--2szM7",
            fieldRow: "skeleton-fieldRow--UM4Zi",
            inputSlider: "skeleton-inputSlider--175Rh",
            input: "skeleton-input--3rnI3",
            paymentInfo: "skeleton-paymentInfo--2vX11",
            actions: "skeleton-actions--19ebN",
            userAgreement: "skeleton-userAgreement--2qoGU",
            button: "skeleton-button--1XwpT",
            island: "skeleton-island--yTEYa",
            islandHeader: "skeleton-islandHeader--3Q4nV",
            islandContent: "skeleton-islandContent--3a_oi"
        }, t.exports = e
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.ObjectType = void 0;
        var i = n(2),
                a = n(7),
                s = function (t) {
                    function e(e) {
                        var n = this,
                                o = e.schema;
                        return (n = t.call(this, e) || this).schema = o, o || new Error("Schema property is required"), Object.keys(n.schema).forEach((function (t) {
                            if (!(n.schema[t] instanceof i.Base))
                                throw new Error("Field " + t + " must be instance of Type")
                        })), n
                    }
                    return r(e, t), e.prototype.validate = function (e) {
                        var n = this,
                                o = t.prototype.validate.call(this, e);
                        if (null !== o)
                            return o;
                        if (!a.isObject(e))
                            return i.Base.locale.object.not();
                        var r = {};
                        return Object.keys(this.schema).forEach((function (t) {
                            var o = n.schema[t];
                            if (o.isRequired || null != e[t] && "" !== e[t]) {
                                var i = o.validate(e[t]);
                                i && (r[t] = i)
                            }
                        })), Object.keys(r).length > 0 ? r : null
                    }, e
                }(i.Base);
        e.ObjectType = s
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.StringType = void 0;
        var i = n(2),
                a = function (t) {
                    function e() {
                        return null !== t && t.apply(this, arguments) || this
                    }
                    return r(e, t), e.prototype.max = function (t) {
                        return this._max = t, this
                    }, e.prototype.min = function (t) {
                        return this._min = t, this
                    }, e.prototype.match = function (t) {
                        return this._match = t, this
                    }, e.prototype.allowEmpty = function () {
                        return this._allowEmpty = !0, this
                    }, e.prototype.validate = function (e) {
                        if (this._allowEmpty && "" === e)
                            return null;
                        var n = t.prototype.validate.call(this, e);
                        if (n)
                            return n;
                        var o = i.Base.locale.string;
                        return "string" != typeof e ? o.not() : this._match && !e.match(this._match) ? o.match(e, this._match) : this._max && e.length > this._max ? o.max(e, this._max) : this._min && e.length < this._min ? o.min(e, this._min) : null
                    }, e
                }(i.Base);
        e.StringType = a
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.NumberType = void 0;
        var i = n(2),
                a = function (t) {
                    function e() {
                        var e = null !== t && t.apply(this, arguments) || this;
                        return e._isStrict = !0, e
                    }
                    return r(e, t), e.prototype.max = function (t) {
                        return this._max = t, this
                    }, e.prototype.min = function (t) {
                        return this._min = t, this
                    }, e.prototype.eqeq = function () {
                        return this._isStrict = !1, this
                    }, e.prototype.validate = function (e) {
                        var n = t.prototype.validate.call(this, e);
                        if (n)
                            return n;
                        if ("number" != typeof e) {
                            if (this._isStrict)
                                return i.Base.locale.number.not();
                            if ("string" != typeof e)
                                return i.Base.locale.number.not();
                            if (isNaN(Number(e)))
                                return i.Base.locale.number.isNaN()
                        }
                        return this._min && e < this._min ? i.Base.locale.number.min(Number(e), this._min) : this._max && e > this._max ? i.Base.locale.number.max(Number(e), this._max) : null
                    }, e
                }(i.Base);
        e.NumberType = a
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.ArrayType = void 0;
        var i = n(2),
                a = n(7),
                s = function (t) {
                    function e(e) {
                        var n = this,
                                o = e.childType;
                        return (n = t.call(this, e) || this).childType = o, o || new Error("childType property is required"), n
                    }
                    return r(e, t), e.prototype.min = function (t) {
                        return this._min = t, this
                    }, e.prototype.max = function (t) {
                        return this._max = t, this
                    }, e.prototype.validate = function (e) {
                        var n = this,
                                o = t.prototype.validate.call(this, e);
                        return o || (a.isArray(e) ? this._min && e.length < this._min ? i.Base.locale.array.min(e, this._min) : this._max && e.length > this._max ? i.Base.locale.array.max(e, this._max) : e.reduce((function (t, e, o) {
                            var r = t,
                                    i = n.childType.validate(e);
                            return i && (r || (r = {}), r[o] = i), r
                        }), null) : i.Base.locale.array.not())
                    }, e
                }(i.Base);
        e.ArrayType = s
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.OneOfType = void 0;
        var i = n(2),
                a = function (t) {
                    function e(e) {
                        var n = this,
                                o = e.items;
                        if ((n = t.call(this, e) || this).items = o, !o || !o.length)
                            throw new Error("items property is required");
                        return n
                    }
                    return r(e, t), e.prototype.validate = function (e) {
                        var n = t.prototype.validate.call(this, e);
                        return n || (this.items.find((function (t) {
                            return !t.validate(e)
                        })) ? null : i.Base.locale.oneOf.invalid(e, this.items))
                    }, e
                }(i.Base);
        e.OneOfType = a
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.BooleanType = void 0;
        var i = n(2),
                a = function (t) {
                    function e() {
                        return null !== t && t.apply(this, arguments) || this
                    }
                    return r(e, t), e.prototype.validate = function (e) {
                        var n = t.prototype.validate.call(this, e);
                        return n || ("boolean" != typeof e ? i.Base.locale.boolean.not() : null)
                    }, e
                }(i.Base);
        e.BooleanType = a
    }, function (t, e, n) {
        "use strict";
        var o, r = this && this.__extends || (o = function (t, e) {
            return (o = Object.setPrototypeOf || {
                __proto__: []
            }
            instanceof Array && function (t, e) {
                t.__proto__ = e
            } || function (t, e) {
                for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n])
            })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            o(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        });
        Object.defineProperty(e, "__esModule", {
            value: !0
        }), e.EnumType = void 0;
        var i = n(2),
                a = n(7),
                s = function (t) {
                    function e(e) {
                        var n = this,
                                o = e.items;
                        if ((n = t.call(this, e) || this).items = o, !o || !o.length)
                            throw new Error("items property is required");
                        return n
                    }
                    return r(e, t), e.prototype.validate = function (e) {
                        var n = t.prototype.validate.call(this, e);
                        return n || (this.items.find((function (t) {
                            return a.deepEquals(t, e)
                        })) ? null : i.Base.locale.enum.invalid(e, this.items))
                    }, e
                }(i.Base);
        e.EnumType = s
    }, function (t, e, n) {
        var o = n(3),
                r = n(27);
        "string" == typeof (r = r.__esModule ? r.default : r) && (r = [
            [t.i, r, ""]
        ]);
        var i = {
            insert: "head",
            singleton: !1
        },
                a = (o(t.i, r, i), r.locals ? r.locals : {});
        t.exports = a
    }, function (t, e, n) {
        (e = n(4)(!1)).push([t.i, '.TINKOFF_BTN_YELLOW {\n  background-color: #ffdd2d;\n  font-family: haas,pragmatica,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif;\n  position: relative;\n  display: inline-block;\n  border-radius: 4px;\n  border: 1px solid transparent;\n  box-sizing: border-box;\n  max-width: 100%;\n  cursor: pointer;\n  text-decoration: none;\n  color: #333;\n  font-weight: 400;\n  transition-property: background-color, border, box-shadow;\n  transition-duration: .25s;\n  transition-timing-function: ease;\n}\n\n.TINKOFF_BTN_YELLOW:empty:before {\n  content: "РљСѓРїРёС‚СЊ РІ РєСЂРµРґРёС‚"\n}\n\n.TINKOFF_BTN_YELLOW[disabled] {\n  pointer-events: none;\n  opacity: .56;\n}\n\n.TINKOFF_BTN_YELLOW::-moz-focus-inner {\n  border: 0 none;\n  padding: 0;\n}\n\n.TINKOFF_BTN_YELLOW:focus {\n  outline-width: 0;\n}\n\n.TINKOFF_BTN_YELLOW:focus,\n.TINKOFF_BTN_YELLOW:hover:not([disabled]) {\n  background-color: #fcc521;\n}\n\n.TINKOFF_BTN_YELLOW:active:not([disabled]) {\n  background-color: #fab619;\n}\n\n.TINKOFF_BTN_YELLOW,\n.TINKOFF_SIZE_M {\n  min-height: 42px;\n  font-size: 15px;\n  line-height: 24px;\n  padding: 9px 19px;\n}\n\n.TINKOFF_SIZE_XL {\n  padding: 18px 35px 16px;\n  min-height: 58px;\n  font-size: 17px;\n  line-height: 24px;\n}\n\n.TINKOFF_SIZE_L {\n  padding: 15px 31px;\n  min-height: 54px;\n  font-size: 15px;\n  line-height: 24px;\n}\n\n.TINKOFF_SIZE_S {\n  padding: 7px 11px;\n  min-height: 30px;\n  font-size: 13px;\n  line-height: 16px;\n}\n', ""]), t.exports = e
    }, function (t, e, n) {
        "use strict";
        n.r(e);
        var o = n(9),
                r = n.n(o),
                i = n(0),
                a = n(12),
                s = n.n(a),
                l = n(5);

        function c() {
            return "undefined" != typeof window
        }
        var u = function (t, e) {
            var n = {};
            for (var o in t)
                Object.prototype.hasOwnProperty.call(t, o) && e.indexOf(o) < 0 && (n[o] = t[o]);
            if (null != t && "function" == typeof Object.getOwnPropertySymbols) {
                var r = 0;
                for (o = Object.getOwnPropertySymbols(t); r < o.length; r++)
                    e.indexOf(o[r]) < 0 && (n[o[r]] = t[o[r]])
            }
            return n
        },
                d = [],
                p = {};

        function f(t, e) {
            return d.push({
                frameId: t,
                callback: e
            }),
                    function () {
                        return d = d.filter((function (t) {
                            return t.callback !== e
                        }))
                    }
        }
        c() && window.addEventListener("message", (function (t) {
            var e = t.data || p,
                    n = e.type,
                    o = e.frameId,
                    r = u(e, ["type", "frameId"]);
            n && 0 === n.indexOf("tinkoff/") && d.forEach((function (e) {
                o === e.frameId && e.callback({
                    frameId: o,
                    type: t.data.type,
                    data: r
                })
            }))
        }));
        var h = function () {
            function t() {
                this.subs = []
            }
            return t.prototype.on = function (t) {
                var e = t.type,
                        n = t.listener;
                this.subs.push({
                    type: e,
                    listener: n
                })
            }, t.prototype.off = function (t) {
                var e = t.type,
                        n = t.listener;
                this.subs = this.subs.filter((function (t) {
                    return e !== t.type || t.listener !== n
                }))
            }, t.prototype.dispatch = function (t) {
                this.subs.forEach((function (e) {
                    e.type === t.type && e.listener(t)
                }))
            }, t
        }(),
                m = function () {
                    return (m = Object.assign || function (t) {
                        for (var e, n = 1, o = arguments.length; n < o; n++)
                            for (var r in e = arguments[n])
                                Object.prototype.hasOwnProperty.call(e, r) && (t[r] = e[r]);
                        return t
                    }).apply(this, arguments)
                };

        function v(t, e, n) {
            return function (t, e) {
                return fetch(t, e).then(g)
            }(t, {
                method: "POST",
                headers: y(n, "application/json"),
                body: JSON.stringify(e)
            })
        }

        function y(t, e) {
            var n = (t || {}).headers,
                    o = void 0 === n ? {} : n;
            return e ? m({}, o, {
                "Content-Type": e
            }) : o
        }

        function g(t) {
            var e = function (t) {
                var e = t.headers.get("Content-Type");
                if (e && -1 !== e.indexOf("application/json"))
                    return t.json();
                return e && -1 !== e.indexOf("text/") ? t.text() : t.blob()
            }(t);
            return function (t) {
                return t.status < 200 || t.status >= 300
            }(t) ? e.then((function (e) {
                return Promise.reject({
                    response: t,
                    data: e
                })
            })) : e
        }
        var b = "SCRIPT_SENTRY_UUID",
                x = function () {
                    try {
                        return window.localStorage.getItem(b) || null
                    } catch (t) {
                        return null
                    }
                }();

        function w() {
            return x || (t = 65536, e = 16, function (t) {
                try {
                    window.localStorage.setItem(b, t)
                } catch (t) {
                }
            }(x = "" + (n = function () {
                return Math.floor((1 + Math.random()) * t).toString(e).substring(1)
            })() + n() + "-" + n() + "-" + n() + "-" + n() + "-" + n() + n() + n()), x);
            var t, e, n
        }
        var _, k = function () {
            return (k = Object.assign || function (t) {
                for (var e, n = 1, o = arguments.length; n < o; n++)
                    for (var r in e = arguments[n])
                        Object.prototype.hasOwnProperty.call(e, r) && (t[r] = e[r]);
                return t
            }).apply(this, arguments)
        },
                O = {
                    init: function (t) {
                        _ = t, O.captureEvent = j
                    },
                    captureEvent: function (t) {}
                };

        function j(t) {
            c() && v(_, k({}, t, {
                request: {
                    url: window.location.href,
                    headers: {
                        "User-Agent": window.navigator.userAgent
                    }
                },
                tags: [
                    ["uid", w()],
                    ["referrer", window.location.href]
                ].concat(t.tags || []),
                timestamp: (new Date).toISOString(),
                user: {
                    ip_address: "{{auto}}"
                }
            }))
        }
        var E, T, L = O;

        function C(t, e) {
            var n = document.createElement(t);
            return e && n.classList.add(e), n
        }
        !function (t) {
            t.sms = "sms", t.appointment = "appointment", t.reject = "reject"
        }(E || (E = {})),
                function (t) {
                    t.READY = "tinkoff/READY", t.CANCEL = "tinkoff/CANCEL", t.SUCCESS = "tinkoff/SUCCESS", t.REJECT = "tinkoff/REJECT", t.KEEP_ALIVE = "tinkoff/KEEP_ALIVE", t.SCROLL_TOP = "tinkoff/SCROLL_TOP", t.ERROR_RESUME = "tinkoff/ERROR_RESUME", t.RECALCULATE_HEIGHT = "tinkoff/RECALCULATE_HEIGHT"
                }(T || (T = {}));
        var S = n(6);

        function I(t) {
            var e = t.onClose,
                    n = t.iframeId,
                    o = t.confirmDisabled,
                    r = !(void 0 !== o && o),
                    i = function () {
                        if (!r)
                            return e();
                        confirm("Р’С‹ СѓРІРµСЂРµРЅС‹, С‡С‚Рѕ С…РѕС‚РёС‚Рµ Р·Р°РєРѕРЅС‡РёС‚СЊ Р·Р°РїРѕР»РЅРµРЅРёРµ?") && e()
                    },
                    a = C("div", S.root),
                    s = C("div", S.content),
                    l = C("div", S.cross);
            l.addEventListener("click", i);
            var c = function () {
                var t = window.document.createElement("div"),
                        e = t.style;
                e.display = "block", e.position = "absolute", e.width = "100px", e.height = "100px", e.left = "-999px", e.top = "-999px", e.overflow = "scroll", window.document.body.insertBefore(t, null);
                var n = t.clientWidth;
                if (0 === n)
                    return window.document.body.removeChild(t), null;
                var o = 100 - n;
                return window.document.body.removeChild(t), o
            }();
            c && (l.style.right = c + 16 + "px"), s.addEventListener("click", (function (t) {
                return t.stopPropagation()
            }));
            var u = getComputedStyle(document.body).overflow;
            document.body.style.overflow = "hidden", a.scrollTop = 0;
            var d, p, h, m = (d = function (t) {
                return 27 === t.keyCode ? i() : void 0
            }, p = i, (h = a).addEventListener("keydown", d), h.addEventListener("click", p), function () {
                h.removeEventListener("keydown", d), h.removeEventListener("click", p)
            }),
                    v = n ? f(n, (function (t) {
                        switch (t.type) {
                            case T.SCROLL_TOP:
                                a.scrollTo(0, 0);
                                break;
                            case T.REJECT:
                            case T.SUCCESS:
                            case T.CANCEL:
                                r = !1
                        }
                    })) : null;
            return document.body.appendChild(a), a.appendChild(s), a.appendChild(l), {
                append: function (t) {
                    s.insertAdjacentElement("afterbegin", t)
                },
                destroy: function () {
                    document.body.removeChild(a), document.body.style.overflow = u, l.removeEventListener("click", e), m(), v && v()
                }
            }
        }
        var P = n(10),
                N = n(11),
                R = function () {
                    function t(t, e) {
                        this.destroy = this.destroy.bind(this);
                        var n = t.validations && !function (t) {
                            for (var e in t)
                                if (t.hasOwnProperty(e))
                                    return !1;
                            return !0
                        }(t.validations) ? M(t.validations) : null;
                        this.modal = I({
                            onClose: this.destroy,
                            confirmDisabled: !0
                        }), this.modal.append(function (t, e, n) {
                            var o = C("div", P.root);
                            o.classList.add(N.content), e && e.length && o.appendChild(B("РћС€РёР±РєРё", e));
                            t && t.length && o.appendChild(B("РћС€РёР±РєРё РІ РїРѕР»СЏС… РѕР±СЉРµРєС‚Р°", t, Boolean(n)));
                            n && o.appendChild(A("Р”РѕРєСѓРјРµРЅС‚Р°С†РёСЏ", n));
                            return o
                        }(n, t.errors, e))
                    }
                    return t.prototype.destroy = function () {
                        this.modal && this.modal.destroy()
                    }, t
                }();

        function B(t, e, n) {
            var o = document.createDocumentFragment(),
                    r = C("h3");
            r.innerText = t, o.appendChild(r);
            var i = C("ul");
            return e.forEach((function (t) {
                var e = C("li");
                if (e.innerText = t, n) {
                    var o = t.split(":")[0];
                    e.innerText = e.innerText + ". ", e.appendChild(A("Р”РѕРєСѓРјРµРЅС‚Р°С†РёСЏ РїРѕР»СЏ", "https://forma.tinkoff.ru/docs/credit/help/methods/?type=script&method=createDemo#" + o))
                }
                i.appendChild(e)
            })), o.appendChild(i), o
        }

        function A(t, e) {
            var n = C("a");
            return n.innerText = t, n.setAttribute("href", e), n.setAttribute("target", "_blank"), n
        }

        function M(t, e) {
            if (!t)
                return null;
            var n = [];
            for (var o in t)
                if (t.hasOwnProperty(o)) {
                    var r = void 0 === e ? o : e + "." + o;
                    if ("object" == typeof t[o]) {
                        var i = M(t[o], r);
                        i && n.push.apply(n, i)
                    } else
                        n.push(r + ": " + t[o])
                }
            return n
        }
        var q = n(8);
        var F = function () {
            function t(t) {
                var e = t.url,
                        n = t.target,
                        o = t.frameId,
                        r = t.readyByLoad,
                        i = t.onReady;
                if (this._isDestroyed = !1, !e)
                    throw new Error("URL is required");
                if (this.url = e, this.frameId = o, this.destroy = this.destroy.bind(this), this._iframe = function (t, e, n, o) {
                    var r = !1;

                    function i() {
                        r || (r = !0, o(), a.style.minHeight = "", a.style.maxHeight = "")
                    }
                    var a = C("iframe", q.root);
                    n && (a.onload = i), a.setAttribute("style", "max-height: 0; min-height: auto;"), a.setAttribute("src", e), a.setAttribute("scrolling", "no");
                    var s = f(t, (function (t) {
                        t.type !== T.READY ? t.type === T.RECALCULATE_HEIGHT && (a.style.height = t.data.height + "px", r && requestAnimationFrame((function () {
                            a.classList.add(q.loaded)
                        }))) : i()
                    }));
                    return {
                        element: a,
                        destroy: function () {
                            a.parentNode && a.parentNode.removeChild(a), s()
                        }
                    }
                }(this.frameId, function (t, e) {
                    var n = new URL(t),
                            o = n.search ? n.search + "&" + e : "?" + e;
                    return "" + n.origin + n.pathname + o + n.hash
                }(e, "frameId=" + this.frameId), r, i), "string" != typeof n)
                    n.append(this._iframe.element);
                else {
                    var a = document.querySelector(n);
                    if (!a)
                        throw new Error("target element not found");
                    a.appendChild(this._iframe.element)
                }
            }
            return t.prototype.getElement = function () {
                return this._iframe.element
            }, t.prototype.destroy = function () {
                this._isDestroyed || (this._isDestroyed = !0, this._iframe.destroy())
            }, t
        }();
        var U = 0,
                z = function () {
                    function t(t) {
                        var e, n = t.url,
                                o = t.target,
                                r = t.getSkeleton,
                                i = t.readyByLoad,
                                a = void 0 === i || i;
                        this.frameId = "" + ++U, this._isDestroyed = !1, this.url = n, this.target = o, this.readyByLoad = a, this._skeleton = r ? r() : ((e = document.createElement("div")).innerHTML = '<p style="opacity: 0.3;">Р—Р°РіСЂСѓР·РєР°</p>', e.setAttribute("style", "width: 100%; height: 300px; display: flex; align-items: center; justify-content: center; background: white;"), {
                            element: e,
                            destroy: function () {
                                e.parentNode && e.parentNode.removeChild(e)
                            }
                        }), this.destroy = this.destroy.bind(this), o || (this._modal = I({
                            onClose: this.destroy,
                            iframeId: this.frameId
                        })), this.init()
                    }
                    return t.prototype.setUrl = function (t) {
                        if (this.url)
                            throw new Error("Component has already been initialized");
                        if (!t)
                            throw new Error("URL is required");
                        this.url = t, this._modal ? (this.initIframe(this._modal), this._modal.append(this._iframe.getElement())) : this.target && this.initIframe(this.target)
                    }, t.prototype.destroy = function () {
                        this._isDestroyed || (this._isDestroyed = !0, this._skeleton && this._skeleton.destroy(), this._iframe && this._iframe.destroy(), this._modal && this._modal.destroy())
                    }, t.prototype.init = function () {
                        if (this._modal)
                            this.url && (this.initIframe(this._modal), this._modal.append(this._iframe.getElement())), this._modal.append(this._skeleton.element);
                        else if (this.target) {
                            this.url && this.initIframe(this.target);
                            var t = document.querySelector(this.target);
                            t && t.appendChild(this._skeleton.element)
                        }
                    }, t.prototype.initIframe = function (t) {
                        var e = this;
                        this._iframe = new F({
                            url: this.url,
                            target: t,
                            frameId: this.frameId,
                            readyByLoad: this.readyByLoad,
                            onReady: function () {
                                return e._skeleton.destroy()
                            }
                        })
                    }, t
                }();
        var H = function (t, e) {
            var n = l.a;
            return v(n + "/online/application/create-no-redirect", t)
        };
        H.url = "/online/application/create-no-redirect";
        var Y = function (t, e) {
            var n = l.a;
            return v(n + "/online/application/create-demo", t)
        };
        Y.url = "/online/application/create-demo";
        var J = n(1);

        function D() {
            var t = C("div", J.root);
            return t.innerHTML = '<div class="' + J.logo + '"></div><div class="' + J.gamification + '"><div class="' + J.gamificationHeader + '"><p class="' + J.gamificationTitle + '"></p><p class="' + J.gamificationScore + '"></p></div><div class="' + J.gamificationProgress + '"></div><div class="' + J.gamificationFooter + '"><p class="' + J.gamificationProgressValue + '"></p><p class="' + J.gamificationProgressLabel + '"></p></div></div><div class="' + J.row + '"><p class="' + J.title + '"></p><div class="' + J.pageCount + '"></div></div><div class="' + J.form + '"><div class="' + J.fieldRow + '"><div class="' + J.inputSlider + '"></div><div class="' + J.inputSlider + '"></div></div><div class="' + J.paymentInfo + '"></div><p class="' + J.title + '"></p><div class="' + J.input + '"></div><div class="' + J.fieldRow + '"><div class="' + J.input + '"></div><div class="' + J.input + '"></div></div><div class="' + J.actions + '"><div class="' + J.userAgreement + '"></div><div class="' + J.button + '"></div></div></div><div class="' + J.island + '"><p class="' + J.islandHeader + '"></p><div class="' + J.islandContent + '"></div></div>', t.addEventListener("DOMNodeInserted", (function () {
                t.offsetWidth < 600 && t.classList.add(J.mobile)
            }), !1), {
                element: t,
                destroy: function () {
                    t.parentNode && t.parentNode.removeChild(t)
                }
            }
        }
        var K = new RegExp("^(https?:\\/\\/)?((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|((\\d{1,3}\\.){3}\\d{1,3}))(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*(\\?[;&a-z\\d%_.~+=-]*)?(\\#.*)?$", "i"),
                Z = "Р—РЅР°С‡РµРЅРёРµ РґРѕР»Р¶РЅРѕ Р±С‹С‚СЊ СЃС‚СЂРѕРєРѕР№ СЃ Р°Р±СЃРѕР»СЋС‚РЅРѕР№ СЃСЃС‹Р»РєРѕР№ РЅР° СЃР°Р№С‚",
                W = Object(i.object)({
            sum: Object(i.number)().required().eqeq(),
            items: Object(i.array)(Object(i.object)({
                price: Object(i.number)().required().eqeq(),
                quantity: Object(i.number)().required().eqeq(),
                name: Object(i.string)().required().max(255),
                vendorCode: Object(i.string)().max(64),
                category: Object(i.string)().max(255)
            })).required().min(1),
            shopId: Object(i.string)().required().max(50),
            showCaseId: Object(i.string)().max(50),
            promoCode: Object(i.string)().max(256),
            orderNumber: Object(i.string)().max(64),
            demoFlow: i.enumType.apply(void 0, Object.keys(E)),
            initialStage: Object(i.string)(),
            webhookURL: Object(i.string)().match(K),
            failURL: Object(i.string)().match(K),
            successURL: Object(i.string)().match(K),
            returnURL: Object(i.string)().match(K)
        });

        function X(t, e) {
            var n = e.price,
                    o = e.quantity;
            return t + Number(n) * Number(o)
        }
        var V = Object(i.object)({
            contact: Object(i.object)({
                fio: Object(i.object)({
                    firstName: Object(i.string)().required(),
                    lastName: Object(i.string)().required(),
                    middleName: Object(i.string)()
                }),
                mobilePhone: Object(i.string)().match(/^(8|\+7|7)?([ \-()]*\d){10}$/),
                email: Object(i.string)()
            })
        });
        n(26);
        var Q, G, $, tt = function () {
            return (tt = Object.assign || function (t) {
                for (var e, n = 1, o = arguments.length; n < o; n++)
                    for (var r in e = arguments[n])
                        Object.prototype.hasOwnProperty.call(e, r) && (t[r] = e[r]);
                return t
            }).apply(this, arguments)
        };
        Object(i.setLocale)(s.a), l.b && (c() && (Q = (G = [], $ = document.querySelectorAll("script"), $.length ? ($.forEach((function (t) {
            G.push(t.src)
        })), G) : G).filter((function (t) {
            return "https://static2.tinkoff.ru/forma/analytics/onlineScript.js" === t
        }))), L.init(l.b));
        var et = new h,
                nt = [],
                ot = {
                    appPath: null,
                    apiRoot: null,
                    create: function (t, e) {
                        return rt(H, t, e)
                    },
                    createDemo: function (t, e) {
                        return rt(Y, tt({
                            demoFlow: E.sms
                        }, t), e)
                    },
                    createLink: function (t) {
                        return it(H, t)
                    },
                    createDemoLink: function (t) {
                        return it(Y, tt({
                            demoFlow: E.sms
                        }, t))
                    },
                    methods: {
                        destroyAll: function () {
                            nt.forEach((function (t) {
                                t.iframe.destroy(), t.unsubscribe()
                            })), nt.length = 0
                        },
                        renderIframe: function (t, e, n) {
                            var o = (void 0 === n ? {} : n).getSkeleton,
                                    r = new z({
                                        url: t,
                                        target: e,
                                        getSkeleton: o,
                                        readyByLoad: !1
                                    });
                            return nt.push({
                                iframe: r,
                                unsubscribe: f(r.frameId, (function (t) {
                                    var e = t.type,
                                            n = t.data;
                                    return et.dispatch({
                                        type: e,
                                        payload: n,
                                        meta: {
                                            iframe: r
                                        }
                                    })
                                }))
                            }), r
                        },
                        on: function (t, e) {
                            return et.on({
                                type: t,
                                listener: e
                            })
                        },
                        off: function (t, e) {
                            return et.off({
                                type: t,
                                listener: e
                            })
                        }
                    },
                    constants: tt({}, T)
                };

        function rt(t, e, n) {
            void 0 === n && (n = {
                view: "modal"
            });
            var o = [];
            var r = at(t, e, (function () {
                o.forEach((function (t) {
                    return t()
                }))
            }));
            if (r instanceof R)
                return Promise.reject(r);
            var i = n.view;
            switch (i) {
                case "self":
                case "newTab":
                    var a = "newTab" === i ? window.open() : window;
                    return r.then((function (t) {
                        return a.location.assign(t), null
                    })).catch((function (t) {
                        return window !== a && a.close(), Promise.reject(t)
                    }));
                case "iframe":
                case "modal":
                default:
                    var s = n.target,
                            l = ot.methods.renderIframe("", s, {
                                getSkeleton: D
                            });
                    return o.push(l.destroy), r.then((function (t) {
                        return l.setUrl(t)
                    })).catch(l.destroy), Promise.resolve(l)
            }
        }

        function it(t, e) {
            var n = at(t, e);
            return n instanceof R ? Promise.reject(n) : n
        }

        function at(t, e, n) {
            var o = t === Y ? "https://forma.tinkoff.ru/docs/credit/button/" : void 0,
                    i = function (t) {
                        if (!t)
                            return null;
                        var e = (t.contact || {}).mobilePhone;
                        if (e)
                            return tt({}, t, {
                                contact: tt({}, t.contact, {
                                    mobilePhone: st(e)
                                })
                            });
                        return t
                    }(e.values),
                    a = function (t) {
                        var e = W.validate(t);
                        return e ? (e.failURL && (e.failURL = Z), e.successURL && (e.successURL = Z), e.returnURL && (e.returnURL = Z)) : t.items.reduce(X, 0) !== Number(t.sum) && (e = {
                            sum: "РЎСѓРјРјР° СЃС‚РѕРёРјРѕСЃС‚РµР№ С‚РѕРІР°СЂРѕРІ РЅРµ СЃРѕРІРїР°РґР°РµС‚ СЃ РѕР±С‰РµР№ СЃСѓРјРјРѕР№"
                        }), e ? {
                            validations: e,
                            errors: null
                        } : null
                    }(e) || function (t) {
                if (!t)
                    return null;
                var e = V.validate(t);
                return e ? {
                    validations: e,
                    errors: null
                } : null
            }(i);
            if (Q && Q.length > 0 && L.captureEvent({
                message: "OLD_STATIC_USAGE вЂ“ " + window.location.origin,
                level: "info",
                tags: [
                    ["product", "online"]
                ],
                extra: {
                    sources: Q
                }
            }), a)
                return L.captureEvent({
                    message: window.location.hostname + " " + t.url + ": Error validation",
                    level: "error",
                    tags: [
                        ["url", t.url]
                    ],
                    extra: {
                        params: e,
                        errors: a.errors,
                        validations: a.validations
                    }
                }), new R(a, o);
            var s = r()();
            return t(tt({
                integrationType: "script"
            }, e, {
                values: i || void 0,
                showcaseId: e.showcaseId || e.shopId,
                meta: {
                    fingerprint: s,
                    url: window.location.href
                }
            }), ot.apiRoot).then(lt).catch((function (r) {
                return n && n(), Promise.reject(function (t, e, n, o) {
                    var r = t.data,
                            i = t.response,
                            a = i && i.headers.get("Content-Type");
                    if (!r || !i || a && -1 === a.indexOf("application/json"))
                        return L.captureEvent({
                            message: window.location.hostname + " " + e.url + ": Backend error",
                            level: "info",
                            tags: [
                                ["url", e.url]
                            ],
                            extra: {
                                params: n,
                                response: i,
                                data: r
                            }
                        }), new R({
                            errors: ["Р§С‚Рѕ-С‚Рѕ РїРѕС€Р»Рѕ РЅРµ С‚Р°Рє, РїРѕРїСЂРѕР±СѓР№С‚Рµ РїРѕР·Р¶Рµ"]
                        });
                    return L.captureEvent({
                        message: window.location.hostname + " " + e.url + ": Backend validation error",
                        level: "error",
                        tags: [
                            ["url", e.url]
                        ],
                        extra: {
                            params: n,
                            response: i,
                            errors: r.errors,
                            validations: r.validations
                        }
                    }), new R(r, o)
                }(r, t, e, o))
            }))
        }

        function st(t) {
            return t.replace(/\D/g, "").slice(-10)
        }

        function lt(t) {
            return t.link
        }
        var ct = ot;
        window.tinkoff = ct
    }]);