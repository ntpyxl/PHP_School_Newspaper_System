maybe this should just be publish.php and while also displaying the writer's published articles. shared articles should be displayed in shared_articles.php

display published articles with just title and date posted, then on click open a modal containing scrollable content.
user_pending_articles.php already does this along with edit and delete.

same for shared articles but on click should be just new page shared_articles.php

**retain articles_from_students.php (admin, approves articles for publish) and user_pending_articles.php (writer)**
rename writer page to published_articles.php
rename admin page to review_articles.php

writer page just displays writer's published articles and allows for editing and deletion
admin page just displays all articles and its status (pending, active), and allows for deletion. should maybe just change status to 'rejected' instead of permanent deletion.
should also add 'inactive' status, to signify that it's no longer recent and thus should not be shown in the homepage