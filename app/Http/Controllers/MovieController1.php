<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MovieController1 extends Controller
{
    /**
     * Trang chủ: hiển thị 12 phim phổ biến, đánh giá cao, mới nhất.
     */
    public function index()
    {
        $query = DB::table('movie')
            ->where('popularity', '>', 450)
            ->where('vote_average', '>', 7);

        // Chỉ lọc status = 1 nếu cột đã tồn tại
        if (Schema::hasColumn('movie', 'status')) {
            $query->where('status', 1);
        }

        $movies = $query->orderBy('release_date', 'desc')
            ->limit(12)
            ->get();

        return view('movie.home', [
            'movies' => $movies,
            'title'  => 'Trang chủ - Movie Web',
        ]);
    }

    /**
     * Lọc phim theo thể loại.
     */
    public function filterByGenre($id)
    {
        $genre = DB::table('genre')->where('id', $id)->first();

        $query = DB::table('movie')
            ->join('movie_genre', 'movie.id', '=', 'movie_genre.id_movie')
            ->where('movie_genre.id_genre', $id)
            ->select('movie.*');

        if (Schema::hasColumn('movie', 'status')) {
            $query->where('movie.status', 1);
        }

        $movies = $query->orderBy('movie.release_date', 'desc')
            ->limit(12)
            ->get();

        $genreName = $genre?->genre_name_vn ?? 'Thể loại';

        return view('movie.home', [
            'movies' => $movies,
            'title'  => $genreName . ' - Movie Web',
        ]);
    }
}
