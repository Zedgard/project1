(window.webpackJsonp=window.webpackJsonp||[]).push([[93],{CJTH:function(t,e,o){"use strict";var r={props:["footerCredit","version"]},s=(o("b9rR"),o("KHd+")),n=Object(s.a)(r,(function(){var t=this.$createElement,e=this._self._c||t;return e("footer",{staticClass:"guest-footer mt-2"},[e("p",{staticClass:"text-center text-white mb-0 py-3"},[this._v(this._s(this.footerCredit)+" "+this._s(this.$t("product.version"))+" "+this._s(this.version))])])}),[],!1,null,"739170b9",null);e.a=n.exports},DzPO:function(t,e,o){(e=t.exports=o("I1BE")(!1)).push([t.i,"@import url(https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900);",""]),e.push([t.i,".centered-box[data-v-7eb15e32]{flex-direction:column;width:90vw;margin:0 auto}.centered-box[data-v-7eb15e32],.powered-logo[data-v-7eb15e32]{display:flex;justify-content:center}.powered-logo[data-v-7eb15e32]{align-items:center;font-size:.8rem}.powered-logo span[data-v-7eb15e32]{line-height:10px}.powered-logo img[data-v-7eb15e32]{width:80px;margin-left:8px}@media (min-width:768px){.centered-box[data-v-7eb15e32]{width:400px}.centered-box.width-sm[data-v-7eb15e32]{width:350px}.centered-box.width-md[data-v-7eb15e32]{width:450px}.centered-box.width-xl[data-v-7eb15e32]{width:500px}.centered-box.width-xxl[data-v-7eb15e32]{width:550px}.centered-box.width-xxxl[data-v-7eb15e32]{width:600px}}",""])},WK6j:function(t,e,o){"use strict";var r=o("L2JU"),s=o("kUDz"),n=o("l7An"),i=o("CJTH");function a(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function c(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?a(Object(o),!0).forEach((function(e){l(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):a(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}function l(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}e.a={components:{Box:s.a,GuestHeader:n.a,GuestFooter:i.a},data:function(){return{formData:{},formErrors:{},initialFormData:null,initianLength:0,emptyFormData:null,preRequisite:{},isLoading:!0,icons:{facebook:"fab fa-facebook-f",twitter:"fab fa-twitter",github:"fab fa-github",google:"fab fa-google"},btns:{facebook:"btn-facebook",twitter:"btn-twitter",github:"btn-github",google:"btn-google-plus"}}},computed:c(c({},Object(r.c)("config",["configs","vars"])),Object(r.c)("user",["twoFactorSet","hasRole"])),methods:c(c(c({},Object(r.b)("config",["GetConfig"])),Object(r.b)("user",["Register","SetCSRF","Logout","Login","LoginUsingOtp","ResetTwoFactorSet","RequestReset","ValidateResetPassword","ResetPassword","CheckTwoFactorCode"])),{},{withQuery:function(t){var e=this.$route.query;return e&&e.ref&&(t.query={ref:e.ref}),t}}),mounted:function(){this.initialFormData=_.cloneDeep(this.formData),this.isLoading=!1},beforeDestroy:function(){delete this.formData,delete this.formErrors,delete this.preRequisite}}},b9rR:function(t,e,o){"use strict";var r=o("pk0X");o.n(r).a},bdEB:function(t,e,o){"use strict";var r=o("L2JU");function s(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function n(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?s(Object(o),!0).forEach((function(e){i(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):s(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}function i(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var a={props:{place:{type:String,default:"normal"},size:{type:String,default:"normal"},appLogo:{type:Boolean,default:!1},inline:{type:Boolean,default:!1},assets:{type:Object}},data:function(){return{appLogoText:window.kmenv.name}},computed:n(n({},Object(r.c)("config",["configs","uiConfigs"])),{},{orgLogo:function(){if(this.appLogo||!this.configs.assets&&!this.assets)return"navbar"===this.place||"sidebar"===this.place||"dark"===this.place?"/images/logo-light.png":"/images/logo.png";var t=this.assets&&this.assets.logo?this.assets.logo:this.configs.assets.logo?this.configs.assets.logo:"/images/logo.png";return(this.assets&&this.assets.logoLight||this.configs.assets.logoLight)&&("navbar"===this.place&&this.uiConfigs.topNavbarLogoLight||"sidebar"===this.place&&this.uiConfigs.leftSidebarLogoLight||"dark"===this.place)&&(t=this.assets&&this.assets.logoLight?this.assets.logoLight:this.configs.assets.logoLight),t},appTitle:function(){return this.configs.basic?this.configs.basic.orgName:window.kmenv.name}})},c=o("KHd+"),l=Object(c.a)(a,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("a",{class:["logo",t.place+"-logo",t.size+"-logo",t.orgLogo?"org-logo":"app-logo",t.inline?"inline-logo":""],attrs:{href:"/"}},[t.orgLogo?o("img",{staticClass:"logo-icon",attrs:{src:t.orgLogo,alt:t.appTitle}}):[o("span",{staticClass:"logo-text",attrs:{title:t.appTitle}},[t._v(t._s(t.appLogoText))])]],2)}),[],!1,null,null,null);e.a=l.exports},ekaU:function(t,e,o){"use strict";o.r(e);function r(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function s(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var n={extends:o("WK6j").a,data:function(){return{formData:{mobile:"",otp:""},otpRequested:!1}},methods:{submit:function(){var t=this;this.isLoading=!0;var e=this.$route.query,o=this.otpRequested?function(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?r(Object(o),!0).forEach((function(e){s(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):r(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}({},this.formData):{mobile:this.formData.mobile};this.LoginUsingOtp(o).then((function(o){if(t.$toasted.success(o.message,t.$toastConfig),t.otpRequested){t.$gaEvent("activity","loggedin","SMSOTP");var r=o.reload?{name:"appDashboard",query:{reload:1}}:{name:"appDashboard"};e&&e.ref&&t.$router.resolve(e.ref)&&(r=t.$router.resolve(e.ref).route),t.hasRole("admin")&&t.configs.system&&t.configs.system.setupWizard&&(r={name:"setup"}),t.ResetTwoFactorSet().then((function(){t.$router.push(r)})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)}))}else t.$gaEvent("activity","loginOtpRequested","SMSOTP"),t.otpRequested=!0,t.isLoading=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)}))}},mounted:function(){this.SetCSRF()}},i=o("KHd+"),a=Object(i.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"guest-page"},[o("box",[o("animated-loader",{attrs:{"is-loading":t.isLoading,"loader-color":t.vars.loaderColor}}),t._v(" "),o("guest-header",[o("h5",[t._v(t._s(t.$t("auth.login.login_using_sms_otp")))])]),t._v(" "),o("section",{attrs:{role:"main"}},[o("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[o("base-input",{staticClass:"mb-3",attrs:{"auto-focus":!t.otpRequested,label:t.$t("auth.login.props.mobile"),type:"text","addon-left-icon":"fas fa-mobile",error:t.formErrors.mobile,disabled:t.otpRequested},on:{"update:error":function(e){return t.$set(t.formErrors,"mobile",e)}},model:{value:t.formData.mobile,callback:function(e){t.$set(t.formData,"mobile",e)},expression:"formData.mobile"}}),t._v(" "),t.otpRequested?o("base-input",{staticClass:"mb-3",attrs:{"auto-focus":t.otpRequested,label:t.$t("auth.login.props.otp"),type:"text","addon-left-icon":"fas fa-key",error:t.formErrors.otp},on:{"update:error":function(e){return t.$set(t.formErrors,"otp",e)}},model:{value:t.formData.otp,callback:function(e){t.$set(t.formData,"otp",e)},expression:"formData.otp"}}):t._e(),t._v(" "),o("div",{staticClass:"text-center"},[o("base-button",{staticClass:"my-4 text-lg",attrs:{type:"submit",design:"primary",block:""}},[t.otpRequested?o("span",[t._v(t._s(t.$t("auth.login.login")))]):o("span",[t._v(t._s(t.$t("auth.login.request_otp")))])])],1),t._v(" "),o("div",{staticClass:"form-group m-b-0"},[o("div",{staticClass:"col-sm-12 text-center"},[o("p",[o("router-link",{staticClass:"text-primary m-l-5",attrs:{to:t.withQuery({name:"login"})}},[o("span",{staticClass:"font-weight-bold"},[t._v(t._s(t.$t("auth.login.login_using_password")))])])],1)])])],1)])],1),t._v(" "),t.configs.system?o("guest-footer",{attrs:{"footer-credit":t.configs.system.footerCredit,version:t.configs.system.version}}):t._e()],1)}),[],!1,null,"1e87a31c",null);e.default=a.exports},fOGa:function(t,e,o){"use strict";var r=o("j/38");o.n(r).a},"j/38":function(t,e,o){var r=o("DzPO");"string"==typeof r&&(r=[[t.i,r,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};o("aET+")(r,s);r.locals&&(t.exports=r.locals)},kUDz:function(t,e,o){"use strict";var r=o("bdEB"),s=o("L2JU");function n(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function i(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?n(Object(o),!0).forEach((function(e){a(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):n(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}function a(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var c={props:{width:{type:String,default:"normal"}},components:{AppLogo:r.a},data:function(){return{}},computed:i(i({},Object(s.c)("config",["configs"])),{},{orgLogo:function(){return this.configs.image&&this.configs.image.logo?this.configs.image.logo:null}})},l=(o("fOGa"),o("KHd+")),u=Object(l.a)(c,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{class:["centered-box justify-content-center mt-4","width-"+t.width]},[o("card",{staticClass:"border-0",attrs:{type:"white",shadow:"","header-classes":"bg-white","body-classes":"px-lg-4 py-lg-4"}},[t._t("default"),t._v(" "),this.orgLogo?o("div",{staticClass:"powered-logo text-center"},[o("span",{staticClass:"text-muted mr-1"},[t._v(t._s(t.$t("general.powered_by"))+" ")]),t._v(" "),o("app-logo",{attrs:{"app-logo":"",inline:""}})],1):t._e()],2)],1)}),[],!1,null,"7eb15e32",null).exports,p={props:{name:{type:String,default:"CenteredBox"},width:{type:String,default:"normal"}},components:{CenteredBox:u}},f=Object(l.a)(p,(function(){var t=this.$createElement;return(this._self._c||t)(this.name,{tag:"component",attrs:{width:this.width}},[this._t("default")],2)}),[],!1,null,"ebb852f4",null);e.a=f.exports},l7An:function(t,e,o){"use strict";var r=o("bdEB"),s=o("L2JU");function n(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function i(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var a={components:{AppLogo:r.a},data:function(){return{}},computed:function(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?n(Object(o),!0).forEach((function(e){i(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):n(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}({},Object(s.c)("config",["configs"]))},c=o("KHd+"),l=Object(c.a)(a,(function(){var t=this.$createElement,e=this._self._c||t;return e("header",{staticClass:"guest-header text-center mb-4"},[e("div",{staticClass:"logo-wrapper text-center mb-4 pb-2"},[e("app-logo")],1),this._v(" "),this._t("default")],2)}),[],!1,null,null,null);e.a=l.exports},pk0X:function(t,e,o){var r=o("x134");"string"==typeof r&&(r=[[t.i,r,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};o("aET+")(r,s);r.locals&&(t.exports=r.locals)},x134:function(t,e,o){(t.exports=o("I1BE")(!1)).push([t.i,".guest-footer p[data-v-739170b9]{opacity:.3}",""])}}]);
//# sourceMappingURL=login-sms-otp.js.map?id=0cdc77c21936ceb5578d