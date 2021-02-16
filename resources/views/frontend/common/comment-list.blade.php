@if (isset($arrComment) && !empty($arrComment))
    @foreach ($arrComment as $comment)
        <div class="comment-block">
            <div class="comment-user">
                <div>
                    <img src="{{ asset('public/frontend/assets/images/user-2.jpg') }}" alt="{{ $comment->fullname ?? '' }}" width="70" />
                </div>
                <div>
                    <h5>
                        <span>{{ $comment->fullname ?? '' }}</span>
                        <span class="pull-right">
                            {!! Str::ranking($comment->ranking) !!}
                        </span>
                        <small>{{ Carbon::parse($comment->created_at)->format('d M Y') }}</small>
                    </h5>
                </div>
            </div>
            <div class="comment-desc">
                <p>
                    {!! nl2br(e($comment->message)) !!}
                </p>
            </div>
            @if ($comment->lstchild()->count() > 0)
                @foreach ($comment->lstchild as $comment_child)
                <div class="comment-block">
                    <div class="comment-user">
                        <div>
                            <img src="{{ asset('public/frontend/assets/images/user-2.jpg') }}" alt="{{ $comment_child->fullname ?? '' }}" width="70" />
                        </div>
                        <div>
                            <h5>
                                {{ $comment_child->fullname ?? '' }}
                                <small>{{ Carbon::parse($comment_child->created_at)->format('d M Y') }}</small>
                            </h5>
                        </div>
                    </div>
                    <div class="comment-desc">
                        <p>
                            {!! nl2br(e($comment_child->message)) !!}
                        </p>
                    </div>
                </div>
                @endforeach
            @endif

            <!-- comment reply -->

            
            <!--/reply-->
        </div>
    @endforeach
@endif
