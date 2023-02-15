<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        return view('admin.dashboard', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount]);
    }

    public function users()
    {
        $users = User::where('roles_id', 2)->where('status', 'active')->get();
        return view('admin.user.user', ['user' => $users]);
    }

    public function usersRegistered()
    {
        $usersRegistered = User::where('roles_id', 2)->where('status', 'inactive')->get();
        return view('admin.user.user-registered', ['usersRegistered' => $usersRegistered]);
    }

    public function usersDetail($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('admin.user.user-detail', ['user' => $user]);
    }

    public function usersApprove($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('users-detail/'.$slug)->with('status', 'User Approved Successfully');
    }

    public function usersBan($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('users')->with('status', 'User Deleted');
    }

    public function usersBanned()
    {
        $usersBanned = User::onlyTrashed()->get();
        return view('admin.user.user-banned', ['usersBanned' => $usersBanned]);
    }

    public function usersRestore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        return redirect('users')->with('status', 'User Restored Successfully');
    }

    public function category()
    {
        $categories = Category::all();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function books()
    {
        $book = Book::all();
        return view('admin.books.index', ['book' => $book]);
    }

    public function booksAdd()
    {
        $categories = Category::all();
        return view('admin.books.add-book', ['categories' => $categories]);
    }

    public function booksStore(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books',
            'title' => 'required'
        ]);

        $newName = '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }
        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book -> categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book Added Successfuly');
    }
    
    public function booksEdit($slug)
    {
        $books = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('admin.books.edit-book', ['books' => $books, 'categories' => $categories]);
    }

    public function booksUpdate(Request $request, $slug)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }

        $books = Book::where('slug', $slug)->first();
        $books->update($request->all());
        if($request->categories){
            $books->categories()->sync($request->categories);
        }
        return redirect('books')->with('status', 'Book Updated Successfully');
    }

    public function booksDestroy($slug)
    {
        $books = Book::where('slug', $slug)->first();
        $books->delete();
        return redirect('books')->with('status', 'Ges di hapus');
    }

    public function rents()
    {
        return view('admin.rent');
    }

    public function categoryAdd()
    {
        return view('admin.category.add-category');
    }

    public function categoryStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create($request->all());
        return redirect('category')->with('status', 'Category Added Successfuly');
    }

    public function categoryEdit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('admin.category.edit-category', ['category' => $category]);
    }

    public function categoryUpdate(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category -> update($request->all());
        return redirect('category')->with('status', 'Updated Added Successfuly');
    }

    public function categoryDestroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('category')->with('status', 'Hayolo Ilang');
    }
}
