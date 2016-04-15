@extends('/blog/index')
@section('content')
@include('/blog/layouts/topnav')
        <!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- Blog Column -->
        <div class="col-md-8">
            @if($posts->count() > 0)
                <h1 class="page-header">
                    Recent Posts
                </h1>
            @else
                <h3>
                    Sorry, there are no posts under that category..
                </h3>
            @endif

            @foreach($posts as $post)
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
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            @endforeach
            <hr>
            <div class="col-md-8">
                {!! $posts->render() !!}
            </div>
        </div>
    </div>
    <!-- /.row -->

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