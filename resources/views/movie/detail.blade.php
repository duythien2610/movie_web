<x-movie-layout>
    <x-slot name="title">
        {{ $movie->movie_name_vn }}
    </x-slot>

    <div class="movie-info" style="margin-top: 10px;">
        <div class="movie-poster" style="padding-right: 20px;">
            @php
                $imagePath = isset($movie->image) ? asset('images/'.$movie->image) : asset('images/default.jpg');
            @endphp
            <img src="{{ $imagePath }}" alt="{{ $movie->movie_name_vn }}" style="width: 100%;">
        </div>
        <div class="movie-details">
            <h4 style="margin-bottom: 15px;">{{ $movie->movie_name_vn }}</h4>
            <p style="margin-bottom: 5px;">Ngày phát hành: <strong>{{ $movie->release_date ?? '' }}</strong></p>
            <p style="margin-bottom: 5px;">Quốc gia: <strong>{{ $movie->country ?? 'United States of America' }}</strong></p>
            <p style="margin-bottom: 5px;">Thời gian: <strong>{{ $movie->time ?? '119 phút' }}</strong></p>
            <p style="margin-bottom: 5px;">Doanh thu: <strong>{{ $movie->revenue ?? '208' }}</strong></p>
            
            <div style="margin-top: 10px;">
                <p style="margin-bottom: 5px;"><strong>Mô tả:</strong></p>
                <p style="line-height: 1.6;">{{ $movie->description ?? 'Dan Morgan là người toàn diện: một người chồng tận tụy, một người cha yêu thương, một nhân viên bán xe tiếng tăm. Anh cũng là một cựu sát thủ. Và khi những rắc rối quá khứ trở lại ám ảnh hiện tại, anh buộc phải đưa gia đình không mảy may nghi ngờ của mình vào một cuộc hành trình chưa từng có.' }}</p>
            </div>
            
            <button class="btn btn-success" style="margin-top:10px; border-radius: 3px;">Xem trailer</button>
        </div>
    </div>
</x-movie-layout>
