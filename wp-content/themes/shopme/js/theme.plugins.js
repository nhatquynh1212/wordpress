/**
 * jQuery CSS Customizable Scrollbar
 *
 * Copyright 2014, Yuriy Khabarov
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * If you found bug, please contact me via email <13real008@gmail.com>
 *
 * @author Yuriy Khabarov aka Gromo
 * @version 0.2.6
 * @url https://github.com/gromo/jquery.scrollbar/
 *
 */
!function(l,e){"function"==typeof define&&define.amd?define(["jquery"],e):e(l.jQuery)}(this,function(l){"use strict";function e(e){if(t.webkit&&!e)return{height:0,width:0};if(!t.data.outer){var o={border:"none","box-sizing":"content-box",height:"200px",margin:"0",padding:"0",width:"200px"};t.data.inner=l("<div>").css(l.extend({},o)),t.data.outer=l("<div>").css(l.extend({left:"-1000px",overflow:"scroll",position:"absolute",top:"-1000px"},o)).append(t.data.inner).appendTo("body")}return t.data.outer.scrollLeft(1e3).scrollTop(1e3),{height:Math.ceil(t.data.outer.offset().top-t.data.inner.offset().top||0),width:Math.ceil(t.data.outer.offset().left-t.data.inner.offset().left||0)}}function o(){var l=e(!0);return!(l.height||l.width)}function s(l){var e=l.originalEvent;return e.axis&&e.axis===e.HORIZONTAL_AXIS?!1:e.wheelDeltaX?!1:!0}var r=!1,t={data:{index:0,name:"scrollbar"},macosx:/mac/i.test(navigator.platform),mobile:/android|webos|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent),overlay:null,scroll:null,scrolls:[],webkit:/webkit/i.test(navigator.userAgent)&&!/edge\/\d+/i.test(navigator.userAgent)};t.scrolls.add=function(l){this.remove(l).push(l)},t.scrolls.remove=function(e){for(;l.inArray(e,this)>=0;)this.splice(l.inArray(e,this),1);return this};var i={autoScrollSize:!0,autoUpdate:!0,debug:!1,disableBodyScroll:!1,duration:200,ignoreMobile:!1,ignoreOverlay:!1,scrollStep:30,showArrows:!1,stepScrolling:!0,scrollx:null,scrolly:null,onDestroy:null,onInit:null,onScroll:null,onUpdate:null},n=function(s){t.scroll||(t.overlay=o(),t.scroll=e(),a(),l(window).resize(function(){var l=!1;if(t.scroll&&(t.scroll.height||t.scroll.width)){var o=e();(o.height!==t.scroll.height||o.width!==t.scroll.width)&&(t.scroll=o,l=!0)}a(l)})),this.container=s,this.namespace=".scrollbar_"+t.data.index++,this.options=l.extend({},i,window.jQueryScrollbarOptions||{}),this.scrollTo=null,this.scrollx={},this.scrolly={},s.data(t.data.name,this),t.scrolls.add(this)};n.prototype={destroy:function(){if(this.wrapper){this.container.removeData(t.data.name),t.scrolls.remove(this);var e=this.container.scrollLeft(),o=this.container.scrollTop();this.container.insertBefore(this.wrapper).css({height:"",margin:"","max-height":""}).removeClass("scroll-content scroll-scrollx_visible scroll-scrolly_visible").off(this.namespace).scrollLeft(e).scrollTop(o),this.scrollx.scroll.removeClass("scroll-scrollx_visible").find("div").andSelf().off(this.namespace),this.scrolly.scroll.removeClass("scroll-scrolly_visible").find("div").andSelf().off(this.namespace),this.wrapper.remove(),l(document).add("body").off(this.namespace),l.isFunction(this.options.onDestroy)&&this.options.onDestroy.apply(this,[this.container])}},init:function(e){var o=this,r=this.container,i=this.containerWrapper||r,n=this.namespace,c=l.extend(this.options,e||{}),a={x:this.scrollx,y:this.scrolly},d=this.wrapper,h={scrollLeft:r.scrollLeft(),scrollTop:r.scrollTop()};if(t.mobile&&c.ignoreMobile||t.overlay&&c.ignoreOverlay||t.macosx&&!t.webkit)return!1;if(d)i.css({height:"auto","margin-bottom":-1*t.scroll.height+"px","margin-right":-1*t.scroll.width+"px","max-height":""});else{if(this.wrapper=d=l("<div>").addClass("scroll-wrapper").addClass(r.attr("class")).css("position","absolute"==r.css("position")?"absolute":"relative").insertBefore(r).append(r),r.is("textarea")&&(this.containerWrapper=i=l("<div>").insertBefore(r).append(r),d.addClass("scroll-textarea")),i.addClass("scroll-content").css({height:"auto","margin-bottom":-1*t.scroll.height+"px","margin-right":-1*t.scroll.width+"px","max-height":""}),r.on("scroll"+n,function(){l.isFunction(c.onScroll)&&c.onScroll.call(o,{maxScroll:a.y.maxScrollOffset,scroll:r.scrollTop(),size:a.y.size,visible:a.y.visible},{maxScroll:a.x.maxScrollOffset,scroll:r.scrollLeft(),size:a.x.size,visible:a.x.visible}),a.x.isVisible&&a.x.scroll.bar.css("left",r.scrollLeft()*a.x.kx+"px"),a.y.isVisible&&a.y.scroll.bar.css("top",r.scrollTop()*a.y.kx+"px")}),d.on("scroll"+n,function(){d.scrollTop(0).scrollLeft(0)}),c.disableBodyScroll){var p=function(l){s(l)?a.y.isVisible&&a.y.mousewheel(l):a.x.isVisible&&a.x.mousewheel(l)};d.on("MozMousePixelScroll"+n,p),d.on("mousewheel"+n,p),t.mobile&&d.on("touchstart"+n,function(e){var o=e.originalEvent.touches&&e.originalEvent.touches[0]||e,s={pageX:o.pageX,pageY:o.pageY},t={left:r.scrollLeft(),top:r.scrollTop()};l(document).on("touchmove"+n,function(l){var e=l.originalEvent.targetTouches&&l.originalEvent.targetTouches[0]||l;r.scrollLeft(t.left+s.pageX-e.pageX),r.scrollTop(t.top+s.pageY-e.pageY),l.preventDefault()}),l(document).on("touchend"+n,function(){l(document).off(n)})})}l.isFunction(c.onInit)&&c.onInit.apply(this,[r])}l.each(a,function(e,t){var i=null,d=1,h="x"===e?"scrollLeft":"scrollTop",p=c.scrollStep,u=function(){var l=r[h]();r[h](l+p),1==d&&l+p>=f&&(l=r[h]()),-1==d&&f>=l+p&&(l=r[h]()),r[h]()==l&&i&&i()},f=0;t.scroll||(t.scroll=o._getScroll(c["scroll"+e]).addClass("scroll-"+e),c.showArrows&&t.scroll.addClass("scroll-element_arrows_visible"),t.mousewheel=function(l){if(!t.isVisible||"x"===e&&s(l))return!0;if("y"===e&&!s(l))return a.x.mousewheel(l),!0;var i=-1*l.originalEvent.wheelDelta||l.originalEvent.detail,n=t.size-t.visible-t.offset;return(i>0&&n>f||0>i&&f>0)&&(f+=i,0>f&&(f=0),f>n&&(f=n),o.scrollTo=o.scrollTo||{},o.scrollTo[h]=f,setTimeout(function(){o.scrollTo&&(r.stop().animate(o.scrollTo,240,"linear",function(){f=r[h]()}),o.scrollTo=null)},1)),l.preventDefault(),!1},t.scroll.on("MozMousePixelScroll"+n,t.mousewheel).on("mousewheel"+n,t.mousewheel).on("mouseenter"+n,function(){f=r[h]()}),t.scroll.find(".scroll-arrow, .scroll-element_track").on("mousedown"+n,function(s){if(1!=s.which)return!0;d=1;var n={eventOffset:s["x"===e?"pageX":"pageY"],maxScrollValue:t.size-t.visible-t.offset,scrollbarOffset:t.scroll.bar.offset()["x"===e?"left":"top"],scrollbarSize:t.scroll.bar["x"===e?"outerWidth":"outerHeight"]()},a=0,v=0;return l(this).hasClass("scroll-arrow")?(d=l(this).hasClass("scroll-arrow_more")?1:-1,p=c.scrollStep*d,f=d>0?n.maxScrollValue:0):(d=n.eventOffset>n.scrollbarOffset+n.scrollbarSize?1:n.eventOffset<n.scrollbarOffset?-1:0,p=Math.round(.75*t.visible)*d,f=n.eventOffset-n.scrollbarOffset-(c.stepScrolling?1==d?n.scrollbarSize:0:Math.round(n.scrollbarSize/2)),f=r[h]()+f/t.kx),o.scrollTo=o.scrollTo||{},o.scrollTo[h]=c.stepScrolling?r[h]()+p:f,c.stepScrolling&&(i=function(){f=r[h](),clearInterval(v),clearTimeout(a),a=0,v=0},a=setTimeout(function(){v=setInterval(u,40)},c.duration+100)),setTimeout(function(){o.scrollTo&&(r.animate(o.scrollTo,c.duration),o.scrollTo=null)},1),o._handleMouseDown(i,s)}),t.scroll.bar.on("mousedown"+n,function(s){if(1!=s.which)return!0;var i=s["x"===e?"pageX":"pageY"],c=r[h]();return t.scroll.addClass("scroll-draggable"),l(document).on("mousemove"+n,function(l){var o=parseInt((l["x"===e?"pageX":"pageY"]-i)/t.kx,10);r[h](c+o)}),o._handleMouseDown(function(){t.scroll.removeClass("scroll-draggable"),f=r[h]()},s)}))}),l.each(a,function(l,e){var o="scroll-scroll"+l+"_visible",s="x"==l?a.y:a.x;e.scroll.removeClass(o),s.scroll.removeClass(o),i.removeClass(o)}),l.each(a,function(e,o){l.extend(o,"x"==e?{offset:parseInt(r.css("left"),10)||0,size:r.prop("scrollWidth"),visible:d.width()}:{offset:parseInt(r.css("top"),10)||0,size:r.prop("scrollHeight"),visible:d.height()})}),this._updateScroll("x",this.scrollx),this._updateScroll("y",this.scrolly),l.isFunction(c.onUpdate)&&c.onUpdate.apply(this,[r]),l.each(a,function(l,e){var o="x"===l?"left":"top",s="x"===l?"outerWidth":"outerHeight",t="x"===l?"width":"height",i=parseInt(r.css(o),10)||0,n=e.size,a=e.visible+i,d=e.scroll.size[s]()+(parseInt(e.scroll.size.css(o),10)||0);c.autoScrollSize&&(e.scrollbarSize=parseInt(d*a/n,10),e.scroll.bar.css(t,e.scrollbarSize+"px")),e.scrollbarSize=e.scroll.bar[s](),e.kx=(d-e.scrollbarSize)/(n-a)||1,e.maxScrollOffset=n-a}),r.scrollLeft(h.scrollLeft).scrollTop(h.scrollTop).trigger("scroll")},_getScroll:function(e){var o={advanced:['<div class="scroll-element">','<div class="scroll-element_corner"></div>','<div class="scroll-arrow scroll-arrow_less"></div>','<div class="scroll-arrow scroll-arrow_more"></div>','<div class="scroll-element_outer">','<div class="scroll-element_size"></div>','<div class="scroll-element_inner-wrapper">','<div class="scroll-element_inner scroll-element_track">','<div class="scroll-element_inner-bottom"></div>',"</div>","</div>",'<div class="scroll-bar">','<div class="scroll-bar_body">','<div class="scroll-bar_body-inner"></div>',"</div>",'<div class="scroll-bar_bottom"></div>','<div class="scroll-bar_center"></div>',"</div>","</div>","</div>"].join(""),simple:['<div class="scroll-element">','<div class="scroll-element_outer">','<div class="scroll-element_size"></div>','<div class="scroll-element_track"></div>','<div class="scroll-bar"></div>',"</div>","</div>"].join("")};return o[e]&&(e=o[e]),e||(e=o.simple),e="string"==typeof e?l(e).appendTo(this.wrapper):l(e),l.extend(e,{bar:e.find(".scroll-bar"),size:e.find(".scroll-element_size"),track:e.find(".scroll-element_track")}),e},_handleMouseDown:function(e,o){var s=this.namespace;return l(document).on("blur"+s,function(){l(document).add("body").off(s),e&&e()}),l(document).on("dragstart"+s,function(l){return l.preventDefault(),!1}),l(document).on("mouseup"+s,function(){l(document).add("body").off(s),e&&e()}),l("body").on("selectstart"+s,function(l){return l.preventDefault(),!1}),o&&o.preventDefault(),!1},_updateScroll:function(e,o){var s=this.container,r=this.containerWrapper||s,i="scroll-scroll"+e+"_visible",n="x"===e?this.scrolly:this.scrollx,c=parseInt(this.container.css("x"===e?"left":"top"),10)||0,a=this.wrapper,d=o.size,h=o.visible+c;o.isVisible=d-h>1,o.isVisible?(o.scroll.addClass(i),n.scroll.addClass(i),r.addClass(i)):(o.scroll.removeClass(i),n.scroll.removeClass(i),r.removeClass(i)),"y"===e&&r.css(s.is("textarea")||h>d?{height:h+t.scroll.height+"px","max-height":"none"}:{"max-height":h+t.scroll.height+"px"}),(o.size!=s.prop("scrollWidth")||n.size!=s.prop("scrollHeight")||o.visible!=a.width()||n.visible!=a.height()||o.offset!=(parseInt(s.css("left"),10)||0)||n.offset!=(parseInt(s.css("top"),10)||0))&&(l.extend(this.scrollx,{offset:parseInt(s.css("left"),10)||0,size:s.prop("scrollWidth"),visible:a.width()}),l.extend(this.scrolly,{offset:parseInt(s.css("top"),10)||0,size:this.container.prop("scrollHeight"),visible:a.height()}),this._updateScroll("x"===e?"y":"x",n))}};var c=n;l.fn.scrollbar=function(e,o){return"string"!=typeof e&&(o=e,e="init"),"undefined"==typeof o&&(o=[]),l.isArray(o)||(o=[o]),this.not("body, .scroll-wrapper").each(function(){var s=l(this),r=s.data(t.data.name);(r||"init"===e)&&(r||(r=new c(s)),r[e]&&r[e].apply(r,o))}),this},l.fn.scrollbar.options=i;var a=function(){var l=0,e=0;return function(o){var s,i,n,c,d,h,p;for(s=0;s<t.scrolls.length;s++)c=t.scrolls[s],i=c.container,n=c.options,d=c.wrapper,h=c.scrollx,p=c.scrolly,(o||n.autoUpdate&&d&&d.is(":visible")&&(i.prop("scrollWidth")!=h.size||i.prop("scrollHeight")!=p.size||d.width()!=h.visible||d.height()!=p.visible))&&(c.init(),n.debug&&(window.console&&console.log({scrollHeight:i.prop("scrollHeight")+":"+c.scrolly.size,scrollWidth:i.prop("scrollWidth")+":"+c.scrollx.size,visibleHeight:d.height()+":"+c.scrolly.visible,visibleWidth:d.width()+":"+c.scrollx.visible},!0),e++));r&&e>10?(window.console&&console.log("Scroll updates exceed 10"),a=function(){}):(clearTimeout(l),l=setTimeout(a,300))}}();window.angular&&!function(l){l.module("jQueryScrollbar",[]).provider("jQueryScrollbar",function(){var e=i;return{setOptions:function(o){l.extend(e,o)},$get:function(){return{options:l.copy(e)}}}}).directive("jqueryScrollbar",function(l,e){return{restrict:"AC",link:function(o,s,r){var t=e(r.jqueryScrollbar),i=t(o);s.scrollbar(i||l.options).on("$destroy",function(){s.scrollbar("destroy")})}}})}(window.angular)});

/*!
 * jQuery Cookie
 *
 */

jQuery.cookie=function(d,c,a){if("undefined"!=typeof c){a=a||{};null===c&&(c="",a.expires=-1);var b="";if(a.expires&&("number"==typeof a.expires||a.expires.toUTCString))"number"==typeof a.expires?(b=new Date,b.setTime(b.getTime()+864E5*a.expires)):b=a.expires,b="; expires="+b.toUTCString();var e=a.path?"; path="+a.path:"",f=a.domain?"; domain="+a.domain:"";a=a.secure?"; secure":"";document.cookie=[d,"=",encodeURIComponent(c),b,e,f,a].join("")}else{c=null;if(document.cookie&&""!=document.cookie){a=
	document.cookie.split(";");for(b=0;b<a.length;b++)if(e=jQuery.trim(a[b]),e.substring(0,d.length+1)==d+"="){c=decodeURIComponent(e.substring(d.length+1));break}}return c}};

/*!
 * jQuery Raty - A Star Rating Plugin
 *
 * Licensed under The MIT License
 *
 * @version        2.5.2
 * @author         Washington Botelho
 * @documentation  wbotelhos.com/raty
 *
 */

;(function(b){var a={init:function(c){return this.each(function(){a.destroy.call(this);this.opt=b.extend(true,{},b.fn.raty.defaults,c);var e=b(this),g=["number","readOnly","score","scoreName"];a._callback.call(this,g);if(this.opt.precision){a._adjustPrecision.call(this);}this.opt.number=a._between(this.opt.number,0,this.opt.numberMax);this.opt.path=this.opt.path||"";if(this.opt.path&&this.opt.path.slice(this.opt.path.length-1,this.opt.path.length)!=="/"){this.opt.path+="/";}this.stars=a._createStars.call(this);this.score=a._createScore.call(this);a._apply.call(this,this.opt.score);var f=this.opt.space?4:0,d=this.opt.width||(this.opt.number*this.opt.size+this.opt.number*f);if(this.opt.cancel){this.cancel=a._createCancel.call(this);d+=(this.opt.size+f);}if(this.opt.readOnly){a._lock.call(this);}else{e.css("cursor","pointer");a._binds.call(this);}if(this.opt.width!==false){e.css("width",d);}a._target.call(this,this.opt.score);e.data({settings:this.opt,raty:true});});},_adjustPrecision:function(){this.opt.targetType="score";this.opt.half=true;},_apply:function(c){if(c&&c>0){c=a._between(c,0,this.opt.number);this.score.val(c);}a._fill.call(this,c);if(c){a._roundStars.call(this,c);}},_between:function(e,d,c){return Math.min(Math.max(parseFloat(e),d),c);},_binds:function(){if(this.cancel){a._bindCancel.call(this);}a._bindClick.call(this);a._bindOut.call(this);a._bindOver.call(this);},_bindCancel:function(){a._bindClickCancel.call(this);a._bindOutCancel.call(this);a._bindOverCancel.call(this);},_bindClick:function(){var c=this,d=b(c);c.stars.on("click.raty",function(e){c.score.val((c.opt.half||c.opt.precision)?d.data("score"):this.alt);if(c.opt.click){c.opt.click.call(c,parseFloat(c.score.val()),e);}});},_bindClickCancel:function(){var c=this;c.cancel.on("click.raty",function(d){c.score.removeAttr("value");if(c.opt.click){c.opt.click.call(c,null,d);}});},_bindOut:function(){var c=this;b(this).on("mouseleave.raty",function(d){var e=parseFloat(c.score.val())||undefined;a._apply.call(c,e);a._target.call(c,e,d);if(c.opt.mouseout){c.opt.mouseout.call(c,e,d);}});},_bindOutCancel:function(){var c=this;c.cancel.on("mouseleave.raty",function(d){b(this).attr("src",c.opt.path+c.opt.cancelOff);if(c.opt.mouseout){c.opt.mouseout.call(c,c.score.val()||null,d);}});},_bindOverCancel:function(){var c=this;c.cancel.on("mouseover.raty",function(d){b(this).attr("src",c.opt.path+c.opt.cancelOn);c.stars.attr("src",c.opt.path+c.opt.starOff);a._target.call(c,null,d);if(c.opt.mouseover){c.opt.mouseover.call(c,null);}});},_bindOver:function(){var c=this,d=b(c),e=c.opt.half?"mousemove.raty":"mouseover.raty";c.stars.on(e,function(g){var h=parseInt(this.alt,10);if(c.opt.half){var f=parseFloat((g.pageX-b(this).offset().left)/c.opt.size),j=(f>0.5)?1:0.5;h=h-1+j;a._fill.call(c,h);if(c.opt.precision){h=h-j+f;}a._roundStars.call(c,h);d.data("score",h);}else{a._fill.call(c,h);}a._target.call(c,h,g);if(c.opt.mouseover){c.opt.mouseover.call(c,h,g);}});},_callback:function(c){for(i in c){if(typeof this.opt[c[i]]==="function"){this.opt[c[i]]=this.opt[c[i]].call(this);}}},_createCancel:function(){var e=b(this),c=this.opt.path+this.opt.cancelOff,d=b("<img />",{src:c,alt:"x",title:this.opt.cancelHint,"class":"raty-cancel"});if(this.opt.cancelPlace=="left"){e.prepend("&#160;").prepend(d);}else{e.append("&#160;").append(d);}return d;},_createScore:function(){return b("<input />",{type:"hidden",name:this.opt.scoreName}).appendTo(this);},_createStars:function(){var e=b(this);for(var c=1;c<=this.opt.number;c++){var f=a._getHint.call(this,c),d=(this.opt.score&&this.opt.score>=c)?"starOn":"starOff";d=this.opt.path+this.opt[d];b("<img />",{src:d,alt:c,title:f}).appendTo(this);if(this.opt.space){e.append((c<this.opt.number)?"&#160;":"");}}return e.children("img");},_error:function(c){b(this).html(c);b.error(c);},_fill:function(d){var m=this,e=0;for(var f=1;f<=m.stars.length;f++){var g=m.stars.eq(f-1),l=m.opt.single?(f==d):(f<=d);if(m.opt.iconRange&&m.opt.iconRange.length>e){var j=m.opt.iconRange[e],h=j.on||m.opt.starOn,c=j.off||m.opt.starOff,k=l?h:c;if(f<=j.range){g.attr("src",m.opt.path+k);}if(f==j.range){e++;}}else{var k=l?"starOn":"starOff";g.attr("src",this.opt.path+this.opt[k]);}}},_getHint:function(d){var c=this.opt.hints[d-1];return(c==="")?"":(c||d);},_lock:function(){var d=parseInt(this.score.val(),10),c=d?a._getHint.call(this,d):this.opt.noRatedMsg;b(this).data("readonly",true).css("cursor","").attr("title",c);this.score.attr("readonly","readonly");this.stars.attr("title",c);if(this.cancel){this.cancel.hide();}},_roundStars:function(e){var d=(e-Math.floor(e)).toFixed(2);if(d>this.opt.round.down){var c="starOn";if(this.opt.halfShow&&d<this.opt.round.up){c="starHalf";}else{if(d<this.opt.round.full){c="starOff";}}this.stars.eq(Math.ceil(e)-1).attr("src",this.opt.path+this.opt[c]);}},_target:function(f,d){if(this.opt.target){var e=b(this.opt.target);if(e.length===0){a._error.call(this,"Target selector invalid or missing!");}if(this.opt.targetFormat.indexOf("{score}")<0){a._error.call(this,'Template "{score}" missing!');}var c=d&&d.type=="mouseover";if(f===undefined){f=this.opt.targetText;}else{if(f===null){f=c?this.opt.cancelHint:this.opt.targetText;}else{if(this.opt.targetType=="hint"){f=a._getHint.call(this,Math.ceil(f));}else{if(this.opt.precision){f=parseFloat(f).toFixed(1);}}if(!c&&!this.opt.targetKeep){f=this.opt.targetText;}}}if(f){f=this.opt.targetFormat.toString().replace("{score}",f);}if(e.is(":input")){e.val(f);}else{e.html(f);}}},_unlock:function(){b(this).data("readonly",false).css("cursor","pointer").removeAttr("title");this.score.removeAttr("readonly","readonly");for(var c=0;c<this.opt.number;c++){this.stars.eq(c).attr("title",a._getHint.call(this,c+1));}if(this.cancel){this.cancel.css("display","");}},cancel:function(c){return this.each(function(){if(b(this).data("readonly")!==true){a[c?"click":"score"].call(this,null);this.score.removeAttr("value");}});},click:function(c){return b(this).each(function(){if(b(this).data("readonly")!==true){a._apply.call(this,c);if(!this.opt.click){a._error.call(this,'You must add the "click: function(score, evt) { }" callback.');}this.opt.click.call(this,c,{type:"click"});a._target.call(this,c);}});},destroy:function(){return b(this).each(function(){var d=b(this),c=d.data("raw");if(c){d.off(".raty").empty().css({cursor:c.style.cursor,width:c.style.width}).removeData("readonly");}else{d.data("raw",d.clone()[0]);}});},getScore:function(){var d=[],c;b(this).each(function(){c=this.score.val();d.push(c?parseFloat(c):undefined);});return(d.length>1)?d:d[0];},readOnly:function(c){return this.each(function(){var d=b(this);if(d.data("readonly")!==c){if(c){d.off(".raty").children("img").off(".raty");a._lock.call(this);}else{a._binds.call(this);a._unlock.call(this);}d.data("readonly",c);}});},reload:function(){return a.set.call(this,{});},score:function(){return arguments.length?a.setScore.apply(this,arguments):a.getScore.call(this);},set:function(c){return this.each(function(){var e=b(this),f=e.data("settings"),d=b.extend({},f,c);e.raty(d);});},setScore:function(c){return b(this).each(function(){if(b(this).data("readonly")!==true){a._apply.call(this,c);a._target.call(this,c);}});}};b.fn.raty=function(c){if(a[c]){return a[c].apply(this,Array.prototype.slice.call(arguments,1));}else{if(typeof c==="object"||!c){return a.init.apply(this,arguments);}else{b.error("Method "+c+" does not exist!");}}};b.fn.raty.defaults={cancel:false,cancelHint:"Cancel this rating!",cancelOff:"cancel-off.png",cancelOn:"cancel-on.png",cancelPlace:"left",click:undefined,half:false,halfShow:true,hints:["bad","poor","regular","good","gorgeous"],iconRange:undefined,mouseout:undefined,mouseover:undefined,noRatedMsg:"Not rated yet!",number:5,numberMax:20,path:"",precision:false,readOnly:false,round:{down:0.25,full:0.6,up:0.76},score:undefined,scoreName:"score",single:false,size:16,space:true,starHalf:"star-half.png",starOff:"star-off.png",starOn:"star-on.png",target:undefined,targetFormat:"{score}",targetKeep:false,targetText:"",targetType:"hint",width:undefined};})(jQuery);

/*
 * jQuery.appear
 * https://github.com/bas2k/jquery.appear/
 * http://code.google.com/p/jquery-appear/
 * http://bas2k.ru/
 *
 * Copyright (c) 2009 Michael Hixson
 * Copyright (c) 2012-2014 Alexander Brovikov
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 */
!function(e){e.fn.appear=function(a,r){var n=e.extend({data:void 0,one:!0,accX:0,accY:0},r);return this.each(function(){var r=e(this);if(r.appeared=!1,!a)return void r.trigger("appear",n.data);var p=e(window),t=function(){if(!r.is(":visible"))return void(r.appeared=!1);var e=p.scrollLeft(),a=p.scrollTop(),t=r.offset(),c=t.left,i=t.top,o=n.accX,f=n.accY,s=r.height(),u=p.height(),d=r.width(),l=p.width();i+s+f>=a&&a+u+f>=i&&c+d+o>=e&&e+l+o>=c?r.appeared||r.trigger("appear",n.data):r.appeared=!1},c=function(){if(r.appeared=!0,n.one){p.unbind("scroll",t);var c=e.inArray(t,e.fn.appear.checks);c>=0&&e.fn.appear.checks.splice(c,1)}a.apply(this,arguments)};n.one?r.one("appear",n.data,c):r.bind("appear",n.data,c),p.scroll(t),e.fn.appear.checks.push(t),t()})},e.extend(e.fn.appear,{checks:[],timeout:null,checkAll:function(){var a=e.fn.appear.checks.length;if(a>0)for(;a--;)e.fn.appear.checks[a]()},run:function(){e.fn.appear.timeout&&clearTimeout(e.fn.appear.timeout),e.fn.appear.timeout=setTimeout(e.fn.appear.checkAll,20)}}),e.each(["append","prepend","after","before","attr","removeAttr","addClass","removeClass","toggleClass","remove","css","show","hide"],function(a,r){var n=e.fn[r];n&&(e.fn[r]=function(){var a=n.apply(this,arguments);return e.fn.appear.run(),a})})}(jQuery);


/*	Extends Plugins
 /* --------------------------------------------- */

(function ($) {

	$.fn.extend({

		/**
		 **	Emulates select form element
		 **	@return jQuery
		 **/
		shopme_custom_select: function (options) {

			var template = "<div class='active_option open_select'></div><ul class='options_list dropdown'></ul>",
				defaults = {
					speed: 300
				},
				o = $.extend( true, {}, defaults, options),
				support = {
					TRANSITIONSUPPORTED: Modernizr.csstransitions,
					ISTOUCH: Modernizr.touch
				},
				event = support.ISTOUCH ? 'touchstart' : 'click';

			return this.each(function() {

				var $this = $(this),
					tableCellParent = $this.closest('.table_cell');
				$this.prepend(template);

				/* z-index fix */
				if (tableCellParent.length) {
					var zIndex = +tableCellParent.next().css('z-index');
					tableCellParent.css('z-index', ++zIndex);
				}

				var active = $this.children('.active_option'),
					list = $this.children('.options_list'),
					select = $this.children('select').hide(),
					select_name = select.attr('name'),
					options = select.children('option'),
					$input_hidden = $('<input />', {
						type: 'hidden',
						name: select_name
					});
				$this.append($input_hidden);

				active.text(
					select.children('option[selected]').text() ? select.children('option[selected]').text() : options.eq(0).text()
				);

				options.each(function () {
					var optionOuter = $('<li></li>', {
							class : 'animated_item'
						}),
						optionInner = $('<a></a>', {
							text : $(this).text(),
							'data-value': $(this).val(),
							href : 'javascript:void(0)'
						}),
						tpl = optionOuter.append(optionInner);

					list.append(tpl);
				});

				list.on(event, "a", function (e) {
					e.preventDefault();

					var $this = $(this),
						value = $this.data('value'),
						v = $this.text();
					active.text(v);
					select.val(v);

					$input_hidden.val(value);

					active.closest('.dropdown-list').removeClass("active visible").end().removeClass('active');

					//							if (support.TRANSITIONSUPPORTED) {
					//								$this.closest('.dropdown').add(active).removeClass("active");
					//							} else {
					//								$this.closest('.dropdown').add(active).removeClass("active visible");
					//							}
				});

			});

		},

		/**
		 **	@return jQuery
		 **/

		shopme_tabs : function (options) {

			if (!this.length) return;

			return this.each(function () {

				var $container = $(this),

					tabs = {

						init: function () {

							$container.addClass('initialized');

							this.nav = $container.children('.tabs_nav').length ? $container.children('.tabs_nav') : $container.children('.ts_nav');
							this.subContainer = $container.children('.tab_containers_wrap').length ? $container.children('.tab_containers_wrap') : $container.children('.ts_containers_wrap');
							this.tab = this.subContainer.children('.tab_container').length ? this.subContainer.children('.tab_container') : this.subContainer.children('.ts_container');

							this.detectManyTabs(this.nav);

							this.startState();

							var self = this;

							$(window).shopme_after_resize(function () {
								self.responsive.bind(self)();
							}, 300);

							this.nav.on('click', 'a:not(.all)', { tabs : this }, this.openSubContainer);

						},

						detectManyTabs: function (collection) {

							if (collection.hasClass('tabs_nav') && collection.children('li').length >= 5 && $container.hasClass('type_2')){

								$container.addClass('many_tabs');

							}

						},

						startState: function () {

							var i = this.nav.children('.active').index();

							if(i < 0){
								i = 0;
								this.nav.children().eq(i).addClass('active');
							}

							var active = this.tab.eq(i);

							active.siblings().addClass('invisible');

							this.showTab(active);

						},

						openSubContainer : function (e) {
							e.preventDefault();

							var tabs = e.data.tabs,
								tab = $($(this).attr('href'));

							$(this).parent().addClass('active').siblings().removeClass('active');

							tabs.showTab(tab);
						},

						showTab : function (element) {
							var height = element.outerHeight();

							element.removeClass('invisible').siblings().addClass('invisible');
							this.subContainer.css('height', height);
						},

						responsive : function () {
							var height = this.tab.not('.invisible').outerHeight();
							this.subContainer.css('height', height);
						}

					}

				tabs.init();

			});

		},

		/**
		 **	Call function after window resize and delay
		 **	@param fn - function that will be called
		 **	@param delay - Delay, after which function will be called
		 **	@param namespace - namespace for event
		 **/
		shopme_after_resize : function(fn, delay, namespace) {

			var ns = namespace || "";

			return this.each(function () {
				$(this).on('resize' + ns, function () {
					setTimeout(function () { fn(); }, delay);
				});
			});

		}

	});

})(jQuery);

/*	Popup
 /* --------------------------------------------- */

(function ($) {

	$.shopme_popup_prepare = function (el, options) {
		this.el = el;
		this.options = $.extend({}, $.shopme_popup_prepare.DEFAULTS, options);
		this.init();
	}

	$.shopme_popup_prepare.DEFAULTS = {
		actionpopup : '',
		noncepopup: '',
		on_load : function () { }
	}

	$.shopme_popup_prepare.openInstance = [];

	$.shopme_popup_prepare.prototype = {
		init: function () {
			$.shopme_popup_prepare.openInstance.unshift(this);
			var base = this;
			base.scope = false;
			base.doc = $(document);
			base.body = $('body');
			base.instance	= $.shopme_popup_prepare.openInstance.length;
			base.namespace	= '.popup_modal_' + base.instance;

			var animEndEventNames = {
				'WebkitAnimation' : 'webkitAnimationEnd',
				'OAnimation' : 'oAnimationEnd',
				'msAnimation' : 'MSAnimationEnd',
				'animation' : 'animationend'
			};
			base.animEndEventName = animEndEventNames[ Modernizr.prefixed('animation') ];

			base.support = {
				animations: Modernizr.cssanimations,
				touch : Modernizr.touch,
				csstransitions : Modernizr.csstransitions
			};
			base.eventtype = base.support.touch ? 'touchstart' : 'click';
			base.ajaxLoad();
		},
		ajaxLoad: function () {
			this.body.on('click', this.el, $.proxy(function (e) {
				if (!this.scope) {
					this.loadPopup(e);
				}
				this.scope = true;
			}, this));
		},
		loadPopup: function (e) {
			e.preventDefault();

			var base = this,
				el = $(e.target),
				data = el.data();
			data.action = base.options.actionpopup;
			data._wpnonce = base.options.noncepopup;

			if ( data.action == undefined ) return;

			$.ajax({
				type: 'post',
				url: woocommerce_mod.ajaxurl.toString().replace( '%%endpoint%%', data.action ),
				data: data,
				beforeSend: function() {

					if( typeof $.fn.block != 'undefined' ) {
						el.block({
							message: null,
							overlayCSS: {
								background: '#fff url(' + shopme_global.ajax_loader_url + ') no-repeat center',
								backgroundSize: '16px 16px',
								opacity: 0.6
							}
						});
					}

				},
				success: function (response) {

					if( typeof $.fn.block != 'undefined' ) {
						el.unblock();
					}

					if ( response.match('exit') ) {
						response = response.replace('exit', '');
						base.modal	= $('<div class="popup-modal modal-show"></div>');
						base.overlay = $('<div class="popup-modal-overlay"></div>');
						base.body.append(base.modal).append(base.overlay);
						base.modal.append(response);
						base.container = $(response).eq(0);
						base.onLoadCallback();
						base.behavior();
					}
				}
			});

		},
		closeModal: function () {
			var base = this;
			base.modal.removeClass('modal-show');

			setTimeout( function() {
				base.modal.addClass('modal-hide');
			}, 25);

			var onEndAnimationFn = function () {
				base.modal.add(base.overlay).remove();
				base.doc.off('keydown' + base.namespace);
			};

			if (base.support.animations) {
				base.modal.on( base.animEndEventName, onEndAnimationFn );
			} else {
				onEndAnimationFn();
			}
			base.scope = false;
			$.shopme_popup_prepare.openInstance.shift();

		},
		behavior: function () {
			var base = this;

			$('.close', base.modal).add(base.overlay).on(base.eventtype, function (e) {
				e.preventDefault();
				base.closeModal();
			});

			base.doc.on('keydown ' + base.namespace, function (e) {
				var keycode = e.keyCode;
				switch (keycode) {
					case 27:
						setTimeout(function () {
							base.closeModal();
						}, 25);
						e.stopImmediatePropagation();
						break;
				}
			});
		},
		onLoadCallback: function () {
			var callback = this.options.on_load;
			if (typeof callback == 'function') {
				callback.call(this);
			}
		}
	}

})(jQuery);

/*	Lightbox
/* --------------------------------------------- */

(function ($) {

	$.fn.shopme_lightbox = function (options) {

		var defaults = {
				groups			:	['.entry', '.page_wrapper', '.lightbox_list'],
				linkElements	:   'a.image-link, a.fancybox_item, a.mfp-iframe, a[rel^="lightbox"], a[rel^="prettyPhoto"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href*=".jpg?"], a[href*=".png?"], a[href*=".jpeg?"]',
				videoElements	: 	'a[href$=".mov"], a[href*="maps.google.com"], a[href*="vimeo.com"] , a[href*="youtube.com/watch"] , a[href*="screenr.com"], a[href*="iframe=true"]',
				exclude			:	'.middle_btn, .icon_btn, .theme_button, .button_grey, .button_blue, .def_icon_btn, .button_black, .button_dark_grey, .wishlist_button, .compare_button, [class*="share-"]'
			},
			o = $.extend({}, defaults, options),
			args = {
				type: 				'image',
				mainClass: 			'mfp-fade-in',
				removalDelay: 		 300,
				closeBtnInside: 	 true,
				closeOnContentClick: true,
				midClick: 			 true,
				fixedContentPos: 	 false,
				gallery: {
					tCounter:	'%curr% / %total%',
					enabled:	true,
					preload:	[1,1]
				},
				callbacks: {
					open: function () {
						var self = this;

						$.magnificPopup.instance.next = function () {
							self.wrap.removeClass('mfp-image-loaded');
							setTimeout(function () { $.magnificPopup.proto.next.call(self); }, 120);
						}
						$.magnificPopup.instance.prev = function () {
							self.wrap.removeClass('mfp-image-loaded');
							setTimeout(function () { $.magnificPopup.proto.prev.call(self); }, 120);
						}
					},
					imageLoadComplete: function () {
						var self = this;
						setTimeout(function () { self.wrap.addClass('mfp-image-loaded'); }, 16);
					}
				}
			};

		return this.each(function () {
			for (var i = 0; i < o.groups.length; i++) {
				$(o.groups[i]).each(function () {
					$(o.videoElements, this).addClass('mfp-iframe');

					var elements = $(o.linkElements, this);
					elements.not(o.exclude).addClass('lightbox-added').magnificPopup(args);
				});
			}
		});
	}

})(jQuery);

/*	Hover Effect
/* --------------------------------------------- */

(function ($) {

	$.shopme_hover_effect = function (container) {

		var overlay = "";

		if (container.is('body')) {
			var elements = $('.page_wrapper a img')
				.not('.advertise-image, .vc_single_image-img, .size-large, [aria-describedby], .wp-post-image, .dokan-store-img')
				.parents('a')
				.not('.woobanner, .banner-button, .elzoom, .products a, .fancybox_item, .product_thumb, table a, .helper_list_icon');
		} else {
			var elements = $('a img', container)
				.not('.advertise-image, .vc_single_image-img, .size-large, [aria-describedby], .wp-post-image, .dokan-store-img')
				.parents('a')
				.not('.woobanner, .banner-button, .elzoom, .products a, .fancybox_item, .product_thumb, table a, .helper_list_icon');
		}

		elements.each(function () {

			var link = $(this),
				current = link.find('img:first'),
				url		 	= link.attr('href'),
				spanClass	= "",
				overlay 	= link.find('.curtain-overlay');

			if (url) {
				if ( url.match(/(jpg|gif|jpeg|png|tif)/) ) spanClass = "overlay-type-image";
				if (!url.match(/(jpg|gif|jpeg|png|\.tif|\.mov|\.swf|vimeo\.com|youtube\.com)/) ) spanClass = "overlay-type-link";
			}

			if (!overlay.length) {
				overlay = $("<div class='curtain-overlay " + spanClass + "'><div class='box-curtain'><div class='in-front'></div><div class='in-back'></div></div></div>").appendTo(link);
			}

			if (current.hasClass('alignnone')) link.addClass('alignnone');
			if (current.hasClass('alignleft')) link.addClass('alignleft');
			if (current.hasClass('alignright')) link.addClass('alignright');
			if (current.hasClass('aligncenter')) link.wrap('<span class="aligncenter" />').addClass('aligncenter');

		});

	}

})(jQuery);

/*	FitVids
 /* --------------------------------------------- */

(function ($) {

	$.fn.fitVids = function(options) {

		var settings = {
			customSelector: null
		};

		if (!document.getElementById('fit-vids-style')) {

			var div = document.createElement('div'),
				ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
				cssStyles = '&shy;<style>.fluid-video-wrapper{width:100%;position:relative;padding:0;}.fluid-video-wrapper iframe,.fluid-video-wrapper object,.fluid-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

			div.className = 'fit-vids-style';
			div.id = 'fit-vids-style';
			div.style.display = 'none';
			div.innerHTML = cssStyles;

			ref.parentNode.insertBefore(div,ref);

		}

		if (options) {
			$.extend(settings, options);
		}

		return this.each(function () {
			var selectors = [
				"iframe[src*='player.vimeo.com']",
				"iframe[src*='youtube.com']",
				"iframe[src*='youtube-nocookie.com']",
				"iframe[src*='kickstarter.com'][src*='video.html']",
				"iframe[src*='w.soundcloud.com']",
				"object",
				"embed"
			];

			if (settings.customSelector) {
				selectors.push(settings.customSelector);
			}

			var $allVideos = $(this).find(selectors.join(',')).not("iframe[src^='http:/\/\']");
			$allVideos = $allVideos.not("object object"); // SwfObj conflict patch

			$allVideos.each(function(){
				var $this = $(this);
				if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-video-wrapper').length) {
					return;
				}
				var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
					width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
					aspectRatio = height / width;

				if(!$this.attr('id')) {
					var videoID = 'fitvid' + Math.floor(Math.random()*999999);
					$this.attr('id', videoID);
				}
				$this.wrap('<div class="fluid-video-wrapper"></div>').parent('.fluid-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
				$this.removeAttr('height').removeAttr('width');
			});
		});

	};

})(jQuery);


/*
 Plugin Name: 	BrowserSelector
 Written by: 	Crivos - (http://www.crivos.com)
 Version: 		0.1
 */

(function($, navigator) {
	$.extend({

		browserSelector: function() {

			var u = navigator.userAgent,
				ua = u.toLowerCase(),
				is = function (t) {
					return ua.indexOf(t) > -1;
				},
				g = 'gecko',
				w = 'webkit',
				s = 'safari',
				o = 'opera',
				h = document.documentElement,
				b = [(!(/opera|webtv/i.test(ua)) && /msie\s(\d)/.test(ua)) ? ('ie ie' + parseFloat(navigator.appVersion.split("MSIE")[1])) : is('firefox/2') ? g + ' ff2' : is('firefox/3.5') ? g + ' ff3 ff3_5' : is('firefox/3') ? g + ' ff3' : is('gecko/') ? g : is('opera') ? o + (/version\/(\d+)/.test(ua) ? ' ' + o + RegExp.jQuery1 : (/opera(\s|\/)(\d+)/.test(ua) ? ' ' + o + RegExp.jQuery2 : '')) : is('konqueror') ? 'konqueror' : is('chrome') ? w + ' chrome' : is('iron') ? w + ' iron' : is('applewebkit/') ? w + ' ' + s + (/version\/(\d+)/.test(ua) ? ' ' + s + RegExp.jQuery1 : '') : is('mozilla/') ? g : '', is('j2me') ? 'mobile' : is('iphone') ? 'iphone' : is('ipod') ? 'ipod' : is('mac') ? 'mac' : is('darwin') ? 'mac' : is('webtv') ? 'webtv' : is('win') ? 'win' : is('freebsd') ? 'freebsd' : (is('x11') || is('linux')) ? 'linux' : '', 'js'];

			c = b.join(' ');
			h.className += ' ' + c;

		}

	});
})(jQuery, navigator);

/*
 Plugin Name: 	smoothScroll for jQuery.
 Written by: 	Crivos - (http://www.crivos.com)
 Version: 		0.1

 Based on:

 SmoothScroll v1.2.1
 Licensed under the terms of the MIT license.

 People involved
 - Balazs Galambosi (maintainer)
 - Patrick Brunner  (original idea)
 - Michael Herf     (Pulse Algorithm)

 */
(function($) {
	$.extend({

		smoothScroll: function() {

			// Scroll Variables (tweakable)
			var defaultOptions = {

				// Scrolling Core
				frameRate        : 150, // [Hz]
				animationTime    : 700, // [px]
				stepSize         : 80, // [px]

				// Pulse (less tweakable)
				// ratio of "tail" to "acceleration"
				pulseAlgorithm   : true,
				pulseScale       : 8,
				pulseNormalize   : 1,

				// Acceleration
				accelerationDelta : 20,  // 20
				accelerationMax   : 1,   // 1

				// Keyboard Settings
				keyboardSupport   : true,  // option
				arrowScroll       : 50,     // [px]

				// Other
				touchpadSupport   : true,
				fixedBackground   : true,
				excluded          : ""
			};

			var options = defaultOptions;

			// Other Variables
			var isExcluded = false;
			var isFrame = false;
			var direction = { x: 0, y: 0 };
			var initDone  = false;
			var root = document.documentElement;
			var activeElement;
			var observer;
			var deltaBuffer = [ 120, 120, 120 ];

			var key = { left: 37, up: 38, right: 39, down: 40, spacebar: 32,
				pageup: 33, pagedown: 34, end: 35, home: 36 };


			/***********************************************
			 * INITIALIZE
			 ***********************************************/

			/**
			 * Tests if smooth scrolling is allowed. Shuts down everything if not.
			 */
			function initTest() {

				var disableKeyboard = false;

				// disable keys for google reader (spacebar conflict)
				if (document.URL.indexOf("google.com/reader/view") > -1) {
					disableKeyboard = true;
				}

				// disable everything if the page is blacklisted
				if (options.excluded) {
					var domains = options.excluded.split(/[,\n] ?/);
					domains.push("mail.google.com"); // exclude Gmail for now
					for (var i = domains.length; i--;) {
						if (document.URL.indexOf(domains[i]) > -1) {
							observer && observer.disconnect();
							removeEvent("mousewheel", wheel);
							disableKeyboard = true;
							isExcluded = true;
							break;
						}
					}
				}

				// disable keyboard support if anything above requested it
				if (disableKeyboard) {
					removeEvent("keydown", keydown);
				}

				if (options.keyboardSupport && !disableKeyboard) {
					addEvent("keydown", keydown);
				}
			}

			/**
			 * Sets up scrolls array, determines if frames are involved.
			 */
			function init() {

				if (!document.body) return;

				var body = document.body;
				var html = document.documentElement;
				var windowHeight = window.innerHeight;
				var scrollHeight = body.scrollHeight;

				// check compat mode for root element
				root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
				activeElement = body;

				initTest();
				initDone = true;

				// Checks if this script is running in a frame
				if (top != self) {
					isFrame = true;
				}

				/**
				 * This fixes a bug where the areas left and right to
				 * the content does not trigger the onmousewheel event
				 * on some pages. e.g.: html, body { height: 100% }
				 */
				else if (scrollHeight > windowHeight &&
					(body.offsetHeight <= windowHeight ||
					html.offsetHeight <= windowHeight)) {

					// DOMChange (throttle): fix height
					var pending = false;
					var refresh = function () {
						if (!pending && html.scrollHeight != document.height) {
							pending = true; // add a new pending action
							setTimeout(function () {
								html.style.height = document.height + 'px';
								pending = false;
							}, 500); // act rarely to stay fast
						}
					};
					html.style.height = 'auto';
					setTimeout(refresh, 10);

					var config = {
						attributes: true,
						childList: true,
						characterData: false
					};

					observer = new MutationObserver(refresh);
					observer.observe(body, config);

					// clearfix
					if (root.offsetHeight <= windowHeight) {
						var underlay = document.createElement("div");
						underlay.style.clear = "both";
						body.appendChild(underlay);
					}
				}

				// gmail performance fix
				if (document.URL.indexOf("mail.google.com") > -1) {
					var s = document.createElement("style");
					s.innerHTML = ".iu { visibility: hidden }";
					(document.getElementsByTagName("head")[0] || html).appendChild(s);
				}
				// facebook better home timeline performance
				// all the HTML resized images make rendering CPU intensive
				else if (document.URL.indexOf("www.facebook.com") > -1) {
					var home_stream = document.getElementById("home_stream");
					home_stream && (home_stream.style.webkitTransform = "translateZ(0)");
				}
				// disable fixed background
				if (!options.fixedBackground && !isExcluded) {
					body.style.backgroundAttachment = "scroll";
					html.style.backgroundAttachment = "scroll";
				}
			}


			/************************************************
			 * SCROLLING
			 ************************************************/

			var que = [];
			var pending = false;
			var lastScroll = +new Date;

			/**
			 * Pushes scroll actions to the scrolling queue.
			 */
			function scrollArray(elem, left, top, delay) {

				delay || (delay = 1000);
				directionCheck(left, top);

				if (options.accelerationMax != 1) {
					var now = +new Date;
					var elapsed = now - lastScroll;
					if (elapsed < options.accelerationDelta) {
						var factor = (1 + (30 / elapsed)) / 2;
						if (factor > 1) {
							factor = Math.min(factor, options.accelerationMax);
							left *= factor;
							top  *= factor;
						}
					}
					lastScroll = +new Date;
				}

				// push a scroll command
				que.push({
					x: left,
					y: top,
					lastX: (left < 0) ? 0.99 : -0.99,
					lastY: (top  < 0) ? 0.99 : -0.99,
					start: +new Date
				});

				// don't act if there's a pending queue
				if (pending) {
					return;
				}

				var scrollWindow = (elem === document.body);

				var step = function (time) {

					var now = +new Date;
					var scrollX = 0;
					var scrollY = 0;

					for (var i = 0; i < que.length; i++) {

						var item = que[i];
						var elapsed  = now - item.start;
						var finished = (elapsed >= options.animationTime);

						// scroll position: [0, 1]
						var position = (finished) ? 1 : elapsed / options.animationTime;

						// easing [optional]
						if (options.pulseAlgorithm) {
							position = pulse(position);
						}

						// only need the difference
						var x = (item.x * position - item.lastX) >> 0;
						var y = (item.y * position - item.lastY) >> 0;

						// add this to the total scrolling
						scrollX += x;
						scrollY += y;

						// update last values
						item.lastX += x;
						item.lastY += y;

						// delete and step back if it's over
						if (finished) {
							que.splice(i, 1); i--;
						}
					}

					// scroll left and top
					if (scrollWindow) {
						window.scrollBy(scrollX, scrollY);
					}
					else {
						if (scrollX) elem.scrollLeft += scrollX;
						if (scrollY) elem.scrollTop  += scrollY;
					}

					// clean up if there's nothing left to do
					if (!left && !top) {
						que = [];
					}

					if (que.length) {
						requestFrame(step, elem, (delay / options.frameRate + 1));
					} else {
						pending = false;
					}
				};

				// start a new queue of actions
				requestFrame(step, elem, 0);
				pending = true;
			}

			/***********************************************
			 * EVENTS
			 ***********************************************/

			/**
			 * Mouse wheel handler.
			 * @param {Object} event
			 */
			function wheel(event) {

				if (!initDone) {
					init();
				}

				var target = event.target;
				var overflowing = overflowingAncestor(target);

				// use default if there's no overflowing
				// element or default action is prevented
				if (!overflowing || event.defaultPrevented ||
					isNodeName(activeElement, "embed") ||
					(isNodeName(target, "embed") && /\.pdf/i.test(target.src))) {
					return true;
				}

				var deltaX = event.wheelDeltaX || 0;
				var deltaY = event.wheelDeltaY || 0;

				// use wheelDelta if deltaX/Y is not available
				if (!deltaX && !deltaY) {
					deltaY = event.wheelDelta || 0;
				}

				// check if it's a touchpad scroll that should be ignored
				if (!options.touchpadSupport && isTouchpad(deltaY)) {
					return true;
				}

				// scale by step size
				// delta is 120 most of the time
				// synaptics seems to send 1 sometimes
				if (Math.abs(deltaX) > 1.2) {
					deltaX *= options.stepSize / 120;
				}
				if (Math.abs(deltaY) > 1.2) {
					deltaY *= options.stepSize / 120;
				}

				scrollArray(overflowing, -deltaX, -deltaY);
				event.preventDefault();
			}

			/**
			 * Keydown event handler.
			 * @param {Object} event
			 */
			function keydown(event) {

				var target   = event.target;
				var modifier = event.ctrlKey || event.altKey || event.metaKey ||
					(event.shiftKey && event.keyCode !== key.spacebar);

				// do nothing if user is editing text
				// or using a modifier key (except shift)
				// or in a dropdown
				if ( /input|textarea|select|embed/i.test(target.nodeName) ||
					target.isContentEditable ||
					event.defaultPrevented   ||
					modifier ) {
					return true;
				}
				// spacebar should trigger button press
				if (isNodeName(target, "button") &&
					event.keyCode === key.spacebar) {
					return true;
				}

				var shift, x = 0, y = 0;
				var elem = overflowingAncestor(activeElement);
				var clientHeight = elem.clientHeight;

				if (elem == document.body) {
					clientHeight = window.innerHeight;
				}

				switch (event.keyCode) {
					case key.up:
						y = -options.arrowScroll;
						break;
					case key.down:
						y = options.arrowScroll;
						break;
					case key.spacebar: // (+ shift)
						shift = event.shiftKey ? 1 : -1;
						y = -shift * clientHeight * 0.9;
						break;
					case key.pageup:
						y = -clientHeight * 0.9;
						break;
					case key.pagedown:
						y = clientHeight * 0.9;
						break;
					case key.home:
						y = -elem.scrollTop;
						break;
					case key.end:
						var damt = elem.scrollHeight - elem.scrollTop - clientHeight;
						y = (damt > 0) ? damt+10 : 0;
						break;
					case key.left:
						x = -options.arrowScroll;
						break;
					case key.right:
						x = options.arrowScroll;
						break;
					default:
						return true; // a key we don't care about
				}

				scrollArray(elem, x, y);
				event.preventDefault();
			}

			/**
			 * Mousedown event only for updating activeElement
			 */
			function mousedown(event) {
				activeElement = event.target;
			}


			/***********************************************
			 * OVERFLOW
			 ***********************************************/

			var cache = {}; // cleared out every once in while
			setInterval(function () { cache = {}; }, 10 * 1000);

			var uniqueID = (function () {
				var i = 0;
				return function (el) {
					return el.uniqueID || (el.uniqueID = i++);
				};
			})();

			function setCache(elems, overflowing) {
				for (var i = elems.length; i--;)
					cache[uniqueID(elems[i])] = overflowing;
				return overflowing;
			}

			function overflowingAncestor(el) {
				var elems = [];
				var rootScrollHeight = root.scrollHeight;
				do {
					var cached = cache[uniqueID(el)];
					if (cached) {
						return setCache(elems, cached);
					}
					elems.push(el);
					if (rootScrollHeight === el.scrollHeight) {
						if (!isFrame || root.clientHeight + 10 < rootScrollHeight) {
							return setCache(elems, document.body); // scrolling root in WebKit
						}
					} else if (el.clientHeight + 10 < el.scrollHeight) {
						overflow = getComputedStyle(el, "").getPropertyValue("overflow-y");
						if (overflow === "scroll" || overflow === "auto") {
							return setCache(elems, el);
						}
					}
				} while (el = el.parentNode);
			}


			/***********************************************
			 * HELPERS
			 ***********************************************/

			function addEvent(type, fn, bubble) {
				window.addEventListener(type, fn, (bubble||false));
			}

			function removeEvent(type, fn, bubble) {
				window.removeEventListener(type, fn, (bubble||false));
			}

			function isNodeName(el, tag) {
				return (el.nodeName||"").toLowerCase() === tag.toLowerCase();
			}

			function directionCheck(x, y) {
				x = (x > 0) ? 1 : -1;
				y = (y > 0) ? 1 : -1;
				if (direction.x !== x || direction.y !== y) {
					direction.x = x;
					direction.y = y;
					que = [];
					lastScroll = 0;
				}
			}

			var deltaBufferTimer;

			function isTouchpad(deltaY) {
				if (!deltaY) return;
				deltaY = Math.abs(deltaY)
				deltaBuffer.push(deltaY);
				deltaBuffer.shift();
				clearTimeout(deltaBufferTimer);
				var allEquals    = (deltaBuffer[0] == deltaBuffer[1] &&
				deltaBuffer[1] == deltaBuffer[2]);
				var allDivisable = (isDivisible(deltaBuffer[0], 120) &&
				isDivisible(deltaBuffer[1], 120) &&
				isDivisible(deltaBuffer[2], 120));
				return !(allEquals || allDivisable);
			}

			function isDivisible(n, divisor) {
				return (Math.floor(n / divisor) == n / divisor);
			}

			var requestFrame = (function () {
				return  window.requestAnimationFrame       ||
					window.webkitRequestAnimationFrame ||
					function (callback, element, delay) {
						window.setTimeout(callback, delay || (1000/60));
					};
			})();

			var MutationObserver = window.MutationObserver || window.WebKitMutationObserver;


			/***********************************************
			 * PULSE
			 ***********************************************/

			/**
			 * Viscous fluid with a pulse for part and decay for the rest.
			 * - Applies a fixed force over an interval (a damped acceleration), and
			 * - Lets the exponential bleed away the velocity over a longer interval
			 * - Michael Herf, http://stereopsis.com/stopping/
			 */
			function pulse_(x) {
				var val, start, expx;
				// test
				x = x * options.pulseScale;
				if (x < 1) { // acceleartion
					val = x - (1 - Math.exp(-x));
				} else {     // tail
					// the previous animation ended here:
					start = Math.exp(-1);
					// simple viscous drag
					x -= 1;
					expx = 1 - Math.exp(-x);
					val = start + (expx * (1 - start));
				}
				return val * options.pulseNormalize;
			}

			function pulse(x) {
				if (x >= 1) return 1;
				if (x <= 0) return 0;

				if (options.pulseNormalize == 1) {
					options.pulseNormalize /= pulse_(1);
				}
				return pulse_(x);
			}

			addEvent("mousedown", mousedown);
			addEvent("mousewheel", wheel);
			addEvent("load", init);

		}

	});
})(jQuery);

	/*	HELPERS
	/* --------------------------------------------- */

	(function ($) {

		$.shopme_core_helpers = $.shopme_core_helpers || {};

		$.shopme_core_helpers = {
			sameheight : function (obj) {
				var $this = $(this), max = 0,
					$item = $this.find('.owl-item').children();

				$item.css('height','auto').each(function () {
					max = Math.max( max, $(this).outerHeight() );
				}).promise().done(function () {
					$(this).css('height', max);
				});
			},
			owlGetVisibleElements : function () {
				var $this = $(this);

				$this.find('.owl-item').removeClass('first last');
				$this.find('.owl-item.active').first().addClass('first');
				$this.find('.owl-item.active').last().addClass('last');
			}
		}

	})(jQuery);

	/*	CORE
	/* --------------------------------------------- */

	(function ($, navigator) {

		$.shopme_core = $.shopme_core || {};

		$.shopme_core.defaults = {
			sticky: true,
			animated: true
		}

		$.shopme_core = {
			run: function (options) {
				var base = this;
					base.el = $('body');
					base.init(options);
			},
			setUp: function (options) {
				var base = this;

				var animEndEventNames = {
					'WebkitAnimation' : 'webkitAnimationEnd',
					'OAnimation' : 'oAnimationEnd',
					'msAnimation' : 'MSAnimationEnd',
					'animation' : 'animationend'
				},
				transEndEventNames = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'OTransition': 'oTransitionEnd',
					'msTransition': 'MSTransitionEnd',
					'transition': 'transitionend'
				}

				base.$window = $(window);
				base.ANIMATIONEND = animEndEventNames[ Modernizr.prefixed('animation') ];
				base.TRANSITIONEND = transEndEventNames[ Modernizr.prefixed('transition') ];
				base.SUPPORT = {
					animations : Modernizr.csstransitions && Modernizr.cssanimations,
					ANIMATIONSUPPORTED: Modernizr.cssanimations,
					TRANSITIONSUPPORTED: Modernizr.csstransitions,
					ISTOUCH: Modernizr.touch
				};
				base.XHRLEVEL2 = !!window.FormData;

				base.o = $.extend({}, $.shopme_core.defaults, options);
				base.event = base.SUPPORT.ISTOUCH ? 'touchstart' : 'click';

				/*  Refresh elements */
				base.refresh();
			},
			init: function(options) {

				var base = this;

				if (base.el.hasClass('mad__queryloader')) {
					base.queryLoader();
				}

				base.beforeLoaded();
				base.setUp(options);

				if (parseInt(shopme_global.smoothScroll, 10)) {
					if (!base.SUPPORT.ISTOUCH) {
						base.smoothScroll();
					}
				}

				if (base.SUPPORT.animations) {
					if (base.el.hasClass('animated-content') && !base.SUPPORT.ISTOUCH) {
						base.animatedContent();
					} else {
						base.el.removeClass('animated-content');
					}
				}

				base.generateBackToTopButton();
				base.searchChosen();

				base.events.backToTop(this, 500);
				base.events.socialFeeds(base);
				base.events.tableLayoutType.call(this);

				base.responsiveTopBar.init(this);
				base.navInit.init(this);

				if (base.o.sticky) {
					base.stickyMenu.initVars(this);
				}

			},
			beforeLoaded: function () {
				var base = this;

				base.el.shopme_lightbox();

				$.shopme_hover_effect(base.el);

				$('.page_wrapper').fitVids();
			},
			queryLoader: function () {

				var base = this;

				base.el.queryLoader2({
					barHeight : 4,
					backgroundColor : '#fff',
					barColor : '#018bc8',
					minimumTime : 2000,
					onComplete : function () {
						base.loader.fadeOut(100);
					}
				});

			},
			smoothScroll: function () {
				$.browserSelector();
				var $html = $('html');
				if ($html.hasClass('chrome')) {
					$.smoothScroll();
				}
			},
			elements: {
				'.mad__loader' : 'loader',
				'.main_navigation, .full_width_nav, .topbar:not(.no-mobile-advanced)': 'navMain',
				'#mobile-advanced': 'navMobile',
				'#header.type_1 .topbar': 'navTopbar',
				'body.logged-in.admin-bar' : 'logged',
				'#theme-wrapper': 'wrapper',
				'#header' : 'header',
				'#main_navigation_wrap, .sticky_part' : 'navigation'
			},
			$: function (selector) {
				return $(selector);
			},
			refresh: function() {
				for (var key in this.elements) {
					this[this.elements[key]] = this.$(key);
				}
			},
			generateBackToTopButton : function () {
				$('<button></button>', {
					id : "back_to_top",
					class : "back_to_top animated transparent"
				}).appendTo($('body'));
			},
			searchChosen: function () {
				if ($('.search_category').length) {
					$('.search_category select').chosen({
						disable_search_threshold: 10, placeholder_text: shopme_global.placeholder_text }
					);
				}
			},

			animatedContent : function () {

				var base = this,
					data_animation = $('.animated-content .animate-widgets [data-animation], .animated-content .content-holder  [data-animation]');

				if (data_animation.length) {

					data_animation.each(function () {

						var $this = $(this);

						if (!base.SUPPORT.ISTOUCH) {
							$this.appear(function () {

								var delay = ($this.attr("data-animation-delay") ? $this.attr("data-animation-delay") : 1);

								if (delay > 1) $this.css("animation-delay", delay + "ms");
									$this.removeClass('transparent').addClass("visible " + $this.attr("data-animation"));

							}, { accX: 0, accY: -250 });
						} else {
							$this.removeClass("transparent").addClass("visible");
						}

					});

				}

			},

			events: {

				backToTop : function (base, offset) {

					var w = $(window),
						b = $('#back_to_top');

					w.on("scroll", function () {

						if(w.scrollTop() > offset && !b.hasClass('visible')){
							b.removeClass('transparent').addClass('bounceInLeft visible');
						}
						else if(w.scrollTop() <= offset && b.hasClass('visible')){
							b.removeClass('bounceInLeft').addClass('bounceOutLeft');
						}

					});

					b.on('click', function () {

						$('html, body').animate({
							scrollTop : 0
						}, 400, 'swing');

					}).on(base.ANIMATIONEND, function () {

						if (b.hasClass('bounceOutLeft')) {
							b.removeClass('visible bounceOutLeft').addClass('transparent');
						}

					});

				},

				socialFeeds : function (base) {
					$('.social_feeds').on('click', '[class*="open_"]', function() {
						$(this).parents('li').siblings().children('.active').removeClass(base.SUPPORT.TRANSITIONSUPPORTED ? 'active' : 'active visible');
					});
				},

				tableLayoutType : function () {

					var base = this;

					$('.layout_type').on(base.event, '[data-table-layout]', function (e) {
						e.preventDefault();

						var $this = $(this),
							container = $this.parents('.post-area').children('.list_of_entries');
							container.removeClass('grid_view list_view').addClass($this.data('table-layout'));
							$this.addClass('active').siblings().removeClass('active');
					});

				}

			},

			responsiveTopBar : {

				/**
				 **	initialize events for the responsive version of mega menu in the side menu
				 **/
				init : function(base){

					this.container = base.navTopbar;

					if ( !this.container.length ) return;

					this.menu = this.container.find('.sub-menu');

					this.createResponsiveButton(this.container);

					this.checkViewPort();

					$(window).shopme_after_resize(this.checkViewPort.bind(this),300);

				},

				/**
				 ** activated the desired handler relative to window size
				 **/
				checkViewPort : function(){

					var wW = $(window).width();

					if( wW <= 992 ) {
						this.activateMobile();
					} else {
						this.deactivateResponsive();
					}

				},

				/**
				 **	Reset tablet handler and add mobile handler
				 **/
				activateMobile : function(){

					this.deactivateResponsive();

					this.menu.add(this.container).hide();

					this.menu.parent().off('click.tablet').on('click.mobile', this.mobileHandler);

				},
				deactivateResponsive : function(){

					$('.tb_toggle_menu').removeClass('active');

					this.container.add(this.menu).show();

					this.menu.parent().removeClass('tablet_active mobile_active');

					this.container.find('.prevented').removeClass('prevented');

					this.menu.parent().off('click.mobile click.tablet');

				},
				mobileHandler : function(event){

					var link = $(this).children('a'),
						menu = $(this).children('.sub-menu');

					if (!link.hasClass('prevented') && menu.length) {

						link.addClass('prevented');

						menu.stop().slideDown();

						$(this).addClass('mobile_active')
							.siblings()
							.removeClass('mobile_active')
							.children('a')
							.removeClass('prevented').next().stop().slideUp();

						event.preventDefault();

					}

				},
				createResponsiveButton : function(container){

					var el = $('<button></button>',{
						class: 'tb_toggle_menu'
					}).insertBefore(container);

					el.on('click.responsiveButton', function(){
						$(this).toggleClass('active').next().slideToggle();
					});

				}

			},

			navInit : {

				init : function (base) {
					this.createResponsiveButtons.call(base);
					this.navProcess(base);

					if ( base.SUPPORT.ISTOUCH ) {
						this.touchNavMobileNavigation(base);
						this.touchNavHeaderNavigation(base);
					}
				},

				touchNavMobileNavigation: function (base) {
					var self = this;

					base.navMobile
						.on(base.event, 'a', function (e) {
							var $this = $(this).parent('li'),
								$submenu = $this.children('ul.sub-menu, ul.submenu');

							if ( $this.hasClass('li.menu-item-has-children, li.page_item_has_children') ) return;

							if ( $submenu.length ) {
								e.preventDefault();

								$submenu.slideToggle(function () {
									self.applyHeight.call(base);
									$this.toggleClass('open-menu');
								});
							}

						});
				},

				touchNavHeaderNavigation: function (base) {
					var clicked = false;

					$("#header li.menu-item-has-children > a, li.cat-parent > a, #header li.page_item_has_children > a").on(base.event, function (e) {
						if ( clicked != this ) {
							e.preventDefault();
							clicked = this;
						}
					});

					base.navMobile.find('a').off(base.event);

				},

				navProcess: function (base) {

					base.navInit.touchNav(base, base.$window);

					$(window).resize(function (e) {
						setTimeout(function () {
							base.navInit.touchNav(base, e.currentTarget);
						}, 30);
					});

				},

				applyHeight: function () {

					var base = this;
					var window_h = $(window).height();
					var height;

					if ( base.navMobile.children('#mega_main_menu').length ) {
						height = base.navMobile.children('#mega_main_menu').children().outerHeight(true) + 80;
					} else {
						height = base.navMobile.children('ul').outerHeight(true);
					}

					if ( window_h > height ) { height = window_h; }

					base.wrapper.css({
						height: height
					}).addClass('active');

				},

				touchNav: function (base, target) {

					var self = this;

					if ( base.SUPPORT.ISTOUCH || $(target).width() < 993 ) {

						if ( !base.navMobile.children().length ) {
							base.navMobile.append(base.navMain.html());
						}

						base.navButton.on(base.event, function (e) {
							e.preventDefault();

							if ( !base.wrapper.is('.active') ) {
								self.applyHeight.call(base);
							}
						});

						base.navHide.on(base.event, function (e) {
							e.preventDefault();
							if (base.wrapper.is('.active')) {
								$('html, body').animate({ scrollTop: 0 }, 0);
								base.wrapper.css({
									height: 'auto'
								}).removeClass('active');
							}
						});


					} else {
						base.navMobile.children().remove();
					}
				},

				createResponsiveButtons : function () {

					this.navButton = $('<button></button>', {
						id: 'responsive-nav-button',
						'class': 'responsive-nav-button'
					}).insertBefore(this.navMain);

					this.navHide = $('<a></a>', {
						id: 'advanced-menu-hide',
						'href' : '#'
					}).insertBefore(this.navMobile);

				}

			},

			stickyMenu : {

				/**
				 **	Initialize variables
				 **/
				initVars: function (base) {

					this.NAVIGATION = base.navigation;
					this.HEADER = base.header;
					this.logged = base.logged;

					if (!this.NAVIGATION.length) return false;

					this.updatesInfo();

					if (!base.SUPPORT.ISTOUCH) {
						this.needToBeSticky();

						$(window).shopme_after_resize(this.needToBeSticky.bind(this), 300);
					}

				},

				/**
				 **	Initialize sticky menu
				 **/
				initializeSticky: function () {

					this.NAVIGATION.addClass('sticky_initialized');

					this.activateSticky();
					$(window).on('scroll.sticky', this.activateSticky.bind(this));

				},

				/**
				 **	Checks if sticky menu need to initialize
				 **/
				needToBeSticky: function () {

					if ($(window).width() > 991 && this.NAVIGATION.hasClass('sticky_initialized')) {
						this.updatesInfo();
						this.activateSticky();
					} else if($(window).width() > 991 && !this.NAVIGATION.hasClass('sticky_initialized')) {
						this.initializeSticky();
					} else if($(window).width() <= 991) {
						this.destroy();
					}

				},

				/**
				 **	Method that checks scrollbar position and adds/removes
				 **	fixed class on main navigation wrapper element
				 **/
				activateSticky: function () {

					if ($(window).scrollTop() >= this.navTopOffset && !this.NAVIGATION.hasClass('sticky')) {

						this.NAVIGATION.addClass('sticky');
						this.headerSizeCompensation(true);

					} else if($(window).scrollTop() < this.navTopOffset && this.NAVIGATION.hasClass('sticky')) {

						this.NAVIGATION.removeClass('sticky');
						this.headerSizeCompensation(false);

					}

				},

				/**
				 **	Returns main navigation wrapper element to default position
				 **/
				resetStickyPosition: function() {

					this.NAVIGATION.removeClass('sticky');
					this.headerSizeCompensation(false);

				},

				/**
				 **	Updates information about main navigation wrapper element (height, offset)
				 **/
				updatesInfo: function () {

					this.sticky_height = this.NAVIGATION.outerHeight();
					this.adminbar_height = 0;

					this.resetStickyPosition();

					this.navTopOffset = this.NAVIGATION.offset().top;

					if (this.logged.length) {
						this.navTopOffset = this.navTopOffset - 32;
						this.adminbar_height = $('#wpadminbar').outerHeight();
					}

					this.navHeight = this.NAVIGATION.outerHeight();

				},

				/**
				 **	Add padding-bottom to header for compensation sticky menu size
				 **/
				headerSizeCompensation: function(on) {

					if (on) {
						this.HEADER.css('padding-bottom', this.navHeight);
					} else {
						this.HEADER.css('padding-bottom', 0);
					}

				},

				/**
				 **	Destroy sticky menu
				 **/
				destroy : function(){

					this.NAVIGATION.removeClass('sticky_initialized');
					this.resetStickyPosition();
					$(window).off('scroll.sticky');
					this.headerSizeCompensation(false);

				}

			}

		}

	})(jQuery, navigator);

	/*	MAIN ANIMATION
	/* --------------------------------------------- */

	(function ($) {

		$.shopme_dropdown_list = (function () {

			var $dropdown = $('.dropdown-list').not('.visible-dropdown'),
				transEndEventNames = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'OTransition': 'oTransitionEnd',
					'msTransition': 'MSTransitionEnd',
					'transition': 'transitionend'
				},
				transEndEventName = transEndEventNames[ Modernizr.prefixed('transition') ],
				istouch = Modernizr.touch,
				support = Modernizr.csstransitions && !istouch,
				event = istouch ? 'touchstart' : 'click',
				settings = {
					speed : 10
				};

			function init(config) {

				settings = $.extend( {}, settings, config );

				prepareEachDropdown(settings);
				bindEvents();
			}

			function update(dropdown, settings) {

				$(dropdown).each(function (idx, dropdown) {
					initItems(dropdown, settings);
				});

			}

			function prepareEachDropdown(settings) {

				$dropdown.each(function (idx, dropdown) {
					initItems(dropdown, settings);
				});

			}

			function initItems( dropdown, settings ) {

				if (!support) return;

				var $dropdown = $(dropdown),
					$drop = $dropdown.find('.dropdown');

				if ($drop.hasClass("secondary_navigation")) {
					$items = $drop.find('ul').first().children('.menu-item, .page_item');
				} else {
					$items = $dropdown.find('.animated_item');
				}

				$dropdown.data({
					items : $items,
					len : $items.length,
					settings: settings
				});

				defaultState($dropdown, settings.speed);

				$items.eq(0).on(transEndEventName, function (e) {

					if ($dropdown.hasClass("active") || e.originalEvent.propertyName !== "transform") return false;
					defineNewState($dropdown);
					$dropdown.removeClass("visible");

				});

				if ($dropdown.hasClass('active')) {
					defineNewState($dropdown, true);
				}

				$items.eq($dropdown.data("len") - 1).on(transEndEventName, function () {

					if (!$dropdown.hasClass("active")) return false;
					defineNewState($dropdown, true);

				});

			}

			function defaultState(dropdown, speed) {

				dropdown.data('items').each(function (i) {
					$(this).css('transition-delay', (i + 1) / speed + 's');
				});

			}

			function defineNewState(dropdown, reverse) {

				var speed = dropdown.data('settings').speed;

				if (reverse) {

					var len = dropdown.data('len'),
						$items = dropdown.data('items');

					for (var i = len,j = 0; i >= 0, j < len; i--, j++) {
						$items.eq(j).css('transition-delay', i / speed + 's');
					}

				} else {
					defaultState(dropdown, speed);
				}

			}

			function bindEvents() {

				$dropdown.on(event, '[class*="open_"]', function (e) {

					var $target = $(this),
						$delegateTarget = $(e.delegateTarget);

					if (!$delegateTarget.is('.active')) {
						$delegateTarget.trigger('defineNewState', [false]);
						$delegateTarget.add($target).addClass('active').end().addClass('visible');
					} else {
						$delegateTarget.trigger('defineNewState', [true]);
						$delegateTarget.add($target).removeClass('active');
					}

				}).mouseleave(function () {

					var $target = $(this),
						$element = $target.find('[class*="open_"]');

					if ($target.is('.active')) {
						$target.add($element).removeClass('active');
					}

				}).on('defineNewState', function (e, reverse) { });

			}

			return {
				init: init,
				update: update
			}

		})();

	})(jQuery);