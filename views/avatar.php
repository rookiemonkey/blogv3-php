<?php

function render_avatar($dependency, $size)
{
    $default = 'https://res.cloudinary.com/promises/image/upload/v1596613153/global_default_image.png';

    if ($dependency === $default) {
?>
        <img src=<?php echo $default; ?> style="width: <?php echo $size ?>; height:<?php echo $size ?>; border-radius: 20px" />
    <?php } else { ?>
        <img src="/assets/images/avatars/<?php echo $dependency ?>" style="width: <?php echo $size ?>; height:<?php echo $size ?>; border-radius: 20px" />
<?php
    }
}
