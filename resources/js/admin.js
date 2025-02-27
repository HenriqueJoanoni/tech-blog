function updateVisibility(event, postId) {
    event.preventDefault();

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }

    const button = event.currentTarget;
    const icon = button.querySelector('i');

    fetch(`/admin/${postId}/toggle-visibility`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            is_visible: icon.classList.contains('fa-eye') ? 0 : 1
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Post visibility updated",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                button.title = data.is_visible ? 'Hide post' : 'Show post';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Error updating visibility',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
}

function deleteUser() {
    document.querySelectorAll('.delete-user-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            const itemId = this.getAttribute('data-id');
            const itemName = this.getAttribute('data-name');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            Swal.fire({
                title: "Delete: " + itemName + " ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007bff",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Delete anyway"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/user/delete-user/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "User " + itemName + " has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to delete the user.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error deleting this user',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        });
    });
}

function deletePost() {
    document.querySelectorAll('.delete-post-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            const itemId = this.getAttribute('data-post-id');
            const itemName = this.getAttribute('data-post-name');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            Swal.fire({
                title: "Delete: " + itemName + " ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007bff",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Delete anyway"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/delete-post/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Post " + itemName + " has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to delete this post.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error deleting this post',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        });
    });
}

function deleteCategory() {
    document.querySelectorAll('.delete-category-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            const itemId = this.getAttribute('data-category-id');
            const itemName = this.getAttribute('data-category-name');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            Swal.fire({
                title: "Delete: " + itemName + " ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007bff",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Delete anyway"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/categories/delete/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Category " + itemName + " has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to delete this category.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error deleting this category',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    deletePost();
    deleteUser();
    deleteCategory();
});

function handleCategoryIconUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    const preview = document.getElementById('imagePreview');

    reader.onload = function(e) {
        preview.style.backgroundImage = `url(${e.target.result})`;
        preview.style.display = 'none';
        preview.offsetHeight;
        preview.style.display = 'block';
    }
    reader.readAsDataURL(file);
}

function generateSlug() {
    const categoryName = document.getElementById('category-name').value;

    const slug = categoryName
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();

    document.getElementById('slug').value = slug;
}

/** USER RELATED */
function handleAvatarUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    const preview = document.getElementById('imagePreview');

    reader.onload = function(e) {
        preview.style.backgroundImage = `url(${e.target.result})`;
        preview.style.display = 'none';
        preview.offsetHeight;
        preview.style.display = 'block';
    }
    reader.readAsDataURL(file);
}

function updatePasswordStrength(event) {
    const password = event.target.value;
    const strengthBadge = document.getElementById('passwordStrength');
    const strengths = {
        0: 'Very Weak',
        1: 'Weak',
        2: 'Moderate',
        3: 'Strong',
        4: 'Very Strong'
    };

    let strength = 0;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[$@#&!]+/)) strength++;

    if (strengthBadge) {
        strengthBadge.textContent = strengths[Math.min(strength, 4)];
        strengthBadge.className = `badge ${['bg-danger', 'bg-warning', 'bg-info', 'bg-primary', 'bg-success'][strength]}`;
    }
}

function initializeProfileManagement() {
    const avatarUpload = document.getElementById('avatarUpload');
    const passwordInput = document.querySelector('input[name="new_password"]');

    if (avatarUpload) {
        avatarUpload.addEventListener('change', handleAvatarUpload);
    }

    if (passwordInput) {
        passwordInput.addEventListener('input', updatePasswordStrength);
    }
}

document.addEventListener('DOMContentLoaded', initializeProfileManagement);

/** MODAL */
document.addEventListener('DOMContentLoaded', function() {
    const bioLinks = document.querySelectorAll('a[data-bs-target="#user-bio-modal"]');

    bioLinks.forEach(link => {
        link.addEventListener('click', function() {
            const bio = this.getAttribute('data-bio');
            const userName = this.getAttribute('data-user-name');

            document.getElementById('user-bio-content').textContent = bio;
            document.getElementById('user-name').textContent = userName;
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const permissionsUpdate = document.querySelectorAll('a[data-bs-target="#user-permission-modal"]');

    permissionsUpdate.forEach(link => {
        link.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const permissionId = this.getAttribute('data-user-permission-id');

            document.getElementById('user-name').textContent = userName;
            document.getElementById('current-permission-id').value = permissionId;
            document.getElementById('user-id').value = userId;

            const permissionDropdown = document.getElementById('permission-dropdown');
            permissionDropdown.value = permissionId;
        });
    });
});
