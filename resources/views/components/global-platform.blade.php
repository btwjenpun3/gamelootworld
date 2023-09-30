<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
@foreach ($platforms as $platform)
    <li>
        <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">{{ $platform->name }}</a>
    </li>
@endforeach
