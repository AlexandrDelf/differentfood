const buttonMinus = document.querySelector(".minus")
const buttonPlus = document.querySelector(".plus")
const quantityField = document.querySelector(".amount")
let quantityValue = 1

function increaseQuantity() {
   quantityValue++
   quantityField.innerHTML = quantityValue.toString()
}

function decreaseQuantity() {
   if (quantityValue > 0) {
      quantityValue--
      quantityField.innerHTML = quantityValue.toString()
   } 
}



buttonMinus.addEventListener("click", decreaseQuantity)
buttonPlus.addEventListener("click", increaseQuantity)