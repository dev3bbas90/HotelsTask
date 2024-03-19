<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

        <div class="row my-3">
            <div class="col-12 text-center">
                <h2>Hotels Data</h2>
            </div>
        </div>
        <form action="" method="get">
            <div class="row">

                {{-- Start Name Input --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Hotel Name</label>
                        <input type="text" name="name" id="name" value="{{ request()->name }}" class="form-control">
                    </div>
                </div>
                {{-- End Name Input --}}

                {{-- Start Destination --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" name="destination" id="destination" value="{{ request()->destination }}" class="form-control">
                    </div>
                </div>
                {{-- End Destination --}}

                {{-- Start Min Price --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="minPrice">Min Price</label>
                        <input type="number" step="1" name="minPrice" id="minPrice" value="{{ request()->minPrice }}" class="form-control">
                    </div>
                </div>
                {{-- End Min Price --}}

                {{-- Start Max Price --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="maxPrice">Max Price</label>
                        <input type="number" step="1" name="maxPrice" id="maxPrice" value="{{ request()->maxPrice }}" class="form-control">
                    </div>
                </div>
                {{-- End Max Price --}}

                {{-- Start Date From --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="minDate">Date From</label>
                        <input type="date" name="minDate" id="minDate" value="{{ request()->minDate }}" class="form-control">
                    </div>
                </div>
                {{-- End Date From --}}

                {{-- Start Date To --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="maxDate">Date To</label>
                        <input type="date" name="maxDate" id="maxDate" value="{{ request()->maxDate }}" class="form-control">
                    </div>
                </div>
                {{-- End Date To --}}

                {{-- Submit --}}
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary w-50 mt-4" type="submit">
                        Search
                    </button>
                </div>
                {{-- End Submit --}}
            </div>
        </form>

        <hr>
        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Price</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($filteredData as $hotel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hotel['name'] }}</td>
                                <td>{{ $hotel['city'] }}</td>
                                <td>{{ $hotel['price'] }}</td>
                                <td>
                                    @foreach (@$hotel['availability'] ?? [] as $available)
                                        <div>{{ $available['from'] . ' To ' . $available['to'] }}</div>
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5"class="text-center" >No Result Matches Your Search</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
