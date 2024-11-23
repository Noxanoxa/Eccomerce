import React, { useEffect, useState } from "react"
import FlashCard from "./FlashCard"
import "./style.css"
import axios from "axios";

const FlashDeals = ({ productItems, addToCart }) => {

  const [products, setProducts] = useState([])

  useEffect(()=> {
    const getProducts = async () => {
      try {
        // const res = await axios.get(`http://ecommerce.test/api/product/${29960393}`);
        const res = await axios.get(`/api/all_products`);
        setProducts(res.data.data);
      } catch (error) {
        console.log(error)
      } 
    }
    getProducts();
  }, []);

  return (
    <>
      <section className='flash'>
        <div className='container'>
          <div className='heading f_flex'>
            <i className='fa fa-bolt'></i>
            <h1>Flash Delas</h1>
          </div>
          <FlashCard productItems={productItems} products={products} addToCart={addToCart} />
        </div>
      </section>
    </>
  )
}

export default FlashDeals
