const commentBtn = document.getElementById('comment-btn');
const commentInput = document.getElementById('comment-input');

commentBtn.addEventListener('click', () => {
    if (commentInput.style.display === '') {
        commentInput.style.display = 'block';
    } else {
        commentInput.style.display = '';
    }
});
