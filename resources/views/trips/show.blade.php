@extends('layouts.layout')
<header id="header">
    @include('includes.header')
</header>

@section('content')
<div class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="bookingForm" method="POST" action="/booking">
                            @csrf
                            <input id="trip_id" name="trip_id" type="text" style="display: none;" value="{{ $trip->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Pick Point</label>
                                        <select class="form-control" id="pick-point" name="pick-point">
                                            @foreach ($stages as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="">Drop Point</label>
                                        <select class="form-control" id="drop-point" name="drop-point">
                                            <option value="{{ $trip->schedule->destination->id }}">{{ $trip->schedule->destination->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="submitBtn" type="submit" class="btn btn-primary pull-right">Save</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection