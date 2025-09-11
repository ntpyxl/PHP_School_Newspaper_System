$('.articleCard').on('click', function(event) {
    let title = $(this).data("article-title");
    let content = $(this).data("article-content");
    let username = $(this).data("author-username");
    let isAdmin = $(this).data("is-admin");
    let createdAt = $(this).data("created-at");

    $("#readModalTitle").text(title);
    $("#readModalContent").text(content);
    $("#readModalUsername").text(username);
    $("#readModalCreatedAt").text(createdAt);

    if (isAdmin == 1) {
        $("#readModalRole").html('<span class="px-1 rounded-md bg-blue-600 text-white text-xs">Admin</span>');
    } else {
        $("#readModalRole").html('<span class="px-1 rounded-md bg-green-600 text-white text-xs">Writer</span>');
    }

    $('#readArticleModal').addClass('flex').removeClass('hidden');
});

$("#closeReadModalButton").on("click", function () {
    $("#readArticleModal").removeClass("flex").addClass("hidden");
});



$('.editArticleButton').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();

    let id = $(this).data("article-id");
    let title = $(this).data("article-title");
    let content = $(this).data("article-content");
    let return_to = $(this).data("return-to");

    $("#updateModalArticleId").val(id);
    $("#updateModalTitle").val(title);
    $("#updateModalContent").text(content);
    $("#updateModalRedir").val(return_to);

    $('#updateArticleModal').addClass('flex').removeClass('hidden');
});

$("#closeUpdateModalButton, #cancelUpdateButton").on("click", function () {
    $("#updateArticleModal").removeClass("flex").addClass("hidden");
});



$('.deleteArticleButton').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var formData = {
        article_id: $(this).data('article-id'),
        deleteArticleBtn: 1
    }

    if (confirm("Are you sure you want to delete this article?")) {
        $.ajax({
            type: "POST",
            url: "../core/handler.php",
            data: formData,
            success: function(data) {
                if (data) {
                    location.reload();
                } else {
                    alert("Deletion failed");
                }
            }
        })
    }
})

$('.selectShareStatus').on('click', function(event) {
    event.stopPropagation();
})

$('.selectShareStatus').on('change', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var formData = {
        share_id: $(this).data('share-id'),
        share_status: $(this).val(),
        editShareStatusRequest: 1
    }

    $.ajax({
        type: "POST",
        url: "../core/handler.php",
        data: formData,
        success: function(data) {
            if (data) {
                location.reload();
            } else {
                alert("Share Status update failed");
            }
        }
    })
})