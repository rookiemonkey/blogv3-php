<table class='table table-hover table-bordered'>
    <thead>
        <tr>
            <th>Comment ID</th>
            <th>Date</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        AdminView::CommentsTable();
        AdminView::CommentsTableOfPost();
        AdminComments::delete();
        AdminComments::unapprove();
        AdminComments::approve();
        ?>

    </tbody>
</table>