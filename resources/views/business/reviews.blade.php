@extends('layouts.app')

@section('content')
    <!-- Button trigger modal -->
    <div style="padding-left: 30px;">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Add Review
        </button>
        <?php
            $number = 0;

            foreach($reviews as $review)
                {
                    if($review->rate >= 4)
                        $number = 1;
                }
        ?>
        @if($number == 0)
            <ul class="nav nav-tabs" id="nav-tabb">
                <li class="active"><a data-toggle="tab" href="#menu1">Open</a></li>
                <li><a data-toggle="tab" href="#menu2">Closed</a></li>
            </ul>
        @endif
    </div>

    <div class="tab-content">


        <div id="menu1" class="tab-pane fade in active" style="padding: 30px;">
            @foreach($reviews as $review)
                @if($review->status == 1)
                <div style="padding: 30px; background-color: #eeeeee; margin-bottom: 40px">
                    <div style="background-color: mintcream; padding: 13px; margin-bottom: 5px; width: 800px; border: #101010; border-radius: 13px; box-shadow: 5px 5px 5px 5px #888888; ">
                        @if(auth()->user()->id == $review->user_id && $review->rate < 4)
                            @if($review->status == 1)
                                <a href="{{ url('review/toggle_status/'.$review->id) }}">Close</a>
                            @else
                                <a href="{{ url('review/toggle_status/'.$review->id) }}">Open</a>
                            @endif
                        @endif
                        <p>Rate:
                        @for($i=0; $i < $review->rate; $i++)
                            <span>*</span>
                         @endfor
                        </p>
                        <p>Author: <strong>{{ $review->user->name }}</strong></p>
                        <p>Date: {{ $review->created_at }}</p>
                        <h4>{{ $review->text }}</h4>
                    </div>
                <div class="comments" style="background-color: #ffffff; width: 800px; padding: 30px; border-radius: 13px; box-shadow: 5px 5px 5px 5px #888888;">
                    <h1>Comments: </h1>
                    @foreach($review->comments as $comment)
                        <strong>AUTHOR: </strong>{{ $comment->user->name }} <strong>DATE: </strong>{{ $comment->created_at }}
                        <br>
                        <h3>{{ $comment->text }}</h3>
                        <hr>
                    @endforeach
                    <button data-review_id="{{ $review->id }}" type="button" class="btn btn-success btn-lg add_comment" data-toggle="modal" data-target="#commentModal">
                        Add Comment
                    </button>
                </div>
                <hr>
                </div>
                @endif
            @endforeach
        </div>


        <div id="menu2" class="tab-pane fade" style="padding: 30px;">
            @foreach($reviews as $review)
                @if($review->status == 0)
                    <div style="padding: 30px; background-color: #eeeeee; margin-bottom: 40px">
                        <div style="background-color: mintcream; padding: 13px; margin-bottom: 5px; width: 800px; border: #101010; border-radius: 13px; box-shadow: 5px 5px 5px 5px #888888; ">
                            @if(auth()->user()->id == $review->user_id && $review->rate < 4)
                                @if($review->status == 1)
                                    <a href="{{ url('review/toggle_status/'.$review->id) }}">Close</a>
{{--                                @else--}}
{{--                                    <a href="{{ url('review/toggle_status/'.$review->id) }}">Open</a>--}}
                                @endif
                            @endif
                            <p>Rate:
                                @for($i=0; $i < $review->rate; $i++)
                                    <span>*</span>
                                @endfor
                            </p>
                            <p>Author: <strong>{{ $review->user->name }}</strong></p>
                            <p>Date: {{ $review->created_at }}</p>
                            <h4>{{ $review->text }}</h4>
                        </div>
                    <div class="comments" style="background-color: #ffffff; width: 800px; padding: 30px; border-radius: 13px; box-shadow: 5px 5px 5px 5px #888888;">
                        <h1>Comments: </h1>
                        @foreach($review->comments as $comment)
                            <strong>AUTHOR: </strong>{{ $comment->user->name }} <strong>DATE: </strong>{{ $comment->created_at }}
                            <br>
                            <h3>{{ $comment->text }}</h3>
                            <hr>
                        @endforeach
                        @if($review->status == 0)
                        <button data-review_id="{{ $review->id }}" type="button" class="btn btn-success btn-lg add_comment" data-toggle="modal" data-target="#commentModal">
                            Add Comment
                        </button>
                        @endif
                    </div>
                    <hr>
                    </div>
                @endif
            @endforeach
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New review</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="new_review" action="{{ url('review/store/'.$id) }}">
                        {{ csrf_field() }}
                        <div class="rate">
                            <label for="b_{{ $id }}_1">1</label><input id="b_{{ $id }}_1" type="radio" value="1" name="rate">
                            <label for="b_{{ $id }}_2">2</label><input id="b_{{ $id }}_2" type="radio" value="2" name="rate">
                            <label for="b_{{ $id }}_3">3</label><input id="b_{{ $id }}_3" type="radio" value="3" name="rate">
                            <label for="b_{{ $id }}_4">4</label><input id="b_{{ $id }}_4" type="radio" value="4" name="rate">
                            <label for="b_{{ $id }}_5">5</label><input id="b_{{ $id }}_5" type="radio" value="5" name="rate">
                        </div>
                        <textarea placeholder="Your review" rows="6" cols="70" name="review" class="comment"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button form="new_review" type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="commentModalLabel">New Comment</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="new_comment" action="{{ url('comment/add') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="review_id">
                        <textarea placeholder="Your review" rows="6" cols="70" name="review" class="comment"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button form="new_comment" type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).find('.add_comment').on('click', function (e) {
            var id = $(this).data('review_id');
            $('#commentModal').find('input[name="review_id"]').val(id);
        })
    </script>
@endsection