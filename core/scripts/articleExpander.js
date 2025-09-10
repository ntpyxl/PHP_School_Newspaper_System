$('.toggleContent').on('click', function() {
    const container = $(this).closest('.article-preview');
    container.find('.short-content').toggleClass('hidden');
    container.find('.full-content').toggleClass('hidden');

    if ($(this).text().includes("Read more")) {
        $(this).text("Show less ↑");
    } else {
        $(this).text("Read more →");
    }
});
