!function n(e,o,r){function t(a,l){if(!o[a]){if(!e[a]){var f="function"==typeof require&&require;if(!l&&f)return f(a,!0);if(i)return i(a,!0);var s=new Error("Cannot find module '"+a+"'");throw s.code="MODULE_NOT_FOUND",s}var u=o[a]={exports:{}};e[a][0].call(u.exports,function(n){var o=e[a][1][n];return t(o?o:n)},u,u.exports,n,e,o,r)}return o[a].exports}for(var i="function"==typeof require&&require,a=0;a<r.length;a++)t(r[a]);return t}({1:[function(n,e,o){"use strict";$(function(){function n(n){var t="";t=n.target.value.split("\\").pop(),t?o.find("span").html(t):o.html(labelVal),r=r?r:$(e).parents("form")[0],$(r).addClass("loading"),$($(o).find("figure")[0]).toggleClass("icon-cloud-upload fa fa-spin fa-spinner"),$.ajaxFileUpload({url:r.action,dataType:"json",fileElementId:"logo-file",success:function(n){$("#logo-img").attr("src",n.responseText.replace(/<\/?[^>]*>/g,""))},error:function(n){$("#logo-img").attr("src",n.responseText.replace(/<\/?[^>]*>/g,""))},complete:function(){$(r).removeClass("loading"),$($(o).find("figure")[0]).toggleClass("icon-cloud-upload fa fa-spin fa-spinner"),setTimeout(function(){var n="#"+$(r).attr("id");$.pjax.reload(n)},100)}})}var e,o,r;$(".input-file").each(function(){e=$(this),o=e.next("label");o.html();o.on("click",function(){$(e).click()}),e.on("change",n),e.on("focus",function(){e.addClass("has-focus")}).on("blur",function(){e.removeClass("has-focus")})})})},{}]},{},[1]);