$(document).ready(function() {
    $('.profile-card').hide()

    $('#sidenav-btn').click(function() {
        $('aside').toggle()
    });
    $('#msg-btn').click(function() {
        $('.message-list').slideToggle()
    })
    $('#profile-icon').click(function() {
        $('.profile-card').toggle()
        $('.day-time').toggle()
    })
    let datetime = new Date();
    let hour = datetime.getHours() % 12 || 12;
    let minute = datetime.getMinutes();
    let day = datetime.getDay();
    let weekday
    if (day == 0) {
        weekday = 'Sunday'
    } else if (day == 1) {
        weekday = 'Monday'
    } else if (day == 2) {
        weekday = 'Tuesday'
    } else if (day == 3) {
        weekday = 'Wednesday'
    } else if (day == 4) {
        weekday = 'Thursday'
    } else if (day == 5) {
        weekday = 'Friday'
    } else if (day == 6) {
        weekday = 'Saturday'
    }

    $('.datetime').html(hour + ':' + minute + '<br>' + weekday)
    setInterval(() => {
        let datetime = new Date();
        let hour = datetime.getHours() % 12 || 12;
        let minute = datetime.getMinutes();
        $('.datetime').html(hour + ':' + minute + '<br>' + weekday)
    }, 1000);
    $('#message').delay(3000).fadeOut();
})

$('#signupform').validate({
    rules:{
        name:{
            required:true
        },
        email:{
            required:true,
            email:true
        },
        password:{
            required:true,
            minlength:6,
        },
    },
    messages:{
        name:"Please enter your name",
        email:{
            required:"Please enter your email",
            email:"Please enter valid email"
        },
        password:{
            required:"Please enter password",
            minlength:"Please enter password greater than or equal to 6 characters",
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
})

$('#loginform').validate({
    rules:{
        email:{
            required:true,
            email:true
        },
        password:{
            required:true,
            minlength:6,
        },
    },
    messages:{
        email:{
            required:"Please enter your email",
            email:"Please enter valid email"
        },
        password:{
            required:"Please enter password",
            minlength:"Please enter password greater than or equal to 6 characters",
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
})



