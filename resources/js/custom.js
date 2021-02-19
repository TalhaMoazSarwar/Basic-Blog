// Like and Dislike Functionality

let postLike = document.getElementById('post-like');
let postDislike = document.getElementById('post-dislike');

postLike.onclick = function() {
    axios.get(window.location.href + '/like')
        .then(function (response) {
            if (response.data == 'added') {
                postLike.classList.remove('btn-outline-success');
                postLike.classList.add('btn-success');
                postLike.lastElementChild.textContent = "Liked";
            } else if (response.data == 'deleted') {
                postLike.classList.remove('btn-success');
                postLike.classList.add('btn-outline-success');
                postLike.lastElementChild.textContent = "Like";
            } else if (response.data == 'toggled') {
                postLike.classList.remove('btn-outline-success');
                postLike.classList.add('btn-success');
                postDislike.classList.remove('btn-danger');
                postDislike.classList.add('btn-outline-danger');
                postLike.lastElementChild.textContent = "Liked";
                postDislike.lastElementChild.textContent = "Dislike"
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
                postDislike.lastElementChild.textContent = "Disliked"
            } else if (response.data == 'deleted') {
                postDislike.classList.remove('btn-danger');
                postDislike.classList.add('btn-outline-danger');
                postDislike.lastElementChild.textContent = "Dislike"
            } else if (response.data == 'toggled') {
                postDislike.classList.remove('btn-outline-danger');
                postDislike.classList.add('btn-danger');
                postLike.classList.remove('btn-success');
                postLike.classList.add('btn-outline-success');
                postDislike.lastElementChild.textContent = "Disliked"
                postLike.lastElementChild.textContent = "Like";
            }
        })
        .catch(function (error) {
            console.log(error);
        })
}