@extends('layouts.app')
@section('content')
    <table class="table table-info">
        <thead>
            <tr class="table-light">
                <th scope="col">ORDINE N.</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Data</th>
                <th>Bottoni</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->first_name }}</td>
                    <td>{{ $order->last_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-warning mr-3">
                            <i class="fa-solid fa-eye "></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        <h3 class="text-center">Nessun ordine</h3>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <style>
        table {
            border-collapse: collapse
        }

        th,
        td {
            border: 1px solid black
        }
    </style>
@endsection
