Pusher.logToConsole = true;

var pusher = new Pusher('d502f7f1b375d85cba92', {
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
        delay : 8000,
        // text: '<div class="progress mt-3 mb-0">\
        //         <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
        //         <span class="sr-only">0%</span>\
        //         </div>\
        //         </div>',
        // hide: false,
        // buttons: {
        //     closer: false,
        //     sticker: false
        // },
        // before_open: function(PNotify) {
        //     progress = PNotify.get().find("div.progress-bar");
        //     progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");

        //     // Pretend to do something.
        //     var timer = setInterval(function() {
        //         if (cur_value >= 100) {

        //             // Remove the interval.
        //             window.clearInterval(timer);
        //             loader.remove();
        //             return;
        //         }
        //         cur_value += 1;
        //         progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");
        //     }, 65);
        // }
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

var channel = pusher.subscribe('epad-register-notification');
channel.bind('public-realtime-notification', function(e) {
    if(e.data.status == 'verification_register_dpd01') {
        // $.jGrowl(e.data.message, {
        //     position: 'top-center',
        //     theme: 'alert-styled-right bg-info text-white',
        //     header: e.data.title
        // });
        show_stack_custom_top('info', e.data.title, e.data.message);

        if(e.data.broadCast  == broadCastroom) {
            notification.trigger()
        }
    }
});