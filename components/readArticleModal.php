<div id="readArticleModal" class="hidden z-10 fixed inset-0 bg-black/60 justify-center items-center">
    <div class="w-full max-w-4xl px-6 py-2 bg-white rounded-lg shadow-lg">

        <div class="flex pb-2 justify-between items-center">
            <h3 id="readModalTitle" class="text-2xl font-bold"></h3>
            <button id="closeReadModalButton" class="text-4xl text-gray-600 hover:text-gray-900 cursor-pointer">&times;</button>
        </div>

        <div class="space-y-2">
            <p class="text-gray-600 text-sm">
                Published by <span id="readModalRole"></span>
                <span class="font-bold" id="readModalUsername"></span>
                on <span id="readModalCreatedAt"></span>
            </p>

            <div class="max-h-[60vh] p-3 mb-5 bg-gray-100 rounded-xl overflow-y-auto">
                <div class="py-3">
                    <img id="readModalImage" class="max-w-full rounded-lg hidden" alt="Article image">
                </div>
                <p id="readModalContent" class="whitespace-pre-line"></p>
            </div>
        </div>
    </div>
</div>