<div class="fixed-top">
    <header class="header bg-black d-sm-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <div class="d-flex font-size-14">
                @php $phone = Str::of($data->phone1)->explode('|') @endphp
                @php $phone2 = Str::of($data->phone2)->explode('|') @endphp
                <div class="d-flex align-items-center">
                    <i class="fal fa-phone-alt text-white d-block me-2" style="font-size: 20px;"></i>
                    <div class="">
                        @if(count($phone) == 2)
                            <a href="tel:{{$phone[0]}}" class="text-white text-decoration-none underline">{{ $phone[1] }}</a>
                        @else
                            <a href="tel:{{$data->phone1}}" class="text-white text-decoration-none underline">{{ $data->phone1 }}</a>
                        @endif
                        <span class="text-white mx-1">/</span>
                        @if(count($phone2) == 2)
                            <a href="tel:{{$phone2[0]}}" class="text-white text-decoration-none underline">{{ $phone2[1] }}</a>
                        @else
                            <a href="tel:{{$data->phone2}}" class="text-white text-decoration-none underline">{{ $data->phone2 }}</a>
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center ms-3">
                    <i class="fal fa-envelope text-white d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                    <div class="text-start">
                        <a href="mailto:{{ $data->email }}" class="text-white text-decoration-none underline">{{ $data->email }}</a>        
                    </div>     
                </div>
            </div>
            <div class="">
                <a href="" class="me-3"><i class="fab fa-instagram text-white me-2"></i></a>
                <a href="" class="me-3"><i class="fab fa-facebook-f text-white me-2"></i></a>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light w-100 py-md-4 py-sm-1 bg-white">
        <div class="container">
            <a class="navbar-brand d-flex" href="{{ route('index') }}">
                <img src="{{ asset($data->logo_header) }}" class="img-fluid logo-header d-block me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav position-relative align-items-center justify-content-between">
                    <li class="nav-item @if(Request::is('/')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('/')) active @endif" href="{{ route('index') }}">Inicio</a>
                    </li>
                    <li class="nav-item @if(Request::is('empresa')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('empresa')) active @endif" href="{{ route('empresa') }}">Empresa</a>
                    </li>
                    <li class="nav-item @if(Request::is('categorias') || Request::is('categoria/*') || Request::is('sub-categoria/*')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('categorias') || Request::is('categoria/*') || Request::is('sub-categoria/*')) active @endif" href="{{ route('categorias') }}">Productos</a>
                    </li>
                    <li class="nav-item @if(Request::is('aplicaciones')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('aplicaciones')) active @endif" href="{{ route('aplicaciones') }}">Aplicaciones</a>
                    </li>
                    <li class="nav-item @if(Request::is('industrias')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('industrias')) active @endif" href="{{ route('industrias') }}" >Industrias</a>
                    </li> 
                    <li class="nav-item @if(Request::is('calidad')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('calidad')) active @endif" href="{{ route('calidad') }}" >Calidad</a>
                    </li> 
                    @if ($data->news)
                        <li class="nav-item @if(Request::is('novedades') || Request::is('novedad/*')) position-relative @endif">
                            <a class="nav-link font-size-16 text-dark @if(Request::is('novedades') || Request::is('novedad/*')) active @endif" href="{{ route('novedades') }}" >Novedades</a>
                        </li>         
                    @endif
                    <li class="nav-item @if(Request::is('contacto')) position-relative @endif">
                        <a class="nav-link font-size-16 text-dark @if(Request::is('contacto')) active @endif" href="{{ route('contacto') }}" >Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  
</div>
<div id="margin-topfixed"></div>


