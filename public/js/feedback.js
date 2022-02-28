var likeIcon = document.getElementById("like-feedback");
var dislikeIcon = document.getElementById("dislike-feedback");
var feedbackContainer = document.getElementById("feedback-container");

likeIcon.addEventListener(
    "click",
    function(e) {
        e.preventDefault();
        feedbackContainer.classList.toggle('feedbackPromptOff');
        feedbackContainer.classList.toggle('likeFeedbackOn');
        ga('send', 'event', 'Feedback', 'Useful', 'Guides Page', 1);
    });

dislikeIcon.addEventListener(
    "click",
    function(e) {
        e.preventDefault();
        feedbackContainer.classList.toggle('feedbackPromptOff');
        feedbackContainer.classList.toggle('dislikeFeedbackOn');
        ga('send', 'event', 'Feedback', 'Not Useful', 'Guides Page', 0);
    });