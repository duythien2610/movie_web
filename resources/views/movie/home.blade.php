<x-movie-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <div class="list-movie">
        @foreach($movies as $movie)
        <div class="movie">
            <a href="#">
                <img src="{{ $movie->image_link }}" alt="{{ $movie->movie_name }}" style="width:100%; height:250px; object-fit:cover;">
                <div class="movie-info" style="display:block; padding: 10px;">
                    <p style="font-weight:bold; margin:5px 0 2px; color: black;">
                        {{ $movie->movie_name_vn ? $movie->movie_name_vn . ' - ' . $movie->movie_name : $movie->movie_name }}
                    </p>
                    <p style="color:#666; margin:0; font-size:14px;">{{ $movie->release_date }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</x-movie-layout>
