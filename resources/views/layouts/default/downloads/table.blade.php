<ul class="list-group">
    @foreach($files as $file)
        <li class="list-group-item">
            <a href="{{route('frontend.downloads.download', [$file->id])}}" target="_blank">
                {{ $file->name }}
            </a>

            {{-- only show description is one is provided --}}
            @if($file->description)
                - {{$file->description}}
            @endif
            <span style="margin-left: 20px">{{$file->download_count}} downloads</span>
        </li>
    @endforeach
</ul>
