(window.webpackJsonp=window.webpackJsonp||[]).push([[37],{"6qcq":function(t,e,i){"use strict";i.r(e);var r=i("ckZp"),n=i("LF47"),a={components:{CommonForm:r.a},extends:n.a,data:function(){return{initUrl:"contacts",duplicateRoute:"appContactDuplicate",fallBackRoute:"appContactList"}}},o=i("KHd+"),s=Object(o.a)(a,(function(){var t=this.$createElement,e=this._self._c||t;return e("base-container",{attrs:{boxed:""}},[e("common-form",{attrs:{"is-fetching":this.isFetching,"edit-data":this.entity,duplicate:this.duplicate}})],1)}),[],!1,null,null,null);e.default=s.exports},LF47:function(t,e,i){"use strict";var r=i("BcCH"),n=i("L2JU");function a(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,r)}return i}function o(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?a(Object(i),!0).forEach((function(e){s(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):a(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function s(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}e.a={data:function(){return{isLoading:!0,isFetching:!0,uuid:null,subUuid:null,entity:null,duplicate:!1,duplicateRoute:null,fallBackRoute:"appDashboard",initUrl:"",initSubUrl:null}},computed:{},watch:{},methods:o(o({},Object(n.b)("common",["Init","InitSub","Get"])),{},{getInitialData:function(){var t=this;this.isLoading=!0,this.Get(this.uuid).then((function(e){t.entity=e,t.isLoading=!1,t.isFetching=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e),t.$router.push({name:t.fallBackRoute})}))}}),mounted:function(){this.$route.params.uuid&&(this.uuid=this.$route.params.uuid),this.$route.params.subUuid&&(this.subUuid=this.$route.params.subUuid),this.duplicateRoute&&this.$route.name===this.duplicateRoute&&(this.duplicate=!0),this.Init({url:this.initUrl}),this.initSubUrl&&this.InitSub({url:(this.subUuid?this.subUuid+"/":"")+this.initSubUrl}),this.getInitialData()},beforeRouteEnter:function(t,e,i){t.params.uuid?i():i({name:this.fallBackRoute})},beforeRouteLeave:function(t,e,i){r.a.$emit("ROUTE_LEAVING",i)}}},cPOX:function(t,e,i){"use strict";var r=i("o0o1"),n=i.n(r),a=i("L2JU"),o=i("V0LQ");function s(t,e,i,r,n,a,o){try{var s=t[a](o),c=s.value}catch(t){return void i(t)}s.done?e(c):Promise.resolve(c).then(r,n)}function c(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,r)}return i}function u(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?c(Object(i),!0).forEach((function(e){l(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):c(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function l(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}e.a={components:{},props:{pushToArr:{type:Boolean,default:!1}},data:function(){return{formData:{},formErrors:{},initialFormData:null,emptyFormData:null,entity:null,preRequisite:{},isLoading:!0,initUrl:"",dataType:null,dataTypeArr:null,propertyToMatch:null}},computed:u(u({},Object(a.c)("config",["configs","vars"])),{},{codePrefix:function(){return this.formData.codePrefix}}),watch:{codePrefix:function(t){if(this.preRequisite.codes){var e=this.preRequisite.codes.find((function(e){return e.codePrefix===t})),i=this.configs[this.dataType].codeDigit;this.formData.codeNumber=e?Object(o.f)(e.codeNumber+1,i):Object(o.f)(1,i)}}},methods:u(u(u({},Object(a.b)("common",["Init","Store","GetPreRequisite","Custom"])),Object(a.b)("config",["SetUiConfig"])),{},{submit:function(){var t=this;if(formUtil.isUnchanged(this.initialFormData,this.formData))return this.$toasted.info(this.$t("general.nothing_changed"),this.$toastConfig.info),!1;this.isLoading=!0,this.Store(this.formData).then((function(e){t.$toasted.success(e.message,t.$toastConfig),t.initialFormData=_.cloneDeep(t.formData),e.hasOwnProperty(t.dataType)&&(t.entity=e[t.dataType]),t.close(!0),t.isLoading=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)}))},fillPreRequisite:function(t){var e=this;this.preRequisite.objForEach((function(i,r){e.preRequisite[r]=t[r]||i})),this.isLoading=!1},getInitialData:function(t){var e,i=this;return(e=n.a.mark((function e(){var r;return n.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return i.isLoading=!0,e.prev=1,e.next=4,i.GetPreRequisite();case 4:return r=e.sent,i.fillPreRequisite(r),i.configs[i.dataType]&&i.$nextTick((function(){i.formData.codePrefix=i.configs[i.dataType].codePrefix})),t&&i.$nextTick((function(){t()})),e.abrupt("return",r);case 11:throw e.prev=11,e.t0=e.catch(1),i.isLoading=!1,i.formErrors=formUtil.handleErrors(e.t0),e.t0;case 16:case"end":return e.stop()}}),e,null,[[1,11]])})),function(){var t=this,i=arguments;return new Promise((function(r,n){var a=e.apply(t,i);function o(t){s(a,r,n,o,c,"next",t)}function c(t){s(a,r,n,o,c,"throw",t)}o(void 0)}))})()},close:function(t){!0===t?this.$emit("close",Object.assign({},this.entity?this.entity:this.formData,{dataType:this.dataType,dataTypeArr:this.dataTypeArr,propertyToMatch:this.propertyToMatch,dontMatch:!!this.entity,push:this.pushToArr})):this.$emit("close"),this.SetUiConfig({modalSidebarShow:!1})}}),mounted:function(){this.Init({url:this.initUrl}),this.initialFormData=_.cloneDeep(this.formData)},beforeDestroy:function(){delete this.formData,delete this.formErrors,delete this.preRequisite}}},ckZp:function(t,e,i){"use strict";var r=i("g+26"),n={extends:i("cPOX").a,data:function(){return{formData:{uuid:null,name:"",description:""},initUrl:"segments",dataType:"segment",dataTypeArr:"segments",propertyToMatch:"name"}},mounted:function(){this.isLoading=!1}},a=i("KHd+"),o=Object(a.a)(n,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("form",{staticClass:"has-fixed-footer",on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[i("h5",{staticClass:"text-center"},[t._v(t._s(t.$t("global.add",{attribute:t.$t("contact.segment.segment")})))]),t._v(" "),i("hr"),t._v(" "),i("animated-loader",{attrs:{"is-loading":t.isLoading,"loader-color":t.vars.loaderColor}}),t._v(" "),i("div",{staticClass:"row"},[i("div",{staticClass:"col-12 mb-4"},[i("base-input",{attrs:{"auto-focus":"",label:t.$t("contact.segment.props.name"),type:"text",error:t.formErrors.name,required:""},on:{"update:error":function(e){return t.$set(t.formErrors,"name",e)}},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),t._v(" "),i("div",{staticClass:"col-12 mb-4"},[i("base-input",{attrs:{label:t.$t("contact.segment.props.description"),type:"text",error:t.formErrors.description},on:{"update:error":function(e){return t.$set(t.formErrors,"description",e)}},model:{value:t.formData.description,callback:function(e){t.$set(t.formData,"description",e)},expression:"formData.description"}})],1)]),t._v(" "),i("div",{staticClass:"form-footer fixed-footer mt-5"},[i("div",{staticClass:"left-side"},[i("base-button",{attrs:{type:"button",design:"light",tabindex:"-1"},on:{click:function(e){return t.close()}}},[i("i",{staticClass:"fas fa-chevron-left"}),t._v(" "+t._s(t.$t("general.cancel")))])],1),t._v(" "),i("div",{staticClass:"right-side"},[i("base-button",{attrs:{type:"submit",design:"primary"}},[i("i",{staticClass:"fas fa-save"}),t._v(" "+t._s(t.$t("global.save",{attribute:t.$t("contact.segment.segment")})))])],1)])],1)}),[],!1,null,null,null).exports,s={extends:r.a,components:{SegmentForm:o},data:function(){return{formData:{uuid:null,name:"",email:"",segments:[]},preRequisite:{segments:[]},formLabels:{name:$t("contact.props.name"),email:$t("contact.props.email"),segments:$t("contact.segment.segments")},initUrl:"contacts"}},mounted:function(){this.getInitialData()}},c=Object(a.a)(s,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[i("animated-loader",{attrs:{"is-loading":t.isLoading||t.isFetching,"loader-color":t.vars.loaderColor}}),t._v(" "),i("div",{staticClass:"row"},[i("div",{staticClass:"col-12 col-md-6 mb-3"},[i("base-input",{attrs:{"auto-focus":"",label:t.formLabels.email,type:"text",error:t.formErrors.email,required:""},on:{"update:error":function(e){return t.$set(t.formErrors,"email",e)}},model:{value:t.formData.email,callback:function(e){t.$set(t.formData,"email",e)},expression:"formData.email"}})],1),t._v(" "),i("div",{staticClass:"col-12 col-md-6 mb-3"},[i("base-input",{attrs:{label:t.formLabels.name,type:"text",error:t.formErrors.name},on:{"update:error":function(e){return t.$set(t.formErrors,"name",e)}},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),t._v(" "),i("div",{staticClass:"col-12 mb-3"},[i("base-select",{attrs:{options:t.preRequisite.segments,label:t.formLabels.segments,error:t.formErrors.segments,multiple:"","close-on-select":!1,"allow-empty":!0,"add-new-modal":!0,"needed-permission":"access-contact"},on:{"update:error":function(e){return t.$set(t.formErrors,"segments",e)}},scopedSlots:t._u([{key:"addNewModal",fn:function(){return[i("segment-form",{attrs:{"push-to-arr":""},on:{close:t.newModalClose}})]},proxy:!0}]),model:{value:t.formData.segments,callback:function(e){t.$set(t.formData,"segments",e)},expression:"formData.segments"}})],1)]),t._v(" "),i("div",{staticClass:"form-footer mt-3"},[i("div",{staticClass:"left-side"},[i("base-button",{attrs:{type:"button",design:"light",tabindex:"-1"},on:{click:function(e){return t.$router.back()}}},[i("i",{staticClass:"fas fa-chevron-left"}),t._v(" "+t._s(t.$t("general.cancel")))]),t._v(" "),t.showKeepAdding?i("base-checkbox",{staticClass:"ml-3 mt-2",model:{value:t.keepAdding,callback:function(e){t.keepAdding=e},expression:"keepAdding"}},[t._v("\n                "+t._s(t.$t("general.keep_adding"))+"\n            ")]):t._e()],1),t._v(" "),i("div",{staticClass:"right-side"},[i("base-button",{attrs:{type:"button",design:"light"},on:{click:t.reset}},[t._v(t._s(t.$t("general.reset")))]),t._v(" "),i("base-button",{attrs:{type:"submit",design:"primary"}},[i("i",{staticClass:"fas fa-save"}),t._v(" "+t._s(t.$t("global.save",{attribute:t.$t("contact.contact")})))])],1)]),t._v(" "),t.showKeepAdding&&t.keepAdding?[i("keep-adding-form",{attrs:{"keep-adding-fields":t.keepAddingFields,"keep-adding-option":t.keepAddingOption,"keep-adding-selected-fields":t.keepAddingSelectedFields,"is-loading":t.isLoading},on:{optionUpdated:function(e){t.keepAddingOption=e},fieldsUpdated:function(e){t.keepAddingSelectedFields=e}}})]:t._e()],2)}),[],!1,null,null,null);e.a=c.exports}}]);
//# sourceMappingURL=edit.js.map?id=5efcdd58e75c166a99b4