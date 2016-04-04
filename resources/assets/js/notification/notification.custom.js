function TopBarNotify(message,type,callback){
    this.message = message;
    this.type = type;
    this.callback = callback;
}

TopBarNotify.prototype.display = function(){
    var notification = new NotificationFx({
        message: this.message,
        layout: 'bar',
        effect: 'slidetop',
        type: this.type, 
        onClose: this.callback
    });

    // show the notification
    notification.show();
};
