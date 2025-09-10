$('.selectArticleStatus').on('change', function(event){
    event.preventDefault();

    var formData = {
        article_id: $(this).data('article-id'),
        status: $(this).val(),
        updateArticleVisibility: 1
    }

    if (formData.article_id != "" && formData.status != "") {
        $.ajax({
            type:"POST",
            url: "../core/handler.php",
            data: formData,
            success: function (data) {
                if (data) {
                    location.reload();
                }
                else {
                    alert("Visibility update failed");
                }
            }
        })
    }
})