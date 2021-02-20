// Like and Dislike Functionality

let postLike = document.getElementById('post-like');
let postDislike = document.getElementById('post-dislike');

function is_liked() {
    return postLike.classList.contains('btn-success');
}

function is_disliked() {
    return postDislike.classList.contains('btn-danger');
}

function is_liked_or_disliked() {
    return is_liked() || is_disliked();
}

function toggle_like() {
    if ( is_liked() ) {
        
    }
}

postLike.onclick = function() {
    
    if ( is_liked_or_disliked() ) {
        if ( is_liked() ) {
            postLike.classList.remove('btn-success');
            postLike.classList.add('btn-outline-success');
            postLike.lastElementChild.textContent = "Like";
        } else {
            postLike.classList.remove('btn-outline-success');
            postLike.classList.add('btn-success');
            postDislike.classList.remove('btn-danger');
            postDislike.classList.add('btn-outline-danger');
            postLike.lastElementChild.textContent = "Liked";
            postDislike.lastElementChild.textContent = "Dislike"
        }
    } else {
        postLike.classList.remove('btn-outline-success');
        postLike.classList.add('btn-success');
        postLike.lastElementChild.textContent = "Liked";
    }

    axios.get(window.location.href + '/like')
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.error(error);
        })
}

postDislike.onclick = function() {
    
    if ( is_liked_or_disliked() ) {
        if ( is_disliked() ) {
            postDislike.classList.remove('btn-danger');
            postDislike.classList.add('btn-outline-danger');
            postDislike.lastElementChild.textContent = "Dislike";
        } else {
            postDislike.classList.remove('btn-outline-danger');
            postDislike.classList.add('btn-danger');
            postLike.classList.remove('btn-success');
            postLike.classList.add('btn-outline-success');
            postDislike.lastElementChild.textContent = "Disliked"
            postLike.lastElementChild.textContent = "Like";
        }
    } else {
        postDislike.classList.remove('btn-outline-danger');
        postDislike.classList.add('btn-danger');
        postDislike.lastElementChild.textContent = "Disliked"
    }

    axios.get(window.location.href + '/dislike')
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.error(error);
        })
}