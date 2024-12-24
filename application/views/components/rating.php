<h2 class="text-center mb-4 mt-md-5 mt-0 fw-bolder">Rating & Review</h2>
<div class="rating-review-form">
    <form method="post" action="submit_review.php" class="mb-4">
        <div class="form-group">
            <label for="userRating" class="form-label">Your Rating:</label>
            <select id="userRating" name="rating" class="form-control card-neoraised" required>
                <option value="" disabled selected>Choose Rating</option>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Very Good</option>
                <option value="3">3 - Good</option>
                <option value="2">2 - Fair</option>
                <option value="1">1 - Poor</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="userComment" class="form-label">Your Comment:</label>
            <textarea id="userComment" name="comment" class="form-control card-neoraised" rows="4" required style="resize: none;"></textarea>
        </div>
        <button type="submit" class="btn btn-neoraised btn-success mt-3 fw-bold">Submit Review</button>
    </form>
</div>