/*! For license information please see index.js.LICENSE.txt */
"use strict";(self.webpackChunkConnect=self.webpackChunkConnect||[]).push([[5028],{85412:(t,e,r)=>{r.d(e,{Z:()=>h});var o=r(17107),n=r(86908),a=r(20629),i=r(72238);function l(t){return l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},l(t)}function c(){c=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},n=o.iterator||"@@iterator",a=o.asyncIterator||"@@asyncIterator",i=o.toStringTag||"@@toStringTag";function s(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{s({},"")}catch(t){s=function(t,e,r){return t[e]=r}}function u(t,e,r,o){var n=e&&e.prototype instanceof h?e:h,a=Object.create(n.prototype),i=new L(o||[]);return a._invoke=function(t,e,r){var o="suspendedStart";return function(n,a){if("executing"===o)throw new Error("Generator is already running");if("completed"===o){if("throw"===n)throw a;return x()}for(r.method=n,r.arg=a;;){var i=r.delegate;if(i){var l=w(i,r);if(l){if(l===f)continue;return l}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===o)throw o="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);o="executing";var c=d(t,e,r);if("normal"===c.type){if(o=r.done?"completed":"suspendedYield",c.arg===f)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(o="completed",r.method="throw",r.arg=c.arg)}}}(t,r,i),a}function d(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var f={};function h(){}function g(){}function p(){}var m={};s(m,n,(function(){return this}));var v=Object.getPrototypeOf,y=v&&v(v(D([])));y&&y!==e&&r.call(y,n)&&(m=y);var b=p.prototype=h.prototype=Object.create(m);function C(t){["next","throw","return"].forEach((function(e){s(t,e,(function(t){return this._invoke(e,t)}))}))}function k(t,e){function o(n,a,i,c){var s=d(t[n],t,a);if("throw"!==s.type){var u=s.arg,f=u.value;return f&&"object"==l(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){o("next",t,i,c)}),(function(t){o("throw",t,i,c)})):e.resolve(f).then((function(t){u.value=t,i(u)}),(function(t){return o("throw",t,i,c)}))}c(s.arg)}var n;this._invoke=function(t,r){function a(){return new e((function(e,n){o(t,r,e,n)}))}return n=n?n.then(a,a):a()}}function w(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,w(t,e),"throw"===e.method))return f;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return f}var o=d(r,t.iterator,e.arg);if("throw"===o.type)return e.method="throw",e.arg=o.arg,e.delegate=null,f;var n=o.arg;return n?n.done?(e[t.resultName]=n.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,f):n:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,f)}function S(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function _(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function L(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(S,this),this.reset(!0)}function D(t){if(t){var e=t[n];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,a=function e(){for(;++o<t.length;)if(r.call(t,o))return e.value=t[o],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:x}}function x(){return{value:void 0,done:!0}}return g.prototype=p,s(b,"constructor",p),s(p,"constructor",g),g.displayName=s(p,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===g||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,s(t,i,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},C(k.prototype),s(k.prototype,a,(function(){return this})),t.AsyncIterator=k,t.async=function(e,r,o,n,a){void 0===a&&(a=Promise);var i=new k(u(e,r,o,n),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},C(b),s(b,i,"Generator"),s(b,n,(function(){return this})),s(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var o=e.pop();if(o in t)return r.value=o,r.done=!1,r}return r.done=!0,r}},t.values=D,L.prototype={constructor:L,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(_),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function o(r,o){return i.type="throw",i.arg=t,e.next=r,o&&(e.method="next",e.arg=void 0),!!o}for(var n=this.tryEntries.length-1;n>=0;--n){var a=this.tryEntries[n],i=a.completion;if("root"===a.tryLoc)return o("end");if(a.tryLoc<=this.prev){var l=r.call(a,"catchLoc"),c=r.call(a,"finallyLoc");if(l&&c){if(this.prev<a.catchLoc)return o(a.catchLoc,!0);if(this.prev<a.finallyLoc)return o(a.finallyLoc)}else if(l){if(this.prev<a.catchLoc)return o(a.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return o(a.finallyLoc)}}}},abrupt:function(t,e){for(var o=this.tryEntries.length-1;o>=0;--o){var n=this.tryEntries[o];if(n.tryLoc<=this.prev&&r.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var a=n;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,f):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),f},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),_(r),f}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var o=r.completion;if("throw"===o.type){var n=o.arg;_(r)}return n}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:D(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),f}},t}function s(t,e,r,o,n,a,i){try{var l=t[a](i),c=l.value}catch(t){return void r(t)}l.done?e(c):Promise.resolve(c).then(o,n)}function u(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function d(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?u(Object(r),!0).forEach((function(e){f(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):u(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function f(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}const h={components:{CollapseTransition:n.A1},data:function(){return{formData:d(d({},i.Z),{},{type:"ui"}),actions:{leftSidebarStyle:{"push-content":{leftSidebarBackdrop:!1,leftSidebarShadow:!1,leftSidebarShow:!0},push:{leftSidebarShow:!0},over:{leftSidebarBackdrop:!0,leftSidebarShadow:!0,leftSidebarShow:!0},folded:{leftSidebarBackdrop:!0,leftSidebarShow:!1},"off-canvas":{leftSidebarShow:!0}},topNavbarHide:{true:{leftSidebarHeight:"full"}},leftSidebarHeight:{normal:{topNavbarHide:!1}},pageHeaderIsBoxed:{true:{pageHeaderBackgroundColor:"primary",colorScheme:"custom"}},pageHeaderBackgroundColor:{transparent:{pageHeaderIsBoxed:!1},any:{colorScheme:"custom"}},pageBackgroundColor:{any:{colorScheme:"custom"}},pageContainerBackgroundColor:{any:{colorScheme:"custom"}},leftSidebarColor:{any:{colorScheme:"custom"}},rightSidebarColor:{any:{colorScheme:"custom"}},modalSidebarColor:{any:{colorScheme:"custom"}},specialSidebarColor:{any:{colorScheme:"custom"}},topNavbarColor:{any:{colorScheme:"custom"}},colorScheme:{default:{pageBackgroundColor:"light",pageContainerBackgroundColor:"white",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"dark-primary",leftSidebarLogoLight:!0,rightSidebarColor:"white",modalSidebarColor:"white",specialSidebarColor:"secondary",topNavbarColor:"black",topNavbarLogoLight:!0},white:{pageBackgroundColor:"white",pageContainerBackgroundColor:"white",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"white",leftSidebarLogoLight:!1,rightSidebarColor:"white",modalSidebarColor:"white",specialSidebarColor:"white",topNavbarColor:"white",topNavbarLogoLight:!1},light:{pageBackgroundColor:"light",pageContainerBackgroundColor:"white",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"white",leftSidebarLogoLight:!1,rightSidebarColor:"white",modalSidebarColor:"white",specialSidebarColor:"light",topNavbarColor:"white",topNavbarLogoLight:!1},dark:{pageBackgroundColor:"black",pageContainerBackgroundColor:"gray-darkest",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"gray-darkest",leftSidebarLogoLight:!0,rightSidebarColor:"gray-darkest",modalSidebarColor:"black",specialSidebarColor:"black",topNavbarColor:"gray-darkest",topNavbarLogoLight:!0},"semi-dark":{pageBackgroundColor:"gray-darkest",pageContainerBackgroundColor:"gray-darker",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"dark-primary",leftSidebarLogoLight:!0,rightSidebarColor:"gray-darker",modalSidebarColor:"gray-darker",specialSidebarColor:"primary",topNavbarColor:"black",topNavbarLogoLight:!0},casual:{pageBackgroundColor:"light",pageContainerBackgroundColor:"white",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"primary",leftSidebarLogoLight:!0,rightSidebarColor:"white",modalSidebarColor:"white",specialSidebarColor:"success",topNavbarColor:"dark-primary",topNavbarLogoLight:!0},business:{pageBackgroundColor:"light",pageContainerBackgroundColor:"white",pageHeaderBackgroundColor:"transparent",leftSidebarColor:"gray-darkest",leftSidebarLogoLight:!0,rightSidebarColor:"white",modalSidebarColor:"white",specialSidebarColor:"white",topNavbarColor:"white",topNavbarLogoLight:!1}}},formErrors:{},preRequisite:{},colors:[{key:"primary",title:"Primary"},{key:"dark-primary",title:"Dark Primary"},{key:"secondary",title:"Secondary"},{key:"success",title:"Success"},{key:"info",title:"Info"},{key:"warning",title:"Warning"},{key:"danger",title:"Danger"},{key:"white",title:"White"},{key:"light",title:"Light"},{key:"dark",title:"Dark"},{key:"gray-darker",title:"Darker"},{key:"gray-darkest",title:"Darkest"},{key:"black",title:"Black"}],colorSchemes:[{key:"default",title:"Default"},{key:"white",title:"White"},{key:"light",title:"Light"},{key:"dark",title:"Dark"},{key:"semi-dark",title:"Semi Dark"},{key:"casual",title:"Casual"},{key:"business",title:"Business"}],initialFormData:null,emptyFormData:null,readyForAction:!1,isLoading:!0,getInitialDataCalled:!1}},computed:d(d({},(0,a.Se)("config",["vars","uiConfigs"])),{},{computedFormData:function(){return _.cloneDeep(this.formData)}}),watch:{computedFormData:{deep:!0,handler:_.debounce((function(t,e){var r=this;this.readyForAction&&(t=this.processActions(t,e),this.formData.objForEach((function(e,o){r.formData[o]=t[o]})),this.SetUiConfig(t)),"function"==typeof this.afterSettingConfig&&this.$nextTick((function(){r.afterSettingConfig()})),this.readyForAction=!0}),500)}},methods:d(d(d({},(0,a.nv)("config",["GetConfig"])),(0,a.nv)("config",["SetUiConfig"])),{},{processActions:function(t,e){return this.actions.objForEach((function(r,o){if(t[o]!==e[o]){var n=r[t[o]];n&&n.objForEach((function(e,r){t[r]=e}));var a=r.any;a&&a.objForEach((function(e,r){t[r]=e}))}})),t},findActualValue:function(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"uuid";return e.find((function(e){return e[r]===t}))||null},submit:function(){var t=this;if(formUtil.isUnchanged(this.initialFormData,this.formData))return this.$toasted.info(this.$t("general.nothing_changed"),this.$toastConfig.info),!1;this.isLoading=!0,o.Vx(this.formData).then((function(e){t.GetConfig().then((function(){t.isLoading=!1,t.getInitialDataCalled&&t.getInitialData(),t.$toasted.success(e.message,t.$toastConfig.success),t.initialFormData=Object.assign({},t.formData)})).catch((function(e){t.isLoading=!1,formUtil.handleErrors(e)}))})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)}))},reset:function(){var t=this;formUtil.confirmAction().then((function(e){e.value&&(t.formData=Object.assign({},t.formData,_.cloneDeep(t.initialFormData)))}))},unsavedCheck:function(t){var e=this;formUtil.unsavedCheckAlert(this.initialFormData,this.formData,(function(r){r?(e.SetUiConfig(e.initialFormData),t()):!1!==r&&t()}))},fillPreRequisite:function(t){var e=this;this.preRequisite.objForEach((function(r,o){e.preRequisite[o]=t.hasOwnProperty(o)?t[o]:r})),this.isLoading=!1},fillFormData:function(){this.isLoading=!0,this.uiConfigs&&(this.formData=formUtil.assignValues(this.formData,this.uiConfigs)),this.isLoading=!1},getInitialData:function(t){var e,r=this;return(e=c().mark((function e(){var n;return c().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r.isLoading=!0,r.getInitialDataCalled=!0,e.prev=2,e.next=5,o.B_(Object.keys(r.preRequisite).join(","));case 5:return n=e.sent,r.fillPreRequisite(n),t&&r.$nextTick((function(){t()})),e.abrupt("return",n);case 11:throw e.prev=11,e.t0=e.catch(2),r.isLoading=!1,r.formErrors=formUtil.handleErrors(e.t0),e.t0;case 16:case"end":return e.stop()}}),e,null,[[2,11]])})),function(){var t=this,r=arguments;return new Promise((function(o,n){var a=e.apply(t,r);function i(t){s(a,o,n,i,l,"next",t)}function l(t){s(a,o,n,i,l,"throw",t)}i(void 0)}))})()}}),mounted:function(){this.fillFormData(),this.initialFormData=_.cloneDeep(this.formData)},beforeDestroy:function(){delete this.formData,delete this.formErrors,delete this.preRequisite},beforeRouteLeave:function(t,e,r){this.unsavedCheck(r)}}},52738:(t,e,r)=>{r.d(e,{Z:()=>l});var o=r(94015),n=r.n(o),a=r(23645),i=r.n(a)()(n());i.push([t.id,".color-item[data-v-38b63aa0]{width:100%}.color-list[data-v-38b63aa0]{align-items:center;display:flex;flex-wrap:wrap;justify-content:space-between}.color-list>.color-item[data-v-38b63aa0]{flex:0 50%}","",{version:3,sources:["webpack://./resources/js/views/app/ui-config/page/index.vue"],names:[],mappings:"AA0FA,6BACI,UAzFJ,CA4FA,6BAEI,kBAAA,CADA,YAAA,CAGA,cAAA,CADA,6BAxFJ,CA2FI,yCACI,UAzFR",sourcesContent:["\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.color-item {\n    width: 100%;\n}\n\n.color-list {\n    display: flex;\n    align-items: center;\n    justify-content: space-between;\n    flex-wrap: wrap;\n\n    > .color-item {\n        flex: 0 50%;\n    }\n}\n\n"],sourceRoot:""}]);const l=i},11025:(t,e,r)=>{r.r(e),r.d(e,{default:()=>c});const o={extends:r(85412).Z,methods:{getWallpaper:function(){this.$store.dispatch("config/getWallpaper")}}};var n=r(93379),a=r.n(n),i=r(52738),l={insert:"head",singleton:!1};a()(i.Z,l);i.Z.locals;const c=(0,r(51900).Z)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("base-container",{attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-6 mb-5"},[r("h6",{staticClass:"font-weight-700"},[t._v(t._s(t.$t("config.ui.page_bg_color")))]),t._v(" "),r("div",{staticClass:"color-list mt-3"},t._l(t.colors,(function(e){return r("base-radio",{key:e.key,staticClass:"color-item mb-2",attrs:{value:e.key,type:e.key},model:{value:t.formData.pageBackgroundColor,callback:function(e){t.$set(t.formData,"pageBackgroundColor",e)},expression:"formData.pageBackgroundColor"}},[t._v("\n                        "+t._s(e.title)+"\n                    ")])})),1)]),t._v(" "),r("div",{staticClass:"col-12 col-md-6 mb-5"},[r("h6",{staticClass:"font-weight-700"},[t._v(t._s(t.$t("config.ui.page_container_bg_color")))]),t._v(" "),r("div",{staticClass:"color-list mt-3"},t._l(t.colors,(function(e){return r("base-radio",{key:e.key,staticClass:"color-item mb-2",attrs:{value:e.key,type:e.key},model:{value:t.formData.pageContainerBackgroundColor,callback:function(e){t.$set(t.formData,"pageContainerBackgroundColor",e)},expression:"formData.pageContainerBackgroundColor"}},[t._v("\n                        "+t._s(e.title)+"\n                    ")])})),1)])]),t._v(" "),r("h4",[t._v(t._s(t.$t("config.ui.page_header")))]),t._v(" "),r("hr",{staticClass:"mt-3 mb-4"}),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-6 mb-5"},[r("h6",{staticClass:"font-weight-700"},[t._v(t._s(t.$t("config.ui.bg_color")))]),t._v(" "),r("div",{staticClass:"color-list mt-3"},[r("base-radio",{staticClass:"color-item mb-2",attrs:{value:"transparent"},model:{value:t.formData.pageHeaderBackgroundColor,callback:function(e){t.$set(t.formData,"pageHeaderBackgroundColor",e)},expression:"formData.pageHeaderBackgroundColor"}},[t._v("\n                        "+t._s(t.$t("config.ui.transparent"))+"\n                    ")]),t._v(" "),t._l(t.colors,(function(e){return r("base-radio",{key:e.key,staticClass:"color-item mb-2",attrs:{value:e.key,type:e.key},model:{value:t.formData.pageHeaderBackgroundColor,callback:function(e){t.$set(t.formData,"pageHeaderBackgroundColor",e)},expression:"formData.pageHeaderBackgroundColor"}},[t._v("\n                        "+t._s(e.title)+"\n                    ")])}))],2)]),t._v(" "),r("div",{staticClass:"col-12 col-md-6"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 mb-5"},[r("h6",{staticClass:"font-weight-700"},[t._v(t._s(t.$t("config.ui.boxed")))]),t._v(" "),r("div",{staticClass:"d-flex align-items-center mt-3"},[r("base-radio",{attrs:{value:!1,inline:""},model:{value:t.formData.pageHeaderIsBoxed,callback:function(e){t.$set(t.formData,"pageHeaderIsBoxed",e)},expression:"formData.pageHeaderIsBoxed"}},[t._v("\n                                "+t._s(t.$t("config.ui.disable"))+"\n                            ")]),t._v(" "),r("base-radio",{attrs:{value:!0,inline:""},model:{value:t.formData.pageHeaderIsBoxed,callback:function(e){t.$set(t.formData,"pageHeaderIsBoxed",e)},expression:"formData.pageHeaderIsBoxed"}},[t._v("\n                                "+t._s(t.$t("config.ui.enable"))+"\n                            ")])],1)])])])]),t._v(" "),r("div",{staticClass:"text-right mt-5"},[r("base-button",{attrs:{type:"button",design:"light"},on:{click:t.reset}},[t._v(t._s(t.$t("general.reset")))]),t._v(" "),r("base-button",{attrs:{type:"submit",design:"primary"}},[t._v(t._s(t.$t("general.save")))])],1)])])}),[],!1,null,"38b63aa0",null).exports}}]);