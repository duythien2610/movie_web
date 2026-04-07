<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;



class MovieController2 extends Controller
{
    /**
     * Lấy danh sách thể loại phim để truyền vào layout.
     * Nếu bảng genre chưa tồn tại (chưa merge từ người phụ trách admin) thì trả về mảng rỗng.
     */
    private function getGenres()
    {
        try {
            if (Schema::hasTable('genre')) {
                return DB::table('genre')->get();
            }
        } catch (\Exception $e) {
            // bảng chưa có, trả về rỗng
        }
        return collect();
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $genre   = $this->getGenres();

        if (Schema::hasTable('movie') && Schema::hasColumn('movie', 'status')) {
            $movies = DB::select("select * from movie where movie_name_vn like ? and status = 1", ["%" . $keyword . "%"]);
        } elseif (Schema::hasTable('movie')) {
            $movies = DB::select("select * from movie where movie_name_vn like ?", ["%" . $keyword . "%"]);
        } else {
            $movies = [];
        }

        return view('movie.search', compact('movies', 'keyword', 'genre'));
    }

    public function show($id)
    {
        $genre = $this->getGenres();

        if (Schema::hasTable('movie') && Schema::hasColumn('movie', 'status')) {
            $movie = DB::table('movie')->where('id', $id)->where('status', 1)->first();
        } elseif (Schema::hasTable('movie')) {
            $movie = DB::table('movie')->where('id', $id)->first();
        } else {
            $movie = null;
        }

        if (!$movie) {
            abort(404, 'Không tìm thấy bộ phim. (Có thể phim được đặt trạng thái ẩn)');
        }

        return view('movie.detail', compact('movie', 'genre'));
    }
}
