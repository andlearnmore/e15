<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * GET list
    */ 
    public function show(Request $request)
    {
        # Note how in sortByDesc we specify `pivot.created_at` to get 
        # the created_at value for the *relationship*, not the book itself
        $books = $request->user()->books->sortByDesc('pivot.created_at');
        return view('list/show', ['books' => $books]);
    }

    /**
     * GET /list/{slug}/add
     */

    public function add(Request $request, $slug)
    {

        $book = Book::findBySlug($slug);

        # TODO: Handle case where book isn’t found for the given slug

;        return view('list/add', ['book' => $book]);
    }

    /**
     * POST /list/{slug}/save
     */

     public function save(Request $request, $slug) 
     {
         # TODO: Possibly add validation to make sure we have notes?
         
         $book = Book::findBySlug($slug);

         $request->user()->books()->save($book, ['notes' => $request->notes]);

         # With views (as in add above) we pass data as a second argument (array).
         # With redirects, here, we want to use the with method.
         return redirect('/list')->with([
            'flash-alert' => 'The book ' . $book->title . ' was added to your list.']);
     }


    /**
     * 
    */

    public function update(Request $request, $slug)
    {

        // TODO: get update to work
        $book = Book::findBySlug($slug);
        $user = $request->user();

        $book = $user->books()->where('books.id', $book->id)->first();

        $book->pivot->notes = $request->notes;
        $book->pivot->save();

        return redirect('/list')->with([
            'flash-alert' => 'Your changes were saved.'
        ]);

    }

    /**
     * GET/list/{slug}/delete
    */

    public function delete(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/books')->with([
                'flash-alert' => 'Book not found.'
            ]);
        }

        return view('list/delete', ['book' => $book]);

    }

    /**
     * POST /list/{slug}
     */

     public function destroy(Request $request, $slug)
     {

        $book = $request->user()->books()->where('slug', $slug)->first();
        
        $book->pivot->delete();
        // dd('Deleted ' . $book->title );
        
        return redirect('/list')->with([
            'flash-alert' => $book->title . ' has been removed from your list.'
        ]);
     }
}