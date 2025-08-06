document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('marriageBioForm');
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    // Photo upload preview
    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block';
                photoPlaceholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    // Form submission with fetch
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        
        fetch('submit_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                alert('Form submitted successfully!');
                form.reset();
            } else {
                alert(data.message);
            }
        })
        .catch(error => alert('Error: ' + error));
    });
});
