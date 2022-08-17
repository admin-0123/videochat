"use strict";(self.webpackChunkConnect=self.webpackChunkConnect||[]).push([[5972],{46830:(t,n,a)=>{a.d(n,{$c:()=>T,Ig:()=>C,K0:()=>h,S1:()=>m,SU:()=>p,TD:()=>u,Vz:()=>$,Y8:()=>D,Y9:()=>P,_3:()=>L,_D:()=>E,b7:()=>f,bE:()=>c,ij:()=>j,lE:()=>d,lu:()=>K,nh:()=>y,o$:()=>k,v3:()=>M});a(41591);function e(t){return function(t){if(Array.isArray(t))return o(t)}(t)||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(t)||function(t,n){if(!t)return;if("string"==typeof t)return o(t,n);var a=Object.prototype.toString.call(t).slice(8,-1);"Object"===a&&t.constructor&&(a=t.constructor.name);if("Map"===a||"Set"===a)return Array.from(t);if("Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a))return o(t,n)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(t,n){(null==n||n>t.length)&&(n=t.length);for(var a=0,e=new Array(n);a<n;a++)e[a]=t[a];return e}function i(t,n){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var e=Object.getOwnPropertySymbols(t);n&&(e=e.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),a.push.apply(a,e)}return a}function r(t){for(var n=1;n<arguments.length;n++){var a=null!=arguments[n]?arguments[n]:{};n%2?i(Object(a),!0).forEach((function(n){l(t,n,a[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(a,n))}))}return t}function l(t,n,a){return n in t?Object.defineProperty(t,n,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[n]=a,t}var s=function(t){var n=t.label,a=t.icon,e=t.tooltip,o=t.design,i=void 0===o?{color:"white",size:"md"}:o;return{label:n,icon:a,tooltip:e,design:i&&i.color||"white",size:i&&i.size||"md"}},c=function(t,n,a){var e=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null,i=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{},l=arguments.length>6&&void 0!==arguments[6]?arguments[6]:{};return r(r({},s({label:t,icon:n,tooltip:e,design:o})),{},{action:function(t){t.push({name:a,params:i,query:l})}})},d=function(t,n,a,e){var o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null,i=arguments.length>5&&void 0!==arguments[5]?arguments[5]:null,l=arguments.length>6&&void 0!==arguments[6]?arguments[6]:{},s=arguments.length>7&&void 0!==arguments[7]?arguments[7]:{};return r(r({},c(t,n,a,o,i,l,s)),{},{permissions:[e]})},u=function(t,n,a){var e=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null;return r(r({},s({label:t,icon:n,tooltip:e,design:o})),{},{action:a})},f=function(t,n,a){var e=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null;return u(t,n,(function(t,n){n.$emit(a.event,a.options)}),e,o)},h=function(t,n){return d($t("general.add_new"),"fas fa-plus",t,n)},m=function(t,n){return d($t("general.edit"),"fas fa-edit",t,n)},p=function(){return f("","fas fa-filter",{event:"TOGGLE_FILTER"},$t("general.filter"))},D=function(t,n){return d("","fas fa-cog",t,n,$t("general.config"))},g={storeName:"common",design:"white"},y=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[];return r(r(r({},g),t),{},{options:[{label:$t("general.default"),dispatch:{sortBy:""}}].concat(e(n))})},v=function(t){return{label:t.label,icon:t.icon}},b=function(t,n,a){var e=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{};return r(r({},v({label:t,icon:n})),{},{to:{name:a,params:e,query:o}})},_=function(t,n,a,e){var o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{},i=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{};return r(r({},b(t,n,a,o,i)),{},{permissions:[e]})},w=function(t,n,a){return r(r({},v({label:t,icon:n})),{},{action:a})},O=function(t,n,a){return w(t,n,(function(t,n){n.$emit(a.event,a.options)}))},K=function(t,n){return _($t("general.import"),"fas fa-file-import",t,n)},E=function(t,n){return _($t("general.config"),"fas fa-cog",t,n)},j=function(){return O($t("general.save_draft"),"fas fa-file-upload",{event:"SAVE_DRAFT"})},$=function(){return O($t("general.fetch_saved_draft"),"fas fa-file-download",{event:"FETCH_SAVED_DRAFT"})},k=function(){return O($t("general.clear_saved_draft"),"far fa-minus-square",{event:"CLEAR_SAVED_DRAFT"})},L=function(){return O($t("general.print"),"fas fa-print",{event:"EXPORT",options:{type:"print"}})},M=function(){return O($t("general.export_pdf"),"fas fa-file-pdf",{event:"EXPORT",options:{type:"pdf"}})},C=function(){return O($t("general.export_xls"),"fas fa-file-excel",{event:"EXPORT",options:{type:"xls"}})},P=function(){return O($t("general.export_csv"),"fas fa-file-csv",{event:"EXPORT",options:{type:"csv"}})},R={key_p:{type:"event",emit:"EXPORT",payload:{type:"print"}}},S={key_e:{type:"event",emit:"EXPORT",payload:{type:"pdf"}}},T=r(r(r({},{key_f:{type:"event",emit:"TOGGLE_FILTER"}}),R),S)},73513:(t,n,a)=>{a.d(n,{Z:()=>l});var e=a(94015),o=a.n(e),i=a(23645),r=a.n(i)()(o());r.push([t.id,".table-wrapper.has-checkbox .custom-control-label:after,.table-wrapper.has-checkbox .custom-control-label:before{top:-1rem}","",{version:3,sources:["webpack://./resources/js/views/app/config/locale/translation.vue"],names:[],mappings:"AA6SI,iHACI,SAzSR",sourcesContent:["\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.table-wrapper.has-checkbox .custom-control-label {\n    &:before {\n        top: -1rem;\n    }\n    &:after {\n        top: -1rem;\n    }\n}\n"],sourceRoot:""}]);const l=r},24548:(t,n,a)=>{a.r(n),a.d(n,{default:()=>h});var e=a(20629),o=a(46830);function i(t,n){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var e=Object.getOwnPropertySymbols(t);n&&(e=e.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),a.push.apply(a,e)}return a}function r(t){for(var n=1;n<arguments.length;n++){var a=null!=arguments[n]?arguments[n]:{};n%2?i(Object(a),!0).forEach((function(n){l(t,n,a[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(a,n))}))}return t}function l(t,n,a){return n in t?Object.defineProperty(t,n,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[n]=a,t}const s={components:{},data:function(){return{activeModule:"auth",formData:{words:{}},preRequisite:{locales:[],modules:[]},formErrors:{},initialFormData:null,emptyFormData:null,showLocaleEditModal:!1,isModalLoading:!0,modalData:{locale:"en",label:null,translationInEn:null,translation:null,firstKey:null,secondKey:null,thirdKey:null,fourthKey:null},initialModalData:{},isLoading:!1,showReloadBtn:!1}},computed:r({},(0,e.Se)("config",["vars"])),methods:r(r(r({},(0,e.nv)("common",["Custom","SetPageHeader"])),(0,e.nv)("config",["SetUiConfig"])),{},{getInitialData:function(){var t=this;this.isLoading=!0,this.$route.query&&this.$route.query.module&&(this.activeModule=this.$route.query.module),this.Custom({url:"config/locales/pre-requisite",params:{module:this.activeModule}}).then((function(n){t.preRequisite.locales=_.cloneDeep(n.locales),t.preRequisite.modules=_.cloneDeep(n.modules),n.words.objForEach((function(n,a){_.isObject(n)?t.formData.words[a]=Object.assign({},n):t.formData.words[a]={}})),t.initialFormData=Object.assign({},t.formData),t.initialModalData=Object.assign({},t.modalData),t.isLoading=!1})).catch((function(n){t.isLoading=!1,t.formErrors=formUtil.handleErrors(n)}))},humanize:function(t){return _.startCase(t)},getLocaleByCode:function(t){var n=this.preRequisite.locales.find((function(n){return n.locale===t}));return n?"".concat(n.name," (").concat(t,")"):t},updateRouteQuery:function(t){var n=Object.assign({},this.$route.query,t);this.$router.push({path:this.$route.path,query:n})},isString:function(t){return _.isString(t)},isObject:function(t){return _.isObject(t)},toggleLocaleEditModal:function(t,n,a,e,o){this.modalData=_.cloneDeep(this.initialModalData),this.modalData.locale=t,this.modalData.firstKey=n,this.modalData.secondKey=a,this.modalData.thirdKey=e,this.modalData.fourthKey=o,this.modalData.label=this.getLabel(n,a,e,o),this.modalData.translationInEn=this.getTranslation("en",n,a,e,o),this.modalData.translation=this.getTranslation(t,n,a,e,o),this.showLocaleEditModal=!0,this.isModalLoading=!1},onLocaleEditModalShown:function(){var t=this;this.$nextTick((function(){t.$refs.newTranslation.$refs["base-input-newTranslation"].focus()}))},getTranslation:function(t,n,a,e,o){return this.formData.words[t][n]?a&&this.formData.words[t][n][a]?e&&this.formData.words[t][n][a][e]?o&&this.formData.words[t][n][a][e][o]?this.formData.words[t][n][a][e][o]:o?"":this.formData.words[t][n][a][e]:e?"":this.formData.words[t][n][a]:a?"":this.formData.words[t][n]:""},getLabel:function(t,n,a,e){return t+(n?a?e?" -> "+n+" -> "+a+" -> "+e:" -> "+n+" -> "+a:" -> "+n:"")},onLocaleEditModalHidden:function(){this.isModalLoading=!0},onLocaleEditModalOK:function(t){var n=this;t.preventDefault(),this.isModalLoading=!0,this.modalData.firstKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey]={}),this.modalData.secondKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey]={}),this.modalData.thirdKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey]={}),this.modalData.fourthKey&&!this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey][this.modalData.fourthKey]&&(this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey][this.modalData.fourthKey]={}),this.modalData.firstKey&&this.modalData.secondKey&&this.modalData.thirdKey&&this.modalData.fourthKey?this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey][this.modalData.fourthKey]=this.modalData.translation:this.modalData.firstKey&&this.modalData.secondKey&&this.modalData.thirdKey?this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey][this.modalData.thirdKey]=this.modalData.translation:this.modalData.firstKey&&this.modalData.secondKey?this.formData.words[this.modalData.locale][this.modalData.firstKey][this.modalData.secondKey]=this.modalData.translation:this.modalData.firstKey&&(this.formData.words[this.modalData.locale][this.modalData.firstKey]=this.modalData.translation),this.Custom({url:"config/locales/".concat(this.modalData.locale,"/translate"),method:"post",data:{module:this.activeModule,words:this.formData.words[this.modalData.locale]}}).then((function(t){n.initialFormData=_.cloneDeep(n.formData),n.modalData=_.cloneDeep(n.initialModalData),n.$refs.localeEditModal.hide(),n.showReloadBtn=!0})).catch((function(t){n.formData=_.cloneDeep(n.initialFormData),n.isModalLoading=!1,n.formErrors=formUtil.handleErrors(t)}))},applyPageHeader:function(){var t={buttons:[o.K0("appConfigLocaleAdd","access-config")]};this.SetPageHeader(t)},reloadPage:function(){location.reload(!0)}}),mounted:function(){this.emptyFormData=Object.assign({},this.formData),this.getInitialData(),this.applyPageHeader()},watch:{$route:function(){this.getInitialData()}}};var c=a(93379),d=a.n(c),u=a(73513),f={insert:"head",singleton:!1};d()(u.Z,f);u.Z.locals;const h=(0,a(51900).Z)(s,(function(){var t=this,n=t.$createElement,a=t._self._c||n;return a("base-container",{staticClass:"p-0 flex-grow",attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[a("div",{staticClass:"d-flex justify-content-between"},[a("div",{staticClass:"text-left p-4"},[t.showReloadBtn?a("base-button",{attrs:{type:"button",design:"light",size:"md"},on:{click:t.reloadPage}},[a("i",{staticClass:"fas fa-sync-alt"}),t._v(" "+t._s(t.$t("general.reload_page")))]):t._e()],1),t._v(" "),a("div",{staticClass:"text-right p-4"},[a("base-dropdown",{attrs:{tag:"div",direction:"down","menu-classes":"show-dropdown-up",position:"right"}},[a("base-button",{attrs:{slot:"title",type:"button","data-toggle":"dropdown",role:"button",design:"info",size:"md"},slot:"title"},[a("i",{staticClass:"fas fa-boxes"}),t._v(" "+t._s(t.$t(t.activeModule+"."+t.activeModule))+" "),a("i",{staticClass:"fas fa-chevron-down"})]),t._v(" "),t._l(t.preRequisite.modules,(function(n){return a("a",{key:n,staticClass:"dropdown-item",on:{click:function(a){return t.updateRouteQuery({module:n})}}},[t._v("\n                    "+t._s(t.$t(n+"."+n))+"\n                    "),n==t.activeModule?a("i",{staticClass:"fas fa-check pull-right"}):t._e()])}))],2)],1)]),t._v(" "),a("div",{staticClass:"table-responsive table-wrapper"},[a("form",{on:{submit:function(n){return n.preventDefault(),t.submit.apply(null,arguments)}}},[a("table",{staticClass:"table b-table table-striped table-hover b-table-stacked-sm"},[a("thead",[a("tr",[a("th",[t._v(t._s(t.$t("config.locale.key")))]),t._v(" "),t._l(t.preRequisite.locales,(function(n){return a("th",{key:n.locale},[t._v(t._s(n.name+" ("+n.locale+")"))])}))],2)]),t._v(" "),a("tbody",[t._l(t.formData.words.en,(function(n,e){return[t.isString(n)?[a("tr",{key:e},[a("td",[t._v(t._s(e))]),t._v(" "),t._l(t.preRequisite.locales,(function(n){return a("td",{key:n.locale,on:{dblclick:function(a){return t.toggleLocaleEditModal(n.locale,e)}}},[t._v(t._s(t.getTranslation(n.locale,e)))])}))],2)]:t._e(),t._v(" "),t.isObject(n)?[t._l(n,(function(n,o){return[t.isString(n)?[a("tr",{key:""+e+o},[a("td",[t._v(t._s(e)+" -> "+t._s(o))]),t._v(" "),t._l(t.preRequisite.locales,(function(n){return a("td",{key:n.locale,on:{dblclick:function(a){return t.toggleLocaleEditModal(n.locale,e,o)}}},[t._v(t._s(t.getTranslation(n.locale,e,o)))])}))],2)]:t._e(),t._v(" "),t.isObject(n)?[t._l(n,(function(n,i){return[t.isString(n)?[a("tr",{key:""+e+o+i},[a("td",[t._v(t._s(e)+" -> "+t._s(o)+" -> "+t._s(i))]),t._v(" "),t._l(t.preRequisite.locales,(function(n){return a("td",{key:n.locale,on:{dblclick:function(a){return t.toggleLocaleEditModal(n.locale,e,o,i)}}},[t._v(t._s(t.getTranslation(n.locale,e,o,i)))])}))],2)]:t._e(),t._v(" "),t.isObject(n)?t._l(n,(function(n,r){return a("tr",{key:""+e+o+i+r},[a("td",[t._v(t._s(e)+" -> "+t._s(o)+" -> "+t._s(i)+" -> "+t._s(r))]),t._v(" "),t._l(t.preRequisite.locales,(function(n){return a("td",{key:n.locale,on:{dblclick:function(a){return t.toggleLocaleEditModal(n.locale,e,o,i,r)}}},[t._v(t._s(t.getTranslation(n.locale,e,o,i,r)))])}))],2)})):t._e()]}))]:t._e()]}))]:t._e()]}))],2)])])]),t._v(" "),a("b-modal",{ref:"localeEditModal",attrs:{size:"md",centered:"",lazy:"",busy:t.isModalLoading,"no-close-on-backdrop":"","no-close-on-esc":""},on:{ok:t.onLocaleEditModalOK,hidden:t.onLocaleEditModalHidden,shown:t.onLocaleEditModalShown},model:{value:t.showLocaleEditModal,callback:function(n){t.showLocaleEditModal=n},expression:"showLocaleEditModal"}},[a("template",{slot:"modal-header"},[a("h5",{staticClass:"modal-title"},[t._v(t._s(t.$t("config.locale.translation")))])]),t._v(" "),a("div",[a("div",{staticClass:"row"},[a("div",{staticClass:"col-12"},[a("base-input",{ref:"newTranslation",staticClass:"mb-5",attrs:{label:t.modalData.label+" ("+t.modalData.locale+")",type:"text",error:t.formErrors.translation,name:"newTranslation"},on:{"update:error":function(n){return t.$set(t.formErrors,"translation",n)}},model:{value:t.modalData.translation,callback:function(n){t.$set(t.modalData,"translation",n)},expression:"modalData.translation"}})],1)]),t._v(" "),a("p",{staticClass:"text-muted small m-0"},[t._v("In English - "+t._s(t.modalData.translationInEn))])])],2)],1)}),[],!1,null,null,null).exports}}]);