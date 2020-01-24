"use strict";
//<li class="comment" data-id="${id}">

function createComment(author, comment) {
    return `<li class="comment">
                <p class="comment-text">
                <span>${author}</span> 
                ${comment}</p>
                <button class="delete-comment">Delete</button>
                <button class="edit-comment">Edit</button>
            </li>`;
}
// tror inte jag behöver ha med id här? behövs ju endast i edit/delete eller?

const stringToHTML = str => {
    const div = document.createElement("div");
    div.innerHTML = str;
    return div.firstChild;
};
// funkar nu med template literal

const comment = document.querySelector(".comment");
const id = comment.dataset.id;
console.log(id);

const editBtn = document.querySelector(".edit-btn");
const editForm = document.querySelector(".edit-form");
const editInput = document.querySelector(".edit-input");
const hide = document.querySelector(".hide");

editBtn.addEventListener("click", e => {
    hide.classList.add("visible");
});

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

                // const id = json.id;
                const newAuthor = json.name;
                const newComment = json.comment;

                const comment = createComment(newAuthor, newComment);
                const x = stringToHTML(comment);
                console.log(x);

                // const item = document.createElement("li");

                // item.textContent = newAuthor + " " + newComment;
                // item.classList.add("comment");

                // item.appendChild(comment);
                list.appendChild(x);

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
