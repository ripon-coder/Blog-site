@extends('layouts.app')
@section('content')
    <!-- ======= Blog Header ======= -->
    <div class="pt-4">
    </div><!-- End Blog Header -->

    <!-- ======= Blog Page ======= -->
    <div class="blog-page blogpadding">
      <div class="container">
        <h3 class="titleborder">{{$data['cat']->category}}</h3>
       @if (!$data['blogs']->isEmpty())
        <div class="row">
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
             @foreach ($data['blogs'] as $blog)
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-blog">
                  <div class="single-blog-img">
                    <a href="{{route('blog.show',$blog->slug)}}">
                      <img src="{{ url(Storage::url('blogs/' . $blog->image)) }}" alt="">
                    </a>
                  </div>
                  <div class="blog-meta">
                    <span class="date-type">
                      <i class="bi bi-clock"></i>{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                    </span>
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="{{route('blog.show',$blog->slug)}}">{{$blog->title}}</a>
                    </h4>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 250, $end='...') }}</p>
                  </div>
                  <span>
                    <a href="{{route('blog.show',$blog->slug)}}" class="ready-btn">Read more</a>
                  </span>
                </div>
              </div>
              @endforeach

              <!-- End single blog -->
              <div class="blog-pagination">
                {!!$data['blogs']->links("pagination::bootstrap-5")!!}
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="page-head-blog">
              <div class="single-blog-page">
                <!-- search option start -->
                <form action="#">
                  <div class="search-option">
                    <input type="text" placeholder="Search...">
                    <button class="button" type="submit">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </form>
                <!-- search option end -->
              </div>
              <div class="single-blog-page">
                <!-- recent start -->
                <div class="left-blog">
                  <h4>Random post</h4>
                  <div class="recent-post">
                    @foreach ($data['randoms'] as $random)
                    <!-- start single post -->
                    <div class="recent-single-post">
                      <div class="post-img">
                        <a href="{{route('blog.show',$random->slug)}}">
                          <img src="{{ url(Storage::url('blogs/' . $random->image)) }}" alt="">
                        </a>
                      </div>
                      <div class="pst-content">
                        <p><a href="{{route('blog.show',$random->slug)}}">{{$random->title}}</a></p>
                      </div>
                    </div>
                    <!-- End single post -->
                    @endforeach

                  </div>
                </div>
                <!-- recent end -->
              </div>
              <div class="single-blog-page">
                <div class="left-blog">
                  <h4>categories</h4>
                  <ul>
                    @foreach ($data['categories'] as $cat)
                        <li>
                        <a href="{{route('category',$cat->slug)}}">{{$cat->category}} <span class="badge bg-secondary">{{$cat->blog->count()}}</span></a>
                        </li>
                    @endforeach
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
        @else
        <div class="alert alert-danger" role="alert">
            Data Not Found!
          </div>
        @endif
      </div>
    </div><!-- End Blog Page -->

  @endsection