<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function welcome(Request $request){
      return redirect()->route('list');
    }

    public function index(Request $request){
      $items = Item::all();
      return view('list',compact('items'));
    }

    public function create(Request $request){

      $item = new Item();
      $item->item = $request->text;
      $item->save();

      return 'Done';
    }

    public function delete(Request $request){
      $item = Item::findOrFail($request->id);
      $item->delete();
      return 'Done';
    }

    public function update(Request $request){
      $item = Item::findOrFail($request->id);
      $item->item = $request->text;
      $item->save();

      return 'Done';
    }
}
