import axios from "axios";
import { getToken } from "./cookies";

var token;
function getUserToken() {
  if(!token) token = getToken()
  return token;
}

/** INGREDIENTS */
export const countAllIngredients = async () => {
  return await axios.get('http://api.bocafast.io/get/ingredients/countAllIngredients.php',
  {
    headers: {
      auth_token: getUserToken(),
    }
  })
  .then((res) => {
    return res.data;
  })
  .catch((err) => {
    return 'error';
  })
}

export const getAllIngredients = async () => {
  return await axios.get('http://api.bocafast.io/get/ingredients/getAllIngredients.php',
  {
    headers: {
      auth_token: getUserToken(),
    }
  })
  .then((res) => {
    return res.data;
  })
  .catch((err) => {
    return 'error';
  })
}

export const deleteIngredient = async (ingredientId) => {
  return await axios.get('http://api.bocafast.io/set/ingredients/deleteIngredient.php',
  {
    headers: {
      auth_token: getUserToken(),
    },
    params: {
      ingredientId: ingredientId
    }
  })
  .then((res) => {
    return res.data;
  })
  .catch((err) => {
    return 'error';
  })
}

/** COMPLEMENTOS */
export const countAllComplements = async () => {
  return await axios.get('http://api.bocafast.io/get/complements/countAllComplements.php',
  {
    headers: {
      auth_token: getUserToken(),
    }
  })
  .then((res) => {
    return res.data;
  })
  .catch((err) => {
    return 'error';
  })
}

/** PIEZAS */
export const countAllPieces = async () => {
  return await axios.get('http://api.bocafast.io/get/pieces/countAllPieces.php',
  {
    headers: {
      auth_token: getUserToken(),
    }
  })
  .then((res) => {
    return res.data;
  })
  .catch((err) => {
    console.log(err)
    return err;
  })
}

/** PEDIDOS */
export const countAllActiveOrders = async () => {
  return await axios.get('http://api.bocafast.io/get/orders/countAllActiveOrders.php',
  {
    headers: {
      auth_token: getUserToken(),
    }
  })
  .then((res) => {
    return res.data;
  })
  .catch((err) => {
    console.log(err)
    return err;
  })
}

