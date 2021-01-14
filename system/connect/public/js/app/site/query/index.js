(window.webpackJsonp=window.webpackJsonp||[]).push([[67],{lSlZ:function(e,t,r){"use strict";var i=r("L2JU");function s(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,i)}return r}function a(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?s(Object(r),!0).forEach((function(t){n(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function n(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var o={props:{boxed:{type:Boolean,default:!1},isLoading:{type:Boolean,default:!1}},computed:a(a({},Object(i.c)("common",["filters"])),Object(i.c)("config",["vars"])),methods:a(a({},Object(i.b)("common",["ResetFilters"])),{},{submit:function(){var e=a(a(a({},this.$route.query),this.filters),{},{filtered:!0,filtered_at:moment().unix()});this.$router.push({path:this.$route.path,query:e}).catch((function(e){}))},reset:function(){this.ResetFilters(),this.$route.query&&this.$route.query.filtered&&this.$router.push({path:this.$route.path})}})},l=r("KHd+"),c=Object(l.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("base-container",{staticClass:"mb-element",attrs:{boxed:e.boxed,"with-loader":"","is-loading":e.isLoading,"loader-color":e.vars.loaderColor}},[r("close-button",{attrs:{title:e.$t("general.close")},on:{click:function(t){return e.$emit("close")}}}),e._v(" "),r("form",{on:{submit:function(t){return t.preventDefault(),e.submit(t)}}},[e._t("default"),e._v(" "),r("div",{staticClass:"form-footer mt-3"},[r("div",{staticClass:"left-side"},[r("base-button",{attrs:{type:"button",design:"light",disabled:e.isLoading},on:{click:function(t){return e.$emit("close")}}},[e._v(e._s(e.$t("general.close")))])],1),e._v(" "),r("div",{staticClass:"right-side"},[r("base-button",{attrs:{type:"button",design:"light",disabled:e.isLoading},on:{click:e.reset}},[e._v(e._s(e.$t("general.clear")))]),e._v(" "),r("base-button",{attrs:{type:"submit",design:"primary",disabled:e.isLoading}},[e._v(e._s(e.$t("general.filter")))])],1)])],2)],1)}),[],!1,null,null,null).exports;function u(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,i)}return r}function d(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}t.a={components:{FilterWrapper:c},props:{preRequisite:{type:Object,default:function(){return{}}},boxed:{type:Boolean,default:!1},isLoading:{type:Boolean,default:!1}},computed:function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?u(Object(r),!0).forEach((function(t){d(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):u(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},Object(i.c)("common",["filters"]))}},sijl:function(e,t,r){"use strict";r.r(t);var i=r("UPFT"),s={extends:r("lSlZ").a},a=r("KHd+"),n={components:{FilterForm:Object(a.a)(s,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("filter-wrapper",{attrs:{boxed:e.boxed,"is-loading":e.isLoading},on:{close:function(t){return e.$emit("close")}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{"auto-focus":"",label:e.$t("general.keyword"),type:"text",disabled:e.isLoading},model:{value:e.filters.keyword,callback:function(t){e.$set(e.filters,"keyword",t)},expression:"filters.keyword"}})],1),e._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:e.$t("site.query.props.email"),type:"text",disabled:e.isLoading},model:{value:e.filters.email,callback:function(t){e.$set(e.filters,"email",t)},expression:"filters.email"}})],1),e._v(" "),r("div",{staticClass:"col-12 col-md-4 mb-4"},[r("base-input",{attrs:{label:e.$t("site.query.props.contact_number"),type:"text",disabled:e.isLoading},model:{value:e.filters.contactNumber,callback:function(t){e.$set(e.filters,"contactNumber",t)},expression:"filters.contactNumber"}})],1)])])}),[],!1,null,null,null).exports},extends:i.a,data:function(){return{fields:[{key:"name",label:$t("site.query.props.name"),sort:"name"},{key:"email",label:$t("site.query.props.email")},{key:"contactNumber",label:$t("site.query.props.contact_number")},{key:"subject",label:$t("site.query.props.subject"),tdClass:"td-ellipsis max-width-100",transformer:"limitWords"},{key:"createdAt",label:$t("general.submitted_at"),sort:"created_at",transformer:"date"},{key:"updatedAt",label:$t("general.updated_at"),sort:"updated_at",transformer:"date",thClass:"d-none",tdClass:"d-none"},{key:"actions",label:"",cantHide:!0,tdClass:"actions-dropdown-wrapper"}],filtersOptions:{keyword:"",email:"",contactNumber:""},sortOptions:{hasScroll:!0},columnsOptions:{hasScroll:!0},initUrl:"site/queries",dataType:"query"}},mounted:function(){this.updatePageMeta()}},o=Object(a.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"entity-list-container"},[r("collapse-transition",{attrs:{group:!0,duration:300,tag:"div"}},[e.showFilters?r("filter-form",{key:"filters",attrs:{boxed:!0,"pre-requisite":e.preRequisite,"is-loading":e.isLoading},on:{close:e.toggleFilter}}):e._e(),e._v(" "),r("base-container",{key:"list",staticClass:"p-0",attrs:{boxed:"","with-loader":"","is-loading":e.isLoading,"loader-color":e.vars.loaderColor}},[e.isInitialized?r("table-wrapper",{attrs:{meta:e.entities.meta,filtered:e.isFiltered,"entity-title":"site.query.query","entities-title":"site.query.queries","entity-description":"site.query.module_description"}},[r("b-table",{directives:[{name:"show",rawName:"v-show",value:e.entities.meta.total,expression:"entities.meta.total"}],ref:"btable",attrs:{items:e.itemsProvider,fields:e.fields,busy:e.isLoading,hover:"",striped:"",stacked:"sm","per-page":e.entities.meta.perPage,"current-page":e.entities.meta.currentPage,filters:null},on:{"update:busy":function(t){e.isLoading=t},"row-dblclicked":function(t){return e.rowClickHandler({route:"appSiteQueryView"},t)}},scopedSlots:e._u([{key:"cell(name)",fn:function(t){return[r("router-link",{staticClass:"row-link",attrs:{to:{name:"appSiteQueryView",params:{uuid:t.item.uuid}}}},[e._v("\n                            "+e._s(t.item.name)+"\n                        ")])]}},{key:"cell(createdAt)",fn:function(e){return[r("view-date",{staticClass:"mb-0",attrs:{value:e.item.createdAt,"with-tz":"",tag:"span"}})]}},{key:"cell(updatedAt)",fn:function(e){return[r("view-date",{staticClass:"mb-0",attrs:{value:e.item.updatedAt,"with-tz":"",tag:"span"}})]}},{key:"cell(actions)",fn:function(t){return[r("table-row-actions",[r("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"appSiteQueryView",params:{uuid:t.item.uuid}}}},[r("i",{staticClass:"fas fa-arrow-circle-right"}),e._v(" "+e._s(e.$t("global.view",{attribute:e.$t("site.query.query")})))]),e._v(" "),e.hasPermission("delete-query")?r("a",{staticClass:"dropdown-item",on:{click:function(r){return r.stopPropagation(),e.deleteEntity(t.item)}}},[r("i",{staticClass:"fas fa-trash"}),e._v(" "+e._s(e.$t("global.delete",{attribute:e.$t("site.query.query")})))]):e._e()],1)]}}],null,!1,791847730)})],1):e._e()],1)],1)],1)}),[],!1,null,null,null);t.default=o.exports}}]);
//# sourceMappingURL=index.js.map?id=524b0ce864a16716a3b5