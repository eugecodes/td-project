!function(t){var e=function(){var e='<div class="mb_colorpicker"><div class="colpick_color"><div class="colpick_color_overlay1"><div class="colpick_color_overlay2"><div class="colpick_selector_outer"><div class="colpick_selector_inner"></div></div></div></div></div><div class="colpick_hue"><div class="colpick_hue_arrs"><div class="colpick_hue_larr"></div><div class="colpick_hue_rarr"></div></div></div><div class="colpick_new_color"></div><div class="colpick_current_color"></div><div class="colpick_hex_field"><div class="colpick_field_letter">#</div><input type="text" maxlength="6" size="6" /></div><div class="colpick_rgb_r colpick_field"><div class="colpick_field_letter">R</div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"></div><div class="colpick_field_darr"></div></div></div><div class="colpick_rgb_g colpick_field"><div class="colpick_field_letter">G</div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"></div><div class="colpick_field_darr"></div></div></div><div class="colpick_rgb_b colpick_field"><div class="colpick_field_letter">B</div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"></div><div class="colpick_field_darr"></div></div></div><div class="colpick_hsb_h colpick_field"><div class="colpick_field_letter">H</div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"></div><div class="colpick_field_darr"></div></div></div><div class="colpick_hsb_s colpick_field"><div class="colpick_field_letter">S</div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"></div><div class="colpick_field_darr"></div></div></div><div class="colpick_hsb_b colpick_field"><div class="colpick_field_letter">B</div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"></div><div class="colpick_field_darr"></div></div></div><div class="colpick_submit"></div></div>',a={showEvent:"click",onShow:function(){},onBeforeShow:function(){},onHide:function(){},onChange:function(){},onSubmit:function(){},colorScheme:"light",color:"3289c7",livePreview:!0,flat:!1,layout:"full",submit:1,submitText:"OK",height:156},l=function(e,a){var i=c(e);t(a).data("colpick").fields.eq(1).val(i.r).end().eq(2).val(i.g).end().eq(3).val(i.b).end()},r=function(e,a){t(a).data("colpick").fields.eq(4).val(Math.round(e.h)).end().eq(5).val(Math.round(e.s)).end().eq(6).val(Math.round(e.b)).end()},n=function(e,a){t(a).data("colpick").fields.eq(0).val(d(e))},s=function(e,a){t(a).data("colpick").selector.css("backgroundColor","#"+d({h:e.h,s:100,b:100})),t(a).data("colpick").selectorIndic.css({left:parseInt(t(a).data("colpick").height*e.s/100,10),top:parseInt(t(a).data("colpick").height*(100-e.b)/100,10)})},p=function(e,a){t(a).data("colpick").hue.css("top",parseInt(t(a).data("colpick").height-t(a).data("colpick").height*e.h/360,10))},u=function(e,a){t(a).data("colpick").currentColor.css("backgroundColor","#"+d(e))},f=function(e,a){t(a).data("colpick").newColor.css("backgroundColor","#"+d(e))},h=function(){var e,a=t(this).parent().parent();this.parentNode.className.indexOf("_hex")>0?(a.data("colpick").color=e=i(L(this.value)),l(e,a.get(0)),r(e,a.get(0))):this.parentNode.className.indexOf("_hsb")>0?(a.data("colpick").color=e=X({h:parseInt(a.data("colpick").fields.eq(4).val(),10),s:parseInt(a.data("colpick").fields.eq(5).val(),10),b:parseInt(a.data("colpick").fields.eq(6).val(),10)}),l(e,a.get(0)),n(e,a.get(0))):(a.data("colpick").color=e=o(E({r:parseInt(a.data("colpick").fields.eq(1).val(),10),g:parseInt(a.data("colpick").fields.eq(2).val(),10),b:parseInt(a.data("colpick").fields.eq(3).val(),10)})),n(e,a.get(0)),r(e,a.get(0))),s(e,a.get(0)),p(e,a.get(0)),f(e,a.get(0)),a.data("colpick").onChange.apply(a.parent(),[e,d(e),c(e),a.data("colpick").el,0])},v=function(){t(this).parent().removeClass("colpick_focus")},g=function(){t(this).parent().parent().data("colpick").fields.parent().removeClass("colpick_focus"),t(this).parent().addClass("colpick_focus")},k=function(e){e.preventDefault?e.preventDefault():e.returnValue=!1;var a=t(this).parent().find("input").focus(),i={el:t(this).parent().addClass("colpick_slider"),max:this.parentNode.className.indexOf("_hsb_h")>0?360:this.parentNode.className.indexOf("_hsb")>0?100:255,y:e.pageY,field:a,val:parseInt(a.val(),10),preview:t(this).parent().parent().data("colpick").livePreview};t(document).mouseup(i,_),t(document).mousemove(i,m)},m=function(t){return t.data.field.val(Math.max(0,Math.min(t.data.max,parseInt(t.data.val-t.pageY+t.data.y,10)))),t.data.preview&&h.apply(t.data.field.get(0),[!0]),!1},_=function(e){return h.apply(e.data.field.get(0),[!0]),e.data.el.removeClass("colpick_slider").find("input").focus(),t(document).off("mouseup",_),t(document).off("mousemove",m),!1},b=function(e){e.preventDefault?e.preventDefault():e.returnValue=!1;var a={cal:t(this).parent(),y:t(this).offset().top};t(document).on("mouseup touchend",a,y),t(document).on("mousemove touchmove",a,x);var i="touchstart"==e.type?e.originalEvent.changedTouches[0].pageY:e.pageY;return h.apply(a.cal.data("colpick").fields.eq(4).val(parseInt(360*(a.cal.data("colpick").height-(i-a.y))/a.cal.data("colpick").height,10)).get(0),[a.cal.data("colpick").livePreview]),!1},x=function(t){var e="touchmove"==t.type?t.originalEvent.changedTouches[0].pageY:t.pageY;return h.apply(t.data.cal.data("colpick").fields.eq(4).val(parseInt(360*(t.data.cal.data("colpick").height-Math.max(0,Math.min(t.data.cal.data("colpick").height,e-t.data.y)))/t.data.cal.data("colpick").height,10)).get(0),[t.data.preview]),!1},y=function(e){return l(e.data.cal.data("colpick").color,e.data.cal.get(0)),n(e.data.cal.data("colpick").color,e.data.cal.get(0)),t(document).off("mouseup touchend",y),t(document).off("mousemove touchmove",x),!1},w=function(e){e.preventDefault?e.preventDefault():e.returnValue=!1;var a={cal:t(this).parent(),pos:t(this).offset()};a.preview=a.cal.data("colpick").livePreview,t(document).on("mouseup touchend",a,M),t(document).on("mousemove touchmove",a,C);var i;return"touchstart"==e.type?(pageX=e.originalEvent.changedTouches[0].pageX,i=e.originalEvent.changedTouches[0].pageY):(pageX=e.pageX,i=e.pageY),h.apply(a.cal.data("colpick").fields.eq(6).val(parseInt(100*(a.cal.data("colpick").height-(i-a.pos.top))/a.cal.data("colpick").height,10)).end().eq(5).val(parseInt(100*(pageX-a.pos.left)/a.cal.data("colpick").height,10)).get(0),[a.preview]),!1},C=function(t){var e;return"touchmove"==t.type?(pageX=t.originalEvent.changedTouches[0].pageX,e=t.originalEvent.changedTouches[0].pageY):(pageX=t.pageX,e=t.pageY),h.apply(t.data.cal.data("colpick").fields.eq(6).val(parseInt(100*(t.data.cal.data("colpick").height-Math.max(0,Math.min(t.data.cal.data("colpick").height,e-t.data.pos.top)))/t.data.cal.data("colpick").height,10)).end().eq(5).val(parseInt(100*Math.max(0,Math.min(t.data.cal.data("colpick").height,pageX-t.data.pos.left))/t.data.cal.data("colpick").height,10)).get(0),[t.data.preview]),!1},M=function(e){return l(e.data.cal.data("colpick").color,e.data.cal.get(0)),n(e.data.cal.data("colpick").color,e.data.cal.get(0)),t(document).off("mouseup touchend",M),t(document).off("mousemove touchmove",C),!1},I=function(){var e=t(this).parent(),a=e.data("colpick").color;e.data("colpick").origColor=a,u(a,e.get(0)),e.data("colpick").onSubmit(a,d(a),c(a),e.data("colpick").el)},T=function(){var e=t("#"+t(this).data("colpickId"));e.data("colpick").onBeforeShow.apply(this,[e.get(0)]);var a=t(this).offset(),i=a.top+this.offsetHeight,o=a.left,c=S(),l=e.width();o+l>c.l+c.w&&(o-=l),e.css({left:o+"px",top:i+"px"}),0!=e.data("colpick").onShow.apply(this,[e.get(0)])&&e.show(),t("html").mousedown({cal:e},q),e.mousedown(function(t){t.stopPropagation()})},q=function(e){0!=e.data.cal.data("colpick").onHide.apply(this,[e.data.cal.get(0)])&&e.data.cal.hide(),t("html").off("mousedown",q)},S=function(){var t="CSS1Compat"==document.compatMode;return{l:window.pageXOffset||(t?document.documentElement.scrollLeft:document.body.scrollLeft),w:window.innerWidth||(t?document.documentElement.clientWidth:document.body.clientWidth)}},X=function(t){return{h:Math.min(360,Math.max(0,t.h)),s:Math.min(100,Math.max(0,t.s)),b:Math.min(100,Math.max(0,t.b))}},E=function(t){return{r:Math.min(255,Math.max(0,t.r)),g:Math.min(255,Math.max(0,t.g)),b:Math.min(255,Math.max(0,t.b))}},L=function(t){var e=6-t.length;if(e>0){for(var a=[],i=0;e>i;i++)a.push("0");a.push(t),t=a.join("")}return t},Y=function(){var e=t(this).parent(),a=e.data("colpick").origColor;e.data("colpick").color=a,l(a,e.get(0)),n(a,e.get(0)),r(a,e.get(0)),s(a,e.get(0)),p(a,e.get(0)),f(a,e.get(0))};return{init:function(c){if(c=t.extend({},a,c||{}),"string"==typeof c.color)c.color=i(c.color);else if(void 0!=c.color.r&&void 0!=c.color.g&&void 0!=c.color.b)c.color=o(c.color);else{if(void 0==c.color.h||void 0==c.color.s||void 0==c.color.b)return this;c.color=X(c.color)}return this.each(function(){if(!t(this).data("colpickId")){var a=t.extend({},c);a.origColor=c.color;var i="collorpicker_"+parseInt(1e3*Math.random());t(this).data("colpickId",i);var o=t(e).attr("id",i);o.addClass("colpick_"+a.layout+(a.submit?"":" colpick_"+a.layout+"_ns")),"light"!=a.colorScheme&&o.addClass("colpick_"+a.colorScheme),o.find("div.colpick_submit").html(a.submitText).click(I),a.fields=o.find("input").change(h).blur(v).focus(g),o.find("div.colpick_field_arrs").mousedown(k).end().find("div.colpick_current_color").click(Y),a.selector=o.find("div.colpick_color").on("mousedown touchstart",w),a.selectorIndic=a.selector.find("div.colpick_selector_outer"),a.el=this,a.hue=o.find("div.colpick_hue_arrs"),huebar=a.hue.parent();var d=navigator.userAgent.toLowerCase(),m="Microsoft Internet Explorer"===navigator.appName,_=m?parseFloat(d.match(/msie ([0-9]{1,}[\.0-9]{0,})/)[1]):0,x=m&&10>_,y=["#ff0000","#ff0080","#ff00ff","#8000ff","#0000ff","#0080ff","#00ffff","#00ff80","#00ff00","#80ff00","#ffff00","#ff8000","#ff0000"];if(x){var C,M;for(C=0;11>=C;C++)M=t("<div></div>").attr("style","height:8.333333%; filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr="+y[C]+", endColorstr="+y[C+1]+'); -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='+y[C]+", endColorstr="+y[C+1]+')";'),huebar.append(M)}else stopList=y.join(","),huebar.attr("style","background:-webkit-linear-gradient(top,"+stopList+"); background: -o-linear-gradient(top,"+stopList+"); background: -ms-linear-gradient(top,"+stopList+"); background:-moz-linear-gradient(top,"+stopList+"); -webkit-linear-gradient(top,"+stopList+"); background:linear-gradient(to bottom,"+stopList+"); ");o.find("div.colpick_hue").on("mousedown touchstart",b),a.newColor=o.find("div.colpick_new_color"),a.currentColor=o.find("div.colpick_current_color"),o.data("colpick",a),l(a.color,o.get(0)),r(a.color,o.get(0)),n(a.color,o.get(0)),p(a.color,o.get(0)),s(a.color,o.get(0)),u(a.color,o.get(0)),f(a.color,o.get(0)),a.flat?(o.appendTo(this).show(),o.css({position:"relative",display:"block"})):(o.appendTo(document.body),t(this).on(a.showEvent,T),o.css({position:"absolute"}))}})},showPicker:function(){return this.each(function(){t(this).data("colpickId")&&T.apply(this)})},hidePicker:function(){return this.each(function(){t(this).data("colpickId")&&t("#"+t(this).data("colpickId")).hide()})},setColor:function(e,a){if(a="undefined"==typeof a?1:a,"string"==typeof e)e=i(e);else if(void 0!=e.r&&void 0!=e.g&&void 0!=e.b)e=o(e);else{if(void 0==e.h||void 0==e.s||void 0==e.b)return this;e=X(e)}return this.each(function(){if(t(this).data("colpickId")){var i=t("#"+t(this).data("colpickId"));i.data("colpick").color=e,i.data("colpick").origColor=e,l(e,i.get(0)),r(e,i.get(0)),n(e,i.get(0)),p(e,i.get(0)),s(e,i.get(0)),f(e,i.get(0)),i.data("colpick").onChange.apply(i.parent(),[e,d(e),c(e),i.data("colpick").el,1]),a&&u(e,i.get(0))}})}}}(),a=function(t){var t=parseInt(t.indexOf("#")>-1?t.substring(1):t,16);return{r:t>>16,g:(65280&t)>>8,b:255&t}},i=function(t){return o(a(t))},o=function(t){var e={h:0,s:0,b:0},a=Math.min(t.r,t.g,t.b),i=Math.max(t.r,t.g,t.b),o=i-a;return e.b=i,e.s=0!=i?255*o/i:0,e.h=0!=e.s?t.r==i?(t.g-t.b)/o:t.g==i?2+(t.b-t.r)/o:4+(t.r-t.g)/o:-1,e.h*=60,e.h<0&&(e.h+=360),e.s*=100/255,e.b*=100/255,e},c=function(t){var e={},a=t.h,i=255*t.s/100,o=255*t.b/100;if(0==i)e.r=e.g=e.b=o;else{var c=o,l=(255-i)*o/255,d=(c-l)*(a%60)/60;360==a&&(a=0),60>a?(e.r=c,e.b=l,e.g=l+d):120>a?(e.g=c,e.b=l,e.r=c-d):180>a?(e.g=c,e.r=l,e.b=l+d):240>a?(e.b=c,e.r=l,e.g=c-d):300>a?(e.b=c,e.g=l,e.r=l+d):360>a?(e.r=c,e.g=l,e.b=c-d):(e.r=0,e.g=0,e.b=0)}return{r:Math.round(e.r),g:Math.round(e.g),b:Math.round(e.b)}},l=function(e){var a=[e.r.toString(16),e.g.toString(16),e.b.toString(16)];return t.each(a,function(t,e){1==e.length&&(a[t]="0"+e)}),a.join("")},d=function(t){return l(c(t))};t.fn.extend({mbColpick:e.init,mbColpickHide:e.hidePicker,mbColpickShow:e.showPicker,mbColpickSetColor:e.setColor}),t.extend({mbColpick:{rgbToHex:l,rgbToHsb:o,hsbToHex:d,hsbToRgb:c,hexToHsb:i,hexToRgb:a}})}(jQuery);