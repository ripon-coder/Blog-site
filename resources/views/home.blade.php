@extends('layouts.app')

@section('content')
  <!-- ======= hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
          @foreach ($data['sliders'] as $key=>$slider)
          <div class="carousel-item @if($key == 0) active @endif" style="background-image: url({{ url(Storage::url('sliders/' . $slider->image)) }})">
            <div class="carousel-container">
              <div class="container">
                <h2 class="animate__animated animate__fadeInDown">{{$slider->title}}</h2>
                @isset($slider->description)
                  <p class="animate__animated animate__fadeInUp">{{$slider->description}}</p>
                @endisset
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero Section -->

 <!-- ======= About Section ======= -->
 <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              
            </div>
          </div>
        </div>
        @foreach ( $data['chairmans'] as $chairman)
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-left">
              <h4 class="text-center bg-white p-2">Chairman of FCLA</h4>
              <div class="single-well">
                <a href="#">
                  <img src="{{ url(Storage::url('chairmans/' . $chairman->image)) }}" alt="">
                </a>
              </div>
              <div class="single-well bg-white p-4">
                <a href="#">
                  <h4 class="text-center">{{$chairman->name}}</h4>
                </a>
                <p>
                  {{$chairman->description}}
                </p>
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <h4 class="text-center bg-white p-2">Notices</h4>
              <div class="list-group">
                @foreach ($data['notices'] as $notice)
                  <a href="{{route('notice.show',$notice->slug)}}" class="list-group-item list-group-item-action">{{$notice->title}} -- {{ \Carbon\Carbon::parse($notice->created_at)->format('d/M/Y') }}</a>
                @endforeach
              </div>
            </div>
          </div>
          <!-- End col-->
        </div>
        @endforeach
      </div>
    </div><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Our Course</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="bi bi-card-checklist"></i>
                  </a>
                  <h4>Course-1</h4>
                  <p>
                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="bi bi-card-checklist"></i>
                  </a>
                  <h4>Course-2</h4>
                  <p>
                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="bi bi-card-checklist"></i>
                  </a>
                  <h4>Course-3</h4>
                  <p>
                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>

        </div>
      </div>
    </div><!-- End Services Section -->

    <!-- ======= Team Section ======= -->
    <div id="team" class="our-team-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Our Teachers</h2>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($data['teachers'] as $teacher)
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="#">
                  <img src="{{ url(Storage::url('teachers/' . $teacher->image)) }}" alt="">
                </a>
                <div class="team-social-icon text-center">
                  <ul>
                    <li>
                      <a href="#">
                        <i class="bi bi-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="bi bi-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="bi bi-instagram"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="team-content text-center">
                <h4>{{$teacher->name}}</h4>
                <p>{{$teacher->designation}}</p>
              </div>
            </div>
          </div>
          @endforeach
          <!-- End column -->
        </div>
      </div>
    </div><!-- End Team Section -->

    <!-- ======= Rviews Section ======= -->
    <div class="reviews-area">
      <div class="row g-0">
        <div class="col-lg-6">
          <img src="assets/img/about/2.jpg" alt="" class="img-fluid">
        </div>
        <div class="col-lg-6 work-right-text d-flex align-items-center">
          <div class="px-5 py-5 py-lg-0">
            <h2>working with us</h2>
            <h5>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.</h5>
            <a href="#contact" class="ready-btn scrollto">Contact us</a>
          </div>
        </div>
      </div>
    </div><!-- End Rviews Section -->

    <!-- ======= Portfolio Section ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Our Image Gallary</h2>
            </div>
          </div>
        </div>

        <div class="row awesome-project-content portfolio-container">

          <!-- portfolio-item start -->
          @foreach ($data['gallarys'] as $gallary)

          <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-app portfolio-item">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="{{ url(Storage::url('gallarys/' . $gallary->image)) }}" alt="" /></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="portfolio-lightbox" data-gallery="myGallery" href="{{ url(Storage::url('gallarys/' . $gallary->image)) }}">
                      <h4>{{$gallary->title}}</h4>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <!-- portfolio-item end -->

        </div>
      </div>
    </div><!-- End Portfolio Section -->




    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Latest Blogs</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start Right Blog-->
            @foreach ($data['blogs'] as $blog)
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="{{route('blog.show',$blog->slug)}}">
                    <img src="{{ url(Storage::url('blogs/' . $blog->image)) }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="date-type">
                    <i class="fa fa-clock"></i>{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="{{route('blog.show',$blog->slug)}}">{{$blog->title}}</a>
                  </h4>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 200, $end='...') }}</p>
                </div>
                <span>
                  <a href="{{route('blog.show',$blog->slug)}}" class="ready-btn">Read more</a>
                </span>
              </div>
            </div>
            @endforeach
            <!-- End Right Blog-->
          </div>
        </div>
      </div>
    </div><!-- End Blog Section -->

    <!-- ======= Suscribe Section ======= -->
    <div class="suscribe-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
            <div class="suscribe-text text-center">
              <h3>Welcome to Freedom Chemistry Lab Academy</h3>
              <a class="sus-btn" href="{{route('blog.index')}}">Blogs</a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Suscribe Section -->

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Contact us</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <div class="col-md-4">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="bi bi-phone"></i>
                  <p>
                    Call: +1 5589 55488 55<br>
                    <span>Saturday-Thursday (9am-5pm)</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="bi bi-envelope"></i>
                  <p>
                    Email: info@fcla-edu.com<br>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="bi bi-geo-alt"></i>
                  <p>
                    Location: Fire Service, Green Rd<br>
                    <span>Tangail, Bangladesh</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- Start Google Map -->
            <div class="col-md-6">
              <!-- Start Map -->
              <div style="width: 100%"><iframe width="100%" height="380" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=380&amp;hl=en&amp;q=Freedom%20Chemistry%20Lab%20Academy%20-%20FCLA+(My%20Business%20Name)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/truck-gps/">delivery van gps</a></iframe></div>
              <!-- End Map -->
            </div>
            <!-- End Google Map -->

            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form contact-form">
                <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                  </div>
                  <div class="form-group mt-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                  </div>
                  <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                  </div>
                  <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit">Send Message</button></div>
                </form>
              </div>
            </div>
            <!-- End Left contact -->
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

@endsection
