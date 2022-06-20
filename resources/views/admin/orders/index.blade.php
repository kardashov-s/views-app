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
                                <th class="sorting" sortingBy="id">#</th>
                                <th class="sorting" sortingBy="service_id">Service</th>
                                <th class="sorting">Price</th>
                                <th class="sorting" sortingBy="quantity">Quantity</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>#{{ $order->service->id }}: {{ $order->service->name }}</td>
                                    <td>{{ money_to_str($order->price) }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $orders->withQueryString()->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- Sorting --}}
    <script>
        const NONE = 'none';
        const ASC = 'asc';
        const DESC = 'desc';

        let queryString = new URLSearchParams(window.location.search);
        if (queryString.has('sort')) {
            const [column, direction] = queryString.get('sort').split(',');
            $(`th.sorting[sortingBy="${column}"]`).attr('data-sorting', direction).addClass(direction);
        }

        $('th.sorting').click(function () {
            const sorting = nextSorting(($(this).attr('data-sorting') || NONE));
            resetAll();
            $(this).attr('data-sorting', sorting);

            $(this).removeClass(ASC);
            $(this).removeClass(DESC);
            switch (sorting) {
                case ASC:
                    $(this).addClass(sorting);
                    break;
                case DESC:
                    $(this).addClass(sorting);
                    break;
            }

            sortBy($(this).attr('sortingBy'), sorting);
        })

        function nextSorting(sorting) {
            const sortings = {
                [NONE]: DESC,
                [DESC]: ASC,
                [ASC]: NONE,
            }
            return sortings[sorting];
        }

        function resetAll() {
            const all = $('th.sorting');
            all.attr('data-sorting', NONE);
            all.removeClass(ASC);
            all.removeClass(DESC);
        }

        function sortBy(column, direction) {
            let queryString = new URLSearchParams(window.location.search);

            direction === NONE
                ? queryString.delete('sort')
                : queryString.set('sort', `${column},${direction}`);

            history.pushState(null, null, `?${queryString.toString()}`);
            location.reload();
        }
    </script>
@endpush
