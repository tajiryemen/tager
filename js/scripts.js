function previewImages(input, previewContainer) {
    previewContainer.innerHTML = '';
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.height = '80px';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function confirmDelete() {
    return confirm('Are you sure you want to delete this ad?');
}
