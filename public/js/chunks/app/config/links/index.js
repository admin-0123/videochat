/*! For license information please see index.js.LICENSE.txt */
"use strict";(self.webpackChunkConnect=self.webpackChunkConnect||[]).push([[9552],{78248:(t,e,r)=>{r.d(e,{Z:()=>l});var n=r(20629),o=r(17107);r(10013);function i(t){return i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},i(t)}function a(){a=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",s=n.asyncIterator||"@@asyncIterator",c=n.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function f(t,e,r,n){var o=e&&e.prototype instanceof p?e:p,i=Object.create(o.prototype),a=new O(n||[]);return i._invoke=function(t,e,r){var n="suspendedStart";return function(o,i){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw i;return k()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var s=E(a,r);if(s){if(s===h)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var c=l(t,e,r);if("normal"===c.type){if(n=r.done?"completed":"suspendedYield",c.arg===h)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n="completed",r.method="throw",r.arg=c.arg)}}}(t,r,a),i}function l(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=f;var h={};function p(){}function m(){}function d(){}var y={};u(y,o,(function(){return this}));var v=Object.getPrototypeOf,g=v&&v(v(_([])));g&&g!==e&&r.call(g,o)&&(y=g);var b=d.prototype=p.prototype=Object.create(y);function w(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function D(t,e){function n(o,a,s,c){var u=l(t[o],t,a);if("throw"!==u.type){var f=u.arg,h=f.value;return h&&"object"==i(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){n("next",t,s,c)}),(function(t){n("throw",t,s,c)})):e.resolve(h).then((function(t){f.value=t,s(f)}),(function(t){return n("throw",t,s,c)}))}c(u.arg)}var o;this._invoke=function(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}}function E(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,E(t,e),"throw"===e.method))return h;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return h}var n=l(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,h;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,h):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,h)}function x(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function L(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function O(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(x,this),this.reset(!0)}function _(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:k}}function k(){return{value:void 0,done:!0}}return m.prototype=d,u(b,"constructor",d),u(d,"constructor",m),m.displayName=u(d,c,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,d):(t.__proto__=d,u(t,c,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},w(D.prototype),u(D.prototype,s,(function(){return this})),t.AsyncIterator=D,t.async=function(e,r,n,o,i){void 0===i&&(i=Promise);var a=new D(f(e,r,n,o),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},w(b),u(b,c,"Generator"),u(b,o,(function(){return this})),u(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=_,O.prototype={constructor:O,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(L),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],a=i.completion;if("root"===i.tryLoc)return n("end");if(i.tryLoc<=this.prev){var s=r.call(i,"catchLoc"),c=r.call(i,"finallyLoc");if(s&&c){if(this.prev<i.catchLoc)return n(i.catchLoc,!0);if(this.prev<i.finallyLoc)return n(i.finallyLoc)}else if(s){if(this.prev<i.catchLoc)return n(i.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return n(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,h):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),h},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),L(r),h}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;L(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:_(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),h}},t}function s(t,e,r,n,o,i,a){try{var s=t[i](a),c=s.value}catch(t){return void r(t)}s.done?e(c):Promise.resolve(c).then(n,o)}function c(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function u(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?c(Object(r),!0).forEach((function(e){f(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function f(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}const l={components:{},data:function(){return{formData:{},formErrors:{},initialFormData:null,initianLength:0,emptyFormData:null,entity:null,preRequisite:{},isLoading:!0,useUserPreference:!1,dataType:null,configType:""}},computed:u(u({},(0,n.Se)("config",{configsWithPreference:"configs",configs:"configsOriginal",vars:"vars",allowExtraInput:"allowExtraInput"})),{},{formHasErrors:function(){var t=!1;return this.formErrors.objForEach((function(e){t=""!==e||t})),t}}),methods:u(u(u(u(u({},(0,n.nv)("config",["GetConfig"])),(0,n.nv)("user",["GetUser"])),(0,n.nv)("navigation",["Generate"])),(0,n.nv)("common",["Custom"])),{},{findActualValue:function(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"uuid";return e.find((function(e){return e[r]===t}))||null},submit:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if(formUtil.isUnchanged(this.initialFormData,this.formData))return this.$toasted.info(this.$t("general.nothing_changed"),this.$toastConfig.info),!1;this.isLoading=!0,this.formData.hasOwnProperty("type")&&(this.formData.type=this.formData.type.snakeCase());var r=!0===e||this.useUserPreference?o.sS:"module"===this.configType?o.DE:o.Vx;if(this.beforeSubmit&&"function"==typeof this.beforeSubmit){var n=this.beforeSubmit();if(!1===n)return void(this.isLoading=!1)}r(this.formData).then((function(r){(!0===e||t.useUserPreference?t.GetUser:t.GetConfig)().then((function(){t.$toasted.success(r.message,t.$toastConfig),t.initialFormData=_.cloneDeep(t.formData),t.isLoading=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)})),"function"==typeof t.afterSubmit&&t.afterSubmit(),"function"==typeof t.afterSubmitSuccess&&t.afterSubmitSuccess()})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e),"function"==typeof t.afterSubmit&&t.afterSubmit(),"function"==typeof t.afterSubmitError&&t.afterSubmitError()}))},reset:function(){var t=this;formUtil.confirmAction().then((function(e){e.value&&(t.formData=Object.assign({},t.formData,_.cloneDeep(t.initialFormData)))}))},unsavedCheck:function(t){formUtil.unsavedCheckAlert(this.initialFormData,this.formData,t)},fillPreRequisite:function(t){var e=this;this.preRequisite.objForEach((function(r,n){e.preRequisite[n]=t.hasOwnProperty(n)?t[n]:r})),this.isLoading=!1},fillFormData:function(){var t=this;this.isLoading=!0;var e=this.useUserPreference?this.configsWithPreference:this.configs;this.formData.type&&e[this.formData.type]&&(this.formData=formUtil.assignValues(this.formData,e[this.formData.type])),this.formData.types&&Array.isArray(this.formData.types)&&this.formData.types.forEach((function(r){t.formData=formUtil.assignValues(t.formData,e[r])})),this.formData.override&&this.formData.objForEach((function(r,n){r&&_.isObject(r)?t.formData[n]=formUtil.assignValues(t.formData[n],e[n]):t.formData[n]=e[n]?e[n]:r})),"function"==typeof this.addNewRow&&"function"==typeof this.addNewRowIfNone&&this.addNewRowIfNone(),this.isLoading=!1},getInitialData:function(t){var e,r=this;return(e=a().mark((function e(){var n;return a().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r.isLoading=!0,e.prev=1,e.next=4,o.B_(Object.keys(r.preRequisite).join(","));case 4:return n=e.sent,r.fillPreRequisite(n),t&&r.$nextTick((function(){t()})),e.abrupt("return",n);case 10:throw e.prev=10,e.t0=e.catch(1),r.isLoading=!1,r.formErrors=formUtil.handleErrors(e.t0),e.t0;case 15:case"end":return e.stop()}}),e,null,[[1,10]])})),function(){var t=this,r=arguments;return new Promise((function(n,o){var i=e.apply(t,r);function a(t){s(i,n,o,a,c,"next",t)}function c(t){s(i,n,o,a,c,"throw",t)}a(void 0)}))})()}}),mounted:function(){this.fillFormData(),this.initialFormData=_.cloneDeep(this.formData)},beforeDestroy:function(){delete this.formData,delete this.formErrors,delete this.preRequisite},beforeRouteLeave:function(t,e,r){this.unsavedCheck(r)}}},12449:(t,e,r)=>{r.r(e),r.d(e,{default:()=>o});const n={extends:r(78248).Z,data:function(){return{formData:{pusherHelper:"",signalHelper:"",iceHelper:"",type:"links"}}}};const o=(0,r(51900).Z)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("base-container",{attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 mb-4"},[r("base-input",{attrs:{"auto-focus":"",label:t.$t("config.links.url",{attribute:t.$t("config.links.pusher_helper")}),type:"text",error:t.formErrors.pusherHelper},on:{"update:error":function(e){return t.$set(t.formErrors,"pusherHelper",e)}},model:{value:t.formData.pusherHelper,callback:function(e){t.$set(t.formData,"pusherHelper",e)},expression:"formData.pusherHelper"}})],1),t._v(" "),r("div",{staticClass:"col-12 mb-4"},[r("base-input",{attrs:{"auto-focus":"",label:t.$t("config.links.url",{attribute:t.$t("config.links.signal_helper")}),type:"text",error:t.formErrors.signalHelper},on:{"update:error":function(e){return t.$set(t.formErrors,"signalHelper",e)}},model:{value:t.formData.signalHelper,callback:function(e){t.$set(t.formData,"signalHelper",e)},expression:"formData.signalHelper"}})],1),t._v(" "),r("div",{staticClass:"col-12 mb-4"},[r("base-input",{attrs:{"auto-focus":"",label:t.$t("config.links.url",{attribute:t.$t("config.links.ice_helper")}),type:"text",error:t.formErrors.iceHelper},on:{"update:error":function(e){return t.$set(t.formErrors,"iceHelper",e)}},model:{value:t.formData.iceHelper,callback:function(e){t.$set(t.formData,"iceHelper",e)},expression:"formData.iceHelper"}})],1)]),t._v(" "),r("div",{staticClass:"text-right mt-5"},[r("base-button",{attrs:{type:"button",design:"light",click:"reset"}},[t._v(t._s(t.$t("general.reset")))]),t._v(" "),r("base-button",{attrs:{type:"submit",design:"primary"}},[t._v(t._s(t.$t("general.save")))])],1)])])}),[],!1,null,null,null).exports}}]);