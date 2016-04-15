@extends('/blog/index')
@section('content')
@include('/blog/layouts/topnav')
        <!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
                <h2>
                    <a href="/blog/{{ $username  }}/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">{{ $username }}</a>
                </p>
                <p>
                    <span class="glyphicon glyphicon-time"></span> Posted on <span class="date">{{ $post->created_at }}</span>
                    @if(! empty($post->category))
                        under {{ $post->category->name }}
                    @endif
                </p>
                <p>{{ $post->description }}</p>
                <p>{!!  $post->content !!} </p>
        </div>
        @include('/blog/layouts/rightnav')
    </div>
    <hr>
    @include('/blog/layouts/footer')
</div>
<!-- /.container -->
@endsection
@section('footer')
    <script>
        var searchBlog = function() {
            var search = $('#search').val();
            var url = '/blog/{{ $username }}?search=' + search;
            window.location.href = url;
        };
    </script>
@stop