@extends('/blog/index')
@section('content')
@include('/blog/layouts/topnav')
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                @if($posts->count() > 0)
                <h1 class="page-header">
                    Recent Posts
                </h1>
                @else
                    <h3>
                        Sorry, there are no posts here..
                    </h3>
                @endif

                @foreach($posts as $post)
                    <h2>
                        <a href="/blog/{{ $username  }}/post/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class="lead">
                        by <a href="/blog/{{ $username }}">{{ $username }}</a>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> Posted on <span class="date">{{ $post->created_at }}</span>
                        @if(! empty($post->category))
                            under {{ $post->category->name }}
                        @endif
                    </p>
                    <p>{!! $post->description !!}</p>
                    <a class="btn btn-primary" href="/blog/{{ $username }}/post/{{ $post->id }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                @endforeach
                <hr>
                <div class="col-md-8">
                    {!! $posts->render() !!}
                </div>
            </div>
            @include('/blog/layouts/rightnav')
        </div>
        <!-- /.row -->
        <hr>
        @include('/blog/layouts/footer')
    </div>
    <!-- /.container -->
@endsection
@section('footer')
@stop