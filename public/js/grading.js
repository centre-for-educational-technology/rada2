!function(t){function e(i){if(n[i])return n[i].exports;var a=n[i]={i:i,l:!1,exports:{}};return t[i].call(a.exports,a,a.exports,e),a.l=!0,a.exports}var n={};return e.m=t,e.c=n,e.i=function(t){return t},e.d=function(t,e,n){Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:n})},e.n=function(t){var n=t&&t.__esModule?function(){return t["default"]}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=39)}([function(t,e){t.exports=function(t,e,n,i){var a,s=t=t||{},r=typeof t["default"];"object"!==r&&"function"!==r||(a=t,s=t["default"]);var o="function"==typeof s?s.options:s;if(e&&(o.render=e.render,o.staticRenderFns=e.staticRenderFns),n&&(o._scopeId=n),i){var l=o.computed||(o.computed={});Object.keys(i).forEach(function(t){var e=i[t];l[t]=function(){return e}})}return{esModule:a,exports:s,options:o}}},function(t,e){t.exports=function(){var t=[];return t.toString=function(){for(var t=[],e=0;e<this.length;e++){var n=this[e];n[2]?t.push("@media "+n[2]+"{"+n[1]+"}"):t.push(n[1])}return t.join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var i={},a=0;a<this.length;a++){var s=this[a][0];"number"==typeof s&&(i[s]=!0)}for(a=0;a<e.length;a++){var r=e[a];"number"==typeof r[0]&&i[r[0]]||(n&&!r[2]?r[2]=n:n&&(r[2]="("+r[2]+") and ("+n+")"),t.push(r))}},t}},function(t,e,n){function i(t){for(var e=0;e<t.length;e++){var n=t[e],i=u[n.id];if(i){i.refs++;for(var a=0;a<i.parts.length;a++)i.parts[a](n.parts[a]);for(;a<n.parts.length;a++)i.parts.push(s(n.parts[a]));i.parts.length>n.parts.length&&(i.parts.length=n.parts.length)}else{for(var r=[],a=0;a<n.parts.length;a++)r.push(s(n.parts[a]));u[n.id]={id:n.id,refs:1,parts:r}}}}function a(){var t=document.createElement("style");return t.type="text/css",d.appendChild(t),t}function s(t){var e,n,i=document.querySelector('style[data-vue-ssr-id~="'+t.id+'"]');if(i){if(h)return v;i.parentNode.removeChild(i)}if(g){var s=p++;i=f||(f=a()),e=r.bind(null,i,s,!1),n=r.bind(null,i,s,!0)}else i=a(),e=o.bind(null,i),n=function(){i.parentNode.removeChild(i)};return e(t),function(i){if(i){if(i.css===t.css&&i.media===t.media&&i.sourceMap===t.sourceMap)return;e(t=i)}else n()}}function r(t,e,n,i){var a=n?"":i.css;if(t.styleSheet)t.styleSheet.cssText=m(e,a);else{var s=document.createTextNode(a),r=t.childNodes;r[e]&&t.removeChild(r[e]),r.length?t.insertBefore(s,r[e]):t.appendChild(s)}}function o(t,e){var n=e.css,i=e.media,a=e.sourceMap;if(i&&t.setAttribute("media",i),a&&(n+="\n/*# sourceURL="+a.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"),t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}var l="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!l)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var c=n(38),u={},d=l&&(document.head||document.getElementsByTagName("head")[0]),f=null,p=0,h=!1,v=function(){},g="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());t.exports=function(t,e,n){h=n;var a=c(t,e);return i(a),function(e){for(var n=[],s=0;s<a.length;s++){var r=a[s],o=u[r.id];o.refs--,n.push(o)}e?(a=c(t,e),i(a)):a=[];for(var s=0;s<n.length;s++){var o=n[s];if(0===o.refs){for(var l=0;l<o.parts.length;l++)o.parts[l]();delete u[o.id]}}}};var m=function(){var t=[];return function(e,n){return t[e]=n,t.filter(Boolean).join("\n")}}()},function(t,e,n){"use strict";(function(e){function n(t,e){window.console&&(console.warn("[vue-i18n] "+t),e&&console.warn(e.stack))}function i(t,e,n){if("object"==typeof e)n(e);else{var i=e.call(this);if("function"==typeof i)if(i.resolved)n(i.resolved);else if(i.requested)i.pendingCallbacks.push(n);else{i.requested=!0;var s=i.pendingCallbacks=[n];i(function(t){i.resolved=t;for(var e=0,n=s.length;e<n;e++)s[e](t)},function(){n()})}else a(i)&&i.then(function(t){n(t)},function(){n()})["catch"](function(t){console.error(t),n()})}}function a(t){return t&&"function"==typeof t.then}function s(t){if(!b){var e=t.$watch("__watcher__",function(t){});b=t._watchers[0].constructor,e()}return b}function r(t){return!y&&t&&t._data&&t._data.__ob__&&t._data.__ob__.dep&&(y=t._data.__ob__.dep.constructor),y}function o(t){return null===t||void 0===t}function l(t,e){function n(n){var i=arguments.length;return i?i>1?t.apply(e,arguments):t.call(e,n):t.call(e)}return n._length=t.length,n}function c(t){return null!==t&&"object"==typeof t}function u(t){return E.call(t)===k}function d(t,e){return P.call(t,e)}function f(t){return W.test(t)}function p(t){var e=t.charCodeAt(0),n=t.charCodeAt(t.length-1);return e!==n||34!==e&&39!==e?t:t.slice(1,-1)}function h(t){if(void 0===t)return"eof";var e=t.charCodeAt(0);switch(e){case 91:case 93:case 46:case 34:case 39:case 48:return t;case 95:case 36:case 45:return"ident";case 32:case 9:case 10:case 13:case 160:case 65279:case 8232:case 8233:return"ws"}return e>=97&&e<=122||e>=65&&e<=90?"ident":e>=49&&e<=57?"number":"else"}function v(t){var e=t.trim();return("0"!==t.charAt(0)||!isNaN(t))&&(f(e)?p(e):"*"+e)}function g(t){function e(){var e=t[u+1];if(d===G&&"'"===e||d===z&&'"'===e)return u++,i="\\"+e,p[F](),!0}var n,i,a,s,r,o,l,c=[],u=-1,d=j,f=0,p=[];for(p[R]=function(){void 0!==a&&(c.push(a),a=void 0)},p[F]=function(){void 0===a?a=i:a+=i},p[U]=function(){p[F](),f++},p[q]=function(){if(f>0)f--,d=I,p[F]();else{if(f=0,a=v(a),a===!1)return!1;p[R]()}};null!=d;)if(u++,n=t[u],"\\"!==n||!e()){if(s=h(n),l=B[d],r=l[s]||l["else"]||Q,r===Q)return;if(d=r[0],o=p[r[1]],o&&(i=r[2],i=void 0===i?n:i,o()===!1))return;if(d===H)return c.raw=t,c}}function m(t){var e=N[t];return e||(e=g(t),e&&(N[t]=e)),e}function w(t,i){void 0===i&&(i={});var a=t.version&&Number(t.version.split(".")[0])||-1;if("production"!==e.env.NODE_ENV&&w.installed)return void n("already installed.");if("production"!==e.env.NODE_ENV&&a<2)return void n("vue-i18n ("+w.version+") need to use Vue 2.0 or later (Vue: "+t.version+").");var s="en";_(t,s),x(t,K),T(t,K),A(t,K,s),J(t)}function _(t,e){var n=t.config.silent;t.config.silent=!0,K||(K=new t({data:{lang:e,locales:{}}})),t.config.silent=n}var b,y,C,x=function(t,e){t.locale=function(t,a,s){return void 0===a?e.locales[t]:void(null===a?(e.locales[t]=void 0,delete e.locales[t]):i(t,a,function(i){i?e.$set(e.locales,t,i):n("failed set `"+t+"` locale"),s&&s()}))}},T=function(t,e){var n=t.prototype._init;t.prototype._init=function(t){var i=this;n.call(this,t),this.$parent||(this._$lang=e,this._langUnwatch=this._$lang.$watch("$data",function(t,e){i.$forceUpdate()},{deep:!0}))};var i=t.prototype._destroy;t.prototype._destroy=function(){!this.$parent&&this._langUnwatch&&(this._langUnwatch(),this._langUnwatch=null,this._$lang=null),i.apply(this,arguments)}},E=Object.prototype.toString,k="[object Object]",P=Object.prototype.hasOwnProperty,$=null,L=null,A=function(t,e,n){function i(t,e){var n=new a(e,t,null,{lazy:!0});return function(){return n.dirty&&n.evaluate(),o&&o.target&&n.depend(),n.value}}var a=s(e),o=r(e);Object.defineProperty(t.config,"lang",{enumerable:!0,configurable:!0,get:i(function(){return e.lang},e),set:l(function(t){e.lang=t},e)}),C=n,Object.defineProperty(t.config,"fallbackLang",{enumerable:!0,configurable:!0,get:function(){return C},set:function(t){C=t}}),Object.defineProperty(t.config,"missingHandler",{enumerable:!0,configurable:!0,get:function(){return $},set:function(t){$=t}}),Object.defineProperty(t.config,"i18nFormatter",{enumerable:!0,configurable:!0,get:function(){return L},set:function(t){L=t}})},O=/(%|)\{([0-9a-zA-Z_]+)\}/g,D=function(t){function e(t){for(var e=[],n=arguments.length-1;n-- >0;)e[n]=arguments[n+1];return e=1===e.length&&"object"==typeof e[0]?e[0]:{},e&&e.hasOwnProperty||(e={}),t.replace(O,function(n,i,a,s){var r;return"{"===t[s-1]&&"}"===t[s+n.length]?a:(r=d(e,a)?e[a]:n,o(r)?"":r)})}return e},N=Object.create(null),F=0,R=1,U=2,q=3,j=0,S=1,M=2,V=3,I=4,G=5,z=6,H=7,Q=8,B=[];B[j]={ws:[j],ident:[V,F],"[":[I],eof:[H]},B[S]={ws:[S],".":[M],"[":[I],eof:[H]},B[M]={ws:[M],ident:[V,F],0:[V,F],number:[V,F]},B[V]={ident:[V,F],0:[V,F],number:[V,F],ws:[S,R],".":[M,R],"[":[I,R],eof:[H,R]},B[I]={"'":[G,F],'"':[z,F],"[":[I,U],"]":[S,q],eof:Q,"else":[I,F]},B[G]={"'":[I,F],eof:Q,"else":[G,F]},B[z]={'"':[I,F],eof:Q,"else":[z,F]};var K,W=/^\s?(true|false|-?[\d.]+|'[^']*'|"[^"]*")\s?$/,X=function(t){function e(t){if(null===t||void 0===t)return!0;if(Array.isArray(t)){if(t.length>0)return!1;if(0===t.length)return!0}else if(u(t))for(var e in t)if(d(t,e))return!1;return!0}function n(t,n){if(!c(t))return null;var i=m(n);if(e(i))return null;for(var a=i.length,s=null,r=t,o=0;o<a;){var l=r[i[o]];if(void 0===l){r=null;break}r=l,o++}return s=r}return n},J=function(t){function i(){for(var e=[],n=arguments.length;n--;)e[n]=arguments[n];var i=t.config.lang,a=t.config.fallbackLang;return 1===e.length?c(e[0])||Array.isArray(e[0])?e=e[0]:"string"==typeof e[0]&&(i=e[0]):2===e.length&&("string"==typeof e[0]&&(i=e[0]),(c(e[1])||Array.isArray(e[1]))&&(e=e[1])),{lang:i,fallback:a,params:e}}function a(t,e){return!(!t||!e)&&!o(m(t,e))}function s(e,i,a){if(!e)return null;var r=m(e,i);if(Array.isArray(r))return r;if(o(r)&&(r=e[i]),o(r))return null;if("string"!=typeof r)return n("Value of key '"+i+"' is not a string!"),null;if(r.indexOf("@:")>=0){var l=r.match(/(@:[\w|.]+)/g);for(var c in l){var u=l[c],d=u.substr(2),f=s(e,d,a);r=r.replace(u,f)}}return a?t.config.i18nFormatter?t.config.i18nFormatter.apply(null,[r].concat(a)):g(r,a):r}function r(t,i,a,r,l){var c=null;return c=s(t(i),r,l),o(c)?(c=s(t(a),r,l),o(c)?null:("production"!==e.env.NODE_ENV&&n('Fall back to translate the keypath "'+r+'" with "'+a+'" language.'),c)):c}function u(i,a,s,r){return o(r)?(t.config.missingHandler?t.config.missingHandler.apply(null,[i,a,s]):"production"!==e.env.NODE_ENV&&n('Cannot translate the value of keypath "'+a+'". Use the value of keypath as default'),a):r}function d(e){return t.locale(e)}function f(t){return this.$options.locales[t]}function p(t){return t?t>1?1:0:1}function h(t,e){return t=Math.abs(t),2===e?p(t):t?Math.min(t,2):0}function v(t,e){if(!t&&"string"!=typeof t)return null;var n=t.split("|");return e=h(e,n.length),n[e]?n[e].trim():t}var g=D(t),m=X(t);return t.t=function(t){for(var e=[],n=arguments.length-1;n-- >0;)e[n]=arguments[n+1];if(!t)return"";var a=i.apply(void 0,e),s=a.lang,o=a.fallback,l=a.params;return u(s,t,null,r(d,s,o,t,l))},t.tc=function(e,n){for(var i=[],a=arguments.length-2;a-- >0;)i[a]=arguments[a+2];return v(t.t.apply(t,[e].concat(i)),n)},t.te=function(t){for(var e=[],n=arguments.length-1;n-- >0;)e[n]=arguments[n+1];var s=i.apply(void 0,e),r=s.lang;return a(d(r),t)},t.prototype.$t=function(t){for(var e=[],n=arguments.length-1;n-- >0;)e[n]=arguments[n+1];if(!t)return"";var a=i.apply(void 0,e),s=a.lang,o=a.fallback,c=a.params,p=null;return this.$options.locales&&(p=r(l(f,this),s,o,t,c))?p:u(s,t,this,r(d,s,o,t,c))},t.prototype.$tc=function(t,e){for(var n=[],i=arguments.length-2;i-- >0;)n[i]=arguments[i+2];return"number"!=typeof e&&"undefined"!=typeof e?t:v((a=this).$t.apply(a,[t].concat(n)),e);var a},t.prototype.$te=function(t){for(var e=[],n=arguments.length-1;n-- >0;)e[n]=arguments[n+1];var s=i.apply(void 0,e),r=s.lang,o=!1;return this.$options.locales&&(o=a(l(f)(r),t)),o||(o=a(d(r),t)),o},t.mixin({computed:{$lang:function(){return t.config.lang}}}),t};w.version="__VERSION__","undefined"!=typeof window&&window.Vue&&window.Vue.use(w),t.exports=w}).call(e,n(18))},function(t,e,n){n(34);var i=n(0)(n(7),n(27),"data-v-3556f9b2",null);t.exports=i.exports},function(t,e,n){"use strict";e["default"]={props:["onSwitchChange","label"],methods:{onChange:function(t){"undefined"!=typeof this.onSwitchChange&&this.onSwitchChange(t.target.checked)},onLabelClick:function(){this.$refs.input.click()}}}},function(t,e,n){"use strict";e["default"]={props:["answer","viewType"],components:{freeform:n(22),photo:n(23)},mounted:function(){var t=this;this.$nextTick(function(){t.$nextTick(function(){t.baseUrl=window.RADA.config.base_url})})},data:function(){return{image:null,baseUrl:"",answerx:null}},methods:{reset:function(){this.image=null,this.$set(this,"answer",null)},setAnswer:function(t){this.$set(this,"answer",t),this.answer&&this.answer.image&&(this.image="/uploads/images/activity_items/"+this.answer.activity_item_id+"/"+this.answer.image)},getQuestionTypeTranslation:function(){return window.Laravel.questionTypes[this.answer.type]},isInformation:function(){return this.answer.type===window.Laravel.questionTypeConstants.INFORMATION},isOneCorrectAnswer:function(){return this.answer.type===window.Laravel.questionTypeConstants.ONE_CORRECT_ANSWER},isMultipleCorrectAnswers:function(){return this.answer.type===window.Laravel.questionTypeConstants.MULTIPLE_CORRECT_ANSWERS},isFreeformAnswer:function(){return this.answer.type===window.Laravel.questionTypeConstants.FREEFORM_ANSWER},isMatchPairs:function(){return this.answer.type===window.Laravel.questionTypeConstants.MATCH_PAIRS},isEmbeddedContent:function(){return this.answer.type===window.Laravel.questionTypeConstants.EMBEDDED_CONTENT},isPhoto:function(){return this.answer.type===window.Laravel.questionTypeConstants.PHOTO},isMissingWord:function(){return this.answer.type===window.Laravel.questionTypeConstants.MISSING_WORD}}}},function(t,e,n){"use strict";e["default"]={props:["answers"],components:{"grading-list-item":n(21),pagination:n(24),"form-element-switch":n(19),"grading-edit":n(20)},mounted:function(){var t=this,e=this;this.$nextTick(function(){if(t.baseUrl=window.RADA.config.base_url,t.viewType=window.Laravel.viewType,"list"===t.viewType){var e=window.Laravel.currentPage;t.currentPage=e,0===e&&(e=1),t.paginationPage=e}}),window.addEventListener("popstate",function(t){var n=t.state;null===n?(e.reset(),e.resetEdit()):(e.resetEdit(),e.setData(n))})},updated:function(){if("edit"===this.viewType){var t=this.answers.filter(function(t){return t.id===window.Laravel.currentAnswerId});t.length>0&&this.setEditAnswer(t[0])}},data:function(){return{itemsPerPage:3,baseUrl:"",paginationPage:0,currentPage:0,showGraded:!1,viewType:"list",editFormKey:0,canUpdateEditKey:!1,currentAnswer:null,bootstrapPaginationClasses:{ul:"pagination",li:"page-item",liActive:"active",liDisable:"disabled",button:"page-link"}}},computed:{filteredAnswers:function(){var t=this;return this.answers.filter(function(e){return t.showGraded!==!1||null===e.grade})},pages:function(){return Math.ceil(this.filteredAnswers.length/this.itemsPerPage)},answersPerPage:function(){var t=this.itemsPerPage*(this.currentPage-1),e=t+(this.itemsPerPage-1);return this.filteredAnswers.filter(function(n,i){return i>=t&&i<=e})}},watch:{paginationPage:function(){this.currentPage!==this.paginationPage&&(this.currentPage=this.paginationPage,this.changePage())}},methods:{setEditAnswer:function(t,e){var n=this;"undefined"!=typeof e&&(this.canUpdateEditKey=!0),this.canUpdateEditKey&&this.editFormKey++,this.$nextTick(function(){n.currentAnswer=t})},resetEdit:function(){this.$refs.gradingEditComponent.reset()},reset:function(){this.setData({currentPage:1,showGraded:!1,viewType:"list"})},setData:function(t){this.currentPage=t.currentPage,this.paginationPage=t.currentPage,this.showGraded=t.showGraded,this.viewType=t.viewType},getData:function(){return{currentPage:this.currentPage,showGraded:this.showGraded,viewType:this.viewType}},onSwitchChange:function(t){this.showGraded=t},changePage:function(){window.history.pushState(this.getData(),"index ("+this.currentPage+")","/grading/page/"+this.currentPage)}}}},function(t,e,n){"use strict";e["default"]={props:["answer"],mounted:function(){var t=this;this.$nextTick(function(){t.$nextTick(function(){t.baseUrl=window.RADA.config.base_url,t.href="/grading/"+t.answer.id+"/edit"})})},data:function(){return{baseUrl:"",href:""}},methods:{onClickOpenEditView:function(t){t.preventDefault();var e="/grading/"+this.answer.id+"/edit",n=this.$parent.getData();return n.currentAnswer=this.answer,n.viewType="edit",this.$emit("setData",n),this.$parent.setEditAnswer(this.answer,!0),history.pushState(n,this.answer.title,e),!1},getQuestionTypeImageUrl:function(){var t={1:"information",2:"one-correct-answer",3:"multiple-correct-answers",4:"freeform-answer",5:"match-pairs",6:"embedded-content",7:"photo"},e="/img/logos/logo-square.png";return"undefined"!=typeof t[this.answer.type]&&(e="/img/icons/item/"+t[this.answer.type]+".png"),this.baseUrl+e},getQuestionTypeTranslation:function(){return window.Laravel.questionTypes[this.answer.type]}}}},function(t,e,n){"use strict";e["default"]={props:["answer"],methods:{show:function(){return this.$parent.isFreeformAnswer()}}}},function(t,e,n){"use strict";e["default"]={props:["answer"],data:function(){return{image:this.answer.answer_image?"/uploads/images/activities/"+this.answer.activity_id+"/"+this.answer.game_id+"/"+this.answer.answer_image:null}},methods:{show:function(){return this.$parent.isPhoto()}}}},function(t,e,n){"use strict";var i={ul:"pagination",li:"pagination-item",liActive:"pagination-item--active",liDisable:"pagination-item--disable",button:"pagination-link",buttonActive:"pagination-link--active",buttonDisable:"pagination-link--disable"},a={first:"&laquo;",prev:"&lsaquo;",next:"&rsaquo;",last:"&raquo;"};e["default"]={props:{value:{type:Number,required:!0},pageCount:{type:Number,required:!0},classes:{type:Object,required:!1,"default":function(){return{}}},labels:{type:Object,required:!1,"default":function(){return{}}}},data:function(){return{paginationClasses:Object.assign({},i,this.classes),paginationLabels:Object.assign({},a,this.labels)}},mounted:function(){this.value>this.pageCount&&this.$emit("input",this.pageCount)},computed:{items:function(){for(var t=this,e=this.value>1?this.value-1:1,n=this.value<this.pageCount?this.value+1:this.pageCount,i=3===e?2:null,a=n===this.pageCount-2?this.pageCount-1:null,s=e>3?2:null,r=n<this.pageCount-2?this.pageCount-1:null,o=[],l=1;l<=this.pageCount;l+=1)[1,t.pageCount,t.value,e,n,i,a,s,r].includes(l)&&o.push({label:l,active:t.value===l,disable:[s,r].includes(l)});return o},hasFirst:function(){return 1===this.value},hasLast:function(){return this.value===this.pageCount}},watch:{value:function(){this.$emit("change")}},methods:{first:function(){this.hasFirst||this.$emit("input",1)},prev:function(){this.hasFirst||this.$emit("input",this.value-1)},"goto":function(t){this.$emit("input",t)},next:function(){this.hasLast||this.$emit("input",this.value+1)},last:function(){this.hasLast||this.$emit("input",this.pageCount)}}}},function(t,e,n){e=t.exports=n(1)(),e.push([t.i,".question-title[data-v-16c6aada]{padding:5px 0;display:block}.activity-title[data-v-16c6aada]{font-size:14px}.bottom-padding[data-v-16c6aada]{padding-bottom:15px}.image[data-v-16c6aada]{max-width:100%}",""])},function(t,e,n){e=t.exports=n(1)(),e.push([t.i,'.switch[data-v-22fae6dc]{position:relative;display:inline-block;width:50px;height:25px}.switch input[data-v-22fae6dc]{opacity:0;width:0;height:0}.slider[data-v-22fae6dc]{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:#ccc;-webkit-transition:.4s;transition:.4s}.slider[data-v-22fae6dc]:before{position:absolute;content:"";height:18px;width:20px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider[data-v-22fae6dc]{background-color:#f57c35}input:focus+.slider[data-v-22fae6dc]{box-shadow:0 0 1px #f57c35}input:checked+.slider[data-v-22fae6dc]:before{-webkit-transform:translateX(21px);-ms-transform:translateX(21px);transform:translateX(21px)}.slider.round[data-v-22fae6dc]{border-radius:34px}.slider.round[data-v-22fae6dc]:before{border-radius:50%}.switch-text[data-v-22fae6dc]{cursor:pointer;padding:15px 5px}',""])},function(t,e,n){e=t.exports=n(1)(),e.push([t.i,"",""])},function(t,e,n){e=t.exports=n(1)(),e.push([t.i,".media .media-left[data-v-78a47d4c]{position:relative}.media .media-left .grade-container[data-v-78a47d4c]{padding-top:15px}.media .media-left .grade-container .grade-label[data-v-78a47d4c]{color:green;font-weight:700;text-align:center;text-transform:uppercase}.media .media-left .grade-container .grade[data-v-78a47d4c]{text-align:center}.question-title[data-v-78a47d4c]{padding:5px 0;display:block}.activity-title[data-v-78a47d4c]{font-size:14px}.mdi-school[data-v-78a47d4c]{height:38px;line-height:60px;cursor:pointer}",""])},function(t,e,n){e=t.exports=n(1)(),e.push([t.i,".image[data-v-8d0b186a]{max-width:100%}",""])},function(t,e,n){e=t.exports=n(1)(),e.push([t.i,"",""])},function(t,e){function n(){throw new Error("setTimeout has not been defined")}function i(){throw new Error("clearTimeout has not been defined")}function a(t){if(u===setTimeout)return setTimeout(t,0);if((u===n||!u)&&setTimeout)return u=setTimeout,setTimeout(t,0);try{return u(t,0)}catch(e){try{return u.call(null,t,0)}catch(e){return u.call(this,t,0)}}}function s(t){if(d===clearTimeout)return clearTimeout(t);if((d===i||!d)&&clearTimeout)return d=clearTimeout,clearTimeout(t);try{return d(t)}catch(e){try{return d.call(null,t)}catch(e){return d.call(this,t)}}}function r(){v&&p&&(v=!1,p.length?h=p.concat(h):g=-1,h.length&&o())}function o(){if(!v){var t=a(r);v=!0;for(var e=h.length;e;){for(p=h,h=[];++g<e;)p&&p[g].run();g=-1,e=h.length}p=null,v=!1,s(t)}}function l(t,e){this.fun=t,this.array=e}function c(){}var u,d,f=t.exports={};!function(){try{u="function"==typeof setTimeout?setTimeout:n}catch(t){u=n}try{d="function"==typeof clearTimeout?clearTimeout:i}catch(t){d=i}}();var p,h=[],v=!1,g=-1;f.nextTick=function(t){var e=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)e[n-1]=arguments[n];h.push(new l(t,e)),1!==h.length||v||a(o)},l.prototype.run=function(){this.fun.apply(null,this.array)},f.title="browser",f.browser=!0,f.env={},f.argv=[],f.version="",f.versions={},f.on=c,f.addListener=c,f.once=c,f.off=c,f.removeListener=c,f.removeAllListeners=c,f.emit=c,f.prependListener=c,f.prependOnceListener=c,f.listeners=function(t){return[]},f.binding=function(t){throw new Error("process.binding is not supported")},f.cwd=function(){return"/"},f.chdir=function(t){throw new Error("process.chdir is not supported")},f.umask=function(){return 0}},function(t,e,n){n(33);var i=n(0)(n(5),n(26),"data-v-22fae6dc",null);t.exports=i.exports},function(t,e,n){n(32);var i=n(0)(n(6),n(25),"data-v-16c6aada",null);t.exports=i.exports},function(t,e,n){n(35);var i=n(0)(n(8),n(29),"data-v-78a47d4c",null);t.exports=i.exports},function(t,e,n){var i=n(0)(n(9),n(28),null,null);t.exports=i.exports},function(t,e,n){n(36);var i=n(0)(n(10),n(30),"data-v-8d0b186a",null);t.exports=i.exports},function(t,e,n){n(37);var i=n(0)(n(11),n(31),null,null);t.exports=i.exports},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return"edit"===t.viewType&&null!=t.answer?n("div",{staticClass:"panel panel-default"},[n("div",{staticClass:"panel-heading"},[t._v("\n        "+t._s(t.$t("pages.grading.index.heading"))+"\n    ")]),t._v(" "),n("div",{staticClass:"panel-body"},[n("div",{staticClass:"media sz-author"},[t._m(0),t._v(" "),n("div",{staticClass:"media-body"},[n("div",[t._v(t._s(t.answer.user_name))]),t._v(" "),n("div",{staticClass:"sz-date"},[n("i",{staticClass:"mdi mdi-clock",attrs:{"aria-hidden":"true"}}),t._v("\n                    "+t._s(t.answer.created_at)+"\n                ")])])]),t._v(" "),n("div",{staticClass:"media-body bottom-padding"},[n("h4",{staticClass:"media-heading"},[n("div",{staticClass:"col-xs-12"},[n("div",{staticClass:"row"},[n("div",{staticClass:"question-title"},[t._v(t._s(t.answer.title))]),t._v(" "),n("div",{staticClass:"activity-title"},[t._v(t._s(this.getQuestionTypeTranslation()))]),t._v(" "),null!=t.image?n("img",{staticClass:"image",attrs:{src:t.image}}):t._e(),t._v(" "),t.answer.description.length>0?n("div",[n("h4",[t._v("Question/Information text")]),t._v(" "),n("p",[t._v("\n                                "+t._s(t.answer.description)+"\n                            ")])]):t._e()])])])]),t._v(" "),n("div",[n("freeform",{attrs:{answer:t.answer}}),t._v(" "),n("photo",{attrs:{answer:t.answer}})],1),t._v(" "),n("h4",[t._v("Previous grades text")]),t._v(" "),t._m(1)])]):t._e()},staticRenderFns:[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"media-left"},[n("i",{staticClass:"mdi mdi-account-circle",attrs:{"aria-hidden":"true"}})])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",[t._v("10")]),t._v(" "),n("div",[n("p",[t._v("Anser")]),t._v(" "),n("span",[t._v("User Name")])]),t._v(" "),n("div",[n("a",{staticClass:"btn btn-xs btn-primary",attrs:{href:""}},[t._v("Details btn")])])])}]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"switch-container"},["undefined"!=typeof t.label?n("span",{staticClass:"switch-text",on:{click:t.onLabelClick}},[t._v(t._s(t.label))]):t._e(),t._v(" "),n("label",{staticClass:"switch"},[n("input",{ref:"input",attrs:{type:"checkbox"},on:{change:t.onChange}}),t._v(" "),n("span",{staticClass:"slider round"})])])},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",["list"===t.viewType?n("div",{staticClass:"panel panel-default"},[n("div",{staticClass:"panel-heading"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-xs-12 col-md-6"},[t._v("\n                    "+t._s(t.$t("pages.grading.index.heading"))+"\n                ")]),t._v(" "),n("div",{staticClass:"col-xs-12 col-md-6"},[n("div",{staticClass:"pull-right"},[n("form-element-switch",{attrs:{onSwitchChange:t.onSwitchChange,label:t.$t("pages.grading.index.switch-label")}})],1)])])]),t._v(" "),n("div",{staticClass:"panel-body",attrs:{id:"search-results"}},[0===t.answers.length?n("div",{staticClass:"well"},[t._v(t._s(t.$t("pages.grading.index.none-found")))]):t._e(),t._v(" "),t.answers.length>0?n("div",[t._l(t.answersPerPage,function(e){return n("grading-list-item",{attrs:{answer:e},on:{setData:t.setData}})}),t._v(" "),n("pagination",{attrs:{"page-count":t.pages,classes:t.bootstrapPaginationClasses,labels:t.paginationAnchorTexts},model:{value:t.paginationPage,callback:function(e){t.paginationPage=e},expression:"paginationPage"}})],2):t._e()])]):t._e(),t._v(" "),n("grading-edit",{key:t.editFormKey,ref:"gradingEditComponent",attrs:{viewType:t.viewType,answer:t.currentAnswer}})],1)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return t.show()?n("div",[n("h4",[t._v("Answer text")]),t._v(" "),n("p",[t._v("\n        "+t._s(t.answer.answer)+"\n    ")])]):t._e()},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"media"},[n("div",{staticClass:"media-left"},[n("a",[n("img",{staticClass:"media-object img-rounded sz-img-64x64",attrs:{src:t.getQuestionTypeImageUrl(),alt:"featured-image"}})]),t._v(" "),1===t.answer.correct&&null!==t.answer.grade?n("div",{staticClass:"grade-container"},[n("div",{staticClass:"grade-label"},[t._v(t._s(t.$t("pages.grading.index.graded")))]),t._v(" "),n("div",{staticClass:"grade"},[t._v(t._s(t.answer.grade)+"p")])]):t._e()]),t._v(" "),n("div",{staticClass:"media-body"},[n("h4",{staticClass:"media-heading"},[n("div",{staticClass:"col-xs-12 col-md-8"},[n("div",{staticClass:"row"},[n("a",{staticClass:"question-title",on:{click:t.onClickOpenEditView}},[t._v(t._s(t.answer.title))]),t._v(" "),n("div",{staticClass:"activity-title"},[t._v(t._s(t.answer.activity_title))])])]),t._v(" "),n("div",{staticClass:"col-xs-12 col-md-4"},[n("div",{staticClass:"row"},[n("a",{staticClass:"pull-right",on:{click:t.onClickOpenEditView}},[n("i",{staticClass:"mdi mdi-school mdi-48px",attrs:{"aria-hidden":"true"}})])])])]),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-xs-12 col-sm-6"},[n("div",{staticClass:"media sz-author"},[t._m(0),t._v(" "),n("div",{staticClass:"media-body"},[n("div",[t._v(t._s(t.answer.user_name))]),t._v(" "),n("div",{staticClass:"sz-date"},[n("i",{staticClass:"mdi mdi-clock",attrs:{"aria-hidden":"true"}}),t._v("\n                            "+t._s(t.answer.created_at)+"\n                        ")])])])])]),t._v(" "),t._m(1),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-xs-12 col-md-6"},[n("div",{staticClass:"sz-metadata"},[n("i",{staticClass:"mdi mdi-crosshairs",attrs:{"aria-hidden":"true"}}),t._v("\n                    "+t._s(this.getQuestionTypeTranslation())+"\n                ")])])]),t._v(" "),n("hr")])])},staticRenderFns:[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"media-left"},[n("i",{staticClass:"mdi mdi-account-circle",attrs:{"aria-hidden":"true"}})])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"row"},[n("div",{staticClass:"col-xs-12 col-md-6"},[n("div",{staticClass:"sz-metadata"},[n("i",{staticClass:"mdi mdi-translate",attrs:{"aria-hidden":"true"}}),t._v("\n                    English\n                ")])])])}]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return t.show()?n("div",[null!=t.image?n("img",{staticClass:"image",attrs:{src:t.image}}):t._e(),t._v(" "),n("h4",[t._v("Grade text")]),t._v(" "),t._m(0)]):t._e()},staticRenderFns:[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("input",{attrs:{type:"text"}}),t._v(" "),n("input",{staticClass:"btn btn-xs btn-primary",attrs:{type:"button"}}),t._v(" "),n("span",[t._v("You can enter value between 0 and 20 text")])])}]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("ul",{"class":t.paginationClasses.ul,attrs:{role:"navigation"}},[t.paginationLabels.first?n("li",{"class":t.paginationClasses.li+" "+(t.hasFirst?t.paginationClasses.liDisable:"")},[n("span",{"class":t.paginationClasses.button+" "+(t.hasFirst?t.paginationClasses.buttonDisable:""),attrs:{disabled:t.hasFirst},domProps:{innerHTML:t._s(t.paginationLabels.first)},on:{click:t.first}})]):t._e(),t._v(" "),t.paginationLabels.prev?n("li",{"class":t.paginationClasses.li+" "+(t.hasFirst?t.paginationClasses.liDisable:"")},[n("span",{"class":t.paginationClasses.button+" "+(t.hasFirst?t.paginationClasses.buttonDisable:""),attrs:{disabled:t.hasFirst},domProps:{innerHTML:t._s(t.paginationLabels.prev)},on:{click:t.prev}})]):t._e(),t._v(" "),t._l(t.items,function(e){return n("li",{key:e.label,"class":t.paginationClasses.li+" "+(e.active?t.paginationClasses.liActive:"")+" "+(e.disable?t.paginationClasses.liDisable:"")},[e.disable?n("span",{"class":t.paginationClasses.button+" "+t.paginationClasses.buttonDisable},[t._v("\n    ...\n  ")]):n("span",{"class":t.paginationClasses.button+" "+(e.active?t.paginationClasses.buttonActive:""),on:{click:function(n){return t["goto"](e.label)}}},[t._v("\n            "+t._s(e.label)+"\n        ")])])}),t._v(" "),t.paginationLabels.next?n("li",{"class":t.paginationClasses.li+" "+(t.hasLast?t.paginationClasses.liDisable:"")},[n("span",{"class":t.paginationClasses.button+" "+(t.hasLast?t.paginationClasses.buttonDisable:""),attrs:{disabled:t.hasLast},domProps:{innerHTML:t._s(t.paginationLabels.next)},on:{click:t.next}})]):t._e(),t._v(" "),t.paginationLabels.last?n("li",{"class":t.paginationClasses.li+" "+(t.hasLast?t.paginationClasses.liDisable:"")},[n("span",{"class":t.paginationClasses.button+" "+(t.hasLast?t.paginationClasses.buttonDisable:""),attrs:{disabled:t.hasLast},domProps:{innerHTML:t._s(t.paginationLabels.last)},on:{click:t.last}})]):t._e()],2)},staticRenderFns:[]}},function(t,e,n){var i=n(12);"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);n(2)("748a5f96",i,!0)},function(t,e,n){var i=n(13);"string"==typeof i&&(i=[[t.i,i,""]]),
i.locals&&(t.exports=i.locals);n(2)("16e7be00",i,!0)},function(t,e,n){var i=n(14);"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);n(2)("203c53dc",i,!0)},function(t,e,n){var i=n(15);"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);n(2)("1c451169",i,!0)},function(t,e,n){var i=n(16);"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);n(2)("54457816",i,!0)},function(t,e,n){var i=n(17);"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);n(2)("7860b1bd",i,!0)},function(t,e){t.exports=function(t,e){for(var n=[],i={},a=0;a<e.length;a++){var s=e[a],r=s[0],o=s[1],l=s[2],c=s[3],u={id:t+":"+a,css:o,media:l,sourceMap:c};i[r]?i[r].parts.push(u):n.push(i[r]={id:r,parts:[u]})}return n}},function(t,e,n){var i=n(3);Vue.use(i),Vue.config.lang=window.Laravel.locale,Vue.locale(window.Laravel.locale,_.cloneDeep(window.Laravel.translations)),Vue.component("grading-list",n(4));new Vue({el:"#grading-list-container",mounted:function(){this.answers=window.Laravel.answers},data:function(){return{baseUrl:"/",answers:[]}},methods:{}})}]);