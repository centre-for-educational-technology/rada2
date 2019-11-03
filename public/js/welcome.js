!function(t){function n(r){if(e[r])return e[r].exports;var i=e[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}var e={};return n.m=t,n.c=e,n.i=function(t){return t},n.d=function(t,n,e){Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:e})},n.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},n.p="",n(n.s=12)}([function(t,n,e){"use strict";(function(n){function e(t,n){window.console&&(console.warn("[vue-i18n] "+t),n&&console.warn(n.stack))}function r(t,n,e){if("object"==typeof n)e(n);else{var r=n.call(this);if("function"==typeof r)if(r.resolved)e(r.resolved);else if(r.requested)r.pendingCallbacks.push(e);else{r.requested=!0;var o=r.pendingCallbacks=[e];r(function(t){r.resolved=t;for(var n=0,e=o.length;n<e;n++)o[n](t)},function(){e()})}else i(r)&&r.then(function(t){e(t)},function(){e()})["catch"](function(t){console.error(t),e()})}}function i(t){return t&&"function"==typeof t.then}function o(t){if(!w){var n=t.$watch("__watcher__",function(t){});w=t._watchers[0].constructor,n()}return w}function a(t){return!_&&t&&t._data&&t._data.__ob__&&t._data.__ob__.dep&&(_=t._data.__ob__.dep.constructor),_}function s(t){return null===t||void 0===t}function u(t,n){function e(e){var r=arguments.length;return r?r>1?t.apply(n,arguments):t.call(n,e):t.call(n)}return e._length=t.length,e}function l(t){return null!==t&&"object"==typeof t}function c(t){return $.call(t)===T}function f(t,n){return A.call(t,n)}function d(t){return Z.test(t)}function p(t){var n=t.charCodeAt(0),e=t.charCodeAt(t.length-1);return n!==e||34!==n&&39!==n?t:t.slice(1,-1)}function h(t){if(void 0===t)return"eof";var n=t.charCodeAt(0);switch(n){case 91:case 93:case 46:case 34:case 39:case 48:return t;case 95:case 36:case 45:return"ident";case 32:case 9:case 10:case 13:case 160:case 65279:case 8232:case 8233:return"ws"}return n>=97&&n<=122||n>=65&&n<=90?"ident":n>=49&&n<=57?"number":"else"}function v(t){var n=t.trim();return("0"!==t.charAt(0)||!isNaN(t))&&(d(n)?p(n):"*"+n)}function g(t){function n(){var n=t[c+1];if(f===R&&"'"===n||f===I&&'"'===n)return c++,r="\\"+n,p[U](),!0}var e,r,i,o,a,s,u,l=[],c=-1,f=P,d=0,p=[];for(p[z]=function(){void 0!==i&&(l.push(i),i=void 0)},p[U]=function(){void 0===i?i=r:i+=r},p[V]=function(){p[U](),d++},p[q]=function(){if(d>0)d--,f=G,p[U]();else{if(d=0,i=v(i),i===!1)return!1;p[z]()}};null!=f;)if(c++,e=t[c],"\\"!==e||!n()){if(o=h(e),u=J[f],a=u[o]||u["else"]||H,a===H)return;if(f=a[0],s=p[a[1]],s&&(r=a[2],r=void 0===r?e:r,s()===!1))return;if(f===F)return l.raw=t,l}}function m(t){var n=j[t];return n||(n=g(t),n&&(j[t]=n)),n}function b(t,r){void 0===r&&(r={});var i=t.version&&Number(t.version.split(".")[0])||-1;if("production"!==n.env.NODE_ENV&&b.installed)return void e("already installed.");if("production"!==n.env.NODE_ENV&&i<2)return void e("vue-i18n ("+b.version+") need to use Vue 2.0 or later (Vue: "+t.version+").");var o="en";y(t,o),C(t,W),x(t,W),O(t,W,o),Q(t)}function y(t,n){var e=t.config.silent;t.config.silent=!0,W||(W=new t({data:{lang:n,locales:{}}})),t.config.silent=e}var w,_,k,C=function(t,n){t.locale=function(t,i,o){return void 0===i?n.locales[t]:void(null===i?(n.locales[t]=void 0,delete n.locales[t]):r(t,i,function(r){r?n.$set(n.locales,t,r):e("failed set `"+t+"` locale"),o&&o()}))}},x=function(t,n){var e=t.prototype._init;t.prototype._init=function(t){var r=this;e.call(this,t),this.$parent||(this._$lang=n,this._langUnwatch=this._$lang.$watch("$data",function(t,n){r.$forceUpdate()},{deep:!0}))};var r=t.prototype._destroy;t.prototype._destroy=function(){!this.$parent&&this._langUnwatch&&(this._langUnwatch(),this._langUnwatch=null,this._$lang=null),r.apply(this,arguments)}},$=Object.prototype.toString,T="[object Object]",A=Object.prototype.hasOwnProperty,E=null,L=null,O=function(t,n,e){function r(t,n){var e=new i(n,t,null,{lazy:!0});return function(){return e.dirty&&e.evaluate(),s&&s.target&&e.depend(),e.value}}var i=o(n),s=a(n);Object.defineProperty(t.config,"lang",{enumerable:!0,configurable:!0,get:r(function(){return n.lang},n),set:u(function(t){n.lang=t},n)}),k=e,Object.defineProperty(t.config,"fallbackLang",{enumerable:!0,configurable:!0,get:function(){return k},set:function(t){k=t}}),Object.defineProperty(t.config,"missingHandler",{enumerable:!0,configurable:!0,get:function(){return E},set:function(t){E=t}}),Object.defineProperty(t.config,"i18nFormatter",{enumerable:!0,configurable:!0,get:function(){return L},set:function(t){L=t}})},B=/(%|)\{([0-9a-zA-Z_]+)\}/g,N=function(t){function n(t){for(var n=[],e=arguments.length-1;e-- >0;)n[e]=arguments[e+1];return n=1===n.length&&"object"==typeof n[0]?n[0]:{},n&&n.hasOwnProperty||(n={}),t.replace(B,function(e,r,i,o){var a;return"{"===t[o-1]&&"}"===t[o+e.length]?i:(a=f(n,i)?n[i]:e,s(a)?"":a)})}return n},j=Object.create(null),U=0,z=1,V=2,q=3,P=0,S=1,M=2,D=3,G=4,R=5,I=6,F=7,H=8,J=[];J[P]={ws:[P],ident:[D,U],"[":[G],eof:[F]},J[S]={ws:[S],".":[M],"[":[G],eof:[F]},J[M]={ws:[M],ident:[D,U],0:[D,U],number:[D,U]},J[D]={ident:[D,U],0:[D,U],number:[D,U],ws:[S,z],".":[M,z],"[":[G,z],eof:[F,z]},J[G]={"'":[R,U],'"':[I,U],"[":[G,V],"]":[S,q],eof:H,"else":[G,U]},J[R]={"'":[G,U],eof:H,"else":[R,U]},J[I]={'"':[G,U],eof:H,"else":[I,U]};var W,Z=/^\s?(true|false|-?[\d.]+|'[^']*'|"[^"]*")\s?$/,K=function(t){function n(t){if(null===t||void 0===t)return!0;if(Array.isArray(t)){if(t.length>0)return!1;if(0===t.length)return!0}else if(c(t))for(var n in t)if(f(t,n))return!1;return!0}function e(t,e){if(!l(t))return null;var r=m(e);if(n(r))return null;for(var i=r.length,o=null,a=t,s=0;s<i;){var u=a[r[s]];if(void 0===u){a=null;break}a=u,s++}return o=a}return e},Q=function(t){function r(){for(var n=[],e=arguments.length;e--;)n[e]=arguments[e];var r=t.config.lang,i=t.config.fallbackLang;return 1===n.length?l(n[0])||Array.isArray(n[0])?n=n[0]:"string"==typeof n[0]&&(r=n[0]):2===n.length&&("string"==typeof n[0]&&(r=n[0]),(l(n[1])||Array.isArray(n[1]))&&(n=n[1])),{lang:r,fallback:i,params:n}}function i(t,n){return!(!t||!n)&&!s(m(t,n))}function o(n,r,i){if(!n)return null;var a=m(n,r);if(Array.isArray(a))return a;if(s(a)&&(a=n[r]),s(a))return null;if("string"!=typeof a)return e("Value of key '"+r+"' is not a string!"),null;if(a.indexOf("@:")>=0){var u=a.match(/(@:[\w|.]+)/g);for(var l in u){var c=u[l],f=c.substr(2),d=o(n,f,i);a=a.replace(c,d)}}return i?t.config.i18nFormatter?t.config.i18nFormatter.apply(null,[a].concat(i)):g(a,i):a}function a(t,r,i,a,u){var l=null;return l=o(t(r),a,u),s(l)?(l=o(t(i),a,u),s(l)?null:("production"!==n.env.NODE_ENV&&e('Fall back to translate the keypath "'+a+'" with "'+i+'" language.'),l)):l}function c(r,i,o,a){return s(a)?(t.config.missingHandler?t.config.missingHandler.apply(null,[r,i,o]):"production"!==n.env.NODE_ENV&&e('Cannot translate the value of keypath "'+i+'". Use the value of keypath as default'),i):a}function f(n){return t.locale(n)}function d(t){return this.$options.locales[t]}function p(t){return t?t>1?1:0:1}function h(t,n){return t=Math.abs(t),2===n?p(t):t?Math.min(t,2):0}function v(t,n){if(!t&&"string"!=typeof t)return null;var e=t.split("|");return n=h(n,e.length),e[n]?e[n].trim():t}var g=N(t),m=K(t);return t.t=function(t){for(var n=[],e=arguments.length-1;e-- >0;)n[e]=arguments[e+1];if(!t)return"";var i=r.apply(void 0,n),o=i.lang,s=i.fallback,u=i.params;return c(o,t,null,a(f,o,s,t,u))},t.tc=function(n,e){for(var r=[],i=arguments.length-2;i-- >0;)r[i]=arguments[i+2];return v(t.t.apply(t,[n].concat(r)),e)},t.te=function(t){for(var n=[],e=arguments.length-1;e-- >0;)n[e]=arguments[e+1];var o=r.apply(void 0,n),a=o.lang;return i(f(a),t)},t.prototype.$t=function(t){for(var n=[],e=arguments.length-1;e-- >0;)n[e]=arguments[e+1];if(!t)return"";var i=r.apply(void 0,n),o=i.lang,s=i.fallback,l=i.params,p=null;return this.$options.locales&&(p=a(u(d,this),o,s,t,l))?p:c(o,t,this,a(f,o,s,t,l))},t.prototype.$tc=function(t,n){for(var e=[],r=arguments.length-2;r-- >0;)e[r]=arguments[r+2];return"number"!=typeof n&&"undefined"!=typeof n?t:v((i=this).$t.apply(i,[t].concat(e)),n);var i},t.prototype.$te=function(t){for(var n=[],e=arguments.length-1;e-- >0;)n[e]=arguments[e+1];var o=r.apply(void 0,n),a=o.lang,s=!1;return this.$options.locales&&(s=i(u(d)(a),t)),s||(s=i(f(a),t)),s},t.mixin({computed:{$lang:function(){return t.config.lang}}}),t};b.version="__VERSION__","undefined"!=typeof window&&window.Vue&&window.Vue.use(b),t.exports=b}).call(n,e(6))},function(t,n,e){e(9);var r=e(7)(e(3),e(8),"data-v-c1e28914",null);t.exports=r.exports},function(t,n){t.exports=function(t,n){var e=null;return function(){clearTimeout(e);var r=arguments,i=this;e=setTimeout(function(){t.apply(i,r)},n)}}},function(t,n,e){"use strict";function r(t){var n=t.url,e=t.name,r=t.error,i=t.id;return{url:n,name:e,error:r,id:i}}var i=e(2);e.n(i);n["default"]={props:[],mixins:[],beforeCreate:function(){},created:function(){},beforeMount:function(){},mounted:function(){var t=this;this.defaultButtonClass="btn btn-default sz-quick-play-btn btn-lg pull-right play-button",this.buttonClass=this.defaultButtonClass,this.$nextTick(function(){t.baseUrl=window.RADA.config.base_url,t.pinLength=window.RADA.config.pin_length})},beforeUpdate:function(){},updated:function(){},beforeDestroy:function(){},destroyed:function(){},data:function(){return{baseUrl:"",loading:!1,pin:"",game:null,pinLength:6,defaultButtonClass:"",buttonClass:"",searchGame:!1,placeholder:this.$t("pin-placeholder"),nickname:""}},watch:{pin:function(t){t.length>this.pinLength&&(t=t.substring(0,this.pinLength),this.pin=t),this.game=null,this.showHideStartButton(t)}},methods:{showHideStartButton:function(t){t.length===this.pinLength?this.searchGame=!0:this.searchGame=!1},onPlayButtonClick:function(){if(this.searchGame===!1)return!1;var t="undefined"!=typeof window.Laravel.isLoggedIn&&window.Laravel.isLoggedIn===!0;""===this.nickname&&t===!1?$(this.$refs.modal).modal("show"):this.onConfirmButtonClick()},onConfirmButtonClick:function(){var t=this;$(this.$refs.modal).modal("hide"),this.$refs.playButton.setAttribute("disabled","disabled"),this.$refs.pinInput.setAttribute("disabled","disabled"),this.loading=!0,this.findGame(function(n){t.loading=!1,null!==n&&(t.game=new r(n),t.$refs.playButton.removeAttribute("disabled"),t.$refs.pinInput.removeAttribute("disabled"),null!==t.game.url&&(t.sendGameStartedToLrs(t.game.id),setTimeout(function(){window.location.href=t.game.url},20)))})},wait:function(t){setTimeout(function(){t()},2e3)},findGame:function(t){var n=this.baseUrl+"/api/game/find-game",e={pin:this.pin,nickname:this.nickname};this.$http.post(n,e).then(function(n){t(n.body)},function(n){t(null),console.log("Error: "+n)})},sendGameStartedToLrs:function(t){var n=this.baseUrl+"/api/tasks/"+t+"/send-game-started-to-lrs";this.$http.get(n).then(function(t){})},onEnter:function(){this.onPlayButtonClick()},onMarkerButtonClick:function(){this.$refs.pinContainer.classList.remove("hidden"),this.$refs.markerButtonContainer.classList.add("hidden")}}}},function(t,n,e){n=t.exports=e(5)(),n.push([t.i,".open-game-by-entering-pin-code-container .pin-input[data-v-c1e28914]{margin-top:1px;float:left;letter-spacing:1px;width:80%;font-size:50px;font-family:MONOSPACE;text-align:center;height:75px;text-transform:uppercase}#sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button[data-v-c1e28914]{padding:0;width:18%}#sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button i.mdi[data-v-c1e28914]{margin-top:10px;margin-bottom:0}#sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button i.mdi[data-v-c1e28914]:before{font-size:40px;top:4px}.open-game-by-entering-pin-code-container .center-block[data-v-c1e28914]{width:100%}.open-game-by-entering-pin-code-container .center-block .btn[data-v-c1e28914]{padding:13px 20px;font-size:22px}.input-button-container[data-v-c1e28914]{position:relative;display:block;overflow:hidden;margin-bottom:15px;padding:25px 0}@media (max-width:450px){.open-game-by-entering-pin-code-container .pin-input[data-v-c1e28914]{width:100%;margin-bottom:10px}#sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button[data-v-c1e28914]{width:100%}}",""])},function(t,n){t.exports=function(){var t=[];return t.toString=function(){for(var t=[],n=0;n<this.length;n++){var e=this[n];e[2]?t.push("@media "+e[2]+"{"+e[1]+"}"):t.push(e[1])}return t.join("")},t.i=function(n,e){"string"==typeof n&&(n=[[null,n,""]]);for(var r={},i=0;i<this.length;i++){var o=this[i][0];"number"==typeof o&&(r[o]=!0)}for(i=0;i<n.length;i++){var a=n[i];"number"==typeof a[0]&&r[a[0]]||(e&&!a[2]?a[2]=e:e&&(a[2]="("+a[2]+") and ("+e+")"),t.push(a))}},t}},function(t,n){function e(){throw new Error("setTimeout has not been defined")}function r(){throw new Error("clearTimeout has not been defined")}function i(t){if(c===setTimeout)return setTimeout(t,0);if((c===e||!c)&&setTimeout)return c=setTimeout,setTimeout(t,0);try{return c(t,0)}catch(n){try{return c.call(null,t,0)}catch(n){return c.call(this,t,0)}}}function o(t){if(f===clearTimeout)return clearTimeout(t);if((f===r||!f)&&clearTimeout)return f=clearTimeout,clearTimeout(t);try{return f(t)}catch(n){try{return f.call(null,t)}catch(n){return f.call(this,t)}}}function a(){v&&p&&(v=!1,p.length?h=p.concat(h):g=-1,h.length&&s())}function s(){if(!v){var t=i(a);v=!0;for(var n=h.length;n;){for(p=h,h=[];++g<n;)p&&p[g].run();g=-1,n=h.length}p=null,v=!1,o(t)}}function u(t,n){this.fun=t,this.array=n}function l(){}var c,f,d=t.exports={};!function(){try{c="function"==typeof setTimeout?setTimeout:e}catch(t){c=e}try{f="function"==typeof clearTimeout?clearTimeout:r}catch(t){f=r}}();var p,h=[],v=!1,g=-1;d.nextTick=function(t){var n=new Array(arguments.length-1);if(arguments.length>1)for(var e=1;e<arguments.length;e++)n[e-1]=arguments[e];h.push(new u(t,n)),1!==h.length||v||i(s)},u.prototype.run=function(){this.fun.apply(null,this.array)},d.title="browser",d.browser=!0,d.env={},d.argv=[],d.version="",d.versions={},d.on=l,d.addListener=l,d.once=l,d.off=l,d.removeListener=l,d.removeAllListeners=l,d.emit=l,d.prependListener=l,d.prependOnceListener=l,d.listeners=function(t){return[]},d.binding=function(t){throw new Error("process.binding is not supported")},d.cwd=function(){return"/"},d.chdir=function(t){throw new Error("process.chdir is not supported")},d.umask=function(){return 0}},function(t,n){t.exports=function(t,n,e,r){var i,o=t=t||{},a=typeof t["default"];"object"!==a&&"function"!==a||(i=t,o=t["default"]);var s="function"==typeof o?o.options:o;if(n&&(s.render=n.render,s.staticRenderFns=n.staticRenderFns),e&&(s._scopeId=e),r){var u=s.computed||(s.computed={});Object.keys(r).forEach(function(t){var n=r[t];u[t]=function(){return n}})}return{esModule:i,exports:o,options:s}}},function(t,n){t.exports={render:function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"open-game-by-entering-pin-code-container"},[e("div",{ref:"markerButtonContainer",staticClass:"col-xs-12"},[e("button",{staticClass:"btn btn-default sz-quick-play-btn",on:{click:t.onMarkerButtonClick}},[e("i",{staticClass:"mdi mdi-map-marker",attrs:{"aria-hidden":"true"}}),t._v("\n            "+t._s(t.$t("play"))+"\n        ")])]),t._v(" "),e("div",{ref:"pinContainer",staticClass:"center-block hidden"},[e("div",{staticClass:"input-button-container"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.pin,expression:"pin"}],ref:"pinInput",staticClass:"pin-input",attrs:{type:"number",placeholder:t.placeholder},domProps:{value:t.pin},on:{keyup:function(n){return!n.type.indexOf("key")&&t._k(n.keyCode,"enter",13,n.key,"Enter")?null:t.onEnter(n)},input:function(n){n.target.composing||(t.pin=n.target.value)}}}),t._v(" "),e("button",{ref:"playButton","class":t.buttonClass,on:{click:t.onPlayButtonClick}},[e("i",{staticClass:"mdi mdi-map-marker"}),t._v("\n                "+t._s(t.$t("play"))+"\n            ")])]),t._v(" "),e("div",[t.game&&null!==t.game.error?e("div",{staticClass:"alert alert-danger"},[t._v(t._s(t.game.error))]):t._e()])]),t._v(" "),e("div",{ref:"modal",staticClass:"modal fade",attrs:{tabindex:"-1",role:"dialog"}},[e("div",{staticClass:"modal-dialog modal-sm",attrs:{role:"document"}},[e("div",{staticClass:"modal-content"},[t._m(0),t._v(" "),e("div",{staticClass:"modal-body text-center"},[e("p",[t._v(t._s(t.$t("general.confirmations.play")))]),t._v(" "),e("div",{staticClass:"form-group"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.nickname,expression:"nickname"}],staticClass:"form-control",attrs:{type:"text",placeholder:t.$t("enter-your-name")},domProps:{value:t.nickname},on:{input:function(n){n.target.composing||(t.nickname=n.target.value)}}})])]),t._v(" "),e("div",{staticClass:"modal-footer text-center"},[e("button",{staticClass:"btn btn-default",attrs:{type:"button",title:t.$t("general.buttons.cancel"),"data-dismiss":"modal"}},[e("i",{staticClass:"mdi mdi-close"})]),t._v(" "),e("button",{staticClass:"btn btn-success btn-play",attrs:{type:"button",title:t.$t("general.actions.play"),disabled:t.nickname.length<2},on:{click:t.onConfirmButtonClick}},[e("i",{staticClass:"mdi mdi-play-circle-outline"})])])])])])])},staticRenderFns:[function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"modal-header"},[e("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[e("span",{attrs:{"aria-hidden":"true"}},[t._v("×")])]),t._v(" "),e("h4",{staticClass:"modal-title"})])}]}},function(t,n,e){var r=e(4);"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);e(10)("62b0375a",r,!0)},function(t,n,e){function r(t){for(var n=0;n<t.length;n++){var e=t[n],r=c[e.id];if(r){r.refs++;for(var i=0;i<r.parts.length;i++)r.parts[i](e.parts[i]);for(;i<e.parts.length;i++)r.parts.push(o(e.parts[i]));r.parts.length>e.parts.length&&(r.parts.length=e.parts.length)}else{for(var a=[],i=0;i<e.parts.length;i++)a.push(o(e.parts[i]));c[e.id]={id:e.id,refs:1,parts:a}}}}function i(){var t=document.createElement("style");return t.type="text/css",f.appendChild(t),t}function o(t){var n,e,r=document.querySelector('style[data-vue-ssr-id~="'+t.id+'"]');if(r){if(h)return v;r.parentNode.removeChild(r)}if(g){var o=p++;r=d||(d=i()),n=a.bind(null,r,o,!1),e=a.bind(null,r,o,!0)}else r=i(),n=s.bind(null,r),e=function(){r.parentNode.removeChild(r)};return n(t),function(r){if(r){if(r.css===t.css&&r.media===t.media&&r.sourceMap===t.sourceMap)return;n(t=r)}else e()}}function a(t,n,e,r){var i=e?"":r.css;if(t.styleSheet)t.styleSheet.cssText=m(n,i);else{var o=document.createTextNode(i),a=t.childNodes;a[n]&&t.removeChild(a[n]),a.length?t.insertBefore(o,a[n]):t.appendChild(o)}}function s(t,n){var e=n.css,r=n.media,i=n.sourceMap;if(r&&t.setAttribute("media",r),i&&(e+="\n/*# sourceURL="+i.sources[0]+" */",e+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */"),t.styleSheet)t.styleSheet.cssText=e;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(e))}}var u="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!u)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var l=e(11),c={},f=u&&(document.head||document.getElementsByTagName("head")[0]),d=null,p=0,h=!1,v=function(){},g="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());t.exports=function(t,n,e){h=e;var i=l(t,n);return r(i),function(n){for(var e=[],o=0;o<i.length;o++){var a=i[o],s=c[a.id];s.refs--,e.push(s)}n?(i=l(t,n),r(i)):i=[];for(var o=0;o<e.length;o++){var s=e[o];if(0===s.refs){for(var u=0;u<s.parts.length;u++)s.parts[u]();delete c[s.id]}}}};var m=function(){var t=[];return function(n,e){return t[n]=e,t.filter(Boolean).join("\n")}}()},function(t,n){t.exports=function(t,n){for(var e=[],r={},i=0;i<n.length;i++){var o=n[i],a=o[0],s=o[1],u=o[2],l=o[3],c={id:t+":"+i,css:s,media:u,sourceMap:l};r[a]?r[a].parts.push(c):e.push(r[a]={id:a,parts:[c]})}return e}},function(t,n,e){var r=e(0);Vue.use(r),Vue.config.lang=window.Laravel.locale,Vue.locale(window.Laravel.locale,_.cloneDeep(window.Laravel.translations)),Vue.component("open-game-by-entering-pin-code",e(1));new Vue({el:"#sz-quick-play",mounted:function(){},data:function(){return{baseUrl:"/"}},methods:{}})}]);