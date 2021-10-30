(function () {
    var current = location.pathname;
    if (current === "") return;

    if (current.includes('post')) {
        var post = document.querySelectorAll('#post a');
        post[0].classList.add('active');
    } else if (current.includes('chat')) {
        var chat = document.querySelectorAll('#chat a');
        chat[0].classList.add('active');
    } else if (current.includes('profile')) {
        var profile = document.querySelectorAll('#profile a');
        profile[0].classList.add('active');
    } else if (current.includes('saved')) {
        var saved = document.querySelectorAll('#saved a');
        saved[0].classList.add('active');
    } else {
        var home = document.querySelectorAll('#home a');
        home[0].classList.add('active');
    }

})();