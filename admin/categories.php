<?php require '../vendor/autoload.php'; ?>
<?php AdminView::AdminHeader(); ?>  

<div id="wrapper">

    <?php AdminView::AdminNavigation(); ?>  

    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories Dashboard
                    </h1>

                    <div class='col-xs-6'>

                        <?php AdminCategories::create(); ?>
                        <?php AdminCategories::delete(); ?>
                        <?php AdminCategories::update(); ?>

                        <form action='' method='POST'>
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control"  name="cat_title" id="cat_title" required/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="add_category" value="Add"/>
                            </div>
                        </form>

                        <?php AdminUtilities::render_UpdateCategoryForm(); ?>

                    </div>

                    <div class='col-xs-6'>
                        <table class='table table-hover table-bordered'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php AdminView::CategoriesTable(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php AdminView::AdminFooter(); ?>  