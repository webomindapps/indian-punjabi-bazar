<div class="container secs healthy">
    <h2 class="sec_title">Health Goals And Concerns</h2>
    {{-- {{dd($health_goals->child)}} --}}
    <div class="owl-carousel owl-theme owl-one">
        @for ($i = 0; $i < min(11, count($health_goals->child)); $i++)
            @php
                $item = $health_goals->child[$i];
            @endphp
            <a href="{{ route('productByCategory', $item->slug) }}">
                <div class="col text-center" style="--bg-color: #f5fdfa">
                    <img src="{{ asset($item->getImage() ?? 'frontend/assets/images/default.png') }}" alt=""
                        class="img-fluid circle mx-auto">
                    <h3>{{ $item->name }}</h3>
                </div>
            </a>
        @endfor
    </div>
    <div class="btn_wrapper text-center">
        <a href="{{ route('all.healths') }}?is_new=1" class="view-all">
            All Health Goals And Concerns
            <i class='bx bx-right-arrow-alt'></i>
        </a>
    </div>
</div>
