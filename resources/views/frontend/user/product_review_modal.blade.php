<div class="modal-header">
    <h5 class="modal-title h6">{{translate('Review')}}</h5>
    <button type="button" class="close" data-dismiss="modal">
    </button>
</div>

@if($review == null)
    <!-- Add new review -->
    <form action="{{ route('reviews.store') }}" method="POST" >
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="modal-body">
            <div class="form-group">
                <label class="opacity-60">{{ translate('Product')}}</label>
                <p>{{ $product->getTranslation('name') }}</p>
            </div>
            <!-- Rating -->
            <div class="form-group">
                <label class="opacity-60">{{ translate('Rating')}}</label>
                <div class="rating rating-input">
                    <label>
                        <input type="radio" name="rating" value="1" required>
                        <i class="las la-star"></i>
                    </label>
                    <label>
                        <input type="radio" name="rating" value="2">
                        <i class="las la-star"></i>
                    </label>
                    <label>
                        <input type="radio" name="rating" value="3">
                        <i class="las la-star"></i>
                    </label>
                    <label>
                        <input type="radio" name="rating" value="4">
                        <i class="las la-star"></i>
                    </label>
                    <label>
                        <input type="radio" name="rating" value="5">
                        <i class="las la-star"></i>
                    </label>
                </div>
            </div>
            <!-- Comment -->
            <div class="form-group">
                <label class="opacity-60">{{ translate('Comment')}}</label>
                <textarea class="form-control rounded-0" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>
            </div>
            <!-- Review Images -->
            <div class="form-group">
                <label class="" for="photos">{{translate('Review Images')}}</label>
                <div class="">
                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium rounded-0">{{ translate('Browse')}}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="photos[]" class="selected-files">
                    </div>
                    <div class="file-preview box sm">
                    </div>
                    <small class="text-muted">{{translate('These images are visible in product review page gallery. Upload square images')}}</small>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary rounded-0" data-dismiss="modal">{{translate('Cancel')}}</button>
            <button type="submit" class="btn btn-sm btn-primary rounded-0">{{translate('Submit Review')}}</button>
        </div>
    </form>
@else
    <!-- Review -->
    <li class="media list-group-item d-flex">
        <div class="media-body text-left">
            <!-- Rating -->
            <div class="form-group">
                <label class="opacity-60">{{ translate('Rating')}}</label>
                <p class="rating rating-sm">
                    @for ($i=0; $i < $review->rating; $i++)
                        <i class="las la-star active"></i>
                    @endfor
                    @for ($i=0; $i < 5-$review->rating; $i++)
                        <i class="las la-star"></i>
                    @endfor
                </p>
            </div>
            <!-- Comment -->
            <div class="form-group">
                <label class="opacity-60">{{ translate('Comment')}}</label>
                <p class="comment-text">
                    {{ $review->comment }}
                </p>
            </div>
            <!-- Review Images -->
            <div class="form-group">
                <label class="opacity-60">{{ translate('Images')}}</label>
                <div class="d-flex flex-wrap">
                    @foreach (explode(',', $review->photos) as $photo)
                        <div class="mr-3 mb-3 size-90px">
                            <img class="img-fit h-100 lazyload border"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($photo) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </li>
@endif

