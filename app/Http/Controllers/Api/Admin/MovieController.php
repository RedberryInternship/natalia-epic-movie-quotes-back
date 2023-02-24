<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMovieRequest;
use App\Http\Requests\Admin\UpdateMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
	public function index()
	{
		$userMovies = Movie::where('user_id', auth()->user()->id)->latest()->get();
		$movie = $userMovies->map(function ($movie) {
			return [
				'id'     => $movie->id,
				'title'  => json_decode($movie->title),
				'image'  => Storage::url($movie->image),
				'year'   => $movie->year,
				'quotes' => $movie->quotes,
			];
		});
		return $movie;
	}

	public function store(StoreMovieRequest $request)
	{
		$movie = Movie::create([
			'title'         => json_encode([
				'en' => $request['title_en'],
				'ge' => $request['title_ge'],
			]),
			'director'      => json_encode([
				'en' => $request['director_en'],
				'ge' => $request['director_ge'],
			]),
			'description'   => json_encode([
				'en' => $request['description_en'],
				'ge' => $request['description_ge'],
			]),
			'genre'         => json_encode($request['genre']),

			'year'          => $request['year'],
			'user_id'       => auth()->user()->id,
			'budget'        => $request['budget'],
			'image'         => request()->file('image')->store('images'),
		]);

		if (!$movie)
		{
			return response()->json('Error has occurred', 422);
		}

		return response()->json('success', 201);
	}

	public function get($id)
	{
		$movie = Movie::where('id', $id)->first();
		if (auth()->user()->id === $movie->user_id)
		{
			return [
				'id'              => $movie->id,
				'title'           => json_decode($movie->title),
				'image'           => Storage::url($movie->image),
				'year'            => $movie->year,
				'budget'          => $movie->budget,
				'director'        => json_decode($movie->director),
				'description'     => json_decode($movie->description),
				'quotes'          => $movie->quotes,
				'genre'           => json_decode($movie->genre),
			];
		}

		return response()->json('Unauthorized', 401);
	}

	public function update(UpdateMovieRequest $request)
	{
		$movie = Movie::where('id', $request->id)->first();

		$attributes = [
			'title'         => json_encode([
				'en' => $request['title_en'],
				'ge' => $request['title_ge'],
			]),

			'director'      => json_encode([
				'en' => $request['director_en'],
				'ge' => $request['director_ge'],
			]),
			'description'   => json_encode([
				'en' => $request['description_en'],
				'ge' => $request['description_ge'],
			]),
			'genre'         => json_encode($request['genre']),

			'year'          => $request['year'],
			'budget'        => $request['budget'],
		];

		if (isset($request['image']))
		{
			$attributes['image'] = request()->file('image')->store('images');
		}

		$movie->update($attributes);

		return response()->json($movie);
	}

	public function search(Request $request)
	{
		$search = $request->input('search');
		$movies = Movie::where('user_id', auth()->user()->id)
				->where('title->en', 'like', $search . '%')
				->orWhere('title->ge', 'like', $search . '%')
				->get()
				->map(function ($movie) {
					$movie->title = json_decode($movie->title);
					$movie->image = Storage::url($movie->image);
					return $movie;
				});

		if (!$movies)
		{
			return response()->json('Error has occurred', 422);
		}

		return response()->json('success', 201);
	}

	public function destroy($id)
	{
		$movie = Movie::where('id', $id);
		$movie->delete();
		return response()->json('Movie deleted successfully', 200);
	}
}
