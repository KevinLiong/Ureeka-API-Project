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
        $koleksi_buku = buku::all();
        // dd($koleksi_buku);
        return response()->json($koleksi_buku);
    }

    public function addBook(Request $request)
    {
        $validatedData = $request->validate([
            'isbn'=>'required|unique:buku',
            'judul'=>'required|max:100',
            'penulis'=>'required|max:50',
            'tahun_terbit'=>'required'
        ]);
        
        if(! $validatedData) return response()->json('Book information is invalid.');
        
        buku::create($validatedData);
        return response()->json($request->judul . ' added.');
    }

    public function updateBook(Request $request)
    {
        $validatedData = $request->validate([
            'isbn'=>'required|unique:buku',
            'judul'=>'required|max:100',
            'penulis'=>'required|max:50',
            'tahun_terbit'=>'required'
        ]);
        
        if(! $validatedData) return response()->json('Book information is invalid.');
        
    
        buku::where('isbn', $request->isbn_buku)->update($validatedData);
        return response()->json('Book updated.');
    }

    public function deleteBook(Request $request)
    {
        $book = buku::find($request->isbn);
        // return response()->json($book);
        $message = $book->judul . ' deleted.';
        
        return $book->destroy($request->isbn) ? response()->json($message) : response()->json('Deletion unsuccessful.');
    }    
}
