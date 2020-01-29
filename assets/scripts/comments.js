"use strict";

function createComment(author, comment) {
    return `<li class="comment">
                <p class="comment-text">
                <span>${author}</span> 
                ${comment}</p>
                <button class="edit-btn">Edit</button>
                <div class="hidden">
                        <form class="edit-form" action="/app/posts/edit-comment.php" method="post">
                            <input class="comment-input" type="text" name="edit-comment" id="edit-comment" value="">
                            <input type="hidden" name="comment-id" id="comment-id" value="">
                            <input type="hidden" name="username" id="username" value="">
                            <button class="edit-comment" type="submit">Save</button>
                        </form>
                        <form class="delete-form" action="/app/posts/delete-comment.php" method="post">
                            <input type="hidden" name="comment-id" id="comment-id" value="">
                            <input type="hidden" name="author-id" id="author-id" value="">
                            <button class="delete-comment" type="submit">Delete</button>
                        </form>
                    </div>
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
    const hiddenForm = comment.querySelector(".hidden");
    const editForm = comment.querySelector(".edit-form");
    const deleteForm = comment.querySelector(".delete-form");
    const id = comment.dataset.id;

    if (editBtn) {
        editBtn.addEventListener("click", e => {
            hiddenForm.classList.add("visible");
            hiddenForm.classList.add("flex-row");
            comment.classList.add("flex-column");
            editBtn.classList.add("hidden");
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
                    <button class="edit-btn">Edit</button>`;

                    hiddenForm.classList.remove("visible");
                    comment.classList.remove("flex-column");
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
                    const parent = comment;
                    parent.parentNode.removeChild(parent);

                    hiddenForm.classList.remove("visible");
                });
        });
    }
});
