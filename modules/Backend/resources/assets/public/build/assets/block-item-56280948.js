import{r as m,a as i,F as g,j as l}from"./app-2d01f232.js";import{I as d}from"./input-0dbd4292.js";import{B}from"./button-b1936e8c.js";import{c as N,b as _}from"./functions-d556270f.js";function L({setting:f,index:r}){const[s,n]=m.useState(f.blocks||[]),u={name:"",label:""},[o,v]=m.useState([]),b=e=>{e.preventDefault(),n([...s,u])},h=(e,a)=>{if(e.target.value==="")return;let t=N(e.target.value),c=_(t);e.target.value=t,v({...o,[a]:c})};return i(g,{children:[s==null?void 0:s.map((e,a)=>i("div",{className:"row",children:[l("div",{className:"col-md-5",children:l(d,{name:`settings[${r}][blocks][${a}][name]`,label:"Block Name",value:e.name,onBlur:t=>h(t,a)})}),l("div",{className:"col-md-6",children:l(d,{name:`settings[${r}][blocks][${a}][label]`,label:"Block Label",value:o[a]||e.label})}),l("div",{className:"col-md-1",children:l("a",{href:"#",className:"text-danger",style:{float:"right"},onClick:t=>{t.preventDefault(),n(s.filter((c,p)=>p!==a))},children:l("i",{className:"fa fa-trash"})})})]},a)),l(B,{class:"btn-sm",label:"Add block",onClick:b})]})}export{L as default};
