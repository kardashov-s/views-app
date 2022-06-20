@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Max provider price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <th scope="row">{{ $service->id }}
                                    </th>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ money_to_str($service->price) }}</td>
                                    <td>{{ money_to_str($service->max_provider_price) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
