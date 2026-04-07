<x-movie-layout>
    <x-slot name="title">
        Danh sách phim
    </x-slot>

    <style>
        .admin-panel {
            padding: 8px 14px 12px 14px;
            background: #fff;
            min-height: 760px;
        }

        .admin-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .admin-action-bar {
            margin: 8px 0 10px 0;
        }

        .movie-thumb {
            width: 60px;
            height: 90px;
            object-fit: cover;
            border: 1px solid #d9d9d9;
        }

        #id-table {
            margin-top: 6px !important;
            border-collapse: collapse !important;
        }

        #id-table thead th {
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            background: #fff;
        }

        #id-table td {
            vertical-align: top;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .movie-summary {
            min-width: 210px;
            line-height: 1.55;
        }

        .movie-actions {
            display: flex;
            gap: 6px;
            align-items: flex-start;
        }

        .admin-table-wrap {
            overflow-x: auto;
        }

        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
            margin-bottom: 8px;
        }

        div.dataTables_wrapper div.dataTables_length {
            margin-bottom: 8px;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

    <div class="admin-panel">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h1 class="admin-title">DANH SÁCH PHIM</h1>

        <div class="admin-action-bar">
            <a href="{{ route('admin.movies.create') }}" class="btn btn-success btn-sm">Thêm</a>
        </div>

        <div class="admin-table-wrap">
            <table class="table table-bordered table-striped" id="id-table" style="width:100%; min-width: 860px;">
                <thead>
                    <tr>
                        <th>Ảnh đại diện</th>
                        <th>Tiêu đề</th>
                        <th>Giới thiệu</th>
                        <th>Ngày phát hành</th>
                        <th>Điểm đánh giá</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr>
                            <td>
                                <img src="{{ $movie->display_image }}" alt="{{ $movie->movie_name_vn ?? $movie->movie_name }}" class="movie-thumb">
                            </td>
                            <td class="movie-summary">{{ $movie->movie_name_vn ?: $movie->movie_name }}</td>
                            <td class="movie-summary">{{ \Illuminate\Support\Str::limit($movie->overview_vn ?? $movie->overview ?? 'Chưa có mô tả.', 60) }}</td>
                            <td class="text-center">{{ $movie->release_date ?? 'Chưa cập nhật' }}</td>
                            <td class="text-center">{{ $movie->vote_average !== null ? $movie->vote_average : 0 }}</td>
                            <td>
                                <div class="movie-actions">
                                    <a href="{{ route('admin.movies.show', $movie->id) }}" class="btn btn-primary btn-sm">Xem</a>
                                    <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa mềm phim này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('#id-table').DataTable({
                responsive: false,
                autoWidth: false,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                bStateSave: true,
                language: {
                    search: 'Search:',
                    lengthMenu: '_MENU_ entries per page',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    paginate: {
                        first: '«',
                        previous: '‹',
                        next: '›',
                        last: '»'
                    }
                }
            });
        });
    </script>
</x-movie-layout>
