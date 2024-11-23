import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import Data from "../components/Data";

const ProductDetails = ({ addToCart }) => {
  const { id } = useParams();

  const [productDetails, setProductDetails] = useState("");

  const sizes = ["S", "M", "X", "XL", "XXL"];

  const [activeSize, setActiveSize] = useState(false);

  const productImages = {
    main_image:
      "https://th.bing.com/th/id/OIP.EiLQxWQybyjEkZW1NhYrOwAAAA?rs=1&pid=ImgDetMain",
    side_images: [
      "https://th.bing.com/th/id/OIP.EiLQxWQybyjEkZW1NhYrOwAAAA?rs=1&pid=ImgDetMain",
      "https://th.bing.com/th/id/OIP.EiLQxWQybyjEkZW1NhYrOwAAAA?rs=1&pid=ImgDetMain",
      "https://th.bing.com/th/id/OIP.EiLQxWQybyjEkZW1NhYrOwAAAA?rs=1&pid=ImgDetMain",
    ],
  };

  useEffect(() => {
    const getData = async () => {
      try {
        // const res = await axios.get(`http://ecommerce.test/api/product/${29960393}`);
        const res = await axios.get(`/api/product/${id}`);
        setProductDetails(res.data.data);
      } catch (error) {
        console.log(error);
      }
    };

    getData();
  }, []);

  return (
    <article className="product-details">
      <div className="product-details-container container">
        <div className="path">
          <p>{productDetails?.category?.name}</p>
          <p>/</p>
          <p>{productDetails?.product_name}</p>
        </div>

        <div className="product-details-info container">
          <div className="product-pictures">
            <div className="side-images">
              {productImages.side_images.map((img) => (
                <img
                  key={img}
                  src={img}
                  style={{
                    height: `${100 / productImages.side_images.length}%`,
                    width: "100%",
                  }}
                  alt="side-image"
                />
              ))}
            </div>

            <div className="main-image">
              <img src={productImages.main_image} alt="main img" />
            </div>
          </div>

          <div className="product-info">
            <div className="product-title">
              <h1>{productDetails?.product_name}</h1>
              <div className="rate">
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
              </div>
            </div>

            <div className="price">
              <h4>${productDetails?.product_price}</h4>
            </div>

            <h3 className="brand-name">{productDetails?.product_brand}</h3>

            <div className="product-sizes">
              {sizes.map((s, index) => (
                <div
                  key={s}
                  className={`size-circle ${
                    !activeSize
                      ? s === productDetails.product_size && "active-size"
                      : activeSize === index + 1 && "active-size"
                  }`}
                  onClick={() => setActiveSize(index + 1)}
                >
                  {s}
                </div>
              ))}
            </div>

            <p className="product-description">
              {productDetails?.product_description}
            </p>

            <button
              className="add-to-cart-button"
              onClick={() => addToCart(productDetails)}
            >
              <i className="fa fa-plus"></i>
              <p>Add to cart</p>
            </button>
          </div>
        </div>
      </div>
    </article>
  );
};

export default ProductDetails;
