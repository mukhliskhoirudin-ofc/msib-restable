<?php

namespace App\Http\Controllers\Backend;

use App\Models\Review;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        // N+1
        $reviews = Review::with('transaction')
            ->latest()
            ->select('uuid', 'transaction_id', 'rating', 'comment')
            ->paginate(5);

        return view('backend.review.index', [
            'reviews' => $reviews,
        ]);
    }

    public function show(Review $review)
    {
        // N+1
        $review->load('transaction');

        return view('backend.review.show', [
            'review' => $review,
        ]);
    }
}
