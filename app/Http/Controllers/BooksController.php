<?php
/**
 * Books controller for search, update and delete books
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/22/16
 * Time: 11:38 AM
 */
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class BooksController extends BaseController{
    /**
     * Method for books search
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BookSearch(Request $request){
        $author_id=intval($request->input('author-id-select'));
        $book_name=addslashes($request->input('book-name'));
        $date_from=preg_replace( '/[^0-9]/', '',addslashes($request->input('date-from-picker')));
        $date_to=preg_replace( '/[^0-9]/', '',addslashes($request->input('date-to-picker')));
        $where_clause="";

        if (isset($author_id)&&$author_id>0)
            $where_clause.="author_id=".$author_id;
        if (isset($book_name)&&strlen($book_name)>0)
            $where_clause.=" and name Like('%$book_name%')";
        if (isset($date_from)&&strlen($date_from)>0)
            $where_clause.=" and date>'$date_from'";
        if (isset($date_to)&&strlen($date_to)>0)
            $where_clause.=" and date<'$date_to'";
        if (strlen($where_clause)===0)
            $where_clause=1;

        $data=\App\Books::whereRaw($where_clause)->get();
        return view('books',['data'=>$data]);
    }


    /**
     * Search book by id and return form for update
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BookUpdate(Request $request){
        $book_id=intval($request->input('id'));
        if ($book_id>0) {
            $data = \App\Books::find($book_id);
            return view('form', ['data' => $data,'book'=>$book_id]);
        } else
            echo 'Book not found...<br/>';
    }

    /**
     * Get data from request and update book
     * @param Request $request
     */
    public function UpdateAction(Request $request){
        $book_id=intval($request->input('book-id'));
        $author_id=intval($request->input('author-id-select'));
        $book_name=addslashes($request->input('book-name'));
        $preview=addslashes($request->input('preview-name'));
        $date=preg_replace( '/[^0-9]/', '',addslashes($request->input('date-picker')));
        if ($book_id>0) {
            $book = \App\Books::find($book_id);
            $book->author_id = $author_id;
            $book->name = $book_name;
            $book->preview = $preview;
            $book->date = $date;
            $book->save();
            echo 'Book updated successfully...<br/>';
        } else
            echo 'Book not found...<br/>';
    }

    /**
     * Delete book
     * @param Request $request
     */
    public function BookDelete(Request $request){
        $book_id=intval($request->input('id'));
        if ($book_id>0) {
            $book = \App\Books::find($book_id);
            $book->delete();
            echo 'Book delete successfully...<br/>';
        } else
            echo 'Book not found...<br/>';
    }
}