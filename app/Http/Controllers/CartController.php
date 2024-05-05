<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationFormRequest;
use App\Models\Competition;
use App\Models\Spectator;
use Cart;


class CartController extends Controller
{
    public function cartList()
{
    $cartItems = Cart::getContent();
    return view('cart', ['cartItems' => $cartItems]);
}


    public function addToCart(ReservationFormRequest $request)
{
    $data = $request->validated();

    // Loop through each competition selected
    foreach ($data['competitions'] as $competitionId) {
        $competition = Competition::findOrFail($competitionId);
        // Loop through each spectator
        foreach ($data['first_name'] as $index => $firstName) {
            $name = $data['first_name'][$index] . ' ' . $data['last_name'][$index];
            $recap = $competition->sport->name . ' | ' . $competition->round . ' | ' . date('d F', strtotime($competition->day)) ;
            \Cart::add(array(
                'id' => $competitionId,
                'name' => $name,
                'price' => $competition->price, 
                'sport' => $competition->sport->name,
                'quantity' => 1,
                'attributes' => array(
                    'first_name' => $data['first_name'][$index],
                    'last_name' => $data['last_name'][$index],
                    'recap' => $recap,
                    'phone_number' => $data['phone_number'][0], 
                    'email' => $data['email'][0], 
                ),
            ));
        }
    }

    return redirect()->route('cart.list')->with('success', 'Ajout au panier réussi');
}

public function saveToDB(Request $request)
{
    // Get all items in the cart
    $cartItems = Cart::getContent();

    // Loop through each item
    foreach ($cartItems as $item) {
        // Create a new spectator instance
        $spectator = new Spectator();
            
        // Assign values from cart item attributes
        $spectator->competition_id = $item->id;
        $spectator->first_name = $item->attributes['first_name'];
        $spectator->last_name = $item->attributes['last_name'];
        $spectator->phone_number = $item->attributes['phone_number'];
        $spectator->email = $item->attributes['email'];
        $spectator->save();
    }

    // Clear the cart after saving data to the database
    Cart::clear();

    // Redirect back to the cart list with a success message
    return redirect()->route('cart.list')->with('success', 'Les réservations ont été confirmées et enregistrées.');
}


    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);

        return redirect()->route('cart.list')->with('success', 'Le produit a ete supprime du panier');
    }


    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
