    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>

    <script>
        $(document).ready(function() {
            let windowHeight = window.innerHeight;
            let mainView = document.querySelector('#page-wrapper');
            let navHeight = document.querySelector('#navigation_bar').offsetHeight;
            let calcHeight = windowHeight - navHeight;
            mainView.setAttribute("style", `min-height:${calcHeight}px`);
        })
    </script>

    </body>

    </html>