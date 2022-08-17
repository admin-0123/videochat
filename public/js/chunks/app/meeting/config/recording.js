/*! For license information please see recording.js.LICENSE.txt */
"use strict";(self.webpackChunkConnect=self.webpackChunkConnect||[]).push([[968],{78248:(t,e,r)=>{r.d(e,{Z:()=>l});var o=r(20629),n=r(17107);r(10013);function i(t){return i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},i(t)}function a(){a=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},n=o.iterator||"@@iterator",c=o.asyncIterator||"@@asyncIterator",s=o.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function f(t,e,r,o){var n=e&&e.prototype instanceof h?e:h,i=Object.create(n.prototype),a=new E(o||[]);return i._invoke=function(t,e,r){var o="suspendedStart";return function(n,i){if("executing"===o)throw new Error("Generator is already running");if("completed"===o){if("throw"===n)throw i;return U()}for(r.method=n,r.arg=i;;){var a=r.delegate;if(a){var c=_(a,r);if(c){if(c===d)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===o)throw o="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);o="executing";var s=l(t,e,r);if("normal"===s.type){if(o=r.done?"completed":"suspendedYield",s.arg===d)continue;return{value:s.arg,done:r.done}}"throw"===s.type&&(o="completed",r.method="throw",r.arg=s.arg)}}}(t,r,a),i}function l(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=f;var d={};function h(){}function m(){}function p(){}var v={};u(v,n,(function(){return this}));var g=Object.getPrototypeOf,b=g&&g(g(L([])));b&&b!==e&&r.call(b,n)&&(v=b);var y=p.prototype=h.prototype=Object.create(v);function w(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function D(t,e){function o(n,a,c,s){var u=l(t[n],t,a);if("throw"!==u.type){var f=u.arg,d=f.value;return d&&"object"==i(d)&&r.call(d,"__await")?e.resolve(d.__await).then((function(t){o("next",t,c,s)}),(function(t){o("throw",t,c,s)})):e.resolve(d).then((function(t){f.value=t,c(f)}),(function(t){return o("throw",t,c,s)}))}s(u.arg)}var n;this._invoke=function(t,r){function i(){return new e((function(e,n){o(t,r,e,n)}))}return n=n?n.then(i,i):i()}}function _(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,_(t,e),"throw"===e.method))return d;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var o=l(r,t.iterator,e.arg);if("throw"===o.type)return e.method="throw",e.arg=o.arg,e.delegate=null,d;var n=o.arg;return n?n.done?(e[t.resultName]=n.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,d):n:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,d)}function R(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function x(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function E(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(R,this),this.reset(!0)}function L(t){if(t){var e=t[n];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,i=function e(){for(;++o<t.length;)if(r.call(t,o))return e.value=t[o],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:U}}function U(){return{value:void 0,done:!0}}return m.prototype=p,u(y,"constructor",p),u(p,"constructor",m),m.displayName=u(p,s,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,u(t,s,"GeneratorFunction")),t.prototype=Object.create(y),t},t.awrap=function(t){return{__await:t}},w(D.prototype),u(D.prototype,c,(function(){return this})),t.AsyncIterator=D,t.async=function(e,r,o,n,i){void 0===i&&(i=Promise);var a=new D(f(e,r,o,n),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},w(y),u(y,s,"Generator"),u(y,n,(function(){return this})),u(y,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var o=e.pop();if(o in t)return r.value=o,r.done=!1,r}return r.done=!0,r}},t.values=L,E.prototype={constructor:E,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(x),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function o(r,o){return a.type="throw",a.arg=t,e.next=r,o&&(e.method="next",e.arg=void 0),!!o}for(var n=this.tryEntries.length-1;n>=0;--n){var i=this.tryEntries[n],a=i.completion;if("root"===i.tryLoc)return o("end");if(i.tryLoc<=this.prev){var c=r.call(i,"catchLoc"),s=r.call(i,"finallyLoc");if(c&&s){if(this.prev<i.catchLoc)return o(i.catchLoc,!0);if(this.prev<i.finallyLoc)return o(i.finallyLoc)}else if(c){if(this.prev<i.catchLoc)return o(i.catchLoc,!0)}else{if(!s)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return o(i.finallyLoc)}}}},abrupt:function(t,e){for(var o=this.tryEntries.length-1;o>=0;--o){var n=this.tryEntries[o];if(n.tryLoc<=this.prev&&r.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var i=n;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,d):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),x(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var o=r.completion;if("throw"===o.type){var n=o.arg;x(r)}return n}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:L(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),d}},t}function c(t,e,r,o,n,i,a){try{var c=t[i](a),s=c.value}catch(t){return void r(t)}c.done?e(s):Promise.resolve(s).then(o,n)}function s(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function u(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?s(Object(r),!0).forEach((function(e){f(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function f(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}const l={components:{},data:function(){return{formData:{},formErrors:{},initialFormData:null,initianLength:0,emptyFormData:null,entity:null,preRequisite:{},isLoading:!0,useUserPreference:!1,dataType:null,configType:""}},computed:u(u({},(0,o.Se)("config",{configsWithPreference:"configs",configs:"configsOriginal",vars:"vars",allowExtraInput:"allowExtraInput"})),{},{formHasErrors:function(){var t=!1;return this.formErrors.objForEach((function(e){t=""!==e||t})),t}}),methods:u(u(u(u(u({},(0,o.nv)("config",["GetConfig"])),(0,o.nv)("user",["GetUser"])),(0,o.nv)("navigation",["Generate"])),(0,o.nv)("common",["Custom"])),{},{findActualValue:function(t,e){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"uuid";return e.find((function(e){return e[r]===t}))||null},submit:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if(formUtil.isUnchanged(this.initialFormData,this.formData))return this.$toasted.info(this.$t("general.nothing_changed"),this.$toastConfig.info),!1;this.isLoading=!0,this.formData.hasOwnProperty("type")&&(this.formData.type=this.formData.type.snakeCase());var r=!0===e||this.useUserPreference?n.sS:"module"===this.configType?n.DE:n.Vx;if(this.beforeSubmit&&"function"==typeof this.beforeSubmit){var o=this.beforeSubmit();if(!1===o)return void(this.isLoading=!1)}r(this.formData).then((function(r){(!0===e||t.useUserPreference?t.GetUser:t.GetConfig)().then((function(){t.$toasted.success(r.message,t.$toastConfig),t.initialFormData=_.cloneDeep(t.formData),t.isLoading=!1})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e)})),"function"==typeof t.afterSubmit&&t.afterSubmit(),"function"==typeof t.afterSubmitSuccess&&t.afterSubmitSuccess()})).catch((function(e){t.isLoading=!1,t.formErrors=formUtil.handleErrors(e),"function"==typeof t.afterSubmit&&t.afterSubmit(),"function"==typeof t.afterSubmitError&&t.afterSubmitError()}))},reset:function(){var t=this;formUtil.confirmAction().then((function(e){e.value&&(t.formData=Object.assign({},t.formData,_.cloneDeep(t.initialFormData)))}))},unsavedCheck:function(t){formUtil.unsavedCheckAlert(this.initialFormData,this.formData,t)},fillPreRequisite:function(t){var e=this;this.preRequisite.objForEach((function(r,o){e.preRequisite[o]=t.hasOwnProperty(o)?t[o]:r})),this.isLoading=!1},fillFormData:function(){var t=this;this.isLoading=!0;var e=this.useUserPreference?this.configsWithPreference:this.configs;this.formData.type&&e[this.formData.type]&&(this.formData=formUtil.assignValues(this.formData,e[this.formData.type])),this.formData.types&&Array.isArray(this.formData.types)&&this.formData.types.forEach((function(r){t.formData=formUtil.assignValues(t.formData,e[r])})),this.formData.override&&this.formData.objForEach((function(r,o){r&&_.isObject(r)?t.formData[o]=formUtil.assignValues(t.formData[o],e[o]):t.formData[o]=e[o]?e[o]:r})),"function"==typeof this.addNewRow&&"function"==typeof this.addNewRowIfNone&&this.addNewRowIfNone(),this.isLoading=!1},getInitialData:function(t){var e,r=this;return(e=a().mark((function e(){var o;return a().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r.isLoading=!0,e.prev=1,e.next=4,n.B_(Object.keys(r.preRequisite).join(","));case 4:return o=e.sent,r.fillPreRequisite(o),t&&r.$nextTick((function(){t()})),e.abrupt("return",o);case 10:throw e.prev=10,e.t0=e.catch(1),r.isLoading=!1,r.formErrors=formUtil.handleErrors(e.t0),e.t0;case 15:case"end":return e.stop()}}),e,null,[[1,10]])})),function(){var t=this,r=arguments;return new Promise((function(o,n){var i=e.apply(t,r);function a(t){c(i,o,n,a,s,"next",t)}function s(t){c(i,o,n,a,s,"throw",t)}a(void 0)}))})()}}),mounted:function(){this.fillFormData(),this.initialFormData=_.cloneDeep(this.formData)},beforeDestroy:function(){delete this.formData,delete this.formErrors,delete this.preRequisite},beforeRouteLeave:function(t,e,r){this.unsavedCheck(r)}}},1983:(t,e,r)=>{r.r(e),r.d(e,{default:()=>n});const o={extends:r(78248).Z,data:function(){return{formData:{canRecord:!0,enableAutoRecording:!1,autoUploadRecording:!1,autoUploadRecorded:!1,canStopAutoRecording:!1,recordingFormatAudio:"audio/webm",recordingFormatVideo:"video/webm",rtcLibrary:"rtcmc",type:"meeting"},mimeTypesAudio:[{uuid:"audio/webm",label:"audio/webm"},{uuid:"audio/wav",label:"audio/wav"},{uuid:"audio/webm;codecs=pcm",label:"audio/webm;codecs=pcm"}],mimeTypesVideo:[{uuid:"video/mp4",label:"video/mp4"},{uuid:"video/webm",label:"video/webm"},{uuid:"video/webm;codecs=vp9",label:"video/webm;codecs=vp9"},{uuid:"video/webm;codecs=vp8",label:"video/webm;codecs=vp8"},{uuid:"video/webm;codecs=h264",label:"video/webm;codecs=h264"},{uuid:"video/x-matroska;codecs=avc1",label:"video/x-matroska;codecs=avc1"}]}},methods:{autoUploadRecordedChanged:function(){this.formData.autoUploadRecording=!this.formData.autoUploadRecorded&&this.formData.autoUploadRecording},autoUploadRecordingChanged:function(){this.formData.autoUploadRecorded=!this.formData.autoUploadRecording&&this.formData.autoUploadRecorded},beforeSubmit:function(){return this.formData.autoUploadRecorded=!this.formData.autoUploadRecording&&this.formData.autoUploadRecorded,!0}},mounted:function(){this.getInitialData()}};const n=(0,r(51900).Z)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("base-container",{attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[r("h5",{staticClass:"mb-4 pb-3 border-bottom"},[t._v(t._s(t.$t("meeting.config.recording")))]),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-6 mb-3"},[r("switch-wrapper",{attrs:{label:t.$t("meeting.config.can_record")}},[r("base-switch",{model:{value:t.formData.canRecord,callback:function(e){t.$set(t.formData,"canRecord",e)},expression:"formData.canRecord"}})],1)],1)]),t._v(" "),t.formData.canRecord&&"rtcmc"===t.formData.rtcLibrary?[r("h5",{staticClass:"mb-4 pb-3 border-bottom"},[t._v(t._s(t.$t("meeting.config.for_rtc_library",{attribute:"RTCMC"})))]),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-6 mb-3"},[r("switch-wrapper",{attrs:{label:t.$t("meeting.config.enable_auto_recording")}},[r("base-switch",{model:{value:t.formData.enableAutoRecording,callback:function(e){t.$set(t.formData,"enableAutoRecording",e)},expression:"formData.enableAutoRecording"}})],1)],1),t._v(" "),t.formData.enableAutoRecording?r("div",{staticClass:"col-12 col-md-6 mb-3"},[r("switch-wrapper",{attrs:{label:t.$t("meeting.config.can_stop_auto_recording")}},[r("base-switch",{model:{value:t.formData.canStopAutoRecording,callback:function(e){t.$set(t.formData,"canStopAutoRecording",e)},expression:"formData.canStopAutoRecording"}})],1)],1):t._e(),t._v(" "),r("div",{staticClass:"col-12 col-md-6 mb-3"},[r("switch-wrapper",{attrs:{label:t.$t("meeting.config.auto_upload_recording")}},[r("base-switch",{on:{input:t.autoUploadRecordingChanged},model:{value:t.formData.autoUploadRecording,callback:function(e){t.$set(t.formData,"autoUploadRecording",e)},expression:"formData.autoUploadRecording"}})],1)],1),t._v(" "),r("div",{staticClass:"col-12 col-md-6 mb-3"},[r("switch-wrapper",{attrs:{label:t.$t("meeting.config.auto_upload_recorded")}},[r("base-switch",{on:{input:t.autoUploadRecordedChanged},model:{value:t.formData.autoUploadRecorded,callback:function(e){t.$set(t.formData,"autoUploadRecorded",e)},expression:"formData.autoUploadRecorded"}})],1)],1)])]:t._e(),t._v(" "),r("div",{staticClass:"form-footer mt-5"},[r("div",{staticClass:"left-side"},[r("base-button",{attrs:{type:"button",design:"light",tabindex:"-1"},on:{click:function(e){return t.$router.back()}}},[r("i",{staticClass:"fas fa-chevron-left"}),t._v(" "+t._s(t.$t("general.cancel")))])],1),t._v(" "),r("div",{staticClass:"right-side"},[r("base-button",{attrs:{type:"button",design:"light"},on:{click:t.reset}},[t._v(t._s(t.$t("general.reset")))]),t._v(" "),r("base-button",{attrs:{type:"submit",design:"primary"}},[r("i",{staticClass:"fas fa-save"}),t._v(" "+t._s(t.$t("general.save")))])],1)])],2)])}),[],!1,null,null,null).exports}}]);