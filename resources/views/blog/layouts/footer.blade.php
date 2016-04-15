<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; AnthonyUmpad 2016</p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <script>
        var searchBlog = function() {
            var search = $('#search').val();
            var url = '/blog/{{ $username }}?search=' + search;
            window.location.href = url;
        };
    </script>
</footer>