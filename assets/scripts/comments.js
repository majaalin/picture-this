"use strict";
//<li class="comment" data-id="${id}">

function createComment(author, comment) {
    return `<li class="comment">
                <p class="comment-text">
                <span>${author}</span> 
                ${comment}</p>
                <button class="edit-comment">Edit</button>
            </li>`;
}

const stringToHTML = str => {
    const div = document.createElement("div");
    div.innerHTML = str;
    return div.firstChild;
};

// ADD COMMMENTS
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
                // const id = json.id;
                const newAuthor = json.name;
                const newComment = json.comment;

                const addComment = createComment(newAuthor, newComment);
                const comment = stringToHTML(addComment);

                list.appendChild(comment);
                form.reset();
            });
    });
});

// EDIT & DELETE COMMENTS
const comments = document.querySelectorAll(".comment");

comments.forEach(comment => {
    const editBtn = comment.querySelector(".edit-btn");
    const hiddenForm = comment.querySelector(".hide");
    const editForm = comment.querySelector(".edit-form");
    const deleteForm = comment.querySelector(".delete-form");
    const id = comment.dataset.id;

    editBtn.addEventListener("click", e => {
        hiddenForm.classList.add("visible");
    });

    editForm.addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(editForm);

        fetch("http://localhost:8000/app/posts/edit-comment.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                comment.innerHTML = `<p class="comment-text">
                <span>${json.name}</span> 
                ${json.comment}</p>
                <button class="edit-comment">Edit</button>`;

                hiddenForm.classList.remove("visible");

                console.log(id);
            });
    });

    deleteForm.addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(deleteForm);

        fetch("http://localhost:8000/app/posts/delete-comment.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                console.log(json);

                const parent = comment;
                parent.parentNode.removeChild(parent);

                hiddenForm.classList.remove("visible");
            });
    });
});
