import{h as a,j as o}from"./index-1414b55d.js";var s;function r(){return s||(s=o()),s}const h=t=>(location.search.match(new RegExp("[?&]"+t+"=([^&]+)"))||[,null])[1],d=async()=>await a.get("http://api.bocafast.io/get/ingredients/countAllIngredients.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>"error"),i=async()=>await a.get("http://api.bocafast.io/get/complements/countAllComplements.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>"error"),p=async()=>await a.get("http://api.bocafast.io/get/pieces/countAllPieces.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>(console.log(t),t)),u=async()=>await a.get("http://api.bocafast.io/get/pieces/getAllPieces.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>(console.log(t),t)),l=async t=>await a.get("http://api.bocafast.io/get/pieces/getPieceById.php",{headers:{auth_token:r()},params:{pieceId:t}}).then(e=>e.data[0]).catch(e=>(console.log(e),e)),g=async()=>await a.get("http://api.bocafast.io/get/orders/countAllActiveOrders.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>(console.log(t),t)),A=async t=>await a.get("http://api.bocafast.io/get/orders/getOrderById.php",{headers:{auth_token:r()},params:{orderId:t}}).then(e=>e.data).catch(e=>(console.log(e),e)),y=async()=>await a.get("http://api.bocafast.io/get/orders/getAllActiveOrders.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>(console.log(t),t)),f=async()=>await a.get("http://api.bocafast.io/get/orders/getAllFinishedOrders.php",{headers:{auth_token:r()}}).then(t=>t.data).catch(t=>(console.log(t),t)),k=async t=>await a.get("http://api.bocafast.io/set/orders/cancelOrder.php",{headers:{auth_token:r()},params:{orderId:t}}).then(e=>e.data).catch(e=>(console.log(e),e)),m=async t=>await a.get("http://api.bocafast.io/set/orders/deleteOrder.php",{headers:{auth_token:r()},params:{orderId:t}}).then(e=>e.data).catch(e=>(console.log(e),e)),O=async(t,e)=>await a.get("http://api.bocafast.io/set/orders/setOrderState.php",{headers:{auth_token:r()},params:{orderId:t,state:e}}).then(n=>n.data).catch(n=>(console.log(n),n));export{i as a,p as b,d as c,g as d,y as e,f,u as g,m as h,k as i,O as j,h as k,A as l,l as m};