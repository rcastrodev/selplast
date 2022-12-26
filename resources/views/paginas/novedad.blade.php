@extends('paginas.partials.app')
@section('content')
<div class="row container mx-auto my-5">
    <div class="col-sm-12 col-md-8 mx-auto mt-5">
        <div>
            <a href="{{ route('novedades') }}" class="d-block text-decoration-none mb-4" style="color: #848484;"><i class="fal fa-arrow-left"></i> Novedades</a>
            <img src="{{ asset($new->image) }}" class="img-fluid w-100 d-block mb-5">
            <span class="mb-5 d-block" style="color: #828282;">{{ date_format($new->created_at, 'd/m/Y') }}</span>
            <h1 class="font-size-28 mb-5">{{ $new->content_1 }}</h1>
            <div class="font-size-18">{!! $new->content_2 !!}</div>
        </div>
    </div>
</div>
@endsection
@push('head')
@endpush
@push('scripts')	
@endpush
       
