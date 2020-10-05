<?php

function update_current_user_avatar()
{
    if (isset($_POST['update_avatar'])) {
        $mysqli = AdminModel::Provide_Database();
        $oldimage = Utility::sanitize(($_POST['oldimage']));

        // disallow empty form
        if (!$_FILES['image']['tmp_name'] && !isset($_POST['default'])) {
            AdminUtilities::alert_Failed('Failed to update your avatar since nothing was uploaded');
            return null;
        }

        // disallow both default and uploaded image
        if ($_FILES['image']['tmp_name'] && isset($_POST['default'])) {
            AdminUtilities::alert_Failed('Failed to update your avatar since you tried to upload something and at the same time choosing the default avatar');
            return null;
        }

        // conditionally set the avatar to default or the uploaded one
        $user_avatar = '';

        if (isset($_POST['default']) && !$_FILES['image']['tmp_name']) {
            $user_avatar = "https://res.cloudinary.com/promises/image/upload/v1596613153/global_default_image.png";

            // purge the old image to free space
            define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/assets/images/avatars/");

            if (file_exists(UPLOAD_LOCATION . $oldimage)) {
                unlink(UPLOAD_LOCATION . $oldimage);
            }
        }

        if ($_FILES['image']['tmp_name'] && !isset($_POST['default'])) {
            $user_avatar = Utility::toUploadUpdate($oldimage, $_FILES, 'avatars');
        }

        // proceed in updated the database
        $stmt = "UPDATE users SET user_avatar = ? WHERE user_id = ?";

        $query = $mysqli->prepare($stmt);

        $query->bind_param('ss', $user_avatar, $_SESSION['id']);

        $result = $query->execute();

        $query->close();

        if ($result) {
            AdminUtilities::alert_Success('Succesfully updated your avatar.');
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
