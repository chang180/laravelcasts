<h2>{{ $course->title }}</h2>
<h3>{{ $course->tagline }}</h3>
<p>{{ $course->description }}</p>
<p>{{ $course->videos_count}} videos</p>
<ul>
    @foreach($course->learnings as $learning)
        <li>
            <div>{{ $learning }}</div><span>{{ "https://ccore.newebpay.com/EPG/".config('services.checkout.store')}} / {{ $course->checkout_id }} </span>
        </li>
    @endforeach
</ul>
<img src="{{ asset("images/$course->image_name") }}" alt="Image of course {{ $course->title }}">
