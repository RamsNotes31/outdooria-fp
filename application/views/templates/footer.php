<footer class="mt-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto text-center text-black">
                &copy; Copyright 2024,
                <a href="https://github.com/RamsNotes31/outdooria-fp" class="text-decoration-none text-black fw-bold" target="_blank">Outdooria</a>.
            </div>
        </div>
    </div>
</footer>
</div>
</body>
<script>
    window.addEventListener("scroll", function() {
        if (window.scrollY > 100) {
            document.querySelector(".scroll-top").style.display = "block";
        } else {
            document.querySelector(".scroll-top").style.display = "none";
        }
    });
    document.querySelector(".scroll-top").addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

        $(document).ready(function() {
            $('#datatable1').DataTable();
            $('#datatable2').DataTable();
        });
</script>
<script>
    $(document).ready(function() {
        $('#datatable1').DataTable();
        $('#datatable2').DataTable();
    });
</script>

</html>