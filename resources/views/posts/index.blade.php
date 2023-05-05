@extends('layouts.app')
@section('title', 'Mérkőzések')
@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Mérkőzések</h1>
        </div>
        <div class="col-12 col-md-4">
            <div class="float-lg-end">
                {{-- TODO: Links, policy --}}

                <a href="{{ route('events.create') }}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create event</a>

                <a href="#" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create category</a>

            </div>
        </div>
    </div>

    {{-- TODO: Session flashes --}}

    <div class="row mt-3">
        <div class="col-12 col-lg-9">
            <div class="row">
                @foreach($games as $g)
                    <div class="col-12 mb-3">
                        @if(($g->finished || (date($g->start)) >= $date))
                        <div class="card">
                        @else
                        <div class="card border border-success">
                        @endif
                            <div style="text-transform: uppercase" class="card-header">{{ $g->homeTeam->name }} - {{ $g->awayTeam->name }}</div>
                            <div class="card-body">
                                @foreach($goals as $k => $v)
                                    @if($k == $g->id)
                                    <p class='text-center'><b>{{$v[0]}} - {{$v[1]}}</b></p>
                                    @endif
                                @endforeach
                                <div style="padding-bottom: 1rem">
                                    @if(strcmp($g->homeTeam->image,"") == 0)
                                    <img style="width: 50%; height: auto; float: left"
                                    src="https://via.placeholder.com/400x400.png/004467?text=default">
                                    @else
                                    <img style="width: 50%; height: auto; float: left"
                                    src = "{{$g->homeTeam->image}}"
                                    >
                                    @endif
                                    @if(strcmp($g->awayTeam->image,"") == 0)
                                    <img style="width: 50%; height: auto; float: left"
                                    src="https://via.placeholder.com/400x400.png/004467?text=default">
                                    @else
                                    <img style="width: 50%; height: auto; float: left"
                                    src = "{{$g->awayTeam->image}}"
                                    >
                                    @endif
                                    <div style="clear: both"></div>
                                </div>
                                <div>{{ $g->start }}</div>
                                <a style="margin-top: 1rem" class="btn btn-primary" href="{{ route('posts.show', $g) }}" role="button">Megtekintés</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card bg-light">
                        <div class="card-header">
                            Categories
                        </div>
                        <div class="card-body">
                            {{-- TODO: Read categories from DB --}}
                            @foreach (['primary', 'secondary','danger', 'warning', 'info', 'dark'] as $category)
                                <a href="#" class="text-decoration-none">
                                    <span class="badge bg-{{ $category }}">{{ $category }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="card bg-light">
                        <div class="card-header">
                            Statistics
                        </div>
                        <div class="card-body">
                            <div class="small">
                                <ul class="fa-ul">
                                    {{-- TODO: Read stats from DB --}}
                                    <li><span class="fa-li"><i class="fas fa-user"></i></span>Users: N/A</li>
                                    <li><span class="fa-li"><i class="fas fa-layer-group"></i></span>Categories: N/A</li>
                                    <li><span class="fa-li"><i class="fas fa-file-alt"></i></span>Meccsek: {{count($games)}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
