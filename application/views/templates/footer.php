<footer class="mt-5 py-3 ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                &copy; Copyright 2024,
                <a href="https://github.com/RamsNotes31/outdooria-fp" class="text-decoration-none text-dark fw-bold" target="_blank">Outdooria</a>.
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
</script>

</html>