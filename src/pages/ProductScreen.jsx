import React, { useState } from "react";
import {
  useGetProductsQuery,
} from "../services/api";
import { Link, useParams } from "react-router-dom";
import Header from "../components/Header";
import { useCart } from "../context/CartProvider";

export default function ProductScreen() {
  // products
  const { data: products, isLoading: productsIsLoading } =
    useGetProductsQuery();
  const { productId } = useParams();
  const currentProduct = products?.find((p) => p.id === productId);
  const { addToCart } = useCart();
  return (
    <div>
      <Header />
      <Link to={`/products`}>Back</Link>
      {productsIsLoading ? (
        "Loading..."
      ) : (
        <div>
          <h2>{currentProduct.title}</h2>
          <img src={currentProduct.image} alt={currentProduct.title} />
          <p>{currentProduct.description}</p>
          <p>{currentProduct.price}</p>
          <button onClick={() => addToCart(currentProduct)}>Add to cart</button>
        </div>
      )}
      <h1> Pas de description pour ce produit </h1>
    </div>
  );
}
