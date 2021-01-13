/*jquery.mb.vimeo_player 09-06-2018
 _ jquery.mb.components 
 _ email: matteo@open-lab.com 
 _ Copyright (c) 2001-2018. Matteo Bicocchi (Pupunzi); 
 _ blog: http://pupunzi.open-lab.com 
 _ Open Lab s.r.l., Florence - Italy 
 */
function isTouchSupported(){var a=nAgt.msMaxTouchPoints,b="ontouchstart"in document.createElement("div");return!(!a&&!b)}function isTouchSupported(){var a=nAgt.msMaxTouchPoints,b="ontouchstart"in document.createElement("div");return!(!a&&!b)}var get_vimeo_videoID=function(a){var b;return b=a.indexOf("vimeo.com")>0?a.substr(a.lastIndexOf("/")+1,a.length):a.length>15?null:a};!function($){jQuery.vimeo_player={name:"jquery.mb.vimeo_player",author:"Matteo Bicocchi (pupunzi)",version:"1.1.8",build:"543",defaults:{containment:"body",ratio:16/9,videoURL:null,startAt:0,stopAt:0,autoPlay:!0,fadeTime:1e3,vol:5,addRaster:!1,opacity:1,mute:!0,loop:!0,showControls:!0,show_vimeo_logo:!0,stopMovieOnBlur:!0,realfullscreen:!0,playOnMobile:!0,mobileFallbackImage:null,gaTrack:!1,optimizeDisplay:!0,mask:!1,align:"center,center",onReady:function(a){}},controls:{play:"P",pause:"p",mute:"M",unmute:"A",fullscreen:"O",showSite:"R",logo:"V"},buildPlayer:function(options){var isIframe=function(){var a=!1;try{self.location.href!=top.location.href&&(a=!0)}catch(b){a=!0}return a},script=document.createElement("script");return script.src="//player.vimeo.com/api/player.js",script.onload=function(){jQuery(document).trigger("vimeo_api_loaded")},document.head.appendChild(script),this.each(function(){var vimeo_player=this,$vimeo_player=jQuery(vimeo_player);vimeo_player.loop=0,vimeo_player.opt={},vimeo_player.state={},vimeo_player.id=vimeo_player.id||"YTP_"+(new Date).getTime(),$vimeo_player.addClass("vimeo_player");var property=$vimeo_player.data("property")&&"string"==typeof $vimeo_player.data("property")?eval("("+$vimeo_player.data("property")+")"):$vimeo_player.data("property");if(jQuery.extend(vimeo_player.opt,jQuery.vimeo_player.defaults,options,property),vimeo_player.opt.ratio="auto"==vimeo_player.opt.ratio?16/9:vimeo_player.opt.ratio,eval(vimeo_player.opt.loop)&&(vimeo_player.opt.loop=9999),vimeo_player.isRetina=window.retina||window.devicePixelRatio>1,vimeo_player.canGoFullScreen=!(jQuery.browser.msie||jQuery.browser.opera||isIframe()),vimeo_player.canGoFullScreen||(vimeo_player.opt.realfullscreen=!1),vimeo_player.isAlone=!1,vimeo_player.hasFocus=!0,vimeo_player.videoID=this.opt.videoURL?get_vimeo_videoID(this.opt.videoURL):!!$vimeo_player.attr("href")&&get_vimeo_videoID($vimeo_player.attr("href")),vimeo_player.isSelf="self"==vimeo_player.opt.containment,vimeo_player.opt.containment="self"==vimeo_player.opt.containment?jQuery(this):jQuery(vimeo_player.opt.containment),vimeo_player.opt.vol=vimeo_player.opt.vol/10,vimeo_player.isBackground=vimeo_player.opt.containment.is("body"),!vimeo_player.isBackground||!vimeo_player.backgroundIsInited){vimeo_player.playOnMobile=vimeo_player.opt.playOnMobile&&jQuery.browser.mobile,vimeo_player.isSelf||$vimeo_player.hide();var overlay=jQuery("<div/>").css({position:"absolute",top:0,left:0,width:"100%",height:"100%"}).addClass("vimeo_player_overlay");vimeo_player.isSelf&&overlay.on("click",function(){$vimeo_player.togglePlay()});var playerID="vimeo_player_"+vimeo_player.id,wrapper=jQuery("<div/>").addClass("vimeo_player_wrapper").attr("id","vimeo_player_wrapper_"+playerID);wrapper.css({position:"absolute",zIndex:0,width:"100%",height:"100%",left:0,top:0,overflow:"hidden",opacity:0}),vimeo_player.opt.containment.prepend(wrapper),vimeo_player.opt.containment.children().not("script, style").each(function(){"static"==jQuery(this).css("position")&&jQuery(this).css("position","relative")}),vimeo_player.isBackground?(jQuery("body").css({boxSizing:"border-box"}),wrapper.css({position:"fixed",top:0,left:0,zIndex:0})):"static"==vimeo_player.opt.containment.css("position")&&vimeo_player.opt.containment.css({position:"relative"}),vimeo_player.videoWrapper=wrapper,vimeo_player.overlay=overlay,vimeo_player.isBackground||overlay.on("mouseenter",function(){vimeo_player.controlBar&&vimeo_player.controlBar.length&&vimeo_player.controlBar.addClass("visible")}).on("mouseleave",function(){vimeo_player.controlBar&&vimeo_player.controlBar.length&&vimeo_player.controlBar.removeClass("visible")}),jQuery(document).on("vimeo_api_loaded",function(){var options={id:vimeo_player.opt.videoURL,muted:vimeo_player.opt.mute?1:0,background:1,autoplay:vimeo_player.playOnMobile?1:0};vimeo_player.player=new Vimeo.Player(vimeo_player.videoWrapper.get(0).id,options),vimeo_player.player.ready().then(function(){function start(){vimeo_player.isReady=!0,vimeo_player.opt.mute&&setTimeout(function(){$vimeo_player.v_mute()},1),vimeo_player.opt.showControls&&jQuery.vimeo_player.buildControls(vimeo_player),vimeo_player.opt.autoPlay?vimeo_player.playOnMobile?setTimeout(function(){VEvent=jQuery.Event("VPStart"),$vimeo_player.trigger(VEvent),vimeo_player.videoWrapper.fadeTo(vimeo_player.opt.fadeTime,vimeo_player.opt.opacity)},1e3):setTimeout(function(){vimeo_player.player.pause(),$vimeo_player.v_play(),VEvent=jQuery.Event("VPStart"),$vimeo_player.trigger(VEvent),$vimeo_player.v_optimize_display()},vimeo_player.opt.fadeTime):$vimeo_player.v_pause(),VEvent=jQuery.Event("VPReady"),VEvent.opt=vimeo_player.opt,$vimeo_player.trigger(VEvent),"function"==typeof vimeo_player.opt.onReady&&vimeo_player.opt.onReady(vimeo_player),$vimeo_player.v_optimize_display()}vimeo_player.playerBox=vimeo_player.videoWrapper.find("iframe"),vimeo_player.playerBox.after(overlay);var VEvent;vimeo_player.opt.startAt?(vimeo_player.player.play().then(function(){vimeo_player.player.pause()}),$vimeo_player.v_seekTo(vimeo_player.opt.startAt,function(){start()})):start(),jQuery(window).off("resize.vimeo_player_"+vimeo_player.id).on("resize.vimeo_player_"+vimeo_player.id,function(){clearTimeout(vimeo_player.optimizeD),vimeo_player.optimizeD=setTimeout(function(){$vimeo_player.v_optimize_display()},250)}),vimeo_player.player.on("progress",function(a){VEvent=jQuery.Event("VPProgress"),VEvent.data=a,$vimeo_player.trigger(VEvent)}),vimeo_player.player.on("error",function(a){vimeo_player.state=-1,VEvent=jQuery.Event("VPError"),VEvent.error=a,$vimeo_player.trigger(VEvent)}),vimeo_player.player.on("play",function(data){if(vimeo_player.state=1,$vimeo_player.trigger("change_state"),vimeo_player.controlBar&&vimeo_player.controlBar.length&&vimeo_player.controlBar.find(".vimeo_player_pause").html(jQuery.vimeo_player.controls.pause),"undefined"!=typeof _gaq&&eval(vimeo_player.opt.gaTrack)&&_gaq.push(["_trackEvent","vimeo_player","Play",vimeo_player.videoID]),"undefined"!=typeof ga&&eval(vimeo_player.opt.gaTrack)&&ga("send","event","vimeo_player","play",vimeo_player.videoID),VEvent=jQuery.Event("VPPlay"),VEvent.error=data,$vimeo_player.trigger(VEvent),vimeo_player.opt.addRaster){var classN="dot"==vimeo_player.opt.addRaster?"raster-dot":"raster";vimeo_player.overlay.addClass(vimeo_player.isRetina?classN+" retina":classN)}else vimeo_player.overlay.removeClass(function(a,b){var c=b.split(" "),d=[];return jQuery.each(c,function(a,b){/raster.*/.test(b)&&d.push(b)}),d.push("retina"),d.join(" ")})}),vimeo_player.player.on("pause",function(a){vimeo_player.state=2,$vimeo_player.trigger("change_state"),vimeo_player.controlBar&&vimeo_player.controlBar.length&&vimeo_player.controlBar.find(".vimeo_player_pause").html(jQuery.vimeo_player.controls.play),VEvent=jQuery.Event("VPPause"),VEvent.time=a,$vimeo_player.trigger(VEvent)}),vimeo_player.player.on("seeked",function(a){vimeo_player.state=3,$vimeo_player.trigger("change_state")}),vimeo_player.player.on("ended",function(a){vimeo_player.state=0,$vimeo_player.trigger("change_state"),VEvent=jQuery.Event("VPEnd"),VEvent.time=a,$vimeo_player.trigger(VEvent)}),vimeo_player.player.on("timeupdate",function(a){if(vimeo_player.duration=a.duration,vimeo_player.percent=a.percent,vimeo_player.seconds=a.seconds,vimeo_player.state=1,vimeo_player.player.getPaused().then(function(a){a&&(vimeo_player.state=2)}),vimeo_player.opt.stopMovieOnBlur&&(document.hasFocus()||1==vimeo_player.state&&(vimeo_player.hasFocus=!1,$vimeo_player.v_pause(),vimeo_player.document_focus=setInterval(function(){document.hasFocus()&&!vimeo_player.hasFocus&&(vimeo_player.hasFocus=!0,$vimeo_player.v_play(),clearInterval(vimeo_player.document_focus))},300))),vimeo_player.opt.showControls){var b=jQuery("#controlBar_"+vimeo_player.id),c=b.find(".vimeo_player_pogress"),d=b.find(".vimeo_player_loaded"),e=b.find(".vimeo_player_seek_bar"),f=c.outerWidth(),g=Math.floor(a.seconds),h=Math.floor(a.duration),i=g*f/h,j=0,k=100*a.percent;d.css({left:j,width:k+"%"}),e.css({left:0,width:i}),a.duration?vimeo_player.controlBar.find(".vimeo_player_time").html(jQuery.vimeo_player.formatTime(a.seconds)+" / "+jQuery.vimeo_player.formatTime(a.duration)):vimeo_player.controlBar.find(".vimeo_player_time").html("-- : -- / -- : --")}vimeo_player.opt.stopAt=vimeo_player.opt.stopAt>a.duration?a.duration-.5:vimeo_player.opt.stopAt;var l=vimeo_player.opt.stopAt||a.duration-.5;a.seconds>=l&&(vimeo_player.loop=vimeo_player.loop||0,vimeo_player.opt.loop&&vimeo_player.loop<vimeo_player.opt.loop?($vimeo_player.v_seekTo(vimeo_player.opt.startAt),vimeo_player.loop++):($vimeo_player.v_pause(),vimeo_player.state=0,$vimeo_player.trigger("change_state"))),VEvent=jQuery.Event("VPTime"),VEvent.time=a.seconds,$vimeo_player.trigger(VEvent)})}),$vimeo_player.on("change_state",function(){0==vimeo_player.state&&vimeo_player.videoWrapper.fadeOut(vimeo_player.opt.fadeTime,function(){$vimeo_player.v_seekTo(0)})})})}})},formatTime:function(a){var b=Math.floor(a/60),c=Math.floor(a-60*b);return(b<=9?"0"+b:b)+" : "+(c<=9?"0"+c:c)},play:function(){var a=this.get(0);if(!a.isReady)return this;a.player.pause(),a.player.play(),setTimeout(function(){a.videoWrapper.fadeTo(a.opt.fadeTime,a.opt.opacity)},1e3);var b=jQuery("#controlBar_"+a.id);if(b.length){var c=b.find(".mb_YTPPvimeo_player_playpause");c.html(jQuery.vimeo_player.controls.pause)}return a.state=1,jQuery(a).css("background-image","none"),this},togglePlay:function(a){var b=this.get(0);return 1==b.state?this.v_pause():this.v_play(),"function"==typeof a&&a(b.state),this},pause:function(){var a=this.get(0);return a.player.pause(),a.state=2,this},seekTo:function(a,b){var c=this.get(0),d=c.opt.stopAt&&a>=c.opt.stopAt?c.opt.stopAt-.5:a;return c.player.setCurrentTime(d).then(function(a){"function"==typeof b&&b(a)}),this},setVolume:function(a){var b=this.get(0);return b.isMute=!1,b.opt.vol=a||b.opt.vol,b.player.setVolume(b.opt.vol),b.volumeBar&&b.volumeBar.length&&b.volumeBar.updateSliderVal(100*a),this},toggleVolume:function(){var a=this.get(0);if(a)return a.isMute?(jQuery(a).v_unmute(),!0):(jQuery(a).v_mute(),!1)},mute:function(){var a=this.get(0);if(a.isMute)return this;a.playOnMobile&&a.player.toggleMute(),a.isMute=!0,a.player.setVolume(0),a.volumeBar&&a.volumeBar.length&&a.volumeBar.width()>10&&a.volumeBar.updateSliderVal(0);var b=jQuery("#controlBar_"+a.id),c=b.find(".vimeo_player_muteUnmute");return c.html(jQuery.vimeo_player.controls.unmute),jQuery(a).addClass("isMuted"),a.volumeBar&&a.volumeBar.length&&a.volumeBar.addClass("muted"),this},unmute:function(){var a=this.get(0);if(a.isMute){a.isMute=!1,a.playOnMobile&&a.player.toggleMute(),jQuery(a).v_set_volume(a.opt.vol),a.volumeBar&&a.volumeBar.length&&a.volumeBar.updateSliderVal(a.opt.vol>.1?a.opt.vol:.1);var b=jQuery("#controlBar_"+a.id),c=b.find(".vimeo_player_muteUnmute");return c.html(jQuery.vimeo_player.controls.mute),jQuery(a).removeClass("isMuted"),a.volumeBar&&a.volumeBar.length&&a.volumeBar.removeClass("muted"),this}},changeMovie:function(a){var b=this,c=b.get(0);c.opt.startAt=0,c.opt.stopAt=0,c.opt.mask=!1,c.opt.mute=!0,c.hasData=!1,c.hasChanged=!0,c.player.loopTime=void 0,a&&jQuery.extend(c.opt,a),"true"==c.opt.loop&&(c.opt.loop=9999),c.player.loadVideo(a.videoURL).then(function(a){b.v_optimize_display(),jQuery(c).v_play(),c.opt.startAt&&b.v_seekTo(c.opt.startAt)})},buildControls:function(vimeo_player){var data=vimeo_player.opt;if(!jQuery("#controlBar_"+vimeo_player.id).length){vimeo_player.controlBar=jQuery("<span/>").attr("id","controlBar_"+vimeo_player.id).addClass("vimeo_player_bar").css({whiteSpace:"noWrap",position:vimeo_player.isBackground?"fixed":"absolute",zIndex:vimeo_player.isBackground?1e4:1e3});var buttonBar=jQuery("<div/>").addClass("buttonBar"),playpause=jQuery("<span>"+jQuery.vimeo_player.controls.play+"</span>").addClass("vimeo_player_pause vimeo_icon").click(function(){1==vimeo_player.state?jQuery(vimeo_player).v_pause():jQuery(vimeo_player).v_play()}),MuteUnmute=jQuery("<span>"+jQuery.vimeo_player.controls.mute+"</span>").addClass("vimeo_player_muteUnmute vimeo_icon").click(function(){vimeo_player.isMute?jQuery(vimeo_player).v_unmute():jQuery(vimeo_player).v_mute()}),volumeBar=jQuery("<div/>").addClass("vimeo_player_volume_bar").css({display:"inline-block"});vimeo_player.volumeBar=volumeBar;var idx=jQuery("<span/>").addClass("vimeo_player_time"),vURL="https://vimeo.com/"+vimeo_player.videoID,movieUrl=jQuery("<span/>").html(jQuery.vimeo_player.controls.logo).addClass("vimeo_url vimeo_icon").attr("title","view on Vimeo").on("click",function(){window.open(vURL,"viewOnVimeo")}),fullscreen=jQuery("<span/>").html(jQuery.vimeo_player.controls.fullscreen).addClass("vimeo_fullscreen vimeo_icon").on("click",function(){jQuery(vimeo_player).v_fullscreen(data.realfullscreen)}),progressBar=jQuery("<div/>").addClass("vimeo_player_pogress").css("position","absolute").click(function(a){timeBar.css({width:a.clientX-timeBar.offset().left}),vimeo_player.timeW=a.clientX-timeBar.offset().left,vimeo_player.controlBar.find(".vimeo_player_loaded").css({width:0});var b=Math.floor(vimeo_player.duration);vimeo_player.goto=timeBar.outerWidth()*b/progressBar.outerWidth(),jQuery(vimeo_player).v_seekTo(parseFloat(vimeo_player.goto)),vimeo_player.controlBar.find(".vimeo_player_loaded").css({width:0})}),loadedBar=jQuery("<div/>").addClass("vimeo_player_loaded").css("position","absolute"),timeBar=jQuery("<div/>").addClass("vimeo_player_seek_bar").css("position","absolute");progressBar.append(loadedBar).append(timeBar),buttonBar.append(playpause).append(MuteUnmute).append(volumeBar).append(idx),data.show_vimeo_logo&&buttonBar.append(movieUrl),(vimeo_player.isBackground||eval(vimeo_player.opt.realfullscreen)&&!vimeo_player.isBackground)&&buttonBar.append(fullscreen),vimeo_player.controlBar.append(buttonBar).append(progressBar),vimeo_player.isBackground?jQuery("body").after(vimeo_player.controlBar):vimeo_player.videoWrapper.before(vimeo_player.controlBar),volumeBar.simpleSlider({initialval:vimeo_player.opt.vol,scale:100,orientation:"h",callback:function(a){0==a.value?jQuery(vimeo_player).v_mute():jQuery(vimeo_player).v_unmute(),vimeo_player.player.setVolume(a.value/100),vimeo_player.isMute||(vimeo_player.opt.vol=a.value)}})}},optimizeVimeoDisplay:function(align){var vimeo_player=this.get(0),vid={};vimeo_player.opt.align=align||vimeo_player.opt.align,vimeo_player.opt.align="undefined "!=typeof vimeo_player.opt.align?vimeo_player.opt.align:"center,center";var VimeoAlign=vimeo_player.opt.align.split(",");if(vimeo_player.opt.optimizeDisplay){var win={},el=vimeo_player.videoWrapper,abundance=vimeo_player.isPlayer?0:.15*el.outerHeight();win.width=el.outerWidth()+abundance,win.height=el.outerHeight()+abundance,vimeo_player.opt.ratio=eval(vimeo_player.opt.ratio),vid.width=win.width,vid.height=Math.ceil(vid.width/vimeo_player.opt.ratio),vid.marginTop=Math.ceil(-((vid.height-win.height)/2)),vid.marginLeft=0,vimeo_player.playerBox.css({top:0,opacity:0,width:100,height:Math.ceil(100/vimeo_player.opt.ratio),marginTop:0,marginLeft:0,frameBorder:0});var lowest=vid.height<win.height;lowest&&(vid.height=win.height,vid.width=Math.ceil(vid.height*vimeo_player.opt.ratio),vid.marginTop=0,vid.marginLeft=Math.ceil(-((vid.width-win.width)/2)));for(var a in VimeoAlign)if(VimeoAlign.hasOwnProperty(a)){var al=VimeoAlign[a].replace(/ /g,"");switch(al){case"top":vid.marginTop=lowest?-((vid.height-win.height)/2):0;break;case"bottom":vid.marginTop=lowest?0:-(vid.height-win.height);break;case"left":vid.marginLeft=0;break;case"right":vid.marginLeft=lowest?-(vid.width-win.width):0;break;default:vid.width>win.width&&(vid.marginLeft=-((vid.width-win.width)/2))}}}else vid.width="100%",vid.height="100%",vid.marginTop=0,vid.marginLeft=0;setTimeout(function(){vimeo_player.playerBox.css({opacity:1,width:vid.width,height:vid.height,marginTop:vid.marginTop,marginLeft:vid.marginLeft,maxWidth:"initial"})},10)},setAlign:function(a){var b=this;b.v_optimize_display(a)},getAlign:function(){var a=this.get(0);return a.opt.align},fullscreen:function(real){function hideMouse(){vimeo_player.overlay.css({cursor:"none"})}function RunPrefixMethod(a,b){for(var c,d,e=["webkit","moz","ms","o",""],f=0;f<e.length&&!a[c];){if(c=b,""==e[f]&&(c=c.substr(0,1).toLowerCase()+c.substr(1)),c=e[f]+c,d=typeof a[c],"undefined"!=d)return e=[e[f]],"function"==d?a[c]():a[c];f++}}function launchFullscreen(a){RunPrefixMethod(a,"RequestFullScreen")}function cancelFullscreen(){(RunPrefixMethod(document,"FullScreen")||RunPrefixMethod(document,"IsFullScreen"))&&RunPrefixMethod(document,"CancelFullScreen")}var vimeo_player=this.get(0),$vimeo_player=jQuery(vimeo_player),VEvent;"undefined"==typeof real&&(real=vimeo_player.opt.realfullscreen),real=eval(real);var controls=jQuery("#controlBar_"+vimeo_player.id),fullScreenBtn=controls.find(".vimeo_fullscreen"),videoWrapper=vimeo_player.isSelf?vimeo_player.opt.containment:vimeo_player.videoWrapper;if(real){var fullscreenchange=jQuery.browser.mozilla?"mozfullscreenchange":jQuery.browser.webkit?"webkitfullscreenchange":"fullscreenchange";jQuery(document).off(fullscreenchange).on(fullscreenchange,function(){var a=RunPrefixMethod(document,"IsFullScreen")||RunPrefixMethod(document,"FullScreen");a?(VEvent=jQuery.Event("VPFullScreenStart"),$vimeo_player.trigger(VEvent)):(vimeo_player.isAlone=!1,fullScreenBtn.html(jQuery.vimeo_player.controls.fullscreen),videoWrapper.removeClass("vimeo_player_Fullscreen"),videoWrapper.fadeTo(vimeo_player.opt.fadeTime,vimeo_player.opt.opacity),videoWrapper.css({zIndex:0}),vimeo_player.isBackground?jQuery("body").after(controls):vimeo_player.videoWrapper.before(controls),jQuery(window).resize(),VEvent=jQuery.Event("VPFullScreenEnd"),$vimeo_player.trigger(VEvent))})}return vimeo_player.isAlone?(jQuery(document).off("mousemove.vimeo_player"),clearTimeout(vimeo_player.hideCursor),vimeo_player.overlay.css({cursor:"auto"}),real?cancelFullscreen():videoWrapper.fadeTo(vimeo_player.opt.fadeTime,vimeo_player.opt.opacity).css({zIndex:0}),fullScreenBtn.html(jQuery.vimeo_player.controls.fullscreen),vimeo_player.isAlone=!1):(jQuery(document).on("mousemove.vimeo_player",function(a){vimeo_player.overlay.css({cursor:"auto"}),clearTimeout(vimeo_player.hideCursor),jQuery(a.target).parents().is(".vimeo_player_bar")||(vimeo_player.hideCursor=setTimeout(hideMouse,3e3))}),hideMouse(),real?(videoWrapper.css({opacity:0}),videoWrapper.addClass("vimeo_player_Fullscreen"),launchFullscreen(videoWrapper.get(0)),setTimeout(function(){videoWrapper.fadeTo(vimeo_player.opt.fadeTime,1),vimeo_player.videoWrapper.append(controls),jQuery(vimeo_player).v_optimize_display()},500)):videoWrapper.css({zIndex:1e4}).fadeTo(vimeo_player.opt.fadeTime,1),fullScreenBtn.html(jQuery.vimeo_player.controls.showSite),vimeo_player.isAlone=!0),this}},jQuery.fn.vimeo_player=jQuery.vimeo_player.buildPlayer,jQuery.fn.v_play=jQuery.vimeo_player.play,jQuery.fn.v_toggle_play=jQuery.vimeo_player.togglePlay,jQuery.fn.v_change_movie=jQuery.vimeo_player.changeMovie,jQuery.fn.v_pause=jQuery.vimeo_player.pause,jQuery.fn.v_seekTo=jQuery.vimeo_player.seekTo,jQuery.fn.v_optimize_display=jQuery.vimeo_player.optimizeVimeoDisplay,jQuery.fn.v_set_align=jQuery.vimeo_player.setAlign,jQuery.fn.v_get_align=jQuery.vimeo_player.getAlign,jQuery.fn.v_fullscreen=jQuery.vimeo_player.fullscreen,jQuery.fn.v_mute=jQuery.vimeo_player.mute,jQuery.fn.v_unmute=jQuery.vimeo_player.unmute,jQuery.fn.v_set_volume=jQuery.vimeo_player.setVolume,jQuery.fn.v_toggle_volume=jQuery.vimeo_player.toggleVolume}(jQuery);var nAgt=navigator.userAgent;jQuery.browser=jQuery.browser||{},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.safari=!1,jQuery.browser.chrome=!1,jQuery.browser.androidStock=!1,jQuery.browser.msie=!1,jQuery.browser.edge=!1,jQuery.browser.ua=nAgt;var getOS=function(){var a={version:"Unknown version",name:"Unknown OS"};return-1!=navigator.appVersion.indexOf("Win")&&(a.name="Windows"),-1!=navigator.appVersion.indexOf("Mac")&&0>navigator.appVersion.indexOf("Mobile")&&(a.name="Mac"),-1!=navigator.appVersion.indexOf("Linux")&&(a.name="Linux"),/Mac OS X/.test(nAgt)&&!/Mobile/.test(nAgt)&&(a.version=/Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1],a.version=a.version.replace(/_/g,".").substring(0,5)),/Windows/.test(nAgt)&&(a.version="Unknown.Unknown"),/Windows NT 5.1/.test(nAgt)&&(a.version="5.1"),/Windows NT 6.0/.test(nAgt)&&(a.version="6.0"),/Windows NT 6.1/.test(nAgt)&&(a.version="6.1"),/Windows NT 6.2/.test(nAgt)&&(a.version="6.2"),/Windows NT 10.0/.test(nAgt)&&(a.version="10.0"),/Linux/.test(nAgt)&&/Linux/.test(nAgt)&&(a.version="Unknown.Unknown"),a.name=a.name.toLowerCase(),a.major_version="Unknown",a.minor_version="Unknown","Unknown.Unknown"!=a.version&&(a.major_version=parseFloat(a.version.split(".")[0]),a.minor_version=parseFloat(a.version.split(".")[1])),a};jQuery.browser.os=getOS(),jQuery.browser.hasTouch=isTouchSupported(),jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10);var nameOffset,verOffset,ix;if(-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")){jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.browser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Edge"))?(jQuery.browser.edge=!0,jQuery.browser.name="Microsoft Edge",jQuery.browser.fullVersion=nAgt.substring(verOffset+5)):-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.chrome=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1<nAgt.indexOf("mozilla/5.0")&&-1<nAgt.indexOf("android ")&&-1<nAgt.indexOf("applewebkit")&&!(-1<nAgt.indexOf("chrome"))?(verOffset=nAgt.indexOf("Chrome"),jQuery.browser.webkit=!0,jQuery.browser.androidStock=!0,jQuery.browser.name="androidStock",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.browser.name=nAgt.substring(nameOffset,verOffset),jQuery.browser.fullVersion=nAgt.substring(verOffset+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName));-1!=(ix=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion,jQuery.browser.android=/Android/i.test(nAgt),jQuery.browser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.browser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.browser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.browser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.browser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.browser.mobile=jQuery.browser.android||jQuery.browser.blackberry||jQuery.browser.ios||jQuery.browser.windowsMobile||jQuery.browser.operaMobile||jQuery.browser.kindle,jQuery.isMobile=jQuery.browser.mobile,jQuery.isTablet=jQuery.browser.mobile&&765<jQuery(window).width(),jQuery.isAndroidDefault=jQuery.browser.android&&!/chrome/i.test(nAgt),jQuery.mbBrowser=jQuery.browser,jQuery.browser.versionCompare=function(a,b){if("stringstring"!=typeof a+typeof b)return!1;for(var c=a.split("."),d=b.split("."),e=0,f=Math.max(c.length,d.length);e<f;e++){if(c[e]&&!d[e]&&0<parseInt(c[e])||parseInt(c[e])>parseInt(d[e]))return 1;if(d[e]&&!c[e]&&0<parseInt(d[e])||parseInt(c[e])<parseInt(d[e]))return-1}return 0};var nAgt=navigator.userAgent;jQuery.browser=jQuery.browser||{},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.safari=!1,jQuery.browser.chrome=!1,jQuery.browser.androidStock=!1,jQuery.browser.msie=!1,jQuery.browser.edge=!1,jQuery.browser.ua=nAgt;var getOS=function(){var a={version:"Unknown version",name:"Unknown OS"};return-1!=navigator.appVersion.indexOf("Win")&&(a.name="Windows"),-1!=navigator.appVersion.indexOf("Mac")&&0>navigator.appVersion.indexOf("Mobile")&&(a.name="Mac"),-1!=navigator.appVersion.indexOf("Linux")&&(a.name="Linux"),/Mac OS X/.test(nAgt)&&!/Mobile/.test(nAgt)&&(a.version=/Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1],a.version=a.version.replace(/_/g,".").substring(0,5)),/Windows/.test(nAgt)&&(a.version="Unknown.Unknown"),/Windows NT 5.1/.test(nAgt)&&(a.version="5.1"),/Windows NT 6.0/.test(nAgt)&&(a.version="6.0"),/Windows NT 6.1/.test(nAgt)&&(a.version="6.1"),/Windows NT 6.2/.test(nAgt)&&(a.version="6.2"),/Windows NT 10.0/.test(nAgt)&&(a.version="10.0"),/Linux/.test(nAgt)&&/Linux/.test(nAgt)&&(a.version="Unknown.Unknown"),a.name=a.name.toLowerCase(),a.major_version="Unknown",a.minor_version="Unknown","Unknown.Unknown"!=a.version&&(a.major_version=parseFloat(a.version.split(".")[0]),a.minor_version=parseFloat(a.version.split(".")[1])),a};jQuery.browser.os=getOS(),jQuery.browser.hasTouch=isTouchSupported(),jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10);var nameOffset,verOffset,ix;if(-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")){jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.browser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Edge"))?(jQuery.browser.edge=!0,jQuery.browser.name="Microsoft Edge",jQuery.browser.fullVersion=nAgt.substring(verOffset+5)):-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.chrome=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1<nAgt.indexOf("mozilla/5.0")&&-1<nAgt.indexOf("android ")&&-1<nAgt.indexOf("applewebkit")&&!(-1<nAgt.indexOf("chrome"))?(verOffset=nAgt.indexOf("Chrome"),jQuery.browser.webkit=!0,jQuery.browser.androidStock=!0,jQuery.browser.name="androidStock",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.browser.name=nAgt.substring(nameOffset,verOffset),jQuery.browser.fullVersion=nAgt.substring(verOffset+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName));-1!=(ix=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion,jQuery.browser.android=/Android/i.test(nAgt),jQuery.browser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.browser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.browser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.browser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.browser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.browser.mobile=jQuery.browser.android||jQuery.browser.blackberry||jQuery.browser.ios||jQuery.browser.windowsMobile||jQuery.browser.operaMobile||jQuery.browser.kindle,jQuery.isMobile=jQuery.browser.mobile,jQuery.isTablet=jQuery.browser.mobile&&765<jQuery(window).width(),jQuery.isAndroidDefault=jQuery.browser.android&&!/chrome/i.test(nAgt),jQuery.mbBrowser=jQuery.browser,jQuery.browser.versionCompare=function(a,b){if("stringstring"!=typeof a+typeof b)return!1;for(var c=a.split("."),d=b.split("."),e=0,f=Math.max(c.length,d.length);e<f;e++){if(c[e]&&!d[e]&&0<parseInt(c[e])||parseInt(c[e])>parseInt(d[e]))return 1;if(d[e]&&!c[e]&&0<parseInt(d[e])||parseInt(c[e])<parseInt(d[e]))return-1}return 0},function(a){a.simpleSlider={defaults:{initialval:0,scale:100,orientation:"h",readonly:!1,callback:!1},events:{start:a.browser.mobile?"touchstart":"mousedown",end:a.browser.mobile?"touchend":"mouseup",move:a.browser.mobile?"touchmove":"mousemove"},init:function(b){return this.each(function(){var c=this,d=a(c);d.addClass("simpleSlider"),c.opt={},a.extend(c.opt,a.simpleSlider.defaults,b),a.extend(c.opt,d.data());var e="h"==c.opt.orientation?"horizontal":"vertical";e=a("<div/>").addClass("level").addClass(e),d.prepend(e),c.level=e,d.css({cursor:"default"}),"auto"==c.opt.scale&&(c.opt.scale=a(c).outerWidth()),d.updateSliderVal(),c.opt.readonly||(d.on(a.simpleSlider.events.start,function(b){a.browser.mobile&&(b=b.changedTouches[0]),c.canSlide=!0,d.updateSliderVal(b),"h"==c.opt.orientation?d.css({cursor:"col-resize"}):d.css({cursor:"row-resize"}),a.browser.mobile||(b.preventDefault(),b.stopPropagation())}),a(document).on(a.simpleSlider.events.move,function(b){
a.browser.mobile&&(b=b.changedTouches[0]),c.canSlide&&(a(document).css({cursor:"default"}),d.updateSliderVal(b),a.browser.mobile||(b.preventDefault(),b.stopPropagation()))}).on(a.simpleSlider.events.end,function(){a(document).css({cursor:"auto"}),c.canSlide=!1,d.css({cursor:"auto"})}))})},updateSliderVal:function(b){var c=this.get(0);if(c.opt){c.opt.initialval="number"==typeof c.opt.initialval?c.opt.initialval:c.opt.initialval(c);var d=a(c).outerWidth(),e=a(c).outerHeight();c.x="object"==typeof b?b.clientX+document.body.scrollLeft-this.offset()p*��U  p*��U                  ���U          ����U  �*��U          �*��U  �      �*��U          +document.body.scrollTop-this.offset().top:"number"==typeof b?(c.opt.scale-c.opt.initialval-b)*e/c.opt.scale:c.opt.initialval*e/c.opt.scale,c.y=this.outerHeight()-c.y,c.scaleX=c.x*c.opt.scale/d,c.scaleY=c.y*c.opt.scale/e,c.outOfRangeX=c.scaleX>c.opt.scale?c.scaleX-c.opt.scale:0>c.scaleX?c.scaleX:0,c.outOfRangeY=c.scaleY>c.opt.scale?c.scaleY-c.opt.scale:0>c.scaleY?c.scaleY:0,c.outOfRange="h"==c.opt.orientation?c.outOfRangeX:c.outOfRangeY,c.value="undefined"!=typeof b?"h"==c.opt.orientation?c.x>=this.outerWidth()?c.opt.scale:0>=c.x?0:c.scaleX:c.y>=this.outerHeight()?c.opt.scale:0>=c.y?0:c.scaleY:"h"==c.opt.orientation?c.scaleX:c.scaleY,"h"==c.opt.orientation?c.level.width(Math.floor(100*c.x/d)+"%"):c.level.height(Math.floor(100*c.y/e)),"function"==typeof c.opt.callback&&c.opt.callback(c)}}},a.fn.simpleSlider=a.simpleSlider.init,a.fn.updateSliderVal=a.simpleSlider.updateSliderVal}(jQuery);