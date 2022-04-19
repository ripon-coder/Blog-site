<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>

                {{-- Blog --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#blog"
                    aria-expanded="false" aria-controls="blog">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Blog
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="blog" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin-blog.create')}}">Create Blog</a>
                        <a class="nav-link" href="{{route('admin-blog.index')}}">All Blog</a>
                    </nav>
                </div>

                {{-- Noitce --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Notice"
                    aria-expanded="false" aria-controls="Notice">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Notice
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="Notice" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin-notice.create')}}">Create Notice</a>
                        <a class="nav-link" href="{{route('admin-notice.index')}}">All Notice</a>
                    </nav>
                </div>

                {{-- Category --}}

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#category"
                    aria-expanded="false" aria-controls="category">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('category.create')}}">Create Category</a>
                        <a class="nav-link" href="{{route('category.index')}}">All Category</a>
                    </nav>
                </div>

                {{-- Sliders --}}

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#sliders"
                    aria-expanded="false" aria-controls="sliders">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Sliders
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="sliders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('slider.create')}}">Create Slider</a>
                        <a class="nav-link" href="{{route('slider.index')}}">All Slider</a>
                    </nav>
                </div>

                {{-- Our Teacher --}}

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#teacher"
                    aria-expanded="false" aria-controls="teacher">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Teacher List
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="teacher" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin-teacher.create')}}">Create Teacher</a>
                        <a class="nav-link" href="{{route('admin-teacher.index')}}">All Teacher</a>
                    </nav>
                </div>

                {{-- Our Gallary --}}

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gallary"
                    aria-expanded="false" aria-controls="gallary">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Image Gallery
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="gallary" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin-gallary.create')}}">Add New Image</a>
                        <a class="nav-link" href="{{route('admin-gallary.index')}}">All Image</a>
                    </nav>
                </div>

                {{-- Chairman --}}

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#chairman"
                    aria-expanded="false" aria-controls="chairman">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Chairman
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="chairman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('chairman.create')}}">Add New Chairman</a>
                        <a class="nav-link" href="{{route('chairman.index')}}">Chairman</a>
                    </nav>
                </div>
                {{-- Logout --}}
                <div class="m-2 px-2">
                    {{ Form::open(array('url' =>URL::Route("logout"), 'method' => 'POST', 'name' => 'logout')) }}
                    <button type="submit" class="btn btn-primary btn-sm">LOGOUT</button>
                    {{ Form::close() }}
                </div>








            </div>
        </div>
    </nav>
</div>