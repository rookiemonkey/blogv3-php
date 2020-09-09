<?php

function render_poststatusOptions_edit($post_row)
{
    if ($post_row["post_status"] === 'draft') {
        echo '<option value="draft" selected="selected">Draft</option>';
        echo '<option value="published">Published</option>';
    } else if ($post_row["post_status"] === 'published') {
        echo '<option value="published" selected="selected">Published</option>';
        echo '<option value="draft">Draft</option>';
    }
}
