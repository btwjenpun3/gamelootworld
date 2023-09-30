<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    {{-- <a href="./index.html"><img src="img/logo.png" alt=""></a> --}}
                    <p>(logo soon)</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="{{ route('home.index') }}">Homepage</a></li>
                        {{-- <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p> Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved <a href="https://gamelootworld.com"
                        target="_blank">GameLootWorld</a>
                </p>
            </div>
        </div>
    </div>
</footer>
