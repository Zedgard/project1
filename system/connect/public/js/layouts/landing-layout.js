(window.webpackJsonp=window.webpackJsonp||[]).push([[102],{"/MoV":function(t,e,n){"use strict";n.d(e,"c",(function(){return u})),n.d(e,"f",(function(){return s})),n.d(e,"d",(function(){return c})),n.d(e,"a",(function(){return l})),n.d(e,"g",(function(){return d})),n.d(e,"e",(function(){return f})),n.d(e,"b",(function(){return p}));var r=n("g6NE"),o=r.a.getters["config/configs"],i=r.a.getters["config/vars"],a=function(){return{timezone:o.system.timezone,defaultDateFormat:i.defaultDateFormat,defaultDateTimeFormat:i.defaultDateTimeFormat,serverDateFormat:i.serverDateFormat,serverDateTimeFormat:i.serverDateTimeFormat,calendarLocale:{sameDay:i.defaultTimeFormat,lastWeek:i.defaultDateFormat,sameElse:i.defaultDateFormat}}},u=function(t,e){var n=a(),r=moment(t,n.serverDateFormat);return t?(Array.isArray(t)&&(r=moment(t[0],t[1])),r.format(e||n.defaultDateFormat)):"INVALID DATE STRING"},s=function(t,e){var n=a(),r=moment(t,n.serverTimeFormat);return t?(Array.isArray(t)&&(r=moment(t[0],t[1])),r.format(e||n.defaultTimeFormat)):"INVALID TIME STRING"},c=function(t,e){var n=a(),r=moment(t,n.serverDateTimeFormat);return t?(Array.isArray(t)&&(r=moment(t[0],t[1])),r.format(e||n.defaultDateTimeFormat)):"INVALID DATE TIME STRING"},l=function(t,e){var n=a(),r=moment(t,n.serverDateTimeFormat);return t?(Array.isArray(t)&&(r=moment(t[0],t[1])),r.calendar(e||n.calendarLocale)):"INVALID DATE TIME STRING"},d=function(t,e,n){var r=a(),o=moment.utc("".concat(moment().format(r.serverDateFormat)," ").concat(t),r.serverTimeFormat);return t?(Array.isArray(t)&&(o=moment.utc(t[0],t[1])),o.tz(n||r.timezone).format(e||r.defaultTimeFormat)):"INVALID TIME STRING"},f=function(t,e,n){var r=a(),o=moment.utc(t,r.serverDateTimeFormat);return t?(Array.isArray(t)&&(o=moment.utc(t[0],t[1])),o.tz(n||r.timezone).format(e||r.defaultDateTimeFormat)):"INVALID DATE TIME STRING"},p=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,r=a(),o=moment.utc(t,r.serverDateTimeFormat);if(!t)return"INVALID DATE TIME STRING";Array.isArray(t)&&(o=moment.utc(t[0],t[1]));var i=o.tz(n||r.timezone);return i=i.calendar(e||r.calendarLocale)}},"711M":function(t,e,n){(t.exports=n("I1BE")(!1)).push([t.i,".landing-layout{width:100%;min-height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;position:relative}",""])},BcCH:function(t,e,n){"use strict";var r=n("XuX8"),o=new(n.n(r).a);e.a=o},Ghjc:function(t,e,n){var r=n("711M");"string"==typeof r&&(r=[[t.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(r,o);r.locals&&(t.exports=r.locals)},OCip:function(t,e,n){"use strict";n.d(e,"a",(function(){return p}));var r=n("xjcK"),o=n("3LMw"),i=n("Io6r"),a=n("pddH"),u=n("vika"),s=n("Iyau"),c=n("ex6f"),l=n("jfhb"),d=o.a.extend({name:r.ab,props:{title:{type:String},target:{type:[String,a.b,a.c,Function,Object],required:!0},triggers:{type:[String,Array],default:"hover focus"},placement:{type:String,default:"top"},fallbackPlacement:{type:[String,Array],default:"flip",validator:function(t){return Object(c.a)(t)&&t.every((function(t){return Object(c.l)(t)}))||Object(s.a)(["flip","clockwise","counterclockwise"],t)}},variant:{type:String,default:function(){return Object(i.a)(r.ab,"variant")}},customClass:{type:String,default:function(){return Object(i.a)(r.ab,"customClass")}},delay:{type:[Number,Object,String],default:function(){return Object(i.a)(r.ab,"delay")}},boundary:{type:[String,a.b,Object],default:function(){return Object(i.a)(r.ab,"boundary")}},boundaryPadding:{type:[Number,String],default:function(){return Object(i.a)(r.ab,"boundaryPadding")}},offset:{type:[Number,String],default:0},noFade:{type:Boolean,default:!1},container:{type:[String,a.b,Object]},show:{type:Boolean,default:!1},noninteractive:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},id:{type:String}},data:function(){return{localShow:this.show,localTitle:"",localContent:""}},computed:{templateData:function(){return{title:this.localTitle,content:this.localContent,target:this.target,triggers:this.triggers,placement:this.placement,fallbackPlacement:this.fallbackPlacement,variant:this.variant,customClass:this.customClass,container:this.container,boundary:this.boundary,boundaryPadding:this.boundaryPadding,delay:this.delay,offset:this.offset,noFade:this.noFade,interactive:!this.noninteractive,disabled:this.disabled,id:this.id}},templateTitleContent:function(){return{title:this.title,content:this.content}}},watch:{show:function(t,e){t!==e&&t!==this.localShow&&this.$_toolpop&&(t?this.$_toolpop.show():this.$_toolpop.forceHide())},disabled:function(t){t?this.doDisable():this.doEnable()},localShow:function(t){this.$emit("update:show",t)},templateData:function(){var t=this;this.$nextTick((function(){t.$_toolpop&&t.$_toolpop.updateData(t.templateData)}))},templateTitleContent:function(){this.$nextTick(this.updateContent)}},created:function(){this.$_toolpop=null},updated:function(){this.$nextTick(this.updateContent)},beforeDestroy:function(){this.$off("open",this.doOpen),this.$off("close",this.doClose),this.$off("disable",this.doDisable),this.$off("enable",this.doEnable),this.$_toolpop&&(this.$_toolpop.$destroy(),this.$_toolpop=null)},mounted:function(){var t=this;this.$nextTick((function(){var e=t.getComponent();t.updateContent();var n=Object(u.a)(t)||Object(u.a)(t.$parent),r=t.$_toolpop=new e({parent:t,_scopeId:n||void 0});r.updateData(t.templateData),r.$on("show",t.onShow),r.$on("shown",t.onShown),r.$on("hide",t.onHide),r.$on("hidden",t.onHidden),r.$on("disabled",t.onDisabled),r.$on("enabled",t.onEnabled),t.disabled&&t.doDisable(),t.$on("open",t.doOpen),t.$on("close",t.doClose),t.$on("disable",t.doDisable),t.$on("enable",t.doEnable),t.localShow&&r.show()}))},methods:{getComponent:function(){return l.a},updateContent:function(){this.setTitle(this.$scopedSlots.default||this.title)},setTitle:function(t){t=Object(c.n)(t)?"":t,this.localTitle!==t&&(this.localTitle=t)},setContent:function(t){t=Object(c.n)(t)?"":t,this.localContent!==t&&(this.localContent=t)},onShow:function(t){this.$emit("show",t),t&&(this.localShow=!t.defaultPrevented)},onShown:function(t){this.localShow=!0,this.$emit("shown",t)},onHide:function(t){this.$emit("hide",t)},onHidden:function(t){this.$emit("hidden",t),this.localShow=!1},onDisabled:function(t){t&&"disabled"===t.type&&(this.$emit("update:disabled",!0),this.$emit("disabled",t))},onEnabled:function(t){t&&"enabled"===t.type&&(this.$emit("update:disabled",!1),this.$emit("enabled",t))},doOpen:function(){!this.localShow&&this.$_toolpop&&this.$_toolpop.show()},doClose:function(){this.localShow&&this.$_toolpop&&this.$_toolpop.hide()},doDisable:function(){this.$_toolpop&&this.$_toolpop.disable()},doEnable:function(){this.$_toolpop&&this.$_toolpop.enable()}},render:function(t){return t()}}),f=n("JjLx"),p=o.a.extend({name:r.H,extends:d,inheritAttrs:!1,props:{title:{type:String},content:{type:String},triggers:{type:[String,Array],default:"click"},placement:{type:String,default:"right"},variant:{type:String,default:function(){return Object(i.a)(r.H,"variant")}},customClass:{type:String,default:function(){return Object(i.a)(r.H,"customClass")}},delay:{type:[Number,Object,String],default:function(){return Object(i.a)(r.H,"delay")}},boundary:{type:[String,a.b,Object],default:function(){return Object(i.a)(r.H,"boundary")}},boundaryPadding:{type:[Number,String],default:function(){return Object(i.a)(r.H,"boundaryPadding")}}},methods:{getComponent:function(){return f.a},updateContent:function(){this.setContent(this.$scopedSlots.default||this.content),this.setTitle(this.$scopedSlots.title||this.title)}}})},SokU:function(t,e,n){t.exports=function(t){function e(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,e),o.l=!0,o.exports}var n={};return e.m=t,e.c=n,e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:r})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="/",e(e.s=9)}([function(t,e){var n=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=n)},function(t,e){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,e,n){t.exports=!n(3)((function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}))},function(t,e){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,e){var n=t.exports={version:"2.5.1"};"number"==typeof __e&&(__e=n)},function(t,e,n){var r=n(6),o=n(7);t.exports=function(t){return r(o(t))}},function(t,e,n){var r=n(30);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,e){t.exports=function(t){if(null==t)throw TypeError("Can't call method on  "+t);return t}},function(t,e){var n=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:n)(t)}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.Avatar=void 0;var r=function(t){return t&&t.__esModule?t:{default:t}}(n(10));e.Avatar=r.default,e.default=r.default},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(12),o=n.n(r),i=n(41),a=n(11)(o.a,i.a,!1,null,null,null);e.default=a.exports},function(t,e){t.exports=function(t,e,n,r,o,i){var a,u=t=t||{},s=typeof t.default;"object"!==s&&"function"!==s||(a=t,u=t.default);var c,l="function"==typeof u?u.options:u;if(e&&(l.render=e.render,l.staticRenderFns=e.staticRenderFns,l._compiled=!0),n&&(l.functional=!0),o&&(l._scopeId=o),i?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},l._ssrRegister=c):r&&(c=r),c){var d=l.functional,f=d?l.render:l.beforeCreate;d?(l._injectStyles=c,l.render=function(t,e){return c.call(e),f(t,e)}):l.beforeCreate=f?[].concat(f,c):[c]}return{esModule:a,exports:u,options:l}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=function(t){return t&&t.__esModule?t:{default:t}}(n(13));e.default={name:"avatar",props:{username:{type:String},initials:{type:String},backgroundColor:{type:String},color:{type:String},customStyle:{type:Object},inline:{type:Boolean},size:{type:Number,default:50},src:{type:String},rounded:{type:Boolean,default:!0},lighten:{type:Number,default:80}},data:function(){return{backgroundColors:["#F44336","#FF4081","#9C27B0","#673AB7","#3F51B5","#2196F3","#03A9F4","#00BCD4","#009688","#4CAF50","#8BC34A","#CDDC39","#FFC107","#FF9800","#FF5722","#795548","#9E9E9E","#607D8B"],imgError:!1}},mounted:function(){this.isImage||this.$emit("avatar-initials",this.username,this.userInitial)},computed:{background:function(){if(!this.isImage)return this.backgroundColor||this.randomBackgroundColor(this.username.length,this.backgroundColors)},fontColor:function(){if(!this.isImage)return this.color||this.lightenColor(this.background,this.lighten)},isImage:function(){return!this.imgError&&Boolean(this.src)},style:function(){var t={display:this.inline?"inline-flex":"flex",width:this.size+"px",height:this.size+"px",borderRadius:this.rounded?"50%":0,lineHeight:this.size+Math.floor(this.size/20)+"px",fontWeight:"bold",alignItems:"center",justifyContent:"center",textAlign:"center",userSelect:"none"},e={background:"transparent url('"+this.src+"') no-repeat scroll 0% 0% / "+this.size+"px "+this.size+"px content-box border-box"},n={backgroundColor:this.background,font:Math.floor(this.size/2.5)+"px/"+this.size+"px Helvetica, Arial, sans-serif",color:this.fontColor},o=this.isImage?e:n;return(0,r.default)(t,o),t},userInitial:function(){return this.isImage?"":this.initials||this.initial(this.username)}},methods:{initial:function(t){for(var e=t.split(/[ -]/),n="",r=0;r<e.length;r++)n+=e[r].charAt(0);return n.length>3&&-1!==n.search(/[A-Z]/)&&(n=n.replace(/[a-z]+/g,"")),n.substr(0,3).toUpperCase()},onImgError:function(t){this.imgError=!0},randomBackgroundColor:function(t,e){return e[t%e.length]},lightenColor:function(t,e){var n=!1;"#"===t[0]&&(t=t.slice(1),n=!0);var r=parseInt(t,16),o=(r>>16)+e;o>255?o=255:o<0&&(o=0);var i=(r>>8&255)+e;i>255?i=255:i<0&&(i=0);var a=(255&r)+e;return a>255?a=255:a<0&&(a=0),(n?"#":"")+(a|i<<8|o<<16).toString(16)}}}},function(t,e,n){t.exports={default:n(14),__esModule:!0}},function(t,e,n){n(15),t.exports=n(4).Object.assign},function(t,e,n){var r=n(16);r(r.S+r.F,"Object",{assign:n(26)})},function(t,e,n){var r=n(0),o=n(4),i=n(17),a=n(19),u=function(t,e,n){var s,c,l,d=t&u.F,f=t&u.G,p=t&u.S,h=t&u.P,m=t&u.B,v=t&u.W,b=f?o:o[e]||(o[e]={}),g=b.prototype,y=f?r:p?r[e]:(r[e]||{}).prototype;for(s in f&&(n=e),n)(c=!d&&y&&void 0!==y[s])&&s in b||(l=c?y[s]:n[s],b[s]=f&&"function"!=typeof y[s]?n[s]:m&&c?i(l,r):v&&y[s]==l?function(t){var e=function(e,n,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(e);case 2:return new t(e,n)}return new t(e,n,r)}return t.apply(this,arguments)};return e.prototype=t.prototype,e}(l):h&&"function"==typeof l?i(Function.call,l):l,h&&((b.virtual||(b.virtual={}))[s]=l,t&u.R&&g&&!g[s]&&a(g,s,l)))};u.F=1,u.G=2,u.S=4,u.P=8,u.B=16,u.W=32,u.U=64,u.R=128,t.exports=u},function(t,e,n){var r=n(18);t.exports=function(t,e,n){if(r(t),void 0===e)return t;switch(n){case 1:return function(n){return t.call(e,n)};case 2:return function(n,r){return t.call(e,n,r)};case 3:return function(n,r,o){return t.call(e,n,r,o)}}return function(){return t.apply(e,arguments)}}},function(t,e){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,e,n){var r=n(20),o=n(25);t.exports=n(2)?function(t,e,n){return r.f(t,e,o(1,n))}:function(t,e,n){return t[e]=n,t}},function(t,e,n){var r=n(21),o=n(22),i=n(24),a=Object.defineProperty;e.f=n(2)?Object.defineProperty:function(t,e,n){if(r(t),e=i(e,!0),r(n),o)try{return a(t,e,n)}catch(t){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},function(t,e,n){var r=n(1);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,e,n){t.exports=!n(2)&&!n(3)((function(){return 7!=Object.defineProperty(n(23)("div"),"a",{get:function(){return 7}}).a}))},function(t,e,n){var r=n(1),o=n(0).document,i=r(o)&&r(o.createElement);t.exports=function(t){return i?o.createElement(t):{}}},function(t,e,n){var r=n(1);t.exports=function(t,e){if(!r(t))return t;var n,o;if(e&&"function"==typeof(n=t.toString)&&!r(o=n.call(t)))return o;if("function"==typeof(n=t.valueOf)&&!r(o=n.call(t)))return o;if(!e&&"function"==typeof(n=t.toString)&&!r(o=n.call(t)))return o;throw TypeError("Can't convert object to primitive value")}},function(t,e){t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},function(t,e,n){"use strict";var r=n(27),o=n(38),i=n(39),a=n(40),u=n(6),s=Object.assign;t.exports=!s||n(3)((function(){var t={},e={},n=Symbol(),r="abcdefghijklmnopqrst";return t[n]=7,r.split("").forEach((function(t){e[t]=t})),7!=s({},t)[n]||Object.keys(s({},e)).join("")!=r}))?function(t,e){for(var n=a(t),s=arguments.length,c=1,l=o.f,d=i.f;s>c;)for(var f,p=u(arguments[c++]),h=l?r(p).concat(l(p)):r(p),m=h.length,v=0;m>v;)d.call(p,f=h[v++])&&(n[f]=p[f]);return n}:s},function(t,e,n){var r=n(28),o=n(37);t.exports=Object.keys||function(t){return r(t,o)}},function(t,e,n){var r=n(29),o=n(5),i=n(31)(!1),a=n(34)("IE_PROTO");t.exports=function(t,e){var n,u=o(t),s=0,c=[];for(n in u)n!=a&&r(u,n)&&c.push(n);for(;e.length>s;)r(u,n=e[s++])&&(~i(c,n)||c.push(n));return c}},function(t,e){var n={}.hasOwnProperty;t.exports=function(t,e){return n.call(t,e)}},function(t,e){var n={}.toString;t.exports=function(t){return n.call(t).slice(8,-1)}},function(t,e,n){var r=n(5),o=n(32),i=n(33);t.exports=function(t){return function(e,n,a){var u,s=r(e),c=o(s.length),l=i(a,c);if(t&&n!=n){for(;c>l;)if((u=s[l++])!=u)return!0}else for(;c>l;l++)if((t||l in s)&&s[l]===n)return t||l||0;return!t&&-1}}},function(t,e,n){var r=n(8),o=Math.min;t.exports=function(t){return t>0?o(r(t),9007199254740991):0}},function(t,e,n){var r=n(8),o=Math.max,i=Math.min;t.exports=function(t,e){return(t=r(t))<0?o(t+e,0):i(t,e)}},function(t,e,n){var r=n(35)("keys"),o=n(36);t.exports=function(t){return r[t]||(r[t]=o(t))}},function(t,e,n){var r=n(0),o=r["__core-js_shared__"]||(r["__core-js_shared__"]={});t.exports=function(t){return o[t]||(o[t]={})}},function(t,e){var n=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++n+r).toString(36))}},function(t,e){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,e){e.f=Object.getOwnPropertySymbols},function(t,e){e.f={}.propertyIsEnumerable},function(t,e,n){var r=n(7);t.exports=function(t){return Object(r(t))}},function(t,e,n){"use strict";var r={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vue-avatar--wrapper",style:[t.style,t.customStyle],attrs:{"aria-hidden":"true"}},[this.isImage?n("img",{staticStyle:{display:"none"},attrs:{src:this.src},on:{error:t.onImgError}}):t._e(),t._v(" "),n("span",{directives:[{name:"show",rawName:"v-show",value:!this.isImage,expression:"!this.isImage"}]},[t._v(t._s(t.userInitial))])])},staticRenderFns:[]};e.a=r}])},akQX:function(t,e,n){"use strict";n.d(e,"a",(function(){return c})),n.d(e,"e",(function(){return l})),n.d(e,"c",(function(){return p})),n.d(e,"b",(function(){return h})),n.d(e,"d",(function(){return m}));var r=n("V0LQ");navigator.mediaDevices&&navigator.mediaDevices.getUserMedia||alert($t("misc.get_user_media_not_supported")),navigator.mediaDevices&&navigator.mediaDevices.enumerateDevices&&(navigator.enumerateDevices=function(t){navigator.mediaDevices.enumerateDevices().then(t)});var o="https:"===location.protocol,i=[],a=!1;("undefined"!=typeof MediaStreamTrack&&"getSources"in MediaStreamTrack||navigator.mediaDevices&&navigator.mediaDevices.enumerateDevices)&&(a=!0);var u={hasMicrophone:!1,hasWebcam:!1,isMicrophoneAlreadyCaptured:!1,isWebcamAlreadyCaptured:!1,permissionError:!0},s=function(t){a&&(!navigator.enumerateDevices&&window.MediaStreamTrack&&window.MediaStreamTrack.getSources&&(navigator.enumerateDevices=window.MediaStreamTrack.getSources.bind(window.MediaStreamTrack)),!navigator.enumerateDevices&&navigator.enumerateDevices&&(navigator.enumerateDevices=navigator.enumerateDevices.bind(navigator)),navigator.enumerateDevices?(i=[],navigator.enumerateDevices((function(e){e.forEach((function(t){var e,n={};for(var r in t)n[r]=t[r];"audio"===n.kind&&(n.kind="audioinput"),"video"===n.kind&&(n.kind="videoinput"),i.forEach((function(t){t.id===n.id&&t.kind===n.kind&&(e=!0)})),e||(n.deviceId||(n.deviceId=n.id),n.id||(n.id=n.deviceId),n.label?("videoinput"!==n.kind||u.isWebcamAlreadyCaptured||(u.isWebcamAlreadyCaptured=!0),"audioinput"!==n.kind||u.isMicrophoneAlreadyCaptured||(u.isMicrophoneAlreadyCaptured=!0)):(n.label="Please invoke getUserMedia once.",o||(n.label="HTTPs is required to get label of this "+n.kind+" device.")),"audioinput"===n.kind&&(u.hasMicrophone=!0),"videoinput"===n.kind&&(u.hasWebcam=!0),i.push(n))})),t&&t(u)}))):t&&t(u))},c=function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0],e=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];s((function(n){if(n){var r=!1;t&&!n.hasMicrophone&&(r=!0),e&&!n.hasWebcam&&(r=!0),r&&d(n)}}))},l=function(t){var e={icon:"error",footer:$t("misc.solve_and_refresh")};if(t)return"NotAllowedError"===t.name||"PermissionDeniedError"===t.name?(e.title=$t("misc.media.permission_denied"),e.text=$t("misc.media.permission_denied_text")):"NotFoundError"===t.name?(e.title=$t("misc.media.not_found"),e.text=$t("misc.media.not_found_text")):"NotReadableError"===t.name?(e.title=$t("misc.media.unreadable"),e.text=$t("misc.media.unreadable_text")):"SecurityError"!==t.name&&"TypeError"!==t.name||(e.title=$t("misc.media.security"),e.text=$t("misc.media.security_text")),swtAlert.fire(e),e},d=function(t){var e=[];t.hasMicrophone||e.push("Microphone"),t.hasWebcam||e.push("WebCam");var n={icon:"error",title:$t("misc.media.missing"),text:$t("misc.media.missing_text",{attribute:e.join(", ")}),footer:$t("misc.solve_and_refresh")};swtAlert.fire(n)},f=function(t){if((t=Object.assign({},{type:null,loop:!1,duration:1e3},t)).type){var e=new Audio;return e.preload="auto",e.autoplay=!0,e.loop=t.loop,e.src="/sound/".concat(t.type,".mp3"),e.play().then((function(){setTimeout((function(){e&&e.pause()}),t.duration)})).catch((function(t){console.error(t)})),e}},p=function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];if(!document.hasFocus()||t)return f({type:"calling",loop:!0,duration:3e4})},h=function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];if(!document.hasFocus()||t)return f({type:"message",duration:3e3})},m=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=arguments.length>1?arguments[1]:void 0,n=document.querySelector("link[rel=canonical]")?document.querySelector("link[rel=canonical]").href:document.location.href,o=t.url?t.url:n;if(navigator.share)navigator.share({title:t.title?t.title:document.title,url:o}).then((function(){console.log("Thanks for sharing!")})).catch(console.error);else{var i={showCancelButton:!0,confirmButtonText:$t("misc.share_alert.confirm_btn"),cancelButtonText:$t("misc.share_alert.cancel_btn")};t.alertTitle&&(i.title=t.alertTitle),t.alertHtml?i.html=t.alertHtml:i.text=$t("misc.share_alert.text"),swtAlert.fire(i).then((function(t){t.value&&(Object(r.b)(o),setTimeout((function(){e()}),500))}))}}},"dX/l":function(t,e,n){"use strict";var r=n("Ghjc");n.n(r).a},enb3:function(t,e,n){"use strict";n.r(e);n("QNWA");var r={},o=(n("dX/l"),n("KHd+")),i=Object(o.a)(r,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"landing-layout"},[e("transition-page",[e("router-view")],1)],1)}),[],!1,null,null,null);e.default=i.exports}}]);
//# sourceMappingURL=landing-layout.js.map?id=86953603a5cec52c1355