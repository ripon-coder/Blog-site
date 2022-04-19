@extends('layouts.app')
@section('content')
    <!-- ======= Blog Header ======= -->
    <div class="pt-4">
    </div><!-- End Blog Header -->

    <!-- ======= Blog Page ======= -->
    <div class="blog-page blogpadding">
      <div class="container">
        <h3 class="titleborder">All-Notice</h3>

       @if (!$data['notices']->isEmpty())
        <div class="row">
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
             @foreach ($data['notices'] as $notice)
                <div class="list-group">
                    <a href="{{route('notice.show',$notice->slug)}}" class="list-group-item list-group-item-action">{{$notice->title}} -- {{ \Carbon\Carbon::parse($notice->created_at)->format('d/M/Y') }}</a>
                </div>
              @endforeach
            </div>

              <!-- End single blog -->
              <div class="blog-pagination">
                {!!$data['notices']->links("pagination::bootstrap-5")!!}
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