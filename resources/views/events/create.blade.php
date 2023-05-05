@extends('layouts.app')
@section('title', 'Create post')

@section('content')
<div class="container">
    <h1>Create event</h1>
    <div class="mb-4">
        {{-- TODO: Link --}}
        <a href="#"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
    </div>
    @if(Session::has('event_created'))
    <div class="alert alert-success"><p class="m-0">Event created</p></div>
    @endif
    @error('player')
    <div class="alert alert-danger"><p class="m-0">{{$message}}</p></div>
    @enderror
    @error('minute')
    <div class="alert alert-danger"><p class="m-0">{{$message}}</p></div>
    @enderror
    @error('type')
    <div class="alert alert-danger"><p class="m-0">{{$message}}</p></div>
    @enderror
    
    {{-- TODO: action, method, enctype --}}
    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        {{-- TODO: Validation --}}

        <div class="form-group row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Player</label>
            <div class="col-sm-10">
            @if($players->isNotEmpty())
                <select class="form-select" name="player" id="player" value="">
                @foreach ($players as $player)
                    <option value="{{ $player->name}}" data-team="{{ $player->team_id}}" data-num="{{ $player->number}}">{{ $player->name}}</option>
                @endforeach
                </select>
            @else
                <p>No player</p>
            @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="minute" class="col-sm-2 col-form-label">Minute*</label>
            <div class="col-sm-10">
                <input typte="number" min="1" max="90" value="" class="form-control" id="minute" name="minute">
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="categories" class="col-sm-2 col-form-label py-0">Event</label>
            <div class="col-sm-10">
                {{-- TODO: Read post categories from DB --}}
                @foreach (['gól', 'öngól', 'sárga lap', 'piros lap'] as $event)
                    <div class="form-radio">
                        <input
                            type="radio"
                            class="form-check-input"
                            value="{{ $event }}"
                            name="type"
                            id="{{ $event }}"
                        >
                        {{-- TODO --}}
                        <label for="{{ $event }}" class="form-check-label">
                            <span class="badge bg-info">{{ $event }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!--
        <div class="form-group row mb-3">
            <label for="cover_image" class="col-sm-2 col-form-label">Cover image</label>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                        </div>
                        <div id="cover_preview" class="col-12 d-none">
                            <p>Cover preview:</p>
                            <img id="cover_preview_image" src="#" alt="Cover preview">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const coverImageInput = document.querySelector('input#cover_image');
    const coverPreviewContainer = document.querySelector('#cover_preview');
    const coverPreviewImage = document.querySelector('img#cover_preview_image');

    coverImageInput.onchange = event => {
        const [file] = coverImageInput.files;
        if (file) {
            coverPreviewContainer.classList.remove('d-none');
            coverPreviewImage.src = URL.createObjectURL(file);
        } else {
            coverPreviewContainer.classList.add('d-none');
        }
    }
</script>
@endsection
