<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MovieController3 extends Controller
{
    public function index(): View
    {
        $movies = DB::table('movie')
            ->select('id', 'movie_name', 'movie_name_vn', 'image', 'image_link', 'overview', 'overview_vn', 'release_date', 'vote_average', 'popularity')
            ->when($this->hasStatusColumn(), fn ($query) => $query->where('status', 1))
            ->orderByDesc('release_date')
            ->orderByDesc('id')
            ->get()
            ->map(fn ($movie) => $this->appendImageUrl($movie));

        return view('admin.movie.index', compact('movies'));
    }

    public function create(): View
    {
        return view('admin.movie.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'movie_name' => ['required', 'string', 'max:100'],
                'movie_name_vn' => ['required', 'string', 'max:100'],
                'image' => ['required', 'file', 'image'],
                'overview_vn' => ['required', 'string'],
                'release_date' => ['required', 'date_format:Y-m-d'],
            ],
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $imagePath = $this->storeImage($request);
        $nextMovieId = ((int) DB::table('movie')->max('id')) + 1;

        DB::transaction(function () use ($validated, $imagePath, $nextMovieId) {
            $movieData = [
                'id' => $nextMovieId,
                'movie_name' => $validated['movie_name'],
                'movie_name_vn' => $validated['movie_name_vn'],
                'original_name' => $validated['movie_name'],
                'image' => $imagePath,
                'image_link' => null,
                'backdrop' => null,
                'backdrop_link' => null,
                'tagline' => null,
                'tagline_vn' => null,
                'overview' => $validated['overview_vn'],
                'overview_vn' => $validated['overview_vn'],
                'runtime' => null,
                'budget' => null,
                'revenue' => null,
                'popularity' => 0,
                'vote_average' => 0,
                'vote_count' => 0,
                'country_code' => null,
                'country_name' => null,
                'trailer' => null,
                'release_date' => $validated['release_date'],
                'updated_at' => now(),
            ];

            if ($this->hasStatusColumn()) {
                $movieData['status'] = 1;
            }

            DB::table('movie')->insert($movieData);

            $defaultGenreId = DB::table('genre')->value('id');

            if ($defaultGenreId) {
                DB::table('movie_genre')->insert([
                    'id_movie' => $nextMovieId,
                    'id_genre' => $defaultGenreId,
                ]);
            }
        });

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Thêm phim mới thành công.');
    }

    public function show(int $id): View
    {
        $movie = DB::table('movie')
            ->when($this->hasStatusColumn(), fn ($query) => $query->where('status', 1))
            ->where('id', $id)
            ->first();

        abort_if(! $movie, 404);

        $movie = $this->appendImageUrl($movie);
        $genres = DB::table('movie_genre')
            ->join('genre', 'genre.id', '=', 'movie_genre.id_genre')
            ->where('movie_genre.id_movie', $id)
            ->pluck('genre.genre_name_vn');

        return view('admin.movie.show', compact('movie', 'genres'));
    }

    public function destroy(int $id): RedirectResponse
    {
        abort_unless($this->hasStatusColumn(), 500, 'Cần chạy migration thêm cột status trước khi xóa mềm.');

        DB::table('movie')
            ->where('id', $id)
            ->update([
                'status' => 0,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Đã xóa mềm bộ phim thành công.');
    }

    private function hasStatusColumn(): bool
    {
        return Schema::hasColumn('movie', 'status');
    }

    private function appendImageUrl(object $movie): object
    {
        $movie->display_image = $this->resolveImageUrl($movie->image ?? null, $movie->image_link ?? null);

        return $movie;
    }

    private function resolveImageUrl(?string $image, ?string $imageLink): string
    {
        if ($image && Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        if ($image && file_exists(public_path($image))) {
            return asset($image);
        }

        if ($imageLink && Str::startsWith($imageLink, ['http://', 'https://'])) {
            return $imageLink;
        }

        if ($imageLink && file_exists(public_path($imageLink))) {
            return asset($imageLink);
        }

        return 'https://via.placeholder.com/300x450?text=No+Image';
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $directory = public_path('uploads/movies');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = date('YmdHis').'_'.Str::lower(Str::random(6));
        $extension = $file->getClientOriginalExtension();
        $relativePath = 'uploads/movies/'.$fileName.'.'.$extension;

        $file->move($directory, $fileName.'.'.$extension);

        return $relativePath;
    }

    private function validationMessages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi ký tự.',
            'integer' => ':attribute phải là số nguyên.',
            'numeric' => ':attribute phải là số.',
            'min' => ':attribute không hợp lệ.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'date_format' => ':attribute phải đúng định dạng yyyy-mm-dd.',
            'image.image' => 'Ảnh đại diện phải là file ảnh hợp lệ.',
            'image.required' => 'Ảnh đại diện không được để trống.',
        ];
    }

    private function validationAttributes(): array
    {
        return [
            'movie_name' => 'tên phim',
            'movie_name_vn' => 'tên phim tiếng Việt',
            'image' => 'ảnh đại diện',
            'overview_vn' => 'mô tả tiếng Việt',
            'release_date' => 'ngày phát hành',
        ];
    }
}
