// Like/Dislike Supportive Functions

$.fn.extend({
    toggleText: function (a, b) {
        return this.text(this.text() == a ? b : a);
    },
    isLikedOrDisliked: function() {
        return this.text() == 'Liked' || this.text() == 'Disliked';
    },
    replaceClass: function(a, b) {
        this.removeClass(a);
        this.addClass(b);
        return this;
    },
    increaseActionCount: function() {
        return this.text( parseInt(this.text()) + 1 );
    },
    decreaseActionCount: function() {
        return this.text( parseInt(this.text()) - 1 );
    }
});

// Like/Dislike Global Function

function do_like_dislike(like, dislike, model, likeableID, actionType) {

    let likeText = like.find('span.action-text');
    let dislikeText = dislike.find('span.action-text');

    let likeCount = like.find('span.action-count');
    let dislikeCount = dislike.find('span.action-count');

    if (actionType) {
        likeText.toggleText('Like', 'Liked');
        if ( dislikeText.isLikedOrDisliked() ) {
            dislikeText.text('Dislike');
            dislikeCount.decreaseActionCount();
        }

        if ( likeText.text() == 'Liked' ) {
            likeCount.increaseActionCount();
        } else {
            likeCount.decreaseActionCount();
        }
    } else {
        dislikeText.toggleText('Dislike', 'Disliked');
        if ( likeText.isLikedOrDisliked() ) {
            likeText.text('Like');
            likeCount.decreaseActionCount();
        }

        if ( dislikeText.text() == 'Disliked' ) {
            dislikeCount.increaseActionCount();
        } else {
            dislikeCount.decreaseActionCount();
        }
    }

    axios.post('/' + model + '/' + likeableID + (actionType ? '/like' : '/dislike'))
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.error(error);
        });
}

// Post Like/Dislike Functionality

$('.post-likebox').on('click', 'button', function(e) {
    let postID = $(this).parent().attr('data-post-id');
    if ( $(this).hasClass('post-like') ) {

        let like = $(this);
        let dislike = $(this).next();

        like.toggleClass('btn-success btn-outline-success');
        dislike.replaceClass('btn-danger', 'btn-outline-danger');

        do_like_dislike(like, dislike, 'post', postID, true);

    } else if ( $(this).hasClass('post-dislike') ) {

        let dislike = $(this);
        let like = $(this).prev();

        dislike.toggleClass('btn-danger btn-outline-danger');
        like.replaceClass('btn-success', 'btn-outline-success');

        do_like_dislike(like, dislike, 'post', postID, false);

    }
});

// Comment Like/Dislike Functionality

$('.comment-actionbox').on('click', 'a', function(e) {
    let commentID = $(this).parent().attr('data-comment-id');
    if ( $(this).hasClass('comment-like') ) {

        let like = $(this);
        let dislike = $(this).next();

        like.toggleClass('text-success');
        dislike.removeClass('text-danger');

        do_like_dislike(like, dislike, 'comment', commentID, true);

    } else if ( $(this).hasClass('comment-dislike') ) {

        let dislike = $(this);
        let like = $(this).prev();

        dislike.toggleClass('text-danger');
        like.removeClass('text-success');

        do_like_dislike(like, dislike, 'comment', commentID, false);

    } else if ( $(this).hasClass('comment-reply') ) {

        $(this).toggleClass('text-primary');

        let replyBox = $(this).closest('.comment').children('.reply-box');
        replyBox.fadeToggle('slow');
        replyBox.find('textarea').trigger('focus');

    } else if ( $(this).hasClass('comment-edit') ) {

        let parent = $(this).closest('.flex-row');
        parent.children('.comment-content').hide();
        parent.children('.comment-edit-box').fadeIn();

    } else if ( $(this).hasClass('comment-delete') ) {

        let form = $(this).parent();
        form.trigger('submit');

    }
});

// Reply Like/Dislike Functionality

$('.reply-actionbox').on('click', 'a', function(e) {
    let commentID = $(this).parent().attr('data-reply-id');
    if ( $(this).hasClass('reply-like') ) {

        let like = $(this);
        let dislike = $(this).next();

        like.toggleClass('text-success');
        dislike.removeClass('text-danger');

        do_like_dislike(like, dislike, 'reply', commentID, true);

    } else if ( $(this).hasClass('reply-dislike') ) {

        let dislike = $(this);
        let like = $(this).prev();  

        dislike.toggleClass('text-danger');
        like.removeClass('text-success');

        do_like_dislike(like, dislike, 'reply', commentID, false);

    } else if ( $(this).hasClass('reply-edit') ) {

        let parent = $(this).closest('.flex-row');
        parent.children('.reply-content').hide();
        parent.children('.reply-edit-box').fadeIn();

    } else if ( $(this).hasClass('reply-delete') ) {

        let form = $(this).parent();
        form.trigger('submit');
        
    }
});

// User Post Like/Dislike Functionality

$('.post-actionbox').on('click', 'a', function(e) {
    let postID = $(this).parent().attr('data-post-id');
    if ( $(this).hasClass('user-post-like') ) {

        let like = $(this);
        let dislike = $(this).next();

        like.toggleClass('text-success');
        dislike.removeClass('text-danger');

        do_like_dislike(like, dislike, 'post', postID, true);

    } else if ( $(this).hasClass('user-post-dislike') ) {

        let dislike = $(this);
        let like = $(this).prev();  

        dislike.toggleClass('text-danger');
        like.removeClass('text-success');

        do_like_dislike(like, dislike, 'post', postID, false);

    } else if ( $(this).hasClass('user-post-comment') ) {

        

    }
});

// Comment Edit Cancel Button Functionality

$('.comment-edit-box-cancel').on('click', function(e) {
    let parent = $(this).closest('.flex-row');
    parent.children('.comment-edit-box').hide();
    parent.children('.comment-content').fadeIn();
})

$('.reply-edit-box-cancel').on('click', function(e) {
    let parent = $(this).closest('.flex-row');
    parent.children('.reply-edit-box').hide();
    parent.children('.reply-content').fadeIn();
})