// Like and Dislike Functionality

let postLike = document.getElementById('post-like');
let postDislike = document.getElementById('post-dislike');

postLike.onclick = function() {
    axios.get(window.location.href + '/like')
        .then(function (response) {
            if (response.data == 'added') {
                postLike.classList.remove('btn-outline-success');
                postLike.classList.add('btn-success');
            } else if (response.data == 'deleted') {
                postLike.classList.remove('btn-success');
                postLike.classList.add('btn-outline-success');
            } else if (response.data == 'toggled') {
                postLike.classList.remove('btn-outline-success');
                postLike.classList.add('btn-success');
                postDislike.classList.remove('btn-danger');
                postDislike.classList.add('btn-outline-danger');
            }
        })
        .catch(function (error) {
            console.log(error);
        })
}

postDislike.onclick = function() {
    axios.get(window.location.href + '/dislike')
        .then(function (response) {
            if (response.data == 'added') {
                postDislike.classList.remove('btn-outline-danger');
                postDislike.classList.add('btn-danger');
            } else if (response.data == 'deleted') {
                postDislike.classList.remove('btn-danger');
                postDislike.classList.add('btn-outline-danger');
            } else if (response.data == 'toggled') {
                postDislike.classList.remove('btn-outline-danger');
                postDislike.classList.add('btn-danger');
                postLike.classList.remove('btn-success');
                postLike.classList.add('btn-outline-success');
            }
        })
        .catch(function (error) {
            console.log(error);
        })
}