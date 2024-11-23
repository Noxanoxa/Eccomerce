import React from "react";
import "./style.css";
import Data from "../../components/Data";

const Cart = ({ CartItem, setCartItem, addToCart, decreaseQty }) => {
  // Stpe: 7   calucate total of items
  const totalPrice = CartItem.reduce(
    (price, item) =>
      price +
      (item?.qty || parseInt(item?.product_quantity)) *
        (item?.price || parseInt(item?.product_price)),
    0
  );

  const productData = Data.productItems;

  // prodcut qty total
  return (
    <>
      <section className="cart-items">
        <div className="container d_flex">
          <div className="cart-details">
            {CartItem.length === 0 && (
              <h1 className="no-items product">No Items added to the Cart</h1>
            )}

            {CartItem.map((item) => {
              const productQty =
                parseInt(item?.price || item?.product_price) *
                parseInt(item?.qty);

              return (
                <div
                  className="cart-list product d_flex"
                  key={item?.id || item?.code}
                >
                  <div className="img">
                    <img src={productData[0]?.cover} alt="item image" />
                  </div>
                  <div className="cart-details">
                    <h3>{item?.name || item?.product_name}</h3>
                    <p>Total quantity : {item?.product_quantity}</p>
                    <h4>
                      ${item?.price || item?.product_price}.00 * {item?.qty}
                      <span>${productQty}.00</span>
                    </h4>
                  </div>
                  <div className="cart-items-function">
                    <div className="removeCart">
                      <button
                        className="removeCart"
                        onClick={() => {
                          setCartItem(
                            CartItem.filter((_item) => _item.code !== item.code)
                          );
                        }}
                      >
                        <i className="fa-solid fa-xmark"></i>
                      </button>
                    </div>
                    <div className="cartControl d_flex">
                      <button
                        style={{
                          cursor : "pointer"
                        }}
                        className="incCart"
                        onClick={() =>
                          parseInt(item.qty) <
                            parseInt(item.product_quantity) && addToCart(item)
                        }
                      >
                        <i className="fa-solid fa-plus"></i>
                      </button>
                      <button
                        className="desCart"
                        style={{
                          cursor : "pointer"
                        }}
                        onClick={() => decreaseQty(item)}
                      >
                        <i className="fa-solid fa-minus"></i>
                      </button>
                    </div>
                  </div>

                  <div className="cart-item-price"></div>
                </div>
              );
            })}
          </div>

          <div className="cart-total product">
            <h2>Cart Summary</h2>
            <div className=" d_flex">
              <h4>Total Price :</h4>
              <h3>${totalPrice}.00</h3>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default Cart;
