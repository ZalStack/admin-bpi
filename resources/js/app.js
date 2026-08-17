
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.toggleStatus = function (type, id) {
    fetch(`/admin/${type}/${id}/toggle-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
};

window.previewImage = function (input, targetId) {
    const file = input.files && input.files[0];
    const target = document.getElementById(targetId);
    if (!file || !target) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        target.src = e.target.result;
        target.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
};
