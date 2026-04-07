<x-movie-layout>
    <x-slot name="title">
        Kết quả tìm kiếm cho: {{ $keyword }}
    </x-slot>

    <h3 style="margin-left: 10px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ccc;">Kết quả tìm
        kiếm cho: "{{ $keyword }}"</h3>

    <div class="list-movie">
        @if(count($movies) > 0)
            @foreach($movies as $movie)
                <div class="movie">
                    <a href="{{ url('/phim/' . $movie->id) }}">
                        @php

                            $imagePath = isset($movie->image) ? asset('images/' . $movie->image) : asset('images/default.jpg');
                        @endphp
                        <img src="{{ $imagePath }}" alt="{{ $movie->movie_name_vn }}"
                            style="width: 100%; height: 320px; object-fit: cover;">
                        <div style="padding: 10px;">
                            <h6
                                style="font-size:15px; margin-bottom:5px; font-weight: bold; color: black; line-height: 1.4;">
                                {{ $movie->movie_name_vn }}</h6>
                            <p style="font-size:14px; color:#555; margin-bottom: 0;">
                                {{ $movie->release_date ?? '' }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div style="grid-column: span 4; text-align: center; padding: 50px;">
                <p>Không tìm thấy phần phim nào phù hợp.</p>
            </div>
        @endif
    </div>
</x-movie-layout>