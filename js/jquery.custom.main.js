$(document).on('click', '.uk-form-file', function() {
    $("#upload-select").click();
});
$(document).on('drop', '#upload-drop', function(e) {
    var dataTransfer = e && e.dataTransfer ? e.dataTransfer : e.originalEvent.dataTransfer;
    e.preventDefault();
    $("#upload-select").get(0).files = e.originalEvent.dataTransfer.files;
    $("#upload-select").trigger('drop');
});
$(document).on('drop', function(e) {
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragenter', function(e) {
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('click', '.display-player', function() {
    var title = $(this).attr("data-title"),
        preview = $(this).attr("data-preview"),
        id = $(this).attr("data-id"),
	original = $(this).attr("data-original"),
	html = '';
	html += '<div class="uk-text-center"><h2>Audio Id: ' + id + '</h2><p>Name: ' + title + '</p>';
	html += '<h3>Preview: ' + preview + '</h3><audio id="preview' + id + '" title="' + title + '" src="' + preview + '" preload="auto" controls></audio>';
	html += '<h3>Original : ' + original + '</h3><audio id="audio' + id + '"title="' + title + '" controls preload><source src="' + original + '" type="audio/mpeg"></audio></div>';
    UIkit.modal.alert(html);

});
