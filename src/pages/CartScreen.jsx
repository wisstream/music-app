import React from "react";
import Header from "../components/Header";
import CartComponent from "../components/CartComponent";

export default function CartScreen() {
  return (
    <div>
      <Header />
      <h1 class="title"> Votre panier</h1>
      <CartComponent />
    </div>
  );
}
