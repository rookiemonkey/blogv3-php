<table class='table table-hover table-bordered'>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Role</th>
            <th>Change Role</th>
            <th>Change Role</th>   
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>

        <?php
        
            Users::read();
            Users::delete();
            Users::update();
            Users::update_toAdmin();
            Users::update_toSubscriber();

        ?>

    </tbody>
</table>