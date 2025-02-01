<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h2 class="text-center text-success">Login page</h2>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="{{ route('user.db.login')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="email" type="email" required placeholder="Enter your email" class="form-control">
                    <input name="password" type="password" placeholder="Enter your Password" class="form-control">
                    <input type="submit" placeholder="submit" class="form-control bg-success">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>