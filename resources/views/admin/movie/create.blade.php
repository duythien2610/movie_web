<x-movie-layout>
    <x-slot name="title">
        Thêm phim
    </x-slot>

    <style>
        .create-panel {
            padding: 8px 14px 12px 14px;
            background: #fff;
            min-height: 760px;
        }

        .create-title {
            color: #1d4ed8;
            text-align: center;
            font-size: 18px;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .create-panel label {
            margin-bottom: 6px;
        }

        .create-panel .form-control,
        .create-panel .form-control-file {
            border-radius: 2px;
        }

        .create-panel .btn-primary {
            min-width: 70px;
            display: block;
            margin: 0 auto;
        }
    </style>

    <div class="create-panel">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="create-title">THÊM PHIM</h1>

        <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="movie_name">Tên tiếng Anh</label>
                <input type="text" class="form-control" id="movie_name" name="movie_name" value="{{ old('movie_name') }}">
            </div>

            <div class="form-group">
                <label for="movie_name_vn">Tên tiếng Việt</label>
                <input type="text" class="form-control" id="movie_name_vn" name="movie_name_vn" value="{{ old('movie_name_vn') }}">
            </div>

            <div class="form-group">
                <label for="release_date">Ngày phát hành</label>
                <input type="text" class="form-control" id="release_date" name="release_date" placeholder="yyyy-mm-dd" value="{{ old('release_date') }}">
            </div>

            <div class="form-group">
                <label for="overview_vn">Mô tả</label>
                <textarea class="form-control" id="overview_vn" name="overview_vn" rows="4">{{ old('overview_vn') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Ảnh đại diện</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</x-movie-layout>
