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
        </tr>
    </thead>
    <tbody>

        <?php 

            Comments::read();
            Comments::read_ofPost();
            Comments::delete();
            Comments::unapprove();
            Comments::approve();

        ?>

    </tbody>
</table>