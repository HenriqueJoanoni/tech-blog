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
    const preview = document.getElementById('imagePreview');

    if (!file) {
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.style.backgroundImage = `url(${e.target.result})`;
        preview.style.display = 'none';
        void preview.offsetHeight;
        preview.style.display = 'block';
    };

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

/******************************************
 *              FORMS VALIDATION          *
 *****************************************/

/** STORE POST VALIDATION */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#storePost');
    let tinyMCEInitialized = false;

    const initTinyMCEValidation = () => {
        if (typeof tinymce !== 'undefined' && tinymce.get('postContent')) {
            tinyMCEInitialized = true;
            tinymce.get('postContent').on('change', () => validateField('postContent', 'contentError'));
        }
    };

    const observer = new MutationObserver(initTinyMCEValidation);
    observer.observe(document.body, { childList: true, subtree: true });

    const handleCoverPreview = (event) => {
        const input = event.target;
        const preview = document.getElementById('coverPreview');
        const errorDiv = document.getElementById('coverError');
        const file = input.files[0];

        preview.classList.remove('has-image', 'has-error');
        errorDiv.textContent = '';

        if (file) {
            if (!file.type.startsWith('image/')) {
                errorDiv.textContent = 'Please select a valid image file';
                preview.classList.add('has-error');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    };

    const validateField = (fieldId, errorId) => {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(errorId);
        let isValid = true;
        let errorMessage = 'This field is required';

        if (!field) {
            return true;
        }

        if (fieldId === 'postContent' && tinyMCEInitialized) {
            isValid = tinymce.get(fieldId).getContent().trim().length > 0;
        } else if (fieldId === 'postCover') {
            if (field.files.length > 0) {
                const file = field.files[0];
                if (!file.type.startsWith('image/')) {
                    isValid = false;
                    errorMessage = 'Invalid file type (only images allowed)';
                } else if (file.size > 5 * 1024 * 1024) {
                    isValid = false;
                    errorMessage = 'File too large (max 5MB)';
                }
            } else {
                isValid = false;
            }
        } else if (field.type === 'file') {
            isValid = field.files.length > 0;
        } else if (field.tagName === 'SELECT') {
            isValid = field.value !== '';
        } else {
            isValid = field.value.trim() !== '';
        }

        if (!isValid) {
            field.classList.add('is-invalid');
            if (errorElement) {
                errorElement.textContent = errorMessage;
            } else {
                const error = document.createElement('div');
                error.className = 'text-danger mt-1';
                error.id = errorId;
                error.textContent = errorMessage;
                field.closest('.form-group').appendChild(error);
            }
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) errorElement.remove();
        }

        return isValid;
    };

    const fields = [
        { id: 'postTitle', errorId: 'titleError' },
        { id: 'postExcerpt', errorId: 'excerptError' },
        { id: 'postCategory', errorId: 'categoryError' },
        { id: 'postCover', errorId: 'coverError' }
    ];

    fields.forEach(({ id, errorId }) => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', () => validateField(id, errorId));
            field.addEventListener('change', (e) => {
                if (id === 'postCover') handleCoverPreview(e);
                validateField(id, errorId);
            });
        }
    });

    const coverPreview = document.getElementById('coverPreview');
    if (coverPreview) {
        coverPreview.addEventListener('dragover', (e) => {
            e.preventDefault();
            coverPreview.classList.add('dragover');
        });

        coverPreview.addEventListener('dragleave', (e) => {
            e.preventDefault();
            coverPreview.classList.remove('dragover');
        });

        coverPreview.addEventListener('drop', (e) => {
            e.preventDefault();
            coverPreview.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('postCover').files = files;
                const event = new Event('change');
                document.getElementById('postCover').dispatchEvent(event);
            }
        });
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formIsValid = true;

        fields.forEach(({ id, errorId }) => {
            if (!validateField(id, errorId)) formIsValid = false;
        });

        if (tinyMCEInitialized && !validateField('postContent', 'contentError')) {
            formIsValid = false;
        }

        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: 'Please check all required fields',
                didOpen: () => {
                    const firstInvalid = document.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth' });
                }
            });
            return;
        }

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';

        try {
            if (tinyMCEInitialized) {
                tinymce.triggerSave();
            }
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Submission failed');
            }

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                willClose: () => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            });

            form.reset();
            if (tinyMCEInitialized) {
                tinymce.get('postContent').setContent('');
            }
            coverPreview.style.backgroundImage = '';
            coverPreview.classList.remove('has-image');

        } catch (error) {
            console.error('Submission error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Create Post';
        }
    });
});

/** UPDATE POST VALIDATION */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#updatePost');
    let tinyMCEInitialized = false;

    const initTinyMCEValidation = () => {
        if (typeof tinymce !== 'undefined' && tinymce.get('postContent')) {
            tinyMCEInitialized = true;
            tinymce.get('postContent').on('change', () => validateField('postContent', 'contentError'));
        }
    };

    const observer = new MutationObserver(initTinyMCEValidation);
    observer.observe(document.body, { childList: true, subtree: true });

    function handleCoverPreview(event) {
        const file = event.target.files[0];
        coverError.textContent = '';
        coverPreview.classList.remove('has-error');

        if (file) {
            if (!file.type.startsWith('image/')) {
                coverError.textContent = 'Please select a valid image file';
                coverPreview.classList.add('has-error');
                coverInput.value = '';
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                coverError.textContent = 'File size too large (max 5MB)';
                coverPreview.classList.add('has-error');
                coverInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                coverPreview.style.backgroundImage = `url(${e.target.result})`;
                coverPreview.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    }

    const validateField = (fieldId, errorId) => {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(errorId);
        let isValid = true;
        let errorMessage = 'This field is required';

        if (!field) return true;

        if (fieldId === 'postContent' && tinyMCEInitialized) {
            isValid = tinymce.get(fieldId).getContent().trim().length > 0;
        } else if (fieldId === 'postCover') {
            if (field.files.length > 0) {
                const file = field.files[0];
                if (!file.type.startsWith('image/')) {
                    isValid = false;
                    errorMessage = 'Invalid file type (only images allowed)';
                } else if (file.size > 5 * 1024 * 1024) {
                    isValid = false;
                    errorMessage = 'File too large (max 5MB)';
                }
            }
        } else if (field.tagName === 'SELECT') {
            isValid = field.value !== '';
        } else {
            isValid = field.value.trim() !== '';
        }

        if (!isValid) {
            field.classList.add('is-invalid');
            if (errorElement) {
                errorElement.textContent = errorMessage;
            } else {
                const error = document.createElement('div');
                error.className = 'text-danger mt-1';
                error.id = errorId;
                error.textContent = errorMessage;
                field.closest('.form-group').appendChild(error);
            }
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) {
                errorElement.remove();
            }
        }

        return isValid;
    };

    const fields = [
        { id: 'postTitle', errorId: 'titleError' },
        { id: 'postExcerpt', errorId: 'excerptError' },
        { id: 'postCategory', errorId: 'categoryError' }
    ];

    fields.forEach(({ id, errorId }) => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', () => validateField(id, errorId));
            field.addEventListener('change', () => validateField(id, errorId));
        }
    });

    const coverPreview = document.getElementById('coverPreview');
    const coverInput = document.getElementById('postCover');
    const coverError = document.getElementById('coverError');

    if (coverPreview.style.backgroundImage.includes('url("")')) {
        coverPreview.style.backgroundImage = '';
    } else {
        coverPreview.classList.add('has-image');
    }

    coverInput.addEventListener('change', handleCoverPreview);
    coverPreview.addEventListener('dragover', (e) => {
        e.preventDefault();
        coverPreview.classList.add('dragover');
    });

    coverPreview.addEventListener('dragleave', (e) => {
        e.preventDefault();
        coverPreview.classList.remove('dragover');
    });

    coverPreview.addEventListener('drop', (e) => {
        e.preventDefault();
        coverPreview.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            coverInput.files = files;
            handleCoverPreview({target: coverInput});
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formIsValid = true;

        fields.forEach(({ id, errorId }) => {
            if (!validateField(id, errorId)) formIsValid = false;
        });

        if (document.getElementById('postCover').files.length > 0) {
            if (!validateField('postCover', 'coverError')) formIsValid = false;
        }

        if (tinyMCEInitialized && !validateField('postContent', 'contentError')) {
            formIsValid = false;
        }

        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: 'Please check all required fields',
                didOpen: () => {
                    const firstInvalid = document.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth' });
                }
            });
            return;
        }

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';

        try {
            if (tinyMCEInitialized) {
                tinymce.triggerSave();
            }
            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Update failed');
            }

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                willClose: () => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            });

        } catch (error) {
            console.error('Update error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Edit Post';
        }
    });
});

/** STORE CATEGORY VALIDATION */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#storeCategoryForm');
    const slugInput = document.getElementById('slug');
    const imagePreview = document.getElementById('imagePreview');

    const fields = [
        {id: 'category-name', errorId: 'nameError', validate: (field) => field.value.trim() !== ''},
        {
            id: 'category-icon',
            errorId: 'iconError',
            validate: (field) => {
                if (field.files.length === 0) return false;
                const file = field.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
                return validTypes.includes(file.type) && file.size <= 2048 * 1024;
            }
        },
        {
            id: 'visibility',
            errorId: 'visibilityError',
            validate: (field) => field.value !== ''
        }
    ];

    const validateField = ({id, errorId, validate}) => {
        const field = document.getElementById(id);
        const errorElement = document.getElementById(errorId);
        const isValid = validate(field);

        if (!isValid) {
            field.classList.add('is-invalid');
            if (!errorElement) {
                const error = document.createElement('div');
                error.className = 'text-danger mt-1';
                error.id = errorId;
                error.textContent = getErrorMessage(id);
                field.closest('.form-group').appendChild(error);
            }
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) errorElement.remove();
        }

        return isValid;
    };

    const getErrorMessage = (id) => {
        const messages = {
            'category-name': 'Category name is required',
            'category-icon': 'Icon is required (max 2MB, JPG/PNG/GIF/SVG)',
            'visibility': 'Please select visibility status'
        };
        return messages[id] || 'This field is required';
    };

    fields.forEach(({id, errorId, validate}) => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', () => validateField({id, errorId, validate}));
            field.addEventListener('change', () => validateField({id, errorId, validate}));
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formIsValid = true;

        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

        fields.forEach(config => {
            if (!validateField(config)) formIsValid = false;
        });

        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: 'Please check required fields',
                didOpen: () => document.querySelector('.is-invalid')?.scrollIntoView({behavior: 'smooth'})
            });
            return;
        }

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Creating...';

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const fieldId = field === 'category_icon' ? 'category-icon' : field.replace('_', '-');
                        const errorId = `${fieldId}Error`;
                        const fieldElement = document.getElementById(fieldId);
                        if (fieldElement) {
                            fieldElement.classList.add('is-invalid');
                            const error = document.createElement('div');
                            error.className = 'text-danger mt-1';
                            error.id = errorId;
                            error.textContent = messages[0];
                            fieldElement.closest('.form-group').appendChild(error);
                        }
                    });
                    throw new Error('Validation errors occurred');
                }
                throw new Error(data.message || 'Submission failed');
            }

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                willClose: () => data.redirect && (window.location.href = data.redirect)
            });

            if (!data.redirect) {
                form.reset();
                slugInput.value = '';
                imagePreview.style.backgroundImage = `url('{{ asset('avatars/application.png') }}')`;
            }

        } catch (error) {
            Swal.fire({icon: 'error', title: 'Error!', text: error.message});
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Create category';
        }
    });
});

/** UPDATE CATEGORY VALIDATION */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#updateCategoryForm');

    const fields = [
        {id: 'category-name', errorId: 'nameError', validate: (field) => field.value.trim() !== ''},
        {
            id: 'category-icon',
            errorId: 'iconError',
            validate: (field) => {
                if (field.files.length > 0) {
                    const file = field.files[0];
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
                    return validTypes.includes(file.type) && file.size <= 2048 * 1024;
                }
                return true;
            }
        },
        {
            id: 'visibility',
            errorId: 'visibilityError',
            validate: (field) => field.value !== ''
        }
    ];

    const validateField = ({id, errorId, validate}) => {
        const field = document.getElementById(id);
        const errorElement = document.getElementById(errorId);
        const isValid = validate(field);

        if (!isValid) {
            field.classList.add('is-invalid');
            if (!errorElement) {
                const error = document.createElement('div');
                error.className = 'text-danger mt-1';
                error.id = errorId;
                error.textContent = getErrorMessage(id);
                field.closest('.form-group').appendChild(error);
            }
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) errorElement.remove();
        }

        return isValid;
    };

    const getErrorMessage = (id) => {
        const messages = {
            'category-name': 'Category name is required',
            'category-icon': 'Invalid image (max 2MB, JPG/PNG/GIF/SVG)',
            'visibility': 'Please select visibility status'
        };
        return messages[id] || 'This field is required';
    };

    fields.forEach(({id, errorId, validate}) => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', () => validateField({id, errorId, validate}));
            field.addEventListener('change', () => validateField({id, errorId, validate}));
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formIsValid = true;

        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

        fields.forEach(config => {
            if (!validateField(config)) formIsValid = false;
        });

        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: 'Please check required fields',
                didOpen: () => document.querySelector('.is-invalid')?.scrollIntoView({behavior: 'smooth'})
            });
            return;
        }

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Updating...';

        try {
            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const fieldId = field === 'category_icon' ? 'category-icon' : field.replace('_', '-');
                        const errorId = `${fieldId}Error`;
                        const fieldElement = document.getElementById(fieldId);
                        if (fieldElement) {
                            fieldElement.classList.add('is-invalid');
                            const error = document.createElement('div');
                            error.className = 'text-danger mt-1';
                            error.id = errorId;
                            error.textContent = messages[0];
                            fieldElement.closest('.form-group').appendChild(error);
                        }
                    });
                    throw new Error('Validation errors occurred');
                }
                throw new Error(data.message || 'Update failed');
            }

            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: data.message,
                willClose: () => data.redirect && (window.location.href = data.redirect)
            });

        } catch (error) {
            Swal.fire({icon: 'error', title: 'Error!', text: error.message});
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Update category';
        }
    });
});

/** STORE USER VALIDATION */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#storeUserForm');
    let tinyMCEInitialized = false;

    const initTinyMCEValidation = () => {
        if (typeof tinymce !== 'undefined' && tinymce.get('bio')) {
            tinyMCEInitialized = true;
        }
    };

    const observer = new MutationObserver(initTinyMCEValidation);
    observer.observe(document.body, {childList: true, subtree: true});

    const fields = [
        {
            id: 'name',
            errorId: 'nameError',
            validate: (field) => field.value.trim() !== ''
        },
        {
            id: 'email',
            errorId: 'emailError',
            validate: (field) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)
        },
        {
            id: 'password',
            errorId: 'passwordError',
            validate: (field) => field.value === '' || field.value.length >= 8
        },
        {
            id: 'permission',
            errorId: 'permissionError',
            validate: (field) => field.value !== ''
        },
        {
            id: 'avatarUpload',
            errorId: 'avatarError',
            validate: (field) => {
                if (field.files.length === 0) return true;
                const file = field.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                return validTypes.includes(file.type) && file.size <= 2048 * 1024;
            }
        }
    ];

    const validateField = ({id, errorId, validate}) => {
        const field = document.getElementById(id);
        const errorElement = document.getElementById(errorId);
        const isValid = validate(field);

        if (!isValid) {
            field.classList.add('is-invalid');
            if (!errorElement) {
                const error = document.createElement('div');
                error.className = 'text-danger mt-1';
                error.id = errorId;
                error.textContent = getErrorMessage(id);
                field.closest('.form-group').appendChild(error);
            }
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) errorElement.remove();
        }

        return isValid;
    };

    const getErrorMessage = (id) => {
        const messages = {
            'name': 'Name is required',
            'email': 'Valid email is required',
            'password': 'Password must be at least 8 characters',
            'permission': 'Permission selection is required',
            'avatarUpload': 'Invalid image (max 2MB, JPG/PNG/GIF)'
        };
        return messages[id] || 'Invalid value';
    };

    fields.forEach(({id, errorId, validate}) => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', () => validateField({id, errorId, validate}));
            field.addEventListener('change', () => validateField({id, errorId, validate}));
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formIsValid = true;

        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

        fields.forEach(config => {
            if (!validateField(config)) formIsValid = false;
        });

        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: 'Please check required fields',
                didOpen: () => document.querySelector('.is-invalid')?.scrollIntoView({behavior: 'smooth'})
            });
            return;
        }

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Creating...';

        try {
            if (tinyMCEInitialized) {
                tinymce.triggerSave();
            }
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const fieldId = field === 'avatar' ? 'avatarUpload' : field;
                        const errorId = `${fieldId}Error`;
                        const fieldElement = document.getElementById(fieldId);
                        if (fieldElement) {
                            fieldElement.classList.add('is-invalid');
                            const error = document.createElement('div');
                            error.className = 'text-danger mt-1';
                            error.id = errorId;
                            error.textContent = messages[0];
                            fieldElement.closest('.form-group').appendChild(error);
                        }
                    });
                    throw new Error('Validation errors occurred');
                }
                throw new Error(data.message || 'Creation failed');
            }

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                willClose: () => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            });

            form.reset();
            if (tinyMCEInitialized) {
                tinymce.get('bio').setContent('');
            }
            document.getElementById('imagePreview').style.backgroundImage = `url('{{ asset('avatars/profile.png') }}')`;

        } catch (error) {
            Swal.fire({icon: 'error', title: 'Error!', text: error.message});
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Create User';
        }
    });
});

/** UPDATE USER PROFILE VALIDATION */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#editUserProfileForm');
    let tinyMCEInitialized = false;

    const initTinyMCE = () => {
        if (typeof tinymce !== 'undefined' && tinymce.get('bio')) {
            tinyMCEInitialized = true;
        }
    };
    const observer = new MutationObserver(initTinyMCE);
    observer.observe(document.body, {childList: true, subtree: true});

    const fields = [
        {
            id: 'name',
            errorId: 'nameError',
            validate: (field) => field && field.value.trim() !== ''
        },
        {
            id: 'email',
            errorId: 'emailError',
            validate: (field) => field && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)
        },
        {
            id: 'permission',
            errorId: 'permissionError',
            validate: (field) => field && field.value !== ''
        },
        {
            id: 'avatarUpload',
            errorId: 'avatarUploadError',
            validate: (field) => {
                if (!field) return true;
                if (field.files.length === 0) return true;
                const file = field.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                return validTypes.includes(file.type) && file.size <= 2048 * 1024;
            }
        }
    ];

    const validateField = ({id, errorId, validate}) => {
        const field = document.getElementById(id);
        const errorElement = document.getElementById(errorId);

        if (!field) {
            console.warn(`Field with ID ${id} not found`);
            return true;
        }

        const isValid = validate(field);

        if (!isValid) {
            field.classList.add('is-invalid');
            if (!errorElement) {
                const error = document.createElement('div');
                error.className = 'text-danger mt-1';
                error.id = errorId;
                error.textContent = getErrorMessage(id);
                field.closest('.form-group, .col-md-6, .col-5').appendChild(error);
            }
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) errorElement.remove();
        }

        return isValid;
    };

    const validatePassword = () => {
        const password = document.getElementById('new_password');
        const confirm = document.getElementById('new_password_confirmation');
        let isValid = true;

        if (!password || !confirm) return true;

        if (password.value || confirm.value) {
            isValid = password.value === confirm.value && password.value.length >= 8;

            const showError = (field, message) => {
                const errorId = `${field.id}Error`;
                const errorElement = document.getElementById(errorId);
                field.classList.add('is-invalid');
                if (!errorElement) {
                    const error = document.createElement('div');
                    error.className = 'text-danger mt-1';
                    error.id = errorId;
                    error.textContent = message;
                    field.closest('.form-group').appendChild(error);
                }
            };

            if (password.value.length < 8) {
                showError(password, 'Password must be at least 8 characters');
                isValid = false;
            }

            if (password.value !== confirm.value) {
                showError(confirm, 'Passwords do not match');
                isValid = false;
            }
        }

        return isValid;
    };

    const getErrorMessage = (id) => {
        const messages = {
            'name': 'Name is required',
            'email': 'Valid email is required',
            'permission': 'Permission selection is required',
            'avatarUpload': 'Invalid image (max 2MB, JPG/PNG/GIF)'
        };
        return messages[id] || 'Invalid value';
    };

    fields.forEach(({id, errorId, validate}) => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', () => validateField({id, errorId, validate}));
            field.addEventListener('change', () => validateField({id, errorId, validate}));
        }
    });

    document.querySelectorAll('[name="new_password"], [name="new_password_confirmation"]').forEach(field => {
        field.addEventListener('input', validatePassword);
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formIsValid = true;

        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

        fields.forEach(config => {
            if (!validateField(config)) formIsValid = false;
        });

        if (!validatePassword()) {
            formIsValid = false;
        }

        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: 'Please check required fields',
                didOpen: () => document.querySelector('.is-invalid')?.scrollIntoView({behavior: 'smooth'})
            });
            return;
        }

        const submitButton = form.querySelector('button[type="submit"]');
        const originalButtonHTML = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';

        try {
            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Update failed');
            }

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Profile updated successfully',
                willClose: () => window.location.href = data.redirect || form.action
            });

        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonHTML;
        }
    });
});

/** POST COVER UPLOAD HANDLER */
function handleCoverPreview(event) {
    const input = event.target;
    const preview = document.getElementById('coverPreview');
    const errorDiv = document.getElementById('coverError');
    const file = input.files[0];

    preview.classList.remove('has-image', 'has-error');
    errorDiv.textContent = '';

    if (file) {
        if (!file.type.startsWith('image/')) {
            errorDiv.textContent = 'Please select a valid image file';
            preview.classList.add('has-error');
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            preview.style.backgroundImage = `url(${e.target.result})`;
            preview.classList.add('has-image');
        };
        reader.readAsDataURL(file);
    }
}

const preview = document.getElementById('coverPreview');
preview.addEventListener('dragover', (e) => {
    e.preventDefault();
    preview.classList.add('dragover');
});

preview.addEventListener('dragleave', (e) => {
    e.preventDefault();
    preview.classList.remove('dragover');
});

preview.addEventListener('drop', (e) => {
    e.preventDefault();
    preview.classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('postCover').files = files;
        handleCoverPreview({ target: document.getElementById('postCover') });
    }
});
