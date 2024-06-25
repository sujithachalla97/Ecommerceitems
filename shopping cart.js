let cart = [];
let totalPrice = 0;

function addToCart(product, price) {
  cart.push({ product, price });
  updateCart();
}

function updateCart() {
  const cartItems = document.getElementById("cartItems");
  cartItems.innerHTML = "";
  totalPrice = 0;
  
  cart.forEach(item => {
    let li = document.createElement("li");
    li.textContent = `${item.product} - $${item.price.toFixed(2)}`;
    cartItems.appendChild(li);
    totalPrice += item.price;
  });
  
  document.getElementById("totalPrice").textContent = totalPrice.toFixed(2);
}
