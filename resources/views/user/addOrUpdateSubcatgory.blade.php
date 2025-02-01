<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add or update page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2>Add Sub Category</h2>
                {{-- {{dd($data)}} --}}
                <form action="storeSubategory" method="post">
                    @csrf
                    @if(isset($data['loadOnForm']->id))
                        <input type="hidden" name="id" value="{{$data['loadOnForm']->id ?? ""}}" placeholder="Enter name of Category" class="form-control">
                    @endif
                    <input type="text" name="name" placeholder="Enter name of SubCategory" value="{{$data['loadOnForm']->name ?? ''}}" class="form-control">
                    <select name="cat_id" class="form-select">
                        @if(isset($data['loadOnForm']->category_id))
                            <option value="{{$data['loadOnForm']->category_id}}">
                                {{$data['Categorie'][$data['loadOnForm']->category_id]}}
                            </option>
                        @endif
                        <option value="">Select any category</option>
                        @foreach($data['Categorie'] as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input type="submit" placeholder="Submit" class="text-white btn btn-success">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

