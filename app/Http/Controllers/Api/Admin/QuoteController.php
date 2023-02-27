<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuoteRequest;
use App\Http\Requests\Admin\UpdateQuoteRequest;
use App\Http\Resources\GetAllQuoteResource;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
	public function index($id)
	{
		$quotes = Quote::where('movie_id', $id)
					   ->with('movie', 'comments', 'likes')
					   ->orderBy('created_at', 'desc')
					   ->get();

		return response()->json(QuoteResource::collection($quotes));
	}

	public function store(StoreQuoteRequest $request)
	{
		$quote = Quote::create([
			'quote'          => json_encode([
				'en' => $request['quote_en'],
				'ge' => $request['quote_ge'],
			]),
			'movie_id'       => $request->movie_id,
			'user_id'        => auth()->user()->id,
			'image'          => request()->file('image')->store('images'),
		]);

		if (!$quote)
		{
			return response()->json('Error has occurred', 422);
		}

		return response()->json('success', 201);
	}

	public function get($id)
	{
		$quote = Quote::where('id', $id)
		   ->with('user', 'movie', 'comments', 'comments.user', 'likes')
		   ->get()
		   ->map(function ($quote) {
		   	$quote->quote = json_decode($quote->quote);
		   	$quote->image = Storage::url($quote->image);
		   	return $quote;
		   });
		return response()->json($quote, 200);
	}

	public function getAll(Request $request)
	{
		$quotes = Quote::with('user', 'comments', 'comments.user', 'movie', 'likes')
		   ->orderBy('created_at', 'desc')
		   ->skip($request->range)->take(3)->get();
		$quote = Quote::count();
		return response()->json(['quotes' => GetAllQuoteResource::collection($quotes), 'quote_count' => $quote], 200);
	}

	public function search(Request $request)
	{
		$search = $request->search;
		if ($search[0] == '@')
		{
			$search = substr($search, 1);
			$quotes = Quote::whereHas('movie', function ($query) use ($search) {
				$query->where('title->en', 'like', $search . '%')
				   ->orWhere('title->ge', 'like', $search . '%');
			})->with('comments.user')->get();
		}
		elseif ($search[0] == '#')
		{
			$search = substr($search, 1);
			$quotes = Quote::query()
			   ->where('quote->en', 'like', $search . '%')
			   ->orWhere('quote->ge', 'like', $search . '%')->with('comments.user')
			   ->get();
		}
		else
		{
			$quotes = Quote::whereHas('movie', function ($query) use ($search) {
				$query->where('title->en', 'like', $search . '%')
				   ->orWhere('title->ge', 'like', $search . '%');
			})->orWhere('quote->en', 'like', $search . '%')
			   ->orWhere('quote->ge', 'like', $search . '%')->with('comments.user')
			   ->get();
		}

		return response()->json(GetAllQuoteResource::collection($quotes));
	}

	public function update(UpdateQuoteRequest $request)
	{
		$quote = Quote::where('id', $request->id)->first();

		$attributes = [
			'quote' => [
				'en' => $request['quote_en'],
				'ge' => $request['quote_ge'],
			],
		];

		if (isset($request['image']))
		{
			$attributes['image'] = request()->file('image')->store('images');
		}

		$quote->update($attributes);
		return response()->json($request, 200);
	}

	public function destroy($id)
	{
		$quote = Quote::where('id', $id);
		$quote->delete();
		return response()->json('Quote deleted successfully', 200);
	}
}
