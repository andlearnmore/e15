<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PracticeController extends Controller
{
    public function practice19()
    {
        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            if ($book->author) {
                dump($book->author->first_name . ' ' . $book->author->last_name . ' wrote ' . $book->title);
            } else {
                dump($book->title . ' has no author associated with it.');
            }
        }

        dump($books->toArray());
    }

    public function practice18()
    {
        # Get an example book
        $book = Book::whereNotNull('author_id')->first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title . ' was written by ' . $author->first_name . ' ' . $author->last_name);
        dump($book->toArray());
    }
    public function practice17()
    {
        $author = Author::where('first_name', '=', 'Michelle')->first();

        $book = new Book;
        $book->slug = 'the-light-we-carry';
        $book->title = 'The Light We Carry';
        $book->published_year = '2022';
        $book->cover_url = '\images\Light.jpeg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Light_We_Carry:_Overcoming_in_Uncertain_Times';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-light-we-carry-michelle-obama/1141833260';
        $book->author()->associate($author); #<---Associate the author with this book
        $book->description = 'Michelle Obama offers readers a series of fresh stories and insightful reflections on change, challenge, and power, including her belief that when we light up for others, we can illuminate the richness and potential of the world around us, discovering deeper truths and new pathways for progress. Drawing from her experiences as a mother, daughter, spouse, friend, and First Lady, she shares the habits and principles she has developed to successfully adapt to change and overcome various obstacles—the earned wisdom that helps her continue to “become.” She details her most valuable practices, like “starting kind,” “going high,” and assembling a “kitchen table” of trusted friends and mentors.';
        $book->save();
        dump($book->toArray());

    }
    public function practice16(Request $request)
    {
        # Retrieve the currently authenticated user via the Auth facade
        $user = Auth::user();
        dump($user->toArray());

        // # Retrieve the currently authenticated user via request object
        // $user = $request->user();
        // dump($user->toArray());

        // # Check if the user is logged in
        if (Auth::check()) {
            dump('The user ID is '.Auth::id());
            dump($request->user()->id);
            dump(Auth::user()->id);
        }
    }

    public function practice15() {
        $book = Book::where('author', '=', 'Rowling')->get();
        $book->delete();
        dump('Book deleted.');        
        
    }
    public function practice14() {
        // Remove any/all books with an author name that includes the string “Rowling”.
        $books = Book::where('author', 'LIKE', '%Rowling%')->get();
        if (!$books) {
            dump('No books found');
        } else {
            foreach ($books as $book) {
                $book->delete();
                dump('Book deleted');
            }
        }

    }

    public function practice13() {
        // Find any books by the author “Maya Angelou” and update the author name to be “THE Maya Angelou”
        $books = Book::where('author', '=', 'Maya Angelou')->get();

        if (!$books) {
            dump('Did not update; book not found.');
        } else {
            foreach ($books as $book) {
                $book->author = 'THE Maya Angelou';
                $book->save();
                dump('Update complete');
            }
        }
        $new = Book::where('author', 'LIKE', '%Angelou%')->get()->toArray();

        dump($new);


    }

    public function practice12() {
        // Retrieve all the books in descending order according to published year.
        $result = Book::orderByDesc('published_year')->get()->toArray();
        dump($result);
    }

    public function practice11() {
        // Retrieve all the books in alphabetical order by title.
        $result = Book::orderBy('title')->get()->toArray();
        dump($result);
    }

    public function practice10() {
        // Retrieve all the books published after 1950.
        $result = Book::where('published_year', ">", 1950)->get()->toArray();
        dump($result);
    }

    public function practice9() {
        // Retrieve the last 2 books that were added to the books table
        $result = Book::orderBy('created_at')->limit(2)->get()->toArray();
        dump($result);
    }

    public function practice8() {
        # First get a book to delete
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete');
        }

        # Query for books by F. Scott Fitzgerald to confirm the above deletion worked as expected
        # This should yield an empty array
        dump(Book::where('author', '=', 'F. Scott Fitzgerald')->get()->toArray());
    }
    
    public function practice7(){
        # First get a book to update
        $books = Book::where('author', '=', 'J.K. Rowling')->get();
    
        if (!$books) {
            dump("Book not found, can not update.");
        } else {
            
            foreach ($books as $book) {
                # Change some properties
                $book->author = 'JK Rowling';

                # Save the changes
                $book->save();
            }
        
            dump('Update complete');

        }
    
            
        # Output books to confirm the above query worked as expected
        dump(Book::orderBy('published_year')->get()->toArray());
        }
    

    public function practice6(){
    # First get a book to update
    $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

    if (!$book) {
        dump("Book not found, can not update.");
    } else {
        # Change some properties
        $book->title = 'The Really Great Gatsby';
        $book->published_year = '2025';

        # Save the changes
        $book->save();

        dump('Update complete');
    }

        
    # Output books to confirm the above query worked as expected
    dump(Book::orderBy('published_year')->get()->toArray());
    }
    

    public function practice5(){
        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->orWhere('published_year', '>', '1998')->select('title')->get();

        dump($books->toArray());
        // if ($books->isEmpty()) {
        //     dump('No matches found');
        // } else {
        //     foreach ($books as $book) {
        //         dump($book->title);
        //     }
        // }
    }
    public function practice4(){
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a column in the table
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        # Confirm results
        dump('Added: ' . $book->title);
        dump(Book::all()->toArray());
    }

    public function practice3()
    {
        dump(DB::select('SHOW DATABASES;')); 
    }
    public function practice2()
    {
        dump(config('database'));
    }
    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://bookmark.yourdomain.com.loc/practice => Shows a listing of all practice routes
     * http://bookmark.yourdomain.com.loc/practice/1 => Invokes practice1
     * http://bookmark.yourdomain.com.loc/practice/5 => Invokes practice5
     * http://bookmark.yourdomain.com.loc/practice/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with([
                'methods' => $methods,
                'books' => Book::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'title', 'published_year'
                ]
            ]);
        }
    }
}