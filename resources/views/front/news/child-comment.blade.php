@foreach($comments as $comment)
<div class="col-md-2 col-sm-2">
    <div class="blog_1rdt3il">
    <img src="{{ asset('assets/front/img/22.jpg') }}" class="w-100 rounded-circle" alt="{{ $comment->name }}">
    </div>
</div>
<div class="col-md-10 col-sm-10">
    <div class="blog_1rdt3il">
    <h4>{{ $comment->name }} <span class="pull-right">
    </span></h4>
    <h6 class="font_14 mt-3"><i class="fa fa-calendar col_oran me-1"></i> {{ $comment->created_at->format('Y-m-d') }} <i class="fa fa-user col_oran me-1 ms-3"></i> {{ $comment->name }}</h6>
    <p class="mb-0 font_14">{{ $comment->comment }}</p>
        @if($comment->comment_stars == 1) <i class="fa fa-star text-warning"></i> @endif
        @if($comment->comment_stars == 2) <i class="fa fa-star text-warning"></i> <i class="star"></i> @endif
        @if($comment->comment_stars == 3) <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> @endif
        @if($comment->comment_stars == 4) <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> @endif
        @if($comment->comment_stars == 5) <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> @endif
    </div>
</div>

    @endforeach