(window.webpackJsonp=window.webpackJsonp||[]).push([[32],{"3HR4":function(t,e,r){"use strict";var o=r("o0o1"),a=r.n(o),i=r("L2JU"),s=r("8BOd");r("i8R7");function n(t,e,r,o,a,i,s){try{var n=t[i](s),c=n.value}catch(t){return void r(t)}n.done?e(c):Promise.resolve(c).then(o,a)}function c(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function u(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?c(Object(r),!0).forEach((function(e){m(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function m(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}e.a={components:{},data:function(){return{formData:{},formErrors:{},initialFormData:null,initianLength:0,emptyFormData:null,entity:null,preRequisite:{},isLoading:!0,dataType:null,configType:""}},computed:u({},Object(i.c)("config",["configs","vars"])),methods:u(u(u({},Object(i.b)("config",["GetConfig"])),Object(i.b)("navigation",["Generate"])),{},{findActualValue:function(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"uuid";return e.find((function(e){return e[r]===t}))||null},submit:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if(formUtil.isUnchanged(this.initialFormData,this.formData))return this.$toasted.info(this.$t("general.nothing_changed"),this.$toastConfig.info),!1;this.isLoading=!0,this.formData.type=this.formData.type.snakeCase();var r=!0===e?s.e:"module"===this.configType?s.d:s.c;"function"==typeof this.beforeSubmit&&this.beforeSubmit(),r(this.formData).then((function(e){t.GetConfig().then((function(){t.$toasted.success(e.message,t.$toastConfig),t.initialFormData=_.cloneDeep(t.formData),t.isLoading=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)})),"function"==typeof t.afterSubmit&&t.afterSubmit(),"function"==typeof t.afterSubmitSuccess&&t.afterSubmitSuccess()})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e),"function"==typeof t.afterSubmit&&t.afterSubmit(),"function"==typeof t.afterSubmitError&&t.afterSubmitError()}))},reset:function(){var t=this;formUtil.confirmAction().then((function(e){e.value&&(t.formData=Object.assign({},t.formData,_.cloneDeep(t.initialFormData)))}))},unsavedCheck:function(t){formUtil.unsavedCheckAlert(this.initialFormData,this.formData,t)},fillPreRequisite:function(t){var e=this;this.preRequisite.objForEach((function(r,o){e.preRequisite[o]=t[o]||r})),this.isLoading=!1},fillFormData:function(){var t=this;this.isLoading=!0,this.formData.type&&this.configs[this.formData.type]&&(this.formData=formUtil.assignValues(this.formData,this.configs[this.formData.type])),this.formData.types&&Array.isArray(this.formData.types)&&this.formData.types.forEach((function(e){t.formData=formUtil.assignValues(t.formData,t.configs[e])})),"function"==typeof this.addNewRow&&"function"==typeof this.addNewRowIfNone&&this.addNewRowIfNone(),this.isLoading=!1},getInitialData:function(t){var e,r=this;return(e=a.a.mark((function e(){var o;return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r.isLoading=!0,e.prev=1,e.next=4,s.b(Object.keys(r.preRequisite).join(","));case 4:return o=e.sent,r.fillPreRequisite(o),t&&r.$nextTick((function(){t()})),e.abrupt("return",o);case 10:throw e.prev=10,e.t0=e.catch(1),r.isLoading=!1,r.formErrors=formUtil.handleErrors(e.t0),e.t0;case 15:case"end":return e.stop()}}),e,null,[[1,10]])})),function(){var t=this,r=arguments;return new Promise((function(o,a){var i=e.apply(t,r);function s(t){n(i,o,a,s,c,"next",t)}function c(t){n(i,o,a,s,c,"throw",t)}s(void 0)}))})()}}),mounted:function(){this.fillFormData(),this.initialFormData=_.cloneDeep(this.formData)},beforeDestroy:function(){delete this.formData,delete this.formErrors,delete this.preRequisite},beforeRouteLeave:function(t,e,r){this.unsavedCheck(r)}}},K2QC:function(t,e,r){"use strict";r.r(e);var o=r("3HR4"),a=r("fHbr"),i={extends:o.a,components:{CollapseTransition:a.a},data:function(){return{formData:{maxPerChunk:"",customApiGetUrl:"",customApiNumberPrefix:"",customApiSenderIdParam:"",customApiSenderId:"",customApiReceiverParam:"",customApiMessageParam:"",customApiAcceptsMultipleReceiver:!1,type:"sms"}}}},s=r("KHd+"),n=Object(s.a)(i,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("base-container",{attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.max_per_chunk"),type:"text",error:t.formErrors.maxPerChunk},on:{"update:error":function(e){return t.$set(t.formErrors,"maxPerChunk",e)}},model:{value:t.formData.maxPerChunk,callback:function(e){t.$set(t.formData,"maxPerChunk",e)},expression:"formData.maxPerChunk"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.custom_api_get_url"),type:"text",error:t.formErrors.customApiGetUrl},on:{"update:error":function(e){return t.$set(t.formErrors,"customApiGetUrl",e)}},model:{value:t.formData.customApiGetUrl,callback:function(e){t.$set(t.formData,"customApiGetUrl",e)},expression:"formData.customApiGetUrl"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.custom_api_number_prefix"),type:"text",error:t.formErrors.customApiNumberPrefix},on:{"update:error":function(e){return t.$set(t.formErrors,"customApiNumberPrefix",e)}},model:{value:t.formData.customApiNumberPrefix,callback:function(e){t.$set(t.formData,"customApiNumberPrefix",e)},expression:"formData.customApiNumberPrefix"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.custom_api_sender_id_param"),type:"text",error:t.formErrors.customApiSenderIdParam},on:{"update:error":function(e){return t.$set(t.formErrors,"customApiSenderIdParam",e)}},model:{value:t.formData.customApiSenderIdParam,callback:function(e){t.$set(t.formData,"customApiSenderIdParam",e)},expression:"formData.customApiSenderIdParam"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.custom_api_sender_id"),type:"text",error:t.formErrors.customApiSenderId},on:{"update:error":function(e){return t.$set(t.formErrors,"customApiSenderId",e)}},model:{value:t.formData.customApiSenderId,callback:function(e){t.$set(t.formData,"customApiSenderId",e)},expression:"formData.customApiSenderId"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.custom_api_receiver_param"),type:"text",error:t.formErrors.customApiReceiverParam},on:{"update:error":function(e){return t.$set(t.formErrors,"customApiReceiverParam",e)}},model:{value:t.formData.customApiReceiverParam,callback:function(e){t.$set(t.formData,"customApiReceiverParam",e)},expression:"formData.customApiReceiverParam"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:t.$t("config.sms.custom_api_message_param"),type:"text",error:t.formErrors.customApiMessageParam},on:{"update:error":function(e){return t.$set(t.formErrors,"customApiMessageParam",e)}},model:{value:t.formData.customApiMessageParam,callback:function(e){t.$set(t.formData,"customApiMessageParam",e)},expression:"formData.customApiMessageParam"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("div",{staticClass:"d-flex align-items-center"},[r("base-checkbox",{staticClass:"ml-0 mt-2",model:{value:t.formData.customApiAcceptsMultipleReceiver,callback:function(e){t.$set(t.formData,"customApiAcceptsMultipleReceiver",e)},expression:"formData.customApiAcceptsMultipleReceiver"}},[t._v("\n                        "+t._s(t.$t("config.sms.custom_api_accepts_multiple_receiver"))+"\n                    ")])],1)])]),t._v(" "),r("div",{staticClass:"text-right mt-5"},[r("base-button",{attrs:{type:"button",design:"light"},on:{click:t.reset}},[t._v(t._s(t.$t("general.reset")))]),t._v(" "),r("base-button",{attrs:{type:"submit",design:"primary"}},[t._v(t._s(t.$t("general.save")))])],1)])])}),[],!1,null,null,null);e.default=n.exports}}]);
//# sourceMappingURL=index.js.map?id=f48464efcf2c29b27e4f