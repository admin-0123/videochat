"use strict";(self.webpackChunkConnect=self.webpackChunkConnect||[]).push([[2510],{79625:(n,e,t)=>{t.d(e,{Z:()=>s});var a=t(94015),r=t.n(a),i=t(23645),o=t.n(i)()(r());o.push([n.id,"@import url(https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900);"]),o.push([n.id,".error-page[data-v-5ea60559]{color:#fff;padding:2rem 0}.error-page .error_bg[data-v-5ea60559]{background-position:50%;background-repeat:no-repeat;background-size:95%;height:340px}.error-page h1[data-v-5ea60559]{color:inherit;font-size:8em;font-weight:900;letter-spacing:1.5rem;line-height:7rem;margin:0}.error-page h2[data-v-5ea60559]{color:inherit;font-size:4rem;font-weight:300;margin-bottom:1rem}.error-page h3[data-v-5ea60559]{color:inherit;font-size:36px;font-weight:300;margin-top:1.5rem}.error-page p[data-v-5ea60559]{font-size:18px;font-weight:500}.error-page hr[data-v-5ea60559]{border-color:#fff;border-width:2px}@media (max-width:767.98px){.error-page .error_bg[data-v-5ea60559]{height:40vh}.error-page h1[data-v-5ea60559]{font-size:5em;font-weight:800;letter-spacing:.5rem;line-height:5rem}.error-page h2[data-v-5ea60559]{font-size:2rem;margin-bottom:1rem}.error-page h3[data-v-5ea60559]{font-size:1.5rem;font-weight:400;margin-top:1.5rem}.error-page p[data-v-5ea60559]{font-size:14px;font-weight:400}.error-page hr[data-v-5ea60559]{border-width:1px;margin:1rem 0}.error-page a.btn[data-v-5ea60559]{border-radius:0;bottom:0;box-shadow:none;left:0;position:fixed;width:100%}.error-page a.btn[data-v-5ea60559]:hover{box-shadow:none;transform:translateY(0)}}","",{version:3,sources:["webpack://./resources/js/views/pages/partials/error-page.vue","webpack://./resources/js/core/assets/scss/libraries/bootstrap/scss/mixins/_breakpoints.scss"],names:[],mappings:"AAYA,6BACI,UAAA,CACA,cAVJ,CAYI,uCAII,uBAAA,CACA,2BAAA,CAFA,mBAAA,CADA,YARR,CAcI,gCAGI,aAAA,CAFA,aAAA,CACA,eAAA,CAIA,qBAAA,CADA,gBAAA,CADA,QAVR,CAcI,gCAEI,aAAA,CADA,cAAA,CAEA,eAAA,CACA,kBAZR,CAcI,gCAEI,aAAA,CADA,cAAA,CAGA,eAAA,CADA,iBAXR,CAcI,+BACI,cAAA,CACA,eAZR,CAeI,gCACI,iBAAA,CACA,gBAbR,CCmCI,4BDhBI,uCACI,WAfV,CAiBM,gCACI,aAAA,CACA,eAAA,CAEA,oBAAA,CADA,gBAdV,CAiBM,gCACI,cAAA,CACA,kBAfV,CAiBM,gCACI,gBAAA,CAEA,eAAA,CADA,iBAdV,CAiBM,+BACI,cAAA,CACA,eAfV,CAkBM,gCACI,gBAAA,CACA,aAhBV,CAmBM,mCAKI,eAAA,CAHA,QAAA,CAIA,eAAA,CAHA,MAAA,CAFA,cAAA,CAGA,UAfV,CAkBU,yCACI,eAAA,CACA,uBAhBd,CACF",sourcesContent:["\n\n\n\n\n\n\n\n\n\n\n@import '~@js/core/assets/scss/imports.scss';\n.error-page {\n    color: white;\n    padding: 2rem 0;\n\n    .error_bg {\n        // background-image: url('~@images/errors/error-animation.gif');\n        height: 340px;\n        background-size: 95%;\n        background-position: center;\n        background-repeat: no-repeat;\n    }\n\n    h1 {\n        font-size: 8em;\n        font-weight: 900;\n        color: inherit;\n        margin: 0;\n        line-height: 7rem;\n        letter-spacing: 1.5rem;\n    }\n    h2 {\n        font-size: 4rem;\n        color: inherit;\n        font-weight: 300;\n        margin-bottom: 1rem;\n    }\n    h3 {\n        font-size: 36px;\n        color: inherit;\n        margin-top: 1.5rem;\n        font-weight: 300;\n    }\n    p {\n        font-size: 18px;\n        font-weight: 500;\n    }\n    \n    hr {\n        border-color: white;\n        border-width: 2px;\n    }\n}\n\n@include media-breakpoint-down(sm) {\n    .error-page {\n        .error_bg {\n            height: 40vh;\n        }\n        h1 {\n            font-size: 5em;\n            font-weight: 800;\n            line-height: 5rem;\n            letter-spacing: 0.5rem;\n        }\n        h2 {\n            font-size: 2rem;\n            margin-bottom: 1rem;\n        }\n        h3 {\n            font-size: 1.5rem;\n            margin-top: 1.5rem;\n            font-weight: 400;\n        }\n        p {\n            font-size: 14px;\n            font-weight: 400;\n        }\n        \n        hr {\n            border-width: 1px;\n            margin: 1rem 0;\n        }\n\n        a.btn {\n            position: fixed;\n            bottom: 0;\n            left: 0;\n            width: 100%;\n            border-radius: 0;\n            box-shadow: none;\n            &:hover {\n                box-shadow: none;\n                transform: translateY(0px);\n            }\n        }\n    }\n}\n\n",'// Breakpoint viewport sizes and media queries.\n//\n// Breakpoints are defined as a map of (name: minimum width), order from small to large:\n//\n//    (xs: 0, sm: 576px, md: 768px, lg: 992px, xl: 1200px)\n//\n// The map defined in the `$grid-breakpoints` global variable is used as the `$breakpoints` argument by default.\n\n// Name of the next breakpoint, or null for the last breakpoint.\n//\n//    >> breakpoint-next(sm)\n//    md\n//    >> breakpoint-next(sm, (xs: 0, sm: 576px, md: 768px, lg: 992px, xl: 1200px))\n//    md\n//    >> breakpoint-next(sm, $breakpoint-names: (xs sm md lg xl))\n//    md\n@function breakpoint-next($name, $breakpoints: $grid-breakpoints, $breakpoint-names: map-keys($breakpoints)) {\n  $n: index($breakpoint-names, $name);\n  @return if($n != null and $n < length($breakpoint-names), nth($breakpoint-names, $n + 1), null);\n}\n\n// Minimum breakpoint width. Null for the smallest (first) breakpoint.\n//\n//    >> breakpoint-min(sm, (xs: 0, sm: 576px, md: 768px, lg: 992px, xl: 1200px))\n//    576px\n@function breakpoint-min($name, $breakpoints: $grid-breakpoints) {\n  $min: map-get($breakpoints, $name);\n  @return if($min != 0, $min, null);\n}\n\n// Maximum breakpoint width. Null for the largest (last) breakpoint.\n// The maximum value is calculated as the minimum of the next one less 0.02px\n// to work around the limitations of `min-` and `max-` prefixes and viewports with fractional widths.\n// See https://www.w3.org/TR/mediaqueries-4/#mq-min-max\n// Uses 0.02px rather than 0.01px to work around a current rounding bug in Safari.\n// See https://bugs.webkit.org/show_bug.cgi?id=178261\n//\n//    >> breakpoint-max(sm, (xs: 0, sm: 576px, md: 768px, lg: 992px, xl: 1200px))\n//    767.98px\n@function breakpoint-max($name, $breakpoints: $grid-breakpoints) {\n  $next: breakpoint-next($name, $breakpoints);\n  @return if($next, breakpoint-min($next, $breakpoints) - .02, null);\n}\n\n// Returns a blank string if smallest breakpoint, otherwise returns the name with a dash in front.\n// Useful for making responsive utilities.\n//\n//    >> breakpoint-infix(xs, (xs: 0, sm: 576px, md: 768px, lg: 992px, xl: 1200px))\n//    ""  (Returns a blank string)\n//    >> breakpoint-infix(sm, (xs: 0, sm: 576px, md: 768px, lg: 992px, xl: 1200px))\n//    "-sm"\n@function breakpoint-infix($name, $breakpoints: $grid-breakpoints) {\n  @return if(breakpoint-min($name, $breakpoints) == null, "", "-#{$name}");\n}\n\n// Media of at least the minimum breakpoint width. No query for the smallest breakpoint.\n// Makes the @content apply to the given breakpoint and wider.\n@mixin media-breakpoint-up($name, $breakpoints: $grid-breakpoints) {\n  $min: breakpoint-min($name, $breakpoints);\n  @if $min {\n    @media (min-width: $min) {\n      @content;\n    }\n  } @else {\n    @content;\n  }\n}\n\n// Media of at most the maximum breakpoint width. No query for the largest breakpoint.\n// Makes the @content apply to the given breakpoint and narrower.\n@mixin media-breakpoint-down($name, $breakpoints: $grid-breakpoints) {\n  $max: breakpoint-max($name, $breakpoints);\n  @if $max {\n    @media (max-width: $max) {\n      @content;\n    }\n  } @else {\n    @content;\n  }\n}\n\n// Media that spans multiple breakpoint widths.\n// Makes the @content apply between the min and max breakpoints\n@mixin media-breakpoint-between($lower, $upper, $breakpoints: $grid-breakpoints) {\n  $min: breakpoint-min($lower, $breakpoints);\n  $max: breakpoint-max($upper, $breakpoints);\n\n  @if $min != null and $max != null {\n    @media (min-width: $min) and (max-width: $max) {\n      @content;\n    }\n  } @else if $max == null {\n    @include media-breakpoint-up($lower, $breakpoints) {\n      @content;\n    }\n  } @else if $min == null {\n    @include media-breakpoint-down($upper, $breakpoints) {\n      @content;\n    }\n  }\n}\n\n// Media between the breakpoint\'s minimum and maximum widths.\n// No minimum for the smallest breakpoint, and no maximum for the largest one.\n// Makes the @content apply only to the given breakpoint, not viewports any wider or narrower.\n@mixin media-breakpoint-only($name, $breakpoints: $grid-breakpoints) {\n  $min: breakpoint-min($name, $breakpoints);\n  $max: breakpoint-max($name, $breakpoints);\n\n  @if $min != null and $max != null {\n    @media (min-width: $min) and (max-width: $max) {\n      @content;\n    }\n  } @else if $max == null {\n    @include media-breakpoint-up($name, $breakpoints) {\n      @content;\n    }\n  } @else if $min == null {\n    @include media-breakpoint-down($name, $breakpoints) {\n      @content;\n    }\n  }\n}\n'],sourceRoot:""}]);const s=o},86628:(n,e,t)=>{t.r(e),t.d(e,{default:()=>r});const a={components:{ErrorPage:t(92714).Z}};const r=(0,t(51900).Z)(a,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("error-page",{staticClass:"general-page"},[t("div",{staticClass:"col-12 text-center"},[t("h2",[n._v(n._s(n.$t("general.error_page")))]),n._v(" "),t("h3",[n._v(n._s(n.$t("general.error_page_heading")))]),n._v(" "),t("p",[n._v(n._s(n.$t("general.error_page_message")))]),n._v(" "),t("a",{staticClass:"btn btn-success",attrs:{href:"#"},on:{click:function(e){return n.$router.back()}}},[t("i",{staticClass:"fas fa-chevron-left"}),n._v(" "+n._s(n.$t("global.back_to_link",{attribute:n.$t("general.home")})))])])])}),[],!1,null,"4d08c26e",null).exports},92714:(n,e,t)=>{t.d(e,{Z:()=>m});const a={};var r=t(93379),i=t.n(r),o=t(79625),s={insert:"head",singleton:!1};i()(o.Z,s);o.Z.locals;const m=(0,t(51900).Z)(a,(function(){var n=this,e=n.$createElement;return(n._self._c||e)("section",{staticClass:"error-page"},[n._t("default")],2)}),[],!1,null,"5ea60559",null).exports}}]);