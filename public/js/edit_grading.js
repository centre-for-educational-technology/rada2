!function(n){function t(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return n[r].call(o.exports,o,o.exports,t),o.l=!0,o.exports}var e={};return t.m=n,t.c=e,t.i=function(n){return n},t.d=function(n,t,e){Object.defineProperty(n,t,{configurable:!1,enumerable:!0,get:e})},t.n=function(n){var e=n&&n.__esModule?function(){return n["default"]}:function(){return n};return t.d(e,"a",e),e},t.o=function(n,t){return Object.prototype.hasOwnProperty.call(n,t)},t.p="",t(t.s=2)}([function(n,t,e){"use strict";(function(t){function e(n,t){window.console&&(console.warn("[vue-i18n] "+n),t&&console.warn(t.stack))}function r(n,t,e){if("object"==typeof t)e(t);else{var r=t.call(this);if("function"==typeof r)if(r.resolved)e(r.resolved);else if(r.requested)r.pendingCallbacks.push(e);else{r.requested=!0;var i=r.pendingCallbacks=[e];r(function(n){r.resolved=n;for(var t=0,e=i.length;t<e;t++)i[t](n)},function(){e()})}else o(r)&&r.then(function(n){e(n)},function(){e()})["catch"](function(n){console.error(n),e()})}}function o(n){return n&&"function"==typeof n.then}function i(n){if(!m){var t=n.$watch("__watcher__",function(n){});m=n._watchers[0].constructor,t()}return m}function u(n){return!_&&n&&n._data&&n._data.__ob__&&n._data.__ob__.dep&&(_=n._data.__ob__.dep.constructor),_}function a(n){return null===n||void 0===n}function c(n,t){function e(e){var r=arguments.length;return r?r>1?n.apply(t,arguments):n.call(t,e):n.call(t)}return e._length=n.length,e}function l(n){return null!==n&&"object"==typeof n}function f(n){return k.call(n)===A}function s(n,t){return j.call(n,t)}function p(n){return K.test(n)}function d(n){var t=n.charCodeAt(0),e=n.charCodeAt(n.length-1);return t!==e||34!==t&&39!==t?n:n.slice(1,-1)}function v(n){if(void 0===n)return"eof";var t=n.charCodeAt(0);switch(t){case 91:case 93:case 46:case 34:case 39:case 48:return n;case 95:case 36:case 45:return"ident";case 32:case 9:case 10:case 13:case 160:case 65279:case 8232:case 8233:return"ws"}return t>=97&&t<=122||t>=65&&t<=90?"ident":t>=49&&t<=57?"number":"else"}function h(n){var t=n.trim();return("0"!==n.charAt(0)||!isNaN(n))&&(p(t)?d(t):"*"+t)}function g(n){function t(){var t=n[f+1];if(s===I&&"'"===t||s===R&&'"'===t)return f++,r="\\"+t,d[U](),!0}var e,r,o,i,u,a,c,l=[],f=-1,s=H,p=0,d=[];for(d[C]=function(){void 0!==o&&(l.push(o),o=void 0)},d[U]=function(){void 0===o?o=r:o+=r},d[D]=function(){d[U](),p++},d[F]=function(){if(p>0)p--,s=S,d[U]();else{if(p=0,o=h(o),o===!1)return!1;d[C]()}};null!=s;)if(f++,e=n[f],"\\"!==e||!t()){if(i=v(e),c=G[s],u=c[i]||c["else"]||B,u===B)return;if(s=u[0],a=d[u[1]],a&&(r=u[2],r=void 0===r?e:r,a()===!1))return;if(s===Z)return l.raw=n,l}}function y(n){var t=P[n];return t||(t=g(n),t&&(P[n]=t)),t}function w(n,r){void 0===r&&(r={});var o=n.version&&Number(n.version.split(".")[0])||-1;if("production"!==t.env.NODE_ENV&&w.installed)return void e("already installed.");if("production"!==t.env.NODE_ENV&&o<2)return void e("vue-i18n ("+w.version+") need to use Vue 2.0 or later (Vue: "+n.version+").");var i="en";b(n,i),$(n,J),T(n,J),N(n,J,i),W(n)}function b(n,t){var e=n.config.silent;n.config.silent=!0,J||(J=new n({data:{lang:t,locales:{}}})),n.config.silent=e}var m,_,O,$=function(n,t){n.locale=function(n,o,i){return void 0===o?t.locales[n]:void(null===o?(t.locales[n]=void 0,delete t.locales[n]):r(n,o,function(r){r?t.$set(t.locales,n,r):e("failed set `"+n+"` locale"),i&&i()}))}},T=function(n,t){var e=n.prototype._init;n.prototype._init=function(n){var r=this;e.call(this,n),this.$parent||(this._$lang=t,this._langUnwatch=this._$lang.$watch("$data",function(n,t){r.$forceUpdate()},{deep:!0}))};var r=n.prototype._destroy;n.prototype._destroy=function(){!this.$parent&&this._langUnwatch&&(this._langUnwatch(),this._langUnwatch=null,this._$lang=null),r.apply(this,arguments)}},k=Object.prototype.toString,A="[object Object]",j=Object.prototype.hasOwnProperty,V=null,E=null,N=function(n,t,e){function r(n,t){var e=new o(t,n,null,{lazy:!0});return function(){return e.dirty&&e.evaluate(),a&&a.target&&e.depend(),e.value}}var o=i(t),a=u(t);Object.defineProperty(n.config,"lang",{enumerable:!0,configurable:!0,get:r(function(){return t.lang},t),set:c(function(n){t.lang=n},t)}),O=e,Object.defineProperty(n.config,"fallbackLang",{enumerable:!0,configurable:!0,get:function(){return O},set:function(n){O=n}}),Object.defineProperty(n.config,"missingHandler",{enumerable:!0,configurable:!0,get:function(){return V},set:function(n){V=n}}),Object.defineProperty(n.config,"i18nFormatter",{enumerable:!0,configurable:!0,get:function(){return E},set:function(n){E=n}})},x=/(%|)\{([0-9a-zA-Z_]+)\}/g,L=function(n){function t(n){for(var t=[],e=arguments.length-1;e-- >0;)t[e]=arguments[e+1];return t=1===t.length&&"object"==typeof t[0]?t[0]:{},t&&t.hasOwnProperty||(t={}),n.replace(x,function(e,r,o,i){var u;return"{"===n[i-1]&&"}"===n[i+e.length]?o:(u=s(t,o)?t[o]:e,a(u)?"":u)})}return t},P=Object.create(null),U=0,C=1,D=2,F=3,H=0,M=1,q=2,z=3,S=4,I=5,R=6,Z=7,B=8,G=[];G[H]={ws:[H],ident:[z,U],"[":[S],eof:[Z]},G[M]={ws:[M],".":[q],"[":[S],eof:[Z]},G[q]={ws:[q],ident:[z,U],0:[z,U],number:[z,U]},G[z]={ident:[z,U],0:[z,U],number:[z,U],ws:[M,C],".":[q,C],"[":[S,C],eof:[Z,C]},G[S]={"'":[I,U],'"':[R,U],"[":[S,D],"]":[M,F],eof:B,"else":[S,U]},G[I]={"'":[S,U],eof:B,"else":[I,U]},G[R]={'"':[S,U],eof:B,"else":[R,U]};var J,K=/^\s?(true|false|-?[\d.]+|'[^']*'|"[^"]*")\s?$/,Q=function(n){function t(n){if(null===n||void 0===n)return!0;if(Array.isArray(n)){if(n.length>0)return!1;if(0===n.length)return!0}else if(f(n))for(var t in n)if(s(n,t))return!1;return!0}function e(n,e){if(!l(n))return null;var r=y(e);if(t(r))return null;for(var o=r.length,i=null,u=n,a=0;a<o;){var c=u[r[a]];if(void 0===c){u=null;break}u=c,a++}return i=u}return e},W=function(n){function r(){for(var t=[],e=arguments.length;e--;)t[e]=arguments[e];var r=n.config.lang,o=n.config.fallbackLang;return 1===t.length?l(t[0])||Array.isArray(t[0])?t=t[0]:"string"==typeof t[0]&&(r=t[0]):2===t.length&&("string"==typeof t[0]&&(r=t[0]),(l(t[1])||Array.isArray(t[1]))&&(t=t[1])),{lang:r,fallback:o,params:t}}function o(n,t){return!(!n||!t)&&!a(y(n,t))}function i(t,r,o){if(!t)return null;var u=y(t,r);if(Array.isArray(u))return u;if(a(u)&&(u=t[r]),a(u))return null;if("string"!=typeof u)return e("Value of key '"+r+"' is not a string!"),null;if(u.indexOf("@:")>=0){var c=u.match(/(@:[\w|.]+)/g);for(var l in c){var f=c[l],s=f.substr(2),p=i(t,s,o);u=u.replace(f,p)}}return o?n.config.i18nFormatter?n.config.i18nFormatter.apply(null,[u].concat(o)):g(u,o):u}function u(n,r,o,u,c){var l=null;return l=i(n(r),u,c),a(l)?(l=i(n(o),u,c),a(l)?null:("production"!==t.env.NODE_ENV&&e('Fall back to translate the keypath "'+u+'" with "'+o+'" language.'),l)):l}function f(r,o,i,u){return a(u)?(n.config.missingHandler?n.config.missingHandler.apply(null,[r,o,i]):"production"!==t.env.NODE_ENV&&e('Cannot translate the value of keypath "'+o+'". Use the value of keypath as default'),o):u}function s(t){return n.locale(t)}function p(n){return this.$options.locales[n]}function d(n){return n?n>1?1:0:1}function v(n,t){return n=Math.abs(n),2===t?d(n):n?Math.min(n,2):0}function h(n,t){if(!n&&"string"!=typeof n)return null;var e=n.split("|");return t=v(t,e.length),e[t]?e[t].trim():n}var g=L(n),y=Q(n);return n.t=function(n){for(var t=[],e=arguments.length-1;e-- >0;)t[e]=arguments[e+1];if(!n)return"";var o=r.apply(void 0,t),i=o.lang,a=o.fallback,c=o.params;return f(i,n,null,u(s,i,a,n,c))},n.tc=function(t,e){for(var r=[],o=arguments.length-2;o-- >0;)r[o]=arguments[o+2];return h(n.t.apply(n,[t].concat(r)),e)},n.te=function(n){for(var t=[],e=arguments.length-1;e-- >0;)t[e]=arguments[e+1];var i=r.apply(void 0,t),u=i.lang;return o(s(u),n)},n.prototype.$t=function(n){for(var t=[],e=arguments.length-1;e-- >0;)t[e]=arguments[e+1];if(!n)return"";var o=r.apply(void 0,t),i=o.lang,a=o.fallback,l=o.params,d=null;return this.$options.locales&&(d=u(c(p,this),i,a,n,l))?d:f(i,n,this,u(s,i,a,n,l))},n.prototype.$tc=function(n,t){for(var e=[],r=arguments.length-2;r-- >0;)e[r]=arguments[r+2];return"number"!=typeof t&&"undefined"!=typeof t?n:h((o=this).$t.apply(o,[n].concat(e)),t);var o},n.prototype.$te=function(n){for(var t=[],e=arguments.length-1;e-- >0;)t[e]=arguments[e+1];var i=r.apply(void 0,t),u=i.lang,a=!1;return this.$options.locales&&(a=o(c(p)(u),n)),a||(a=o(s(u),n)),a},n.mixin({computed:{$lang:function(){return n.config.lang}}}),n};w.version="__VERSION__","undefined"!=typeof window&&window.Vue&&window.Vue.use(w),n.exports=w}).call(t,e(1))},function(n,t){function e(){throw new Error("setTimeout has not been defined")}function r(){throw new Error("clearTimeout has not been defined")}function o(n){if(f===setTimeout)return setTimeout(n,0);if((f===e||!f)&&setTimeout)return f=setTimeout,setTimeout(n,0);try{return f(n,0)}catch(t){try{return f.call(null,n,0)}catch(t){return f.call(this,n,0)}}}function i(n){if(s===clearTimeout)return clearTimeout(n);if((s===r||!s)&&clearTimeout)return s=clearTimeout,clearTimeout(n);try{return s(n)}catch(t){try{return s.call(null,n)}catch(t){return s.call(this,n)}}}function u(){h&&d&&(h=!1,d.length?v=d.concat(v):g=-1,v.length&&a())}function a(){if(!h){var n=o(u);h=!0;for(var t=v.length;t;){for(d=v,v=[];++g<t;)d&&d[g].run();g=-1,t=v.length}d=null,h=!1,i(n)}}function c(n,t){this.fun=n,this.array=t}function l(){}var f,s,p=n.exports={};!function(){try{f="function"==typeof setTimeout?setTimeout:e}catch(n){f=e}try{s="function"==typeof clearTimeout?clearTimeout:r}catch(n){s=r}}();var d,v=[],h=!1,g=-1;p.nextTick=function(n){var t=new Array(arguments.length-1);if(arguments.length>1)for(var e=1;e<arguments.length;e++)t[e-1]=arguments[e];v.push(new c(n,t)),1!==v.length||h||o(a)},c.prototype.run=function(){this.fun.apply(null,this.array)},p.title="browser",p.browser=!0,p.env={},p.argv=[],p.version="",p.versions={},p.on=l,p.addListener=l,p.once=l,p.off=l,p.removeListener=l,p.removeAllListeners=l,p.emit=l,p.prependListener=l,p.prependOnceListener=l,p.listeners=function(n){return[]},p.binding=function(n){throw new Error("process.binding is not supported")},p.cwd=function(){return"/"},p.chdir=function(n){throw new Error("process.chdir is not supported")},p.umask=function(){return 0}},function(n,t,e){var r=e(0);Vue.use(r),Vue.config.lang=window.Laravel.locale,Vue.locale(window.Laravel.locale,_.cloneDeep(window.Laravel.translations));new Vue({el:"#grading-container",mounted:function(){},data:function(){return{baseUrl:"/"}},methods:{}})}]);