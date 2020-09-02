$(document).ready(function () {

    // text editor
    if (document.querySelector('#body')) {
        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });
    }

    // select all posts checkboxes
    $('#selectAllBoxes').on('click', function () {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            })
        }

        else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            })
        }
    })

})