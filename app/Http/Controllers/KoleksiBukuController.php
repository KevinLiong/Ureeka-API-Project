<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Models\koleksi_buku;
use Session;

class KoleksiBukuController extends Controller
{
    //
    public function getAllBook()
    {
        if (Session::has('...'))
        {
            $koleksi_buku = koleksi_buku::all();
            dd($koleksi_buku);
            return response()->json($koleksi_buku);
        }
    }

    public function addBook(Request $request)
    {
        $isAdmin = Session::get('role');
        
        if ($isAdmin) {
            $newBook = Validator::make($request->all(), [
                'judul'=>'required|max:100',
                'isbn'=>'required|unique',
                'penulis'=>'max:50',
            ]);

            if ($newBook->fails())
            {
                return response()->json('Book information is invalid.');
            }
            else
            {
                $newBook->save();
                return response()->json($request->judul + ' added.');
            }
        } else {
            return response()->json('You are not authorized.');
        }
    }

    public function updateBook(Request $request)
    {
        $isAdmin = Session::get('role');
        
        if ($isAdmin) {
            $book = koleksi_buku::find($request->isbn);

            if (! $book) return response()->json('Book not found.');

            $book->isbn = $request->isbn;
            $book->judul = $request->judul;
            $book->penulis = $request->penulis;
            $book->tahun_terbit = $request->tahun_terbit;

            $book->save();
            return response()->json($request->judul + ' updated.');
        } else {
            return response()->json('You are not authorized.');
        }
    }

    public function deleteBook($isbn)
    {
        $isAdmin = Session::get('role');
        
        if ($isAdmin) {
            $book = koleksi_buku::find($isbn);
            $message = $book->judul + ' deleted.';
            
            return $book->delete() ? response()->json($message) : response()->json('Deletion unsucessful');
        } else {
            return response()->json('You are not authorized.');
        }
    }

    
}
