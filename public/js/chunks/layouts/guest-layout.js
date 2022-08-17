"use strict";(self.webpackChunkConnect=self.webpackChunkConnect||[]).push([[5204],{16168:(n,e,t)=>{t.d(e,{Z:()=>i});var r=t(94015),a=t.n(r),o=t(23645),p=t.n(o)()(a());p.push([n.id,"@import url(https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900);"]),p.push([n.id,'.guest-layout{align-items:center;background-position:bottom;background:#320f57;background:radial-gradient(ellipse at bottom,#581b98 0,#030617 80%);display:flex;flex-direction:column;justify-content:center;min-height:100%;position:relative;width:100%}.guest-layout:before{background:linear-gradient(135deg,#ff005d 12px,#320f57 22px,#320f57 0,transparent 0,transparent 62px,#320f57 64px,#320f57 69px,transparent 0),linear-gradient(225deg,#ff005d 22px,#320f57 0,#320f57 24px,transparent 0,transparent 67px,#320f57 0,#320f57 69px,transparent 0) 0 65px;background-color:#ff005d;background-size:64px 128px;content:"";height:100%;left:0;opacity:.05;position:absolute;top:0;width:100%}.guest-layout .guest-page{display:flex;flex-direction:column;justify-content:center}.guest-layout.design-boxed-left,.guest-layout.design-boxed-right{align-items:stretch;flex-direction:row}.guest-layout.design-boxed-left .guest-page,.guest-layout.design-boxed-right .guest-page{background:#fff;box-shadow:0 .5rem 1rem rgba(0,0,0,.15);overflow-x:hidden;overflow-y:auto}.guest-layout.design-boxed-left{justify-content:flex-start}.guest-layout.design-boxed-right{justify-content:flex-end}.guest-layout.color-light{background:#bababa;background:radial-gradient(ellipse at bottom,#bababa 0,#fff 90%)}.guest-layout.color-light:before{background:linear-gradient(135deg,#fff 12px,#949597 22px,#949597 0,transparent 0,transparent 62px,#949597 64px,#949597 69px,transparent 0),linear-gradient(225deg,#fff 22px,#949597 0,#949597 24px,transparent 0,transparent 67px,#949597 0,#949597 69px,transparent 0) 0 65px;background-color:#fff;background-size:64px 128px;opacity:.05}.guest-layout.color-dark{background:#000;background:radial-gradient(ellipse at bottom,#000 0,#212224 90%)}.guest-layout.color-dark:before{background:linear-gradient(135deg,#f1f2f4 12px,#717274 22px,#717274 0,transparent 0,transparent 62px,#717274 64px,#717274 69px,transparent 0),linear-gradient(225deg,#f1f2f4 22px,#717274 0,#717274 24px,transparent 0,transparent 67px,#717274 0,#717274 69px,transparent 0) 0 65px;background-color:#f1f2f4;background-size:64px 128px;opacity:.05}',"",{version:3,sources:["webpack://./resources/js/views/layouts/guest-layout.vue"],names:[],mappings:"AAuBA,cAII,kBAAA,CAGA,0BAAA,CACA,kBAAA,CACA,mEAAA,CANA,YAAA,CAGA,qBAAA,CADA,sBAAA,CAHA,eAAA,CAQA,iBAAA,CATA,UAZJ,CAuBI,qBAQI,oRAAA,CACA,wBAAA,CACA,0BAAA,CATA,UAAA,CAGA,WAAA,CAEA,MAAA,CAKA,WAAA,CATA,iBAAA,CAGA,KAAA,CAFA,UAdR,CA0BI,0BACI,YAAA,CAEA,qBAAA,CACA,sBAzBR,CA4BI,iEAEI,mBAAA,CADA,kBAzBR,CA4BQ,yFACI,eAAA,CACA,uCAAA,CACA,iBAAA,CACA,eA1BZ,CA8BI,gCACI,0BA5BR,CA+BI,iCACI,wBA7BR,CAgCI,0BACI,kBAAA,CACA,gEA9BR,CAgCQ,iCACI,8QAAA,CACA,qBAAA,CACA,0BAAA,CACA,WA9BZ,CAkCI,yBACI,eAAA,CACA,gEAhCR,CAkCQ,gCACI,oRAAA,CACA,wBAAA,CACA,0BAAA,CACA,WAhCZ",sourcesContent:["\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n@import '~@js/core/assets/scss/imports.scss';\n\n.guest-layout {\n    width: 100%;\n    min-height: 100%;\n    display: flex;\n    align-items: center;\n    justify-content: center;\n    flex-direction: column;\n    background-position: center bottom;\n    background: darken($primary, 15%);\n    background: radial-gradient(ellipse at bottom, $primary 0%, #030617 80%);\n    position: relative;\n\n    &:before {\n        content: \"\";\n        position: absolute;\n        width: 100%;\n        height: 100%;\n        top: 0;\n        left: 0;\n\n        background: linear-gradient(135deg, #ff005d 12px, darken($primary, 15%) 22px, darken($primary, 15%) 22px, transparent 22px, transparent 62px, darken($primary, 15%) 64px, darken($primary, 15%) 69px, transparent 69px), linear-gradient(225deg, #ff005d 22px, darken($primary, 15%) 22px, darken($primary, 15%) 24px, transparent 24px, transparent 67px, darken($primary, 15%) 67px, darken($primary, 15%) 69px, transparent 69px) 0 65px;\n        background-color: #ff005d;\n        background-size: 64px 128px;\n        opacity: 0.05;\n    }\n\n\n    .guest-page {\n        display: flex;\n        // flex: 1 1 auto;\n        flex-direction: column;\n        justify-content: center;\n    }\n\n    &.design-boxed-left, &.design-boxed-right {\n        flex-direction: row;\n        align-items: stretch;\n\n        .guest-page {\n            background: #ffffff;\n            box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);\n            overflow-x: hidden;\n            overflow-y: auto;\n        }\n    }\n\n    &.design-boxed-left {\n        justify-content: flex-start;\n    }\n\n    &.design-boxed-right {\n        justify-content: flex-end;\n    }\n\n    &.color-light {\n        background: #bababa;\n        background: radial-gradient(ellipse at bottom, #bababa 0%, #ffffff 90%);\n\n        &:before {\n            background: linear-gradient(135deg, #ffffff 12px, #949597 22px, #949597 22px, transparent 22px, transparent 62px, #949597 64px, #949597 69px, transparent 69px), linear-gradient(225deg, #ffffff 22px, #949597 22px, #949597 24px, transparent 24px, transparent 67px, #949597 67px, #949597 69px, transparent 69px) 0 65px;\n            background-color: #ffffff;\n            background-size: 64px 128px;\n            opacity: 0.05;\n        }\n    }\n\n    &.color-dark {\n        background: #000000;\n        background: radial-gradient(ellipse at bottom, #000000 0%, #212224 90%);\n\n        &:before {\n            background: linear-gradient(135deg, #f1f2f4 12px, #717274 22px, #717274 22px, transparent 22px, transparent 62px, #717274 64px, #717274 69px, transparent 69px), linear-gradient(225deg, #f1f2f4 22px, #717274 22px, #717274 24px, transparent 24px, transparent 67px, #717274 67px, #717274 69px, transparent 69px) 0 65px;\n            background-color: #f1f2f4;\n            background-size: 64px 128px;\n            opacity: 0.05;\n        }\n    }\n}\n\n"],sourceRoot:""}]);const i=p},73388:(n,e,t)=>{t.r(e),t.d(e,{default:()=>f});function r(n,e){var t=Object.keys(n);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(n);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable}))),t.push.apply(t,r)}return t}function a(n,e,t){return e in n?Object.defineProperty(n,e,{value:t,enumerable:!0,configurable:!0,writable:!0}):n[e]=t,n}const o={computed:function(n){for(var e=1;e<arguments.length;e++){var t=null!=arguments[e]?arguments[e]:{};e%2?r(Object(t),!0).forEach((function(e){a(n,e,t[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(n,Object.getOwnPropertyDescriptors(t)):r(Object(t)).forEach((function(e){Object.defineProperty(n,e,Object.getOwnPropertyDescriptor(t,e))}))}return n}({},(0,t(20629).Se)("config",["configs"]))};var p=t(93379),i=t.n(p),A=t(16168),s={insert:"head",singleton:!1};i()(A.Z,s);A.Z.locals;const f=(0,t(51900).Z)(o,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("div",{class:["guest-layout",n.configs.auth&&n.configs.auth.guestLayoutDesign?"design-"+n.configs.auth.guestLayoutDesign:"",n.configs.auth&&n.configs.auth.guestLayoutColor?"color-"+n.configs.auth.guestLayoutColor:""]},[t("transition-page",[t("router-view")],1)],1)}),[],!1,null,null,null).exports}}]);