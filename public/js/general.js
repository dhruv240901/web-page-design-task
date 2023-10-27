$(document).ready(function () {
    $(".profile-card").hide();

    $("#sidenav-btn").click(function () {
        $("aside").toggle();
    });
    $("#msg-btn").click(function () {
        $(".message-list").slideToggle();
    });

    let datetime = new Date();
    let hour = datetime.getHours() % 12 || 12;
    let minute = datetime.getMinutes();
    let day = datetime.getDay();
    let weekday;
    if (day == 0) {
        weekday = "Sunday";
    } else if (day == 1) {
        weekday = "Monday";
    } else if (day == 2) {
        weekday = "Tuesday";
    } else if (day == 3) {
        weekday = "Wednesday";
    } else if (day == 4) {
        weekday = "Thursday";
    } else if (day == 5) {
        weekday = "Friday";
    } else if (day == 6) {
        weekday = "Saturday";
    }

    $(".datetime").html(hour + ":" + minute + "<br>" + weekday);
    setInterval(() => {
        let datetime = new Date();
        let hour = datetime.getHours() % 12 || 12;
        let minute = datetime.getMinutes();
        $(".datetime").html(hour + ":" + minute + "<br>" + weekday);
    }, 1000);
    $("#message").delay(3000).fadeOut();

    // Validate Firstname
    $("#exampleInputfirstname-error").hide();
    let firstnameError = true;
    $("#firstname").keyup(function () {
        validateFirstname();
    });

    function validateFirstname() {
        let firstnameValue = $("#firstname").val();
        if (firstnameValue.length == "") {
            $("#exampleInputfirstname-error").show();
            $("#exampleInputfirstname-error").html("Please enter firstname");
            firstnameError = false;
            return false;
        } else {
            $("#exampleInputfirstname-error").hide();
        }
    }

    // Validate Lastname
    $("#exampleInputlastname-error").hide();
    let lastnameError = true;
    $("#lastname").keyup(function () {
        validateLastname();
    });

    function validateLastname() {
        let lastnameValue = $("#lastname").val();
        if (lastnameValue.length == "") {
            $("#exampleInputlastname-error").show();
            $("#exampleInputlastname-error").html("Please enter lastname");
            lastnameError = false;
            return false;
        } else {
            $("#exampleInputlastname-error").hide();
        }
    }

    // Validate Email
    $("#exampleInputEmail-error").hide();
    let emailError = true;
    $("#Email").keyup(function () {
        validateEmail();
    });

    function validateEmail() {
        let emailValue = $("#Email").val();
        let regex =
            /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if (emailValue.length == "") {
            $("#exampleInputEmail-error").show();
            $("#exampleInputEmail-error").html("Please enter email");
            emailError = false;
            return false;
        } else if (!regex.test(emailValue)) {
            $("#exampleInputEmail-error").show();
            $("#exampleInputEmail-error").html("Please enter valid email");
            emailError = false;
            return false;
        } else {
            $("#exampleInputEmail-error").hide();
        }
    }

    // Validate Phone
    $("#exampleInputPhone-error").hide();
    let phoneError = true;
    $("#Phone").keyup(function () {
        validatePhone();
    });

    function validatePhone() {
        let phoneValue = $("#Phone").val();
        if (phoneValue.length == "") {
            $("#exampleInputPhone-error").show();
            $("#exampleInputPhone-error").html("Please enter phone number");
            phoneError = false;
            return false;
        }else if(phoneValue.length != 10){
            $("#exampleInputPhone-error").show();
            $("#exampleInputPhone-error").html("Please enter valid phone number");
            phoneError = false;
            return false;
        }
        else {
            $("#exampleInputPhone-error").hide();
        }
    }

    // Submit button
    // $("#adduserbtn").click(function () {
    //     validateFirstname();
    //     validateLastname();
    //     validateEmail();
    //     validatePhone();
    //     if (
    //         firstnameError == true &&
    //         lastnameError == true &&
    //         emailError == true &&
    //         phoneError==true
    //     ) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // });

});

// Validate Signup Form
$("#signupform").validate({
    rules: {
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        phone:{
            required: true,
            number: true,
            minlength:10,
            maxlength:10
        },
        password: {
            required: true,
            minlength: 6,
        },
        confirmpassword:{
            required:true,
            minlength: 6,
            equalTo: "#password"
        }
    },
    messages: {
        firstname: "Please enter your firstname",
        lastname:"Please enter your lastname",
        email: {
            required: "Please enter your email",
            email: "Please enter valid email",
        },
        phone:{
            required: "Please enter your phone number",
            number: "Please enter valid phone number",
            minlength:"Please enter valid phone number",
            maxlength:"Please enter valid phone number"
        },
        password: {
            required: "Please enter password",
            minlength:"Please enter password greater than or equal to 6 characters",
        },
        confirmpassword: {
            required: "Please enter password",
            minlength:"Please enter password greater than or equal to 6 characters",
            equalTo:"Please enter the same password as above"
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

// Validate Login Form
$("#loginform").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 6,
        },
    },
    messages: {
        email: {
            required: "Please enter your email",
            email: "Please enter valid email",
        },
        password: {
            required: "Please enter password",
            minlength:
                "Please enter password greater than or equal to 6 characters",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

// $("#adduserbtn").click(function () {
//     $("#adduserform").validate({
//         rules: {
//             firstname: {
//                 required: true,
//             },
//             lastname: {
//                 required: true,
//             },
//             email: {
//                 required: true,
//                 email: true,
//             },
//             phone: {
//                 required: true,
//                 minlength: 10,
//                 maxlength: 10,
//             },
//         },
//         messages: {
//             firstname: {
//                 required: "Please enter firstname",
//             },
//             lastname: {
//                 required: "Please enter lastname",
//             },
//             email: {
//                 required: "Please enter email",
//                 email: "Please enter valid email",
//             },
//             phone: {
//                 required: "Please enter phone number",
//                 minlength: "Please enter valid phone number",
//                 maxlength: "Please enter valid phone number",
//             },
//         },
//         submitHandler: function (form) {
//             form.submit();
//         },
//     });
// });

$("#edituserform").validate({
    rules: {
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        phone: {
            required: true,
            minlength: 10,
            maxlength: 10,
        },
    },
    messages: {
        firstname: {
            required: "Please enter firstname",
        },
        lastname: {
            required: "Please enter lastname",
        },
        email: {
            required: "Please enter email",
            email: "Please enter valid email",
        },
        phone: {
            required: "Please enter phone number",
            minlength: "Please enter valid phone number",
            maxlength: "Please enter valid phone number",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});
