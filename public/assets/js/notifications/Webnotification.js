Pusher.logToConsole = true;

var pusher = new Pusher('b21a1684a19b32bf82a1', {
    cluster: 'ap1',
    forceTLS: true
});

function show_stack_custom_top(type, title, message) {
    var cur_value = 1,
    progress;


    var opts = {
        width: "100%",
        cornerclass: "rounded-0",
        // addclass: "stack-custom-top bg-danger border-danger text-white",
        stack: {"dir1": "right", "dir2": "down", "push": "top", "spacing1": 1},
        icon: 'icon-spinner4 spinner',
        delay : 5000,
    };

    opts.title = title;
    opts.text = message;
    switch (type) {
        case 'error':
            opts.addclass = "stack-custom-top bg-danger border-danger text-white";
            opts.type = "error";
        break;

        case 'info':
            opts.addclass = "stack-custom-top bg-info border-info text-white";
            opts.type = "info";
        break;

        case 'success':
            opts.addclass = "stack-custom-top bg-success border-success text-white";
            opts.type = "success";
        break;
    }
    
    new PNotify(opts);
}

var channel = pusher.subscribe('ebphtb-karo-notification');
channel.bind('public-realtime-notification', function(e) {
    show_stack_custom_top(e.data.status, e.data.title, e.data.message);
    console.log(broadcastChannel, e.data.broadcastChannel)
    if(e.data.broadcastChannel  == broadcastChannel) {
        notification.trigger()
    }
});