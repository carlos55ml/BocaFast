import axios from "axios";
import { getToken } from "./cookies";

var token;
function getUserToken() {
  if(!token) token = getToken()
  return token;
}


export const getQuery = (q) => {
  return (location.search.match(new RegExp('[?&]' + q + '=([^&]+)')) || [, null])[1];
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

export const getAllOrders = async () => {
  return await axios.get('http://api.bocafast.io/get/orders/getAllOrders.php',
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
export const getAllActiveOrders = async () => {
  return await axios.get('http://api.bocafast.io/get/orders/getAllActiveOrders.php',
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
export const getAllFinishedOrders = async () => {
  return await axios.get('http://api.bocafast.io/get/orders/getAllFinishedOrders.php',
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

export const cancelOrder = async (orderId) => {
  return await axios.get('http://api.bocafast.io/set/orders/cancelOrder.php',
  {
    headers: {
      auth_token: getUserToken(),
    },
    params: {
      orderId: orderId
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
export const deleteOrder = async (orderId) => {
  return await axios.get('http://api.bocafast.io/set/orders/deleteOrder.php',
  {
    headers: {
      auth_token: getUserToken(),
    },
    params: {
      orderId: orderId
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
export const changeOrderState = async (orderId, state) => {
  return await axios.get('http://api.bocafast.io/set/orders/setOrderState.php',
  {
    headers: {
      auth_token: getUserToken(),
    },
    params: {
      orderId: orderId,
      state: state
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


