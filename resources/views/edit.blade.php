@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-6">

    <div class="card">
        <div class="card-header">Edit the order</div>
        <div class="card-body">
            <form method="post" action="{{ route('orders.update', $order->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Your Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{ $order->name }}"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="{{ $order->email }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-label-form">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="number" name="contact" class="form-control" value="{{ $order->contact }}"/>
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
                        <input type="date" name="booked_for" value="{{ $order->booked_for }}"/>
                    </div>
                </div>
                <div class="text-center">
                    <input type="hidden" name="hidden_id" value="{{ $order->id }}" />
                    <input type="submit" class="btn btn-primary" value="Edit" />
                </div>
            </form>
        </div>
    </div>

    </div>
    </div>
    </div>

<script>
    document.getElementsByName('size_id')[0].value = "{{ $order->size_id }}";
    document.getElementsByName('flex')[0].value = "{{ $order->flex }}";
</script>

@endsection
