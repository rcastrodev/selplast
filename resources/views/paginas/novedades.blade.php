@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-sm-none d-xl-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-32 text-red">Novedades</h1>
		</div>
	</div>
</div>
<div class="py-5 container">
    <div class="row">
        @foreach ($news as $n)
            <div class="col-sm-12 col-lg-4 mb-4">
                @includeIf('paginas.partials.novedad', ['e' => $n])
            </div>			
        @endforeach
    </div>
</div>
@endsection
@push('head')

@endpush
@push('scripts')	
@endpush
       
