<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Models\buku;
use Session;

class KoleksiBukuController extends Controller
{
    //
    public function getAllBook()
    {
        if (Session::has('...'))
        {
            $koleksi_buku = buku::all();
            dd($koleksi_buku);
            return response()->json($koleksi_buku);
        }
    }

    public function addBook(Request $request)
    {
        $isAdmin = Session::get('role');
        
        if ($isAdmin) {
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
        } else return response()->json('You are not authorized.');
    }

    public function updateBook(Request $request, $isbn)
    {
        $isAdmin = Session::get('role');
        
        if ($isAdmin) {
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
        } else return response()->json('You are not authorized.');
    }

    public function deleteBook($isbn)
    {
        $isAdmin = Session::get('role');
        
        if ($isAdmin) {
            $book = buku::find($isbn);
            $message = $book->judul + ' deleted.';
            
            return $book->delete() ? response()->json($message) : response()->json('Deletion unsuccessful.');
        } else return response()->json('You are not authorized.');
    }    
}
