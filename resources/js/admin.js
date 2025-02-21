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
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                button.title = data.is_visible ? 'Hide post' : 'Show post';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating visibility');
        });
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
