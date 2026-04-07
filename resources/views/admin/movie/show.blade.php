<x-movie-layout>
    <x-slot name="title">
        Chi tiết phim
    </x-slot>

    <style>
        .detail-panel {
            padding: 8px 14px 12px 14px;
            background: #fff;
            min-height: 760px;
        }

        .detail-poster {
            width: 220px;
            max-width: 100%;
            border: 1px solid #ddd;
        }

        .detail-box {
            border: 1px solid #ddd;
            padding: 18px;
            background: #fff;
        }

        .detail-box p {
            margin-bottom: 10px;
            line-height: 1.55;
        }
    </style>

    <div class="detail-panel">
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary btn-sm mb-3">Quay lại</a>

        <div class="detail-box">
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    <img src="{{ $movie->display_image }}" alt="{{ $movie->movie_name_vn ?? $movie->movie_name }}" class="detail-poster">
                </div>
                <div class="col-md-8">
                    <h3>{{ $movie->movie_name_vn ?: $movie->movie_name }}</h3>
                    <p><strong>Tên tiếng Anh:</strong> {{ $movie->movie_name }}</p>
                    <p><strong>Ngày phát hành:</strong> {{ $movie->release_date ?? 'Chưa cập nhật' }}</p>
                    <p><strong>Điểm đánh giá:</strong> {{ $movie->vote_average ?? 0 }}</p>
                    <p><strong>Thể loại:</strong> {{ $genres->isNotEmpty() ? $genres->implode(', ') : 'Chưa cập nhật' }}</p>
                    <p><strong>Mô tả:</strong> {{ $movie->overview_vn ?: ($movie->overview ?: 'Chưa có mô tả.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-movie-layout>
