import{c as a,a as r,b as e,F as i,r as u,f as d,o as n,_,t,d as o,g as h}from"./index-1414b55d.js";import{g as k}from"./adminHelper-32c12dca.js";const p={class:"uk-container uk-align-center"},g=e("h1",{class:"uk-text-center"},"BOCATAS",-1),m=e("div",{class:"uk-container"},null,-1),b=e("br",null,null,-1),f={class:"uk-container"},v={class:"uk-card-media-left uk-cover-container"},P=["src"],w=e("canvas",{width:"300",height:"300"},null,-1),y={class:"uk-card-body"},A={class:"uk-card-title"},B=e("u",null,"Igredientes:",-1),D=e("br",null,null,-1),N={data(){return{user:{},allPieces:[]}},mounted(){d.on("userObj",c=>{this.user=c}),this.setPageData()},methods:{async setPageData(){this.allPieces=await k()}}},O=Object.assign(N,{__name:"bocatas",setup(c){return(l,j)=>(n(),a(i,null,[r(_),e("main",p,[g,m,b,e("div",f,[(n(!0),a(i,null,u(l.allPieces,s=>(n(),a("div",{key:l.allPieces,class:"uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin","uk-grid":""},[e("div",v,[e("img",{src:s.imagen,width:"300",height:"300",alt:"","uk-cover":""},null,8,P),w]),e("div",y,[e("h3",A,[e("b",null,t(s.nombre),1)]),e("p",null,t(s.descripcion),1),e("p",null,[B,D,o(" "+t(s.ingredientes),1)]),e("span",null,[o("Precio: "),e("b",null,t(s.precio)+"€",1)])])]))),128))])])],64))}}),V=h(O);V.mount("#app");