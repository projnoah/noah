!function t(r,n,e){function i(s,a){if(!n[s]){if(!r[s]){var u="function"==typeof require&&require;if(!a&&u)return u(s,!0);if(o)return o(s,!0);var c=new Error("Cannot find module '"+s+"'");throw c.code="MODULE_NOT_FOUND",c}var f=n[s]={exports:{}};r[s][0].call(f.exports,function(t){var n=r[s][1][t];return i(n?n:t)},f,f.exports,t,r,n,e)}return n[s].exports}for(var o="function"==typeof require&&require,s=0;s<e.length;s++)i(e[s]);return i}({1:[function(t,r,n){"use strict";var e={displayErrorAlert:function(t,r){swal({title:t,text:r,type:"error",timer:2500,showConfirmButton:!1})},displaySuccessAlert:function(t,r){swal({title:t,text:r,type:"success",timer:2500,showConfirmButton:!1})},displayAvatarNotification:function(t){var r=arguments.length<=1||void 0===arguments[1]?function(){}:arguments[1],n=new NotificationFx({message:'<div class="ns-thumb"><img src="'+User.avatarUrl+'"/></div><div class="ns-content"><p>'+t+"</p></div>",layout:"other",ttl:4e3,effect:"thumbslider",type:"notice",onClose:r});n.show()},displayTopBarNotification:function(t){var r=arguments.length<=1||void 0===arguments[1]?function(){}:arguments[1],n=new TopBarNotify('<span class="fa fa-times"></span><p>'+t+"</p>","warning",r());n.display()}};window.Noah=e},{}],2:[function(t,r,n){"use strict"},{}]},{},[1,2]);