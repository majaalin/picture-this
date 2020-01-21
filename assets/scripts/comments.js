"use strict";

const commentForms = document.querySelectorAll(".comment-form");

commentForms.forEach(form => {
    form.addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(form);

        fetch("http://localhost:8000/app/posts/comments.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                // Take the response Promise and return it as JSON.
                return response.json();
            })
            .then(json => {
                // Now it is possible to use the JSON as a normal object.

                const newComment = json.comment;
                const newAuthor = json.name;
                const comment = e.target.querySelector(".comment");
                const author = e.target.querySelector(".author");

                comment.innerHTML = newComment;
                author.innerHTML = newAuthor;
            });
    });
});

// const editBtns = document.querySelectorAll(".edit-comment");
// const modals = document.querySelectorAll(".modal");

// editBtns.forEach(btn => {
//     btn.addEventListener("click", e => {
//         modals.forEach(modal => {
//             modal.style.display = "block";
//         });
//     });
// });
