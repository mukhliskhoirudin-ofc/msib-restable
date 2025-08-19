<section id="review" class="review section">
    <div class="container" data-aos="fade-up">
        <div class="card shadow">
            <div class="card-body">
                <div class="review-header text-center mb-5">
                    <div class="position-relative d-inline-block">
                        <!-- Main Title -->
                        <h2 class="display-5 fw-bold text-gradient-primary mb-3 position-relative">
                            Share Your Dining Experience
                        </h2>

                        <!-- Subtitle with Animated Underline -->
                        <div class="position-relative d-inline-block">
                            <p class="lead text-muted mb-0">Your feedback shapes our future</p>
                            <div class="title-underline"></div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('review.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="code" class="form-label">Code Transaction</label>
                        <input type="text" name="code" id="code" placeholder="ex: ORD-123456"
                            class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="rating-group">
                            <input type="radio" id="star5" name="rating" value="5" class="rating-input">
                            <label for="star5" class="rating-star"><i class="bi bi-star-fill"></i></label>

                            <input type="radio" id="star4" name="rating" value="4" class="rating-input">
                            <label for="star4" class="rating-star"><i class="bi bi-star-fill"></i></label>

                            <input type="radio" id="star3" name="rating" value="3" class="rating-input">
                            <label for="star3" class="rating-star"><i class="bi bi-star-fill"></i></label>

                            <input type="radio" id="star2" name="rating" value="2" class="rating-input">
                            <label for="star2" class="rating-star"><i class="bi bi-star-fill"></i></label>

                            <input type="radio" id="star1" name="rating" value="1" class="rating-input">
                            <label for="star1" class="rating-star"><i class="bi bi-star-fill"></i></label>
                        </div>
                        @error('rating')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" cols="4" rows="4" placeholder="Write your review here..."
                            class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger">Send Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
