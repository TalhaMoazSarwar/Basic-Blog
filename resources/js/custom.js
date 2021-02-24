// Post Like and Dislike Functionality

let postLike = document.getElementById('post-like');
let postDislike = document.getElementById('post-dislike');

function is_liked(el) {
    // return e.classList.contains('btn-success');
    return el.textContent.trim() == "Liked";
}

function is_disliked(el) {
    // return e.classList.contains('btn-danger');
    return el.textContent.trim() == "Disliked";
}

function is_liked_or_disliked(el1, el2) {
    return is_liked(el1) || is_disliked(el2);
}

if (!!postLike || !!postDislike) {

    postLike.onclick = function() {
        
        if ( is_liked_or_disliked(postLike, postDislike) ) {
            if ( is_liked(postLike) ) {
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

        axios.post(window.location.href + '/like')
            .then(function (response) {
                console.log(response.data);
            })
            .catch(function (error) {
                console.error(error);
            })
    }

    postDislike.onclick = function() {
        
        if ( is_liked_or_disliked(postLike, postDislike) ) {
            if ( is_disliked(postDislike) ) {
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

        axios.post(window.location.href + '/dislike')
            .then(function (response) {
                console.log(response.data);
            })
            .catch(function (error) {
                console.error(error);
            })
    }

}

let commentLikes = document.getElementsByClassName('comment-like');
let commentDislikes = document.getElementsByClassName('comment-dislike');

if (!!commentLikes) {

    Array.from(commentLikes).forEach(function (el) {
        el.addEventListener('click', function(event) {
            let like = event.target;
            let dislike = event.target.nextElementSibling;
            let commentID = like.parentElement.getAttribute('data-comment-id');

            if ( is_liked_or_disliked(like, dislike) ) {
                if ( is_liked(like) ) {
                    like.textContent = "Like";
                } else {
                    like.textContent = "Liked";
                    dislike.textContent = "Dislike"
                }
            } else {
                like.textContent = "Liked";
            }

            axios.post('/comment/'+commentID+'/like')
                .then(function (response) {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.error(error);
                })

        })
    });

    Array.from(commentDislikes).forEach(function (el) {
        el.addEventListener('click', function(event) {
            let dislike = event.target;
            let like = event.target.previousElementSibling;
            let commentID = dislike.parentElement.getAttribute('data-comment-id');

            if ( is_liked_or_disliked(like, dislike) ) {
                if ( is_disliked(dislike) ) {
                    dislike.textContent = "Dislike";
                } else {
                    dislike.textContent = "Disliked";
                    like.textContent = "Like"
                }
            } else {
                dislike.textContent = "Disliked";
            }

            axios.post('/comment/'+commentID+'/dislike')
                .then(function (response) {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.error(error);
                })

        })
    });

}