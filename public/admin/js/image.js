function previewImages(files) {
    var previewDiv = document.getElementById('image-preview');
    previewDiv.innerHTML = ''; 

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = function(event) {
            var imgElement = document.createElement('img');
            imgElement.src = event.target.result;
            imgElement.style.maxWidth = '120px';
            previewDiv.appendChild(imgElement);
        }

        reader.readAsDataURL(file);
    }
}