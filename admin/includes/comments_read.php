<table class='table table-hover table-bordered'>
    <thead>
        <tr>
            <th>Comment ID</th>
            <th>Date</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>In Response to</th>
            <th>Status</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>

        <?php read_comments(); ?>
        <?php delete_comment(); ?>
        <?php unapprove_comment(); ?>
        <?php approve_comment(); ?>

    </tbody>
</table>