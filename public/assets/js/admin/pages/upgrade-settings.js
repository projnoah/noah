!function e(r,n,t){function o(s,i){if(!n[s]){if(!r[s]){var u="function"==typeof require&&require;if(!i&&u)return u(s,!0);if(a)return a(s,!0);var c=new Error("Cannot find module '"+s+"'");throw c.code="MODULE_NOT_FOUND",c}var p=n[s]={exports:{}};r[s][0].call(p.exports,function(e){var n=r[s][1][e];return o(n?n:e)},p,p.exports,e,r,n,t)}return n[s].exports}for(var a="function"==typeof require&&require,s=0;s<t.length;s++)o(t[s]);return o}({1:[function(e,r,n){"use strict";$(function(){function e(){i=window.setInterval(r,80)}function r(){s?$.ajax(o,{type:"POST",dataType:"json",data:{_token:$("meta[name=_token]").attr("content")},success:function(e){"pending"==e.upgrade?a!=e.message&&(a=e.message,$("<p>"+e.message+"</p>").appendTo($(".upgrade-logs")),u+=15,$("#upgrade-progress .progress-bar").css("width",u+"%")):s=!1}}):window.clearInterval(i)}function n(){setTimeout(function(){return $("#upgrade-progress").fadeOut()},350),$("#new-version-badge").remove(),$("#new-version-footer").remove(),setTimeout(function(){return $.pjax.reload(pjaxContainer)},1500)}var t='<h1><i class="fa fa-cog fa-spin fa-3x"></i></h1>',o=$("#upgrade-form").attr("action"),a="",s=!0,i=null,u=0;$(".new-version-gift img").on("click",function(r){$(".new-version-gift").html(t).removeClass("new-version-available"),$("#upgrade-progress").fadeIn(),e(),setTimeout(function(){$.ajax(o,{type:"PATCH",data:{_token:$("meta[name=_token]").attr("content")},success:function(){$("#upgrade-progress .progress-bar").css("width","100%"),toastr.success("<h4>"+upgradeCompleteMessage+"</h4>"),n()},timeout:3600})},150)}),$.ajax(upgradeQueryUrl,{type:"GET",dataType:"json",success:function(e){$("#upgrade-description").html(e.description)},error:function(){$("#upgrade-description").html("Error")}})})},{}]},{},[1]);