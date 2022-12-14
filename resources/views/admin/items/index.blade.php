@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-{{ session('type') ?? 'info' }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.items.create') }}" class="btn btn-success mr-3"><i class="fa-solid fa-plus "></i> Crea
            articolo</a>
    </div>
    @foreach ($current_restaurant_items as $item)
        <div class="card my-3">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="{{ str_contains($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="p-3 img-fluid">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h1 class="card-title">{{ $item->name }} - €{{ number_format($item->price, 2 , ',') }}</h1>
                        <div class="card-text my-3">
                            <p>Descrizione: {{ $item->description }}</p>
                            <h6>Data creazione: {{ $item->created_at }}</h6>
                        </div>
                        <div class="d-flex justify-content-end mt-5">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.items.show', $item) }}" class="btn btn-warning mr-3">
                                    <i class="fa-solid fa-eye "></i> Dettagli articolo</a>
                            </div>

                            <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-primary mr-3"><i
                                    class="fa-solid fa-pen"></i> Modifica piatto</a>

                            <form action="{{ route('admin.items.destroy', $item->id) }} " method='POST'>
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" type="submit" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fa-solid fa-trash"></i> Elimina
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Sei sicuro di voler eliminare
                                                    il piatto?</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Questa azione e' IRREVERSIBILE
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary"
                                                    data-dismiss="modal">Chiudi</button>
                                                <button type="submit" class="btn btn-primary">Elimina</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </body>
@endsection
