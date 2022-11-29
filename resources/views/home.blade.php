@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))

    <div class="alert alert-success">
        {{ $message }}
    </div>

@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-6"><b>Cars Booking</b></div>
                        <div class="col col-md-6">
                            <a href="{{ route('orders.create') }}" class="btn btn-success btn-sm float-end">Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Flex</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th>Approved</th>
                            <th>Action</th>
                        </tr>
                        @if(count($data) > 0)

                            @foreach($data as $row)

                                <tr class="{{ $row->approved ? 'approved' : '' }}">
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->contact }}</td>
                                    <td>{{ $row->flex }}</td>
                                    <td>{{ $row->carSize->name }}</td>
                                    <td>{{ $row->booked_for }}</td>
                                    <td>{{ $row->approved }}</td>
                                    <td>
                                        <form method="post" action="{{ route('orders.destroy', $row->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('orders.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                                        </form>
                                        <form method="post" action="{{ route('orders.approve', $row->id) }}">
                                            @csrf
                                            <input type="submit" class="btn btn-success btn-sm" value="Approve" />
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Data Found</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .approved {
        background-color: #deeee8;
    }
</style>

@endsection
