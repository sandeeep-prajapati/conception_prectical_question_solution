<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>product page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    
  </head>
  <body>
    <div class="container mt-4">
        <div class="row">
            <div class="text-center text-success">
                <h2 class="text-center">Add new Product</h2>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    {{-- {{dd($data)}} --}}
                    <form action="product/add/" class="form" method="post">
                        @csrf
                        <input type="text" placeholder="Enter name of product" value="{{isset($data['loLoadOnForm']->title) ? $data['loLoadOnForm']->title : ''}}" class="form-control" name="title">
                        <input type="text" placeholder="Enter discription" value="{{isset($data['loLoadOnForm']->description) ? $data['loLoadOnForm']->description : ''}}" class="form-control" required name="discription">
                        <input type="number" placeholder="Enter amount"  value="{{isset($data['loLoadOnForm']->amount) ? $data['loLoadOnForm']->amount : ''}}" class="form-control" required name="amount">
                        <select name="discount_type" class="form-select">
                            @if(isset($data['loLoadOnForm']->discount_type))
                                <option value="{{$data['loLoadOnForm']->discount_type}}">{{$data['loLoadOnForm']->discount_type}}</option>
                            @endif
                            <option value="Percentage">Percentage</option>
                            <option value="Flat">Flat</option>
                        </select>
                        <select name="cataegory" class="form-select">
                            @if(isset($data['loLoadOnForm']->category_id))
                                <option value="{{$data['loLoadOnForm']->category_id}}">{{$data['category'][$data['loLoadOnForm']->category_id]}}</option>
                            @endif
                            @foreach($data['category'] as $key => $record)
                                <option value="{{$key}}">{{$record}}</option>
                            @endforeach
                        </select>
                        <select name="subcataegory" class="form-select">
                            @if(isset($data['loLoadOnForm']->category_id))
                                <option value="{{$data['loLoadOnForm']->subcategory_id }}">{{$data['subcategory'][$data['loLoadOnForm']->subcategory_id ]}}</option>
                            @endif
                            @foreach($data['subcategory'] as $key => $record)
                                <option value="{{$key}}">{{$record}}</option>
                            @endforeach
                        </select>
                        <input type="number" name="discount" value="{{isset($data['loLoadOnForm']->discount_amount) ? $data['loLoadOnForm']->discount_amount : ''}}" class="form-control" placeholder="Enter amount for discount">
                        <input type="submit" placeholder="submit" class="form-control btn bg-success text-white">
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <h3 class="mb-3">All Product Details</h3>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Discount Type</th>
                    <th>Payable Amount</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Action</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach ($data['product'] as $item)
                    <tr data-id="{{ $item->id }}" class="sortable-row">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->discount_type }}</td>
                        <td>{{ $item->payable_amount }}</td>
                        <td>{{ $item->categorie->name ?? 'N/A' }}</td>
                        <td>{{ $item->subcategorie->name ?? 'N/A' }}</td>
                        <td>
                            <a href="./home?id={{ $item->id }}">
                                <button class="btn btn-warning">Update</button>
                            </a>
                            <button class="btn btn-danger delete-product" data-id="{{ $item->id }}">Delete</button>
                        </td>
                        <td>
                            <a href='product/order/{{ $item->id }}'>
                                <button class="btn btn-warning">Order</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>            
            
            <!-- Pagination Links -->
            <tr>
                <td colspan="10">
                    <div class="pagination-container">
                        <div class="d-flex justify-content-center">
                            {!! $data['product']->onEachSide(1)->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </td>
            </tr>
                      
        </table>
        
        <hr>
        <br>
        <br>
        <a href="{{route('addOrUpdateCatgory')}}">
            <button class="btn btn-success">Add New Category</button>
        </a>
        <h3 class="mb-3">All Category</h3>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['category'] as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                        <td>
                            <a href="addOrUpdateCatgory?id={{$key}}">
                                <button class="btn btn-warning">Update</button>
                            </a>
                            <button class="btn btn-danger delete-category" data-id="{{$key}}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <br>
        <br>
        <h3 class="">All orders</h3>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['order'] as  $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->product->title}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <br>
        <br>
        <a href="{{route('addOrUpdateSubcatgory')}}">
            <button class="btn btn-success">Add New Subcategory</button>
        </a>
        <h3 class="mb-3">All Subcategory</h3>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Subcategory Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['subcategory'] as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                        <td>
                            <a href="addOrUpdateSubcatgory?id={{$key}}">
                                <button class="btn btn-warning">Update</button>
                            </a>
                            <button class="btn btn-danger delete-subcategory" data-id="{{$key}}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#sortable").sortable({
            placeholder: "ui-state-highlight",
            update: function (event, ui) {
                var sortedIDs = [];
                $("#sortable tr").each(function () {
                    sortedIDs.push($(this).attr("data-id"));
                });

                // Send sorted IDs to the server via AJAX
                $.ajax({
                    url: "{{ route('update.product.order') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sortedIDs: sortedIDs
                    },
                    success: function (response) {
                        console.log(response.message);
                    }
                });
            }
        });
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                fetchProducts(page);
            });

            function fetchProducts(page) {
                $.ajax({
                    url: "/home?page=" + page,
                    type: "GET",
                    success: function (data) {
                        $("#pagination_data").html(data);
                    }
                });
            }
            $(".delete-product").click(function(){
                let productId = $(this).data("id");
                let row = $(this).closest("tr");

                if(confirm("Are you sure you want to delete this product?")){
                    $.ajax({
                        url: "/product/delete/" + productId,
                        type: "GET",
                        success: function(response) {
                            if(response.success){
                                row.fadeOut(500, function(){ $(this).remove(); });
                            } else {
                                alert("Failed to delete product!");
                            }
                        }
                    });
                }
            });
            $(".delete-category").click(function(){
                let catId = $(this).data("id");
                let row = $(this).closest("tr");

                if(confirm("Are you sure you want to delete this category?")){
                    $.ajax({
                        url: "/category/delete/" + catId,
                        type: "GET",
                        success: function(response) {
                            if(response.success){
                                row.fadeOut(500, function(){ $(this).remove(); });
                            } else {
                                alert("Failed to delete SubCategory!");
                            }
                        }
                    });
                }
            });
            $(".delete-subcategory").click(function(){
                let subId = $(this).data("id");
                let row = $(this).closest("tr");

                if(confirm("Are you sure you want to delete this sub-category?")){
                    $.ajax({
                        url: "/subcategory/delete/" + subId,
                        type: "GET",
                        success: function(response) {
                            if(response.success){
                                row.fadeOut(500, function(){ $(this).remove(); });
                            } else {
                                alert("Failed to delete SubCategory!");
                            }
                        }
                    });
                }
            });
        });
    </script>

  </body>
</html>

