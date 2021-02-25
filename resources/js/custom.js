// Post Like and Dislike Functionality

let postLike = document.getElementById('post-like');
let postDislike = document.getElementById('post-dislike');

function is_liked(el) {
    return el.text().trim() == "Liked";
}

function is_disliked(el) {
    return el.text().trim() == "Disliked";
}

function is_liked_or_disliked(el1, el2) {
    return is_liked(el1) || is_disliked(el2);
}

function toggle_like(like, dislike, isPost) {
    if (is_liked(like)) {
        like.find('span').text('Like');
        dislike.find('span').text('Disliked');
    } else {
        like.find('span').text('Liked');
        dislike.find('span').text('Dislike');
    }
}

function do_like_dislike(like, dislike, model, likeableID, actionType) {

    if ( is_liked_or_disliked(like, dislike) ) {
        let liked = is_liked(like);
        if ( liked == actionType ) {
            if (actionType) {
                if (model == 'post') {
                    like.removeClass('btn-success');
                    like.addClass('btn-outline-success');
                } else {
                    like.removeClass('text-primary');
                }
                like.find('span').text('Like');
            } else {
                if (model == 'post') {
                    dislike.removeClass('btn-danger');
                    dislike.addClass('btn-outline-danger');
                } else {
                    dislike.removeClass('text-primary');
                }
                dislike.find('span').text('Dislike');
            }
        } else {
            if (model == 'post') {
                if ( liked ) {
                    like.removeClass('btn-success');
                    like.addClass('btn-outline-success');
                    dislike.addClass('btn-danger');
                    dislike.removeClass('btn-outline-danger');
                } else {
                    like.addClass('btn-success');
                    like.removeClass('btn-outline-success');
                    dislike.removeClass('btn-danger');
                    dislike.addClass('btn-outline-danger');
                }
            } else {
                if ( liked ) {
                    like.removeClass('text-primary');
                    dislike.addClass('text-primary');
                } else {
                    like.addClass('text-primary');
                    dislike.removeClass('text-primary');
                }
            }
            toggle_like(like, dislike);
        }
    } else {
        if (actionType) {
            if (model == 'post') {
                like.addClass('btn-success');
                like.removeClass('btn-outline-success');
            } else {
                like.addClass('text-primary');
            }
            like.find('span').text('Liked');
        } else {
            if (model == 'post') {
                dislike.addClass('btn-danger');
                dislike.removeClass('btn-outline-danger');
            } else {
                dislike.addClass('text-primary');
            }
            dislike.find('span').text('Disliked');
        }
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