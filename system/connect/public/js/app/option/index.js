(window.webpackJsonp=window.webpackJsonp||[]).push([[57],{tbxT:function(t,e,i){"use strict";i.r(e);var s={components:{},extends:i("UPFT").a,data:function(){return{fields:[{key:"name",label:$t("option.props.name"),sort:"name"},{key:"slug",label:$t("option.props.slug"),sort:"slug"},{key:"description",label:$t("option.props.description")},{key:"parent.name",label:$t("option.props.parent"),sort:"parent_id"},{key:"createdAt",label:$t("general.created_at"),sort:"created_at",transformer:"date",thClass:"d-none",tdClass:"d-none"},{key:"updatedAt",label:$t("general.updated_at"),sort:"updated_at",transformer:"date",thClass:"d-none",tdClass:"d-none"},{key:"actions",label:"",cantHide:!0,tdClass:"actions-wrapper"}],preRequisite:{options:[]},filtersOptions:{name:""},permissionsRequired:"access-config",routesRequired:{},initUrl:"options",dataType:"option",entityTitle:"option.option",entitiesTitle:"option.options",entityDescription:"option.module_description",hasSlug:!1,hasParent:!1,hideFilterButton:!0,routeNamePrefix:""}},mounted:function(){this.getInitialData()},beforeMount:function(){var t=this.$route.meta;this.customFilters.type=t.optionType,this.entityTitle=t.entityTitle,this.entitiesTitle=t.entitiesTitle,this.entityDescription=t.entityDescription,this.permissionsRequired=t.permissionRequired,this.routeNamePrefix=t.routeNamePrefix,this.routesRequired.add="".concat(t.routeNamePrefix,"Add"),this.fields=this.fields.filter((function(e){return"slug"===e.key?t.hasSlug:"parent.name"!==e.key||t.hasParent}))}},a=i("KHd+"),n=Object(a.a)(s,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("base-container",{staticClass:"p-0 flex-grow",attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[t.isInitialized?i("table-wrapper",{attrs:{meta:t.entities.meta,filtered:t.isFiltered,"add-button-route":t.routesRequired.add,"entity-title":t.entityTitle,"entities-title":t.entitiesTitle,"entity-description":t.entityDescription}},[i("b-table",{directives:[{name:"show",rawName:"v-show",value:t.entities.meta.total,expression:"entities.meta.total"}],ref:"btable",attrs:{items:t.itemsProvider,fields:t.fields,busy:t.isLoading,hover:"",striped:"",stacked:"sm","per-page":t.entities.meta.perPage,"current-page":t.entities.meta.currentPage,filters:null},on:{"update:busy":function(e){t.isLoading=e}},scopedSlots:t._u([{key:"cell(createdAt)",fn:function(t){return[i("view-date",{staticClass:"mb-0",attrs:{value:t.item.createdAt,"with-tz":"",tag:"span"}})]}},{key:"cell(updatedAt)",fn:function(t){return[i("view-date",{staticClass:"mb-0",attrs:{value:t.item.updatedAt,"with-tz":"",tag:"span"}})]}},{key:"cell(actions)",fn:function(e){return[i("div",{staticClass:"btn-group",attrs:{role:"group","aria-label":"Actions Buttons"}},[t.hasPermission(t.permissionsRequired)?i("base-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.d500",modifiers:{hover:!0,d500:!0}}],attrs:{type:"button",size:"sm",design:"dark",title:t.$t("global.edit",{attribute:t.$t(t.entityTitle)})},on:{click:function(i){return i.stopPropagation(),t.$router.push({name:t.routeNamePrefix+"Edit",params:{uuid:e.item.uuid}})}}},[i("i",{staticClass:"fas fa-edit"})]):t._e(),t._v(" "),t.hasPermission(t.permissionsRequired)?i("base-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.d500",modifiers:{hover:!0,d500:!0}}],attrs:{type:"button",size:"sm",design:"dark",title:t.$t("global.delete",{attribute:t.$t(t.entityTitle)})},on:{click:function(i){return i.stopPropagation(),t.deleteEntity(e.item)}}},[i("i",{staticClass:"fas fa-trash"})]):t._e()],1)]}}],null,!1,1766790600)})],1):t._e()],1)}),[],!1,null,null,null);e.default=n.exports}}]);
//# sourceMappingURL=index.js.map?id=51b212176e78cf257117