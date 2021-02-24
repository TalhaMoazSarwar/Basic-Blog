// Post Like and Dislike Functionality

let postLike = document.getElementById('post-like');
let postDislike = document.getElementById('post-dislike');

function is_liked(el) {
    // return e.classList.contains('btn-success');
    return el.text().trim() == "Liked";
}

function is_disliked(el) {
    // return e.classList.contains('btn-danger');
    return el.text().trim() == "Disliked";
}

function is_liked_or_disliked(el1, el2) {
    return is_liked(el1) || is_disliked(el2);
}

function toggle_like(like, dislike) {
    if (is_liked(like)) {
        like.text('Like');
        dislike.text('Disliked');
    } else {
        like.text('Liked');
        dislike.text('Dislike');
    }
}

// if (!!postLike || !!postDislike) {

//     postLike.onclick = function() {
        
//         if ( is_liked_or_disliked(postLike, postDislike) ) {
//             if ( is_liked(postLike) ) {
//                 postLike.classList.remove('btn-success');
//                 postLike.classList.add('btn-outline-success');
//                 postLike.lastElementChild.textContent = "Like";
//             } else {
//                 postLike.classList.remove('btn-outline-success');
//                 postLike.classList.add('btn-success');
//                 postDislike.classList.remove('btn-danger');
//                 postDislike.classList.add('btn-outline-danger');
//                 postLike.lastElementChild.textContent = "Liked";
//                 postDislike.lastElementChild.textContent = "Dislike"
//             }
//         } else {
//             postLike.classList.remove('btn-outline-success');
//             postLike.classList.add('btn-success');
//             postLike.lastElementChild.textContent = "Liked";
//         }

//         axios.post(window.location.href + '/like')
//             .then(function (response) {
//                 console.log(response.data);
//             })
//             .catch(function (error) {
//                 console.error(error);
//             })
//     }

//     postDislike.onclick = function() {
        
//         if ( is_liked_or_disliked(postLike, postDislike) ) {
//             if ( is_disliked(postDislike) ) {
//                 postDislike.classList.remove('btn-danger');
//                 postDislike.classList.add('btn-outline-danger');
//                 postDislike.lastElementChild.textContent = "Dislike";
//             } else {
//                 postDislike.classList.remove('btn-outline-danger');
//                 postDislike.classList.add('btn-danger');
//                 postLike.classList.remove('btn-success');
//                 postLike.classList.add('btn-outline-success');
//                 postDislike.lastElementChild.textContent = "Disliked"
//                 postLike.lastElementChild.textContent = "Like";
//             }
//         } else {
//             postDislike.classList.remove('btn-outline-danger');
//             postDislike.classList.add('btn-danger');
//             postDislike.lastElementChild.textContent = "Disliked"
//         }

//         axios.post(window.location.href + '/dislike')
//             .then(function (response) {
//                 console.log(response.data);
//             })
//             .catch(function (error) {
//                 console.error(error);
//             })
//     }

// }

function do_like_dislike(like, dislike, model, likeableID, actionType) {

    if ( is_liked_or_disliked(like, dislike) ) {
        if ( is_liked(like) == actionType ) {
            actionType ? like.text('Like') : dislike.text('Dislike');
        } else {
            toggle_like(like, dislike);
        }
    } else {
        actionType ? like.text('Liked') : dislike.text('Disliked');
    }

    axios.post('/' + model + '/' + likeableID + (actionType ? '/like' : '/dislike'))
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.error(error);
        })
}

$('.post-likebox').on('click', 'button', function(e) {
    let postID = $(this).parent().attr('data-post-id');
    if ( $(this).hasClass('post-like') ) {

        let like = $(this);
        let dislike = $(this).next();
        do_like_dislike(like, dislike, 'post', postID, true);

    } else if ( $(this).hasClass('post-dislike') ) {

        let dislike = $(this);
        let like = $(this).prev();  
        do_like_dislike(like, dislike, 'post', postID, false);

    }
});

$('.comment-actionbox').on('click', 'a', function(e) {
    let commentID = $(this).parent().attr('data-comment-id');
    if ( $(this).hasClass('comment-like') ) {

        let like = $(this);
        let dislike = $(this).next();
        do_like_dislike(like, dislike, 'comment', commentID, true);

    } else if ( $(this).hasClass('comment-dislike') ) {

        let dislike = $(this);
        let like = $(this).prev();  
        do_like_dislike(like, dislike, 'comment', commentID, false);

    }
});