<?php

namespace App\Http\Controllers\Backend;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()
            ->select('uuid', 'transaction_id', 'rating', 'comment')
            ->paginate(5);

        return view('backend.review.index', [
            'reviews' => $reviews,
        ]);
    }
}
