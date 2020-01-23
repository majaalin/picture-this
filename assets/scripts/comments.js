"use strict";

function createComment(author, comment) {
    return `<p class="comment">
                <span>${author}</span> 
                ${comment}
            </p>`;
}

const allPosts = document.querySelectorAll(".all-posts-container");

allPosts.forEach(post => {
    const form = post.querySelector(".comment-form");
    const list = post.querySelector(".comment-list");

    form.addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(form);

        fetch("http://localhost:8000/app/posts/comments.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                // console.log(json);
                // const comment = createComment(newAuthor, newComment);
                // console.log(comment);

                const newComment = json.comment;
                const newAuthor = json.name;

                const item = document.createElement("li");

                item.textContent = newAuthor + " " + newComment;
                item.classList.add("comments");

                // item.appendChild(comment);
                list.appendChild(item);

                form.reset();
            });
    });
});

// commentForms.forEach(form => {
//     form.addEventListener("submit", e => {
//         e.preventDefault();
//         const formData = new FormData(form);

//         fetch("http://localhost:8000/app/posts/comments.php", {
//             method: "POST",
//             body: formData
//         })
//             .then(response => {
//                 // Take the response Promise and return it as JSON.
//                 return response.json();
//             })
//             .then(json => {
//                 // Now it is possible to use the JSON as a normal object.
//
//                 // // const newComment = json.comment;
//                 // // const newAuthor = json.name;
//                 // // const comment = e.target.querySelector(".comment");
//                 // // const author = e.target.querySelector(".author");

//                 // // comment.innerHTML = newComment;
//                 // // author.innerHTML = newAuthor;
//                 // form.reset();
//             });
//     });
// });

// EDIT COMMENTS
// const editForms = document.querySelectorAll(".edit-form");

// editForms.forEach(form => {
//     form.addEventListener("submit", e => {
//         e.preventDefault();
//         const formData = new FormData(form);

//         fetch("http://localhost:8000/app/posts/edit-comment.php", {
//             method: "POST",
//             body: formData
//         })
//             .then(response => {
//                 // Take the response Promise and return it as JSON.
//                 return response.json();
//             })
//             .then(json => {
//                 // Now it is possible to use the JSON as a normal object.

//                 console.log(json);
//             });
//     });
// });
