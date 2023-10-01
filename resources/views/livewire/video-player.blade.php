<div>
    <iframe src="https://player.vimeo.com/video/{{ $video->vimeo_id }}" width="640" height="346" frameborder="0"
        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
    <p><a href="https://vimeo.com/863336181">Frimas</a> from <a href="https://vimeo.com/h264distribution">H264
            DISTRIBUTION</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
    <h3>{{ $video->title }} ({{ $video->getReadableDuration() }})</h3>
    <p>{{ $video->description }}</p>
    @if($video->alreadyWatchedByCurrentUser())
        <button wire:click='markVideoAsNotCompleted'>Mark as not completed</button>
    @else
        <button wire:click='markVideoAsCompleted'>Mark as completed</button>
    @endif
    <ul>
        @foreach ($courseVideos as $courseVideo)
            <li>
                @if ($this->isCurrentVideo($courseVideo))
                    {{ $courseVideo->title }}
                @else
                    <a href="{{ route('pages.course-videos', [$courseVideo->course, $courseVideo]) }}">
                        {{ $courseVideo->title }}
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
