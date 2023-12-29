<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.index') }}">
                <h2>NewsBD Blog<em>.</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.index') }}">{{__('Home')}}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">{{__('About Us')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('front.all_post')}}">{{__('Blog Entries')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.all_post') }}">{{__('Post Details')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contact') }}">{{__('Contact Us')}}</a>
                    </li>

                    <ul class="float-end" style="">
                        <li class="nav-item">
                            {{-- <a href="" class="dropdown nav-link">Auth <i class="fas fa-arrow-down"></i></a> 
                <a class="nav-link" type="button" class="btn btn-success btn-sm" href="{{route('login')}}">Login</a> --}}

                            <div class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{__('Profile')}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ route('login') }}"> {{__('Login')}} <i
                                                class="fas fa-right-to-bracket"></i></a></li>
                                    <li><a class="nav-link" href="{{ route('register') }}"> {{__('Sign Up')}} <i
                                                class="fas fa-user-plus"></i></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="switch-language" style="margin-right: 5px;">
            <form action="" method="GET" id="switch_language_form">
                <select name="lang" class="form-select form-select-sm" id="switch_language">
                    <option value="en">EN</option>
                    <option value="bn">BN</option>
                </select>
            </form>
        </div>
    </nav>
</header>

@push('js')
    <script>
        
        if (localStorage.lang == 'bn'){
            $('#switch_language').val('bn')
        }else{
            $('#switch_language').val('en')
        }
        $('#switch_language').on('change', function(e){
            e.preventDefault();
            localStorage.lang = $(this).val();
            $('#switch_language_form').submit()
        })
    </script>
@endpush