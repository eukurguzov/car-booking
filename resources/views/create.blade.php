@extends('layouts.app')

@section('content')
    @if($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>

    @endif

    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card">
        <div class="card-header">Book the car</div>
        <div class="card-body">
            <form method="post" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Your Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="number" name="contact" class="form-control" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Flexibility</label>
                    <div class="col-sm-10">
                        <select name="flex" class="form-control">
                            <option value="1">+/- 1 day</option>
                            <option value="2">+/- 2 day</option>
                            <option value="3">+/- 3 day</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-label-form">Car Size</label>
                    <div class="col-sm-10">
                        <select name="size_id" class="form-control">

                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-label-form">Booking Date</label>
                    <div class="col-sm-10">
                        <input type="date" name="booked_for" />
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Add" />
                </div>
            </form>
        </div>
    </div>

    </div>
    </div>
    </div>

@endsection
