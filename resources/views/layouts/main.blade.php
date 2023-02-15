<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rents Books | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<style>
    .main{
        height: 100vh;
    }

    .sidebar{
        background-color: black;
    }

    .sidebar a{
        text-decoration: none;
        padding: 10px 10px; 
        color: whitesmoke;
        display: block;
    }

    .sidebar a:hover{
        background-color: red; 
    }

    .sidebar a.active{
        background-color: red;
        border-right: solid 3px whitesmoke;
    }

    .books{
        background-color: red;
    }

    .category{
        background-color: red;
    }

    .user{
        background-color: red;
    }


    .card-data{
        border-radius: 5px;
        padding: 20px 40px;
        border: solid 1px;
        color: #fff;
    }

    .card-data i{
        font-size: 50px;
    }

    .desc{
        font-size: 30px;
    }

    .count{
        font-size: 25px;
    }
</style>
<body>
<div class="main d-flex-column justify-content-between">
<nav class="navbar navbar-dark" style="background-color: black">
    <div class="container">
      <a class="navbar-brand" href="#">RENT-BOOKS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      </div>
    </div>
  </nav>
  <div class="body-main h-100" style="background-color: white">
    <div class="row g-0 h-100">
        <div class="col-lg-2 sidebar collapse d-lg-block" id="navbarSupportedContent">
            @if (Auth::user()->roles_id == 1) 
            <a href="/dashboard" @if (request()->route()->uri == 'dashboard')
            class="active" @endif><i class="bi bi-house-door"></i>Dashboard</a>
            
            <a href="/users" @if (request()->route()->uri == 'users')
                class="active" @endif><i class="bi bi-lightning-charge"></i>Users</a>

            <a href="/category" @if (request()->route()->uri == 'category')
                class="active" @endif><i class="bi bi-bookmarks"></i>Category</a>

            <a href="/books" @if (request()->route()->uri == 'books')
                class="active" @endif><i class="bi bi-book-half"></i>Books</a>

            <a href="/rentlogs" @if (request()->route()->uri == 'rent-logs')
                class="active" @endif><i class="bi bi-door-open"></i>Rent logs</a>

            <a href="/logout" @if (request()->route()->uri == 'logout')
                class="active" @endif class="position-absolute bottom-0 bi bi-box-arrow-in-left">Logout</a>

            @else
            <a href="/profile" @if (request()->route()->uri == 'profile')
                class="active" @endif class="bi bi-door-open">Profile</a>
            <a href="/logout" class="position-absolute bottom bi bi-box-arrow-in-left">Logout</a>
            @endif
        </div>
        <div class="col-lg-10 p-5 content">
            @yield('content')
        </div>
    </div>
  </div>
</div>
</html> 