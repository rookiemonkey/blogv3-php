<?php

function toUpload($file, $path)
{
    $post_image         = $file['image']['name'];
    $post_image_temp    = $file['image']['tmp_name'];
    $post_image_mime    = $file['image']['type'];
    $post_image_ext     = substr($post_image, strrpos($post_image, '.') + 1);



    // === check the file extenstion
    $allowed_ext = ['jpg', 'jpeg', 'png'];

    $post_image_isvalidext = false;
    foreach ($allowed_ext as $ext) {
        if ($ext == strtolower($post_image_ext)) {
            $post_image_isvalidext = true;
        }
    }

    if (!$post_image_isvalidext) {
        AdminUtilities::alert_Failed('Your image was not uploaded. We can only accept JPEG or PNG images.');
        return null;
    }



    // === check the file's mime type
    $allowed_mime = ['image/jpeg', 'image/png'];

    $post_image_isvalidmime = false;
    foreach ($allowed_mime as $mime) {
        if ($mime == $post_image_mime) {
            $post_image_isvalidmime = true;
        }
    }

    if (!$post_image_isvalidmime) {
        AdminUtilities::alert_Failed('Your image was not uploaded. We can only accept JPEG or PNG images.');
        return null;
    }



    // === Strip any metadata, by re-encoding image
    // // path to recreated image temp file with its renamed filename
    $post_image_recreated_name = md5(uniqid() . $post_image) . '.' . $post_image_ext;
    $post_image_recreated_path = ((ini_get('upload_tmp_dir') == '') ? (sys_get_temp_dir()) : (ini_get('upload_tmp_dir')));
    $post_image_recreated_path .= $post_image_recreated_name;

    // // proceed in stripping the meta data
    if ($post_image_mime == 'image/jpeg') {
        $recreated = imagecreatefromjpeg($post_image_temp);
        if (!$recreated) {
            AdminUtilities::alert_Failed('Your image was not uploaded since it has an invalid meta data. Please try again');
            return null;
        }
        imagejpeg($recreated, $post_image_recreated_path, 100);
        imagedestroy($recreated);
    } else {
        $recreated = imagecreatefrompng($post_image_temp);
        if (!$recreated) {
            AdminUtilities::alert_Failed('Your image was not uploaded since it has an invalid meta data. Please try again');
            return null;
        }
        imagepng($recreated, $post_image_recreated_path, 9);
        imagedestroy($recreated);
    }

    // // create the directory if the folder doesn't exists
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/cms/assets/images/{$path}")) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . "/cms/assets/images/{$path}");
    }

    // // move the recreated temp image from reacted_path to local path
    define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/cms/assets/images/{$path}/");
    copy($post_image_recreated_path, (UPLOAD_LOCATION . $post_image_recreated_name));

    // // Delete the recreated temp image
    if (file_exists($post_image_recreated_path)) {
        unlink($post_image_recreated_path);
    }

    return $post_image_recreated_name;
}
