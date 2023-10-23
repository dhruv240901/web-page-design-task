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
    })

})
