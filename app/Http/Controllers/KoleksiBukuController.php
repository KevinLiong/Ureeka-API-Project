<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class KoleksiBukuController extends Controller
{
    //
    public function getAllBook()
    {
        if (Auth::check())
        {
            $koleksi_buku = buku::all();
            dd($koleksi_buku);
            return response()->json($koleksi_buku);
        }
    }

    public function addBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'=>'required|max:100',
            'isbn'=>'required|unique',
            'penulis'=>'max:50',
        ]);
        
        if ($validator->fails()) return response()->json('Book information is invalid.');
        else
        {
            $newBook = new buku();

            $newBook->id = $request->id;
            $newBook->judul = $request->judul;
            $newBook->isbn = $request->isbn;
            $newBook->penulis = $request->penulis;
            $newBook->tahun_terbit = $request->tahun_terbit;

            return $newBook->save() ? response()->json($request->judul + ' added.') : response()->json('Addition unsuccessful.');
        }
    }

    public function updateBook(Request $request, $isbn)
    {
        $book = buku::find($isbn);
        
        $validator = Validator::make($request->all(), [
            'judul'=>'required|max:100',
            'isbn'=>'required|unique',
            'penulis'=>'max:50',
        ]);

        if ($validator->fails()) return response()->json('Book information is invalid.');
        else
        {
            $book->isbn = $request->isbn;
            $book->judul = $request->judul;
            $book->penulis = $request->penulis;
            $book->tahun_terbit = $request->tahun_terbit;

            return $book->save() ? response()->json($request->judul + ' updated.') : response()->json('Update unsuccessful.');
        }            
    }

    public function deleteBook($isbn)
    {
        $book = buku::find($isbn);
        $message = $book->judul + ' deleted.';
        
        return $book->delete() ? response()->json($message) : response()->json('Deletion unsuccessful.');
    }    
}
