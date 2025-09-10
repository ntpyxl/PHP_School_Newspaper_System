<div id="updateArticleModal" class="hidden z-10 fixed inset-0 bg-black/60 justify-center items-center">
    <div class="w-full max-w-4xl px-6 py-2 bg-white rounded-lg shadow-lg">

        <div class="flex pb-2 justify-between items-center">
            <h3 class="text-2xl font-bold">Editing an article</h3>
            <button id="closeUpdateModalButton" class="text-4xl text-gray-600 hover:text-gray-900 cursor-pointer">&times;</button>
        </div>

        <form action="../core/handler.php" method="POST" class="space-y-4">
            <div>
                <input type="text" name="title" id="updateModalTitle"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    placeholder="Article Title">
            </div>

            <div class="max-h-[60vh] p-3 mb-5 bg-gray-100 rounded-xl overflow-y-auto">
                <textarea name="content" id="updateModalContent"
                    class="w-full h-[50vh] px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    placeholder="Edit your article..."></textarea>
            </div>

            <input type="hidden" name="article_id" id="updateModalArticleId">
            <input type="hidden" name="return_to" id="updateModalRedir">

            <div class="flex mb-5 justify-end space-x-2">
                <button type="submit" name="editArticleBtn"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 cursor-pointer">
                    Update
                </button>
                <button type="button" id="cancelUpdateButton"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 cursor-pointer">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>