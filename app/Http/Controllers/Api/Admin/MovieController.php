<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMovieRequest;
use App\Http\Requests\Api\Admin\Movie\UpdateMovieRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
	public function index()
	{
		$userMovies = Movie::where('user_id', auth()->user()->id)->latest()->get();
		$movie = $userMovies->map(function ($movie) {
			return [
				'name'  => $movie->name,
				'image' => Storage::url($movie->image),
				'year'  => $movie->year,
			];
		});
	}

	public function store(StoreMovieRequest $request)
	{
		$movie = Movie::create([
			'title'         => json_encode([
				'en' => $request['title_en'],
				'ka' => $request['title_ka'],
			]),
			'director'      => json_encode([
				'en' => $request['director_en'],
				'ka' => $request['director_ka'],
			]),
			'description'   => json_encode([
				'en' => $request['description_en'],
				'ka' => $request['description_ka'],
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
			return response()->json($movie);
		}

		return response()->json('Unauthorized', 401);
	}

	public function update(UpdateMovieRequest $request)
	{
		$movie = Movie::where('id', $request->id)->first();

		$attributes = [
			'title'         => json_encode([
				'en' => $request['title_en'],
				'ka' => $request['title_ka'],
			]),
			'genre'         => json_encode($request['genre']),

			'director'      => json_encode([
				'en' => $request['director_en'],
				'ka' => $request['director_ka'],
			]),
			'description'   => json_encode([
				'en' => $request['description_en'],
				'ka' => $request['description_ka'],
			]),
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

	public function destroy(Movie $movie)
	{
		$movie->delete();
		return response()->json('Movie deleted successfully', 200);
	}
}
