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
        <form action="{{ url('/hotels') }}" method="get">
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
                        <input type="number" step="0.1" name="minPrice" id="minPrice" value="{{ request()->minPrice }}" class="form-control">
                    </div>
                </div>
                {{-- End Min Price --}}

                {{-- Start Max Price --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="maxPrice">Max Price</label>
                        <input type="number" step="0.1" name="maxPrice" id="maxPrice" value="{{ request()->maxPrice }}" class="form-control">
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

                {{-- Start Sort --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sort">Sort By</label>
                        <select name="sort" id="sort" class="form-control">
                            <option value="">Sort By</option>
                            <option value="name"  @selected(request()->sort == 'name')>Hotel Name</option>
                            <option value="city"  @selected(request()->sort == 'city')>Destination</option>
                            <option value="price" @selected(request()->sort == 'price')>Price</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sortType"></label>
                        <select name="sortType" id="sortType" class="form-control">
                            <option value="ASC"  @selected(request()->sortType != 'DESC') >Asc</option>
                            <option value="DESC" @selected(request()->sortType == 'DESC') >DESC</option>
                        </select>
                    </div>
                </div>
                {{-- End Sort --}}

                {{-- Submit --}}
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary w-75 mt-4" type="submit">
                        Search
                    </button>
                </div>
                {{-- End Submit --}}
            </div>

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
                            @forelse ($hotels as $hotel)
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
    
            <div class="row mt-3">
                <div class="col-md-4 offset-md-4 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item"><button name="page" value="{{ (request()->page - 1) ?? 1  }}" class="page-link" href="?page">Previous</button></li>
                          <li class="page-item"><button name="page" value="{{ 1  }}" class="page-link" >1</button></li>
                          <li class="page-item"><button name="page" value="{{ 2  }}" class="page-link" >2</button></li>
                          <li class="page-item"><button name="page" value="{{ 3  }}" class="page-link" >3</button></li>
                          <li class="page-item"><button name="page" value="{{ (request()->page + 1) ?? 1  }}" class="page-link" >Next</button></li>
                        </ul>
                      </nav>
                </div>
                <div class="col-md-4 text-right">
                    <select name="limit" id="limit" class="form-control w-auto">
                        <option value="">Per Page</option>
                        <option value="5"  @selected(request()->limit == 5)>5</option>
                        <option value="10"  @selected(!request()->limit || request()->limit == 10)>10</option>
                        <option value="20"  @selected(request()->limit == 20)>20</option>
                        <option value="50"  @selected(request()->limit == 50)>50</option>
                        <option value="100"  @selected(request()->limit == 100)>100</option>
                        <option value="1000"  @selected(request()->limit == 1000)>1000</option>
                    </select>
                </div>
            </div>

        </form>

    </div>
</body>
</html>
