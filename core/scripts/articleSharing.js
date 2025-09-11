$('.requestShareArticleButton').on('click', function(event) {
    event.preventDefault();

    var formData = {
        article_id: $(this).data('article-id'),
        requested_by: $(this).data('requested-by'),
        requestShareArticle: 1
    }

    $.ajax({
        type:"POST",
        url: "core/handler.php",
        data: formData,
        success: function (data) {
            if (data) {
                location.reload();
            }
            else {
                alert("Failed to send request.");
            }
        }
    })
})