<?php

    /**
     * ROUTE: GET /admin/users.php
     * DESC: read all users and render them as a table
     */
    function read_users() {
        global $mysqli;

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->get_result();
        $query->close();
        
        // loop into the results and render
        while($row = $users->fetch_assoc()) {  
?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_username']; ?></td>
                <td><?php echo $row['user_firstname']; ?></td>
                <td><?php echo $row['user_lastname']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['user_avatar']; ?></td>
                <td><?php echo $row['user_role']; ?></td>
                <td>
                    <a href='./users.php?admin=<?php echo $row['user_id']; ?>'>
                        To Admin
                    </a>
                </td>
                <td>
                    <a href='./users.php?subscriber=<?php echo $row['user_id']; ?>'>
                        To Subscriber
                    </a>
                </td>
                <td>
                    <a href='./users.php?delete=<?php echo $row['user_id']; ?>'>
                        Delete
                    </a>
                </td>";
                <td>
                    <a href='./users.php?source=edit_user&u_id=<?php echo $row['user_id']; ?>'>
                        Edit
                    </a>
                </td>
            </tr>
<?php
        }
    }
?>