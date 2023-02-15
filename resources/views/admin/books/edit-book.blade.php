@extends('layouts.main')

@section('title', 'Edit Book')
    
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <h1>Edit Book</h1>

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="book_code" class="form-label">Book Code</label>
        <input type="text" name="book_code" id="book_code" class="form-control w-50" placeholder="Book Code" value="{{$books->book_code}}">
        <br>
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control w-50" placeholder="Title" value="{{$books->title}}">
        <br>
        <label for="image" class="form-label">Cover</label>
        <input type="file" name="image" id="image" class="form-control w-50">
        <label for="currentCover" class="form-label">Current Cover</label>
        <br>
        <div class="mb3">
        @if ($books->cover != '')
        <img src="{{asset('storage/cover/'.$books->cover)}}" alt="" width="200px">
        @else
        <img src="{{asset('img/not-found.jpg')}}" alt="" width="200px">
        @endif
        </div>
        <label for="categories" class="form-label d-block">Category</label>
        <br>
        <select class="form-control w-50 select" name="categories[]" id="categories" multiple="multiple">
            @foreach ($categories as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select><br>
        <label for="listcategory" class="form-label">Current Category</label>
        <ul>
            @foreach ($books->categories as $category)
            <li>{{$category->name}}</li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary mt-4">Update</button>
    </form>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
$('.select').select2();
});
    </script>
@endsection