(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{"1RKl":function(t,e,s){"use strict";s.r(e);var r=s("5TL6"),i="/config/permissions";var o=s("L2JU");function n(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function a(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?n(Object(s),!0).forEach((function(e){u(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):n(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}function u(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var c={data:function(){return{activeModule:"config",formData:{roles:[]},preRequisite:{roles:[],permissions:[],modules:[],assignedPermissions:[]},formErrors:{},initialFormData:null,isLoading:!1}},computed:a({},Object(o.c)("config",["vars"])),methods:{submit:function(){var t,e=this;this.isLoading=!0,(t=a(a({},this.formData),{},{module:this.activeModule}),Object(r.a)({url:i+"/assign",method:"post",data:t})).then((function(t){e.isLoading=!1,e.$toasted.success(t.message,e.$toastConfig.success)})).catch((function(t){e.isLoading=!1,e.formErrors=formUtil.handleErrors(t)}))},getInitialData:function(){var t=this;this.isLoading=!0,this.$route.query&&this.$route.query.module&&(this.activeModule=this.$route.query.module),function(t){return Object(r.a)({url:i+"/pre-requisite",method:"get",params:{module:t}})}(this.activeModule).then((function(e){t.preRequisite=_.cloneDeep(e),t.formData.roles=[],t.preRequisite.roles.forEach((function(e){var s=t.preRequisite.assignedPermissions.find((function(t){return t.role.toUpperCase()===e.name.toUpperCase()}));t.formData.roles.push({name:e.name,permissions:"undefined"!=s?s.permissions:[]})})),t.isLoading=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)}))},humanize:function(t){return _.startCase(t)},updateRouteQuery:function(t){var e=Object.assign({},this.$route.query,t);this.$router.push({path:this.$route.path,query:e})}},mounted:function(){this.getInitialData()},watch:{$route:function(){this.getInitialData()}}},l=(s("L7Gt"),s("KHd+")),p=Object(l.a)(c,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("base-container",{staticClass:"p-0 flex-grow",attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[s("div",{staticClass:"text-right p-4"},[s("base-dropdown",{attrs:{tag:"div",direction:"down","menu-classes":"show-dropdown-up",position:"right"}},[s("base-button",{attrs:{slot:"title",type:"button","data-toggle":"dropdown",role:"button",design:"info",size:"md"},slot:"title"},[s("i",{staticClass:"fas fa-boxes"}),t._v(" "+t._s(t.$t(t.activeModule+"."+t.activeModule))+" "),s("i",{staticClass:"fas fa-chevron-down"})]),t._v(" "),t._l(t.preRequisite.modules,(function(e){return s("a",{staticClass:"dropdown-item",on:{click:function(s){return t.updateRouteQuery({module:e})}}},[t._v("\n                "+t._s(t.$t(e+"."+e))+"\n                "),e==t.activeModule?s("i",{staticClass:"fas fa-check pull-right"}):t._e()])}))],2)],1),t._v(" "),s("div",{staticClass:"table-responsive table-wrapper"},[s("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("table",{staticClass:"table b-table table-striped table-hover b-table-stacked-sm"},[s("thead",[s("tr",[s("th",[t._v(t._s(t.$t("config.permission.permissions")))]),t._v(" "),t._l(t.formData.roles,(function(e){return s("th",[t._v(t._s(t.humanize(e.name)))])}))],2)]),t._v(" "),s("tbody",t._l(t.preRequisite.permissions,(function(e){return s("tr",[s("td",[t._v(t._s(t.humanize(e)))]),t._v(" "),t._l(t.formData.roles,(function(r){return s("td",[s("base-checkbox",{staticClass:"ml-3",attrs:{value:e,disabled:"admin"===r.name},model:{value:r.permissions,callback:function(e){t.$set(r,"permissions",e)},expression:"rolePermission.permissions"}})],1)}))],2)})),0)]),t._v(" "),s("div",{staticClass:"text-right mt-5 px-4 mb-4"},[s("base-button",{attrs:{type:"submit",design:"primary"}},[t._v(t._s(t.$t("global.save",{attribute:t.$t("config.permission.permissions")})))])],1)])])])}),[],!1,null,null,null);e.default=p.exports},EcBm:function(t,e,s){(t.exports=s("I1BE")(!1)).push([t.i,".table-wrapper.has-checkbox .custom-control-label:after,.table-wrapper.has-checkbox .custom-control-label:before{top:-1rem}",""])},L7Gt:function(t,e,s){"use strict";var r=s("pjSy");s.n(r).a},pjSy:function(t,e,s){var r=s("EcBm");"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};s("aET+")(r,i);r.locals&&(t.exports=r.locals)}}]);
//# sourceMappingURL=index.js.map?id=5ab7452c56e9a21f857b