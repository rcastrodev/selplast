@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-32 text-red">INDUSTRIAS</h1>
		</div>
	</div>
</div>
<div class="py-5 container mx-auto">
    <div class="row">
        @foreach ($industrias as $i)
            <div class="col-sm-12 col-md-4 mb-4">
                @includeIf('paginas.partials.industria', ['i' => $i])
            </div>
        @endforeach	
    </div>

</div>
@endsection
@push('head')
    <style>
        .carousel-item{
            min-height: 340px;
        }
    </style>
@endpush
@push('scripts')	
@endpush
       
