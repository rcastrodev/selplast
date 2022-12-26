<a href="{{ route('categoria', ['id'=> $c->id ]) }}" class="card producto text-decoration-none bg-light d-flex justify-content-center align-items-center py-5" style="height: 261px;">
        @if ($c->image)
            <img src="{{ asset($c->image) }}" class="img-fluid img-product" style="min-height: 146px; max-height:146px;">
        @else
            <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product" style="min-height: 146px; max-height:146px;">
        @endif
    <div class="card-body align-items-center d-flex justify-content-center">
        <p class="card-text text-center mb-0 fw-bold ps-2">
            <span class="font-size-18 text-dark" style="font-weight: 500;">{{ Str::limit($c->name, 40) }}</span>
        </p>
    </div>
</a>