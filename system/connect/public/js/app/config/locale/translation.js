(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{"3TDS":function(t,a,e){"use strict";var o=e("L9UH");e.n(o).a},L9UH:function(t,a,e){var o=e("eVvt");"string"==typeof o&&(o=[[t.i,o,""]]);var n={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(o,n);o.locals&&(t.exports=o.locals)},"TBq+":function(t,a,e){"use strict";e.d(a,"k",(function(){return c})),e.d(a,"j",(function(){return d})),e.d(a,"i",(function(){return u})),e.d(a,"a",(function(){return h})),e.d(a,"g",(function(){return m})),e.d(a,"h",(function(){return D})),e.d(a,"l",(function(){return w})),e.d(a,"c",(function(){return O})),e.d(a,"m",(function(){return K})),e.d(a,"e",(function(){return E})),e.d(a,"f",(function(){return j})),e.d(a,"d",(function(){return L})),e.d(a,"b",(function(){return k}));e("nFxi");function o(t){return function(t){if(Array.isArray(t))return n(t)}(t)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(t)||function(t,a){if(!t)return;if("string"==typeof t)return n(t,a);var e=Object.prototype.toString.call(t).slice(8,-1);"Object"===e&&t.constructor&&(e=t.constructor.name);if("Map"===e||"Set"===e)return Array.from(t);if("Arguments"===e||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(e))return n(t,a)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(t,a){(null==a||a>t.length)&&(a=t.length);for(var e=0,o=new Array(a);e<a;e++)o[e]=t[e];return o}function i(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);a&&(o=o.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,o)}return e}function r(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?i(Object(e),!0).forEach((function(a){l(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):i(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}function l(t,a,e){return a in t?Object.defineProperty(t,a,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[a]=e,t}var s=function(t){var a=t.label,e=t.icon,o=t.tooltip,n=t.design,i=void 0===n?{color:"white",size:"md"}:n;return{label:a,icon:e,tooltip:o,design:i&&i.color||"white",size:i&&i.size||"md"}},c=function(t,a,e){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null,i=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{},l=arguments.length>6&&void 0!==arguments[6]?arguments[6]:{};return r(r({},s({label:t,icon:a,tooltip:o,design:n})),{},{action:function(t){t.push({name:e,params:i,query:l})}})},d=function(t,a,e,o){var n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null,i=arguments.length>5&&void 0!==arguments[5]?arguments[5]:null,l=arguments.length>6&&void 0!==arguments[6]?arguments[6]:{},s=arguments.length>7&&void 0!==arguments[7]?arguments[7]:{};return r(r({},c(t,a,e,n,i,l,s)),{},{permissions:[o]})},u=function(t,a,e){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null;return r(r({},s({label:t,icon:a,tooltip:o,design:n})),{},{action:e})},f=function(t,a,e){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null;return u(t,a,(function(t,a){a.$emit(e.event,e.options)}),o,n)},h=function(t,a){return d($t("general.add_new"),"fas fa-plus",t,a)},m=function(){return f($t("general.filter"),"fas fa-filter",{event:"TOGGLE_FILTER"})},p={storeName:"common",design:"white"},D=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[];return r(r(r({},p),t),{},{options:[{label:$t("general.default"),dispatch:{sortBy:"created_at"}}].concat(o(a))})},y=function(t){return{label:t.label,icon:t.icon}},g=function(t,a,e){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{};return r(r({},y({label:t,icon:a})),{},{to:{name:e,params:o,query:n}})},b=function(t,a,e,o){var n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{},i=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{};return r(r({},g(t,a,e,n,i)),{},{permissions:[o]})},v=function(t,a,e){return r(r({},y({label:t,icon:a})),{},{action:e})},_=function(t,a,e){return v(t,a,(function(t,a){a.$emit(e.event,e.options)}))},w=function(t,a){return b($t("general.import"),"fas fa-file-import",t,a)},O=function(t,a){return b($t("general.config"),"fas fa-cog",t,a)},K=function(){return _($t("general.print"),"fas fa-print",{event:"EXPORT",options:{type:"print"}})},E=function(){return _($t("general.export_pdf"),"fas fa-file-pdf",{event:"EXPORT",options:{type:"pdf"}})},j=function(){return _($t("general.export_xls"),"fas fa-file-excel",{event:"EXPORT",options:{type:"xls"}})},L=function(){return _($t("general.export_csv"),"fas fa-file-csv",{event:"EXPORT",options:{type:"csv"}})},M={key_p:{type:"event",emit:"EXPORT",payload:{type:"print"}}},$={key_e:{type:"event",emit:"EXPORT",payload:{type:"pdf"}}},k=r(r(r({},{key_f:{type:"event",emit:"TOGGLE_FILTER"}}),M),$)},eVvt:function(t,a,e){(t.exports=e("I1BE")(!1)).push([t.i,".table-wrapper.has-checkbox .custom-control-label:after,.table-wrapper.has-checkbox .custom-control-label:before{top:-1rem}",""])},zdE2:function(t,a,e){"use strict";e.r(a);var o=e("L2JU"),n=e("TBq+");function i(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);a&&(o=o.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,o)}return e}function r(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?i(Object(e),!0).forEach((function(a){l(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):i(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}function l(t,a,e){return a in t?Object.defineProperty(t,a,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[a]=e,t}var s={components:{},data:function(){return{activeModule:"auth",formData:{words:{}},preRequisite:{locales:[],modules:[]},formErrors:{},initialFormData:null,emptyFormData:null,showLocaleEditModal:!1,isModalLoading:!0,modalData:{locale:"en",label:null,translationInEn:null,translation:null,firstKey:null,secondKey:null,thirdKey:null,fourthKey:null},initialModalData:{},isLoading:!1,showReloadBtn:!1}},computed:r({},Object(o.c)("config",["vars"])),methods:r(r(r({},Object(o.b)("common",["Custom"])),Object(o.b)("config",["SetUiConfig"])),{},{getInitialData:function(){var t=this;this.isLoading=!0,this.$route.query&&this.$route.query.module&&(this.activeModule=this.$route.query.module),this.Custom({url:"config/locales/pre-requisite",params:{module:this.activeModule}}).then((function(a){t.preRequisite.locales=_.cloneDeep(a.locales),t.preRequisite.modules=_.cloneDeep(a.modules),a.words.objForEach((function(a,e){_.isObject(a)?t.formData.words[e]=Object.assign({},a):t.formData.words[e]={}})),t.initialFormData=Object.assign({},t.formData),t.initialModalData=Object.assign({},t.modalData),t.isLoading=!1})).catch((function(a){t.isLoading=!1,t.formErrors=formUtil.handleErrors(a)}))},humanize:function(t){return _.startCase(t)},getLocaleByCode:function(t){var a=this.preRequisite.locales.find((function(a){return a.locale===t}));return a?"".concat(a.name," (").concat(t,")"):t},updateRouteQuery:function(t){var a=Object.assign({},this.$route.query,t);this.$router.push({path:this.$route.path,query:a})},isString:function(t){return _.isString(t)},isObject:function(t){return _.isObject(t)},toggleLocaleEditModal:function(t,a,e,o,n){this.modalData=_.cloneDeep(this.initialModalData),this.modalData.locale=t,this.modalData.firstKey=a,this.modalData.secondKey=e,this.modalData.thirdKey=o,this.modalData.fourthKey=n,this.modalData.label=this.getLabel(a,e,o,n),this.modalData.translationInEn=this.getTranslation("en",a,e,o,n),this.modalData.translation=this.getTranslation(t,a,e,o,n),this.showLocaleEditModal=!0,this.isModalLoading=!1},onLocaleEditModalShown:function(){var t=this;this.$nextTick((function(){t.$refs.newTranslation.$refs["base-input-newTranslation"].focus()}))},getTranslation:function(t,a,e,o,n){return this.formData.words[t][a]?e&&this.formData.words[t][a][e]?o&&this.formData.words[t][a][e][o]?n&&this.formData.words[t][a][e][o][n]?this.formData.words[t][a][e][o][n]:n?"":this.formData.words[t][a][e][o]:o?"":this.formData.words[t][a][e]:e?"":this.formData.words[t][a]:""},getLabel:function(t,a,e,o){return t+(a?e?o?" -> "+a+" -> "+e+" -> "+o:" -> "+a+" -> "+e:" -> "+a:"")},onLocaleEditModalHidden:function(){this.isModalLoading=!0},onLocaleEditModalOK:function(t){var a=this;t.preventDefault(),this.isModalLoading=!0,this.modalData.firstKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey]={}),this.modalData.secondKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey]={}),this.modalData.thirdKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey]={}),this.modalData.fourthKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey][this.modalData.fourthKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey][this.modalData.fourthKey]={}),this.modalData.firstKey&&this.modalData.secondKey&&this.modalData.thirdKey&&this.modalData.fourthKey?this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey][this.modalData.fourthKey]=this.modalData.translation:this.modalData.firstKey&&this.modalData.secondKey&&this.modalData.thirdKey?this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey]=this.modalData.translation:this.modalData.firstKey&&this.modalData.secondKey?this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey]=this.modalData.translation:this.modalData.firstKey&&(this.formData.words[this.modalData.locale][this.modalData.firstKey]=this.modalData.translation),this.Custom({url:"config/locales/".concat(this.modalData.locale,"/translate"),method:"post",data:{module:this.activeModule,words:this.formData.words[this.modalData.locale]}}).then((function(t){a.initialFormData=_.cloneDeep(a.formData),a.modalData=_.cloneDeep(a.initialModalData),a.$refs.localeEditModal.hide(),a.showReloadBtn=!0})).catch((function(t){a.formData=_.cloneDeep(a.initialFormData),a.isModalLoading=!1,a.formErrors=formUtil.handleErrors(t)}))},applyPageHeader:function(){var t={buttons:[n.a("appConfigLocaleAdd","access-config")]};this.SetUiConfig({pageHeader:t})},reloadPage:function(){location.reload(!0)}}),mounted:function(){this.emptyFormData=Object.assign({},this.formData),this.getInitialData(),this.applyPageHeader()},watch:{$route:function(){this.getInitialData()}}},c=(e("3TDS"),e("KHd+")),d=Object(c.a)(s,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("base-container",{staticClass:"p-0 flex-grow",attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[e("div",{staticClass:"d-flex justify-content-between"},[e("div",{staticClass:"text-left p-4"},[t.showReloadBtn?e("base-button",{attrs:{type:"button",design:"light",size:"md"},on:{click:t.reloadPage}},[e("i",{staticClass:"fas fa-sync-alt"}),t._v(" "+t._s(t.$t("general.reload_page")))]):t._e()],1),t._v(" "),e("div",{staticClass:"text-right p-4"},[e("base-dropdown",{attrs:{tag:"div",direction:"down","menu-classes":"show-dropdown-up",position:"right"}},[e("base-button",{attrs:{slot:"title",type:"button","data-toggle":"dropdown",role:"button",design:"info",size:"md"},slot:"title"},[e("i",{staticClass:"fas fa-boxes"}),t._v(" "+t._s(t.$t(t.activeModule+"."+t.activeModule))+" "),e("i",{staticClass:"fas fa-chevron-down"})]),t._v(" "),t._l(t.preRequisite.modules,(function(a){return e("a",{staticClass:"dropdown-item",on:{click:function(e){return t.updateRouteQuery({module:a})}}},[t._v("\n                    "+t._s(t.$t(a+"."+a))+"\n                    "),a==t.activeModule?e("i",{staticClass:"fas fa-check pull-right"}):t._e()])}))],2)],1)]),t._v(" "),e("div",{staticClass:"table-responsive table-wrapper"},[e("form",{on:{submit:function(a){return a.preventDefault(),t.submit(a)}}},[e("table",{staticClass:"table b-table table-striped table-hover b-table-stacked-sm"},[e("thead",[e("tr",[e("th",[t._v(t._s(t.$t("config.locale.key")))]),t._v(" "),t._l(t.preRequisite.locales,(function(a){return e("th",[t._v(t._s(a.name+" ("+a.locale+")"))])}))],2)]),t._v(" "),e("tbody",[t._l(t.formData.words.en,(function(a,o){return[t.isString(a)?[e("tr",[e("td",[t._v(t._s(o))]),t._v(" "),t._l(t.preRequisite.locales,(function(a){return e("td",{on:{dblclick:function(e){return t.toggleLocaleEditModal(a.locale,o)}}},[t._v(t._s(t.getTranslation(a.locale,o)))])}))],2)]:t._e(),t._v(" "),t.isObject(a)?[t._l(a,(function(a,n){return[t.isString(a)?[e("tr",[e("td",[t._v(t._s(o)+" -> "+t._s(n))]),t._v(" "),t._l(t.preRequisite.locales,(function(a){return e("td",{on:{dblclick:function(e){return t.toggleLocaleEditModal(a.locale,o,n)}}},[t._v(t._s(t.getTranslation(a.locale,o,n)))])}))],2)]:t._e(),t._v(" "),t.isObject(a)?[t._l(a,(function(a,i){return[t.isString(a)?[e("tr",[e("td",[t._v(t._s(o)+" -> "+t._s(n)+" -> "+t._s(i))]),t._v(" "),t._l(t.preRequisite.locales,(function(a){return e("td",{on:{dblclick:function(e){return t.toggleLocaleEditModal(a.locale,o,n,i)}}},[t._v(t._s(t.getTranslation(a.locale,o,n,i)))])}))],2)]:t._e(),t._v(" "),t.isObject(a)?t._l(a,(function(a,r){return e("tr",[e("td",[t._v(t._s(o)+" -> "+t._s(n)+" -> "+t._s(i)+" -> "+t._s(r))]),t._v(" "),t._l(t.preRequisite.locales,(function(a){return e("td",{on:{dblclick:function(e){return t.toggleLocaleEditModal(a.locale,o,n,i,r)}}},[t._v(t._s(t.getTranslation(a.locale,o,n,i,r)))])}))],2)})):t._e()]}))]:t._e()]}))]:t._e()]}))],2)])])]),t._v(" "),e("b-modal",{ref:"localeEditModal",attrs:{size:"md",centered:"",lazy:"",busy:t.isModalLoading,"no-close-on-backdrop":"","no-close-on-esc":""},on:{ok:t.onLocaleEditModalOK,hidden:t.onLocaleEditModalHidden,shown:t.onLocaleEditModalShown},model:{value:t.showLocaleEditModal,callback:function(a){t.showLocaleEditModal=a},expression:"showLocaleEditModal"}},[e("template",{slot:"modal-header"},[e("h5",{staticClass:"modal-title"},[t._v(t._s(t.$t("config.locale.translation")))])]),t._v(" "),e("div",[e("div",{staticClass:"row"},[e("div",{staticClass:"col-12"},[e("base-input",{ref:"newTranslation",staticClass:"mb-5",attrs:{label:t.modalData.label+" ("+t.modalData.locale+")",type:"text",error:t.formErrors.translation,name:"newTranslation"},on:{"update:error":function(a){return t.$set(t.formErrors,"translation",a)},keydown:function(a){return!a.type.indexOf("key")&&t._k(a.keyCode,"enter",13,a.key,"Enter")?null:t.onLocaleEditModalOK(a)}},model:{value:t.modalData.translation,callback:function(a){t.$set(t.modalData,"translation",a)},expression:"modalData.translation"}})],1)]),t._v(" "),e("p",{staticClass:"text-muted small m-0"},[t._v("In English - "+t._s(t.modalData.translationInEn))])])],2)],1)}),[],!1,null,null,null);a.default=d.exports}}]);
//# sourceMappingURL=translation.js.map?id=50a04622d058a1bca736