import{a as t,j as d}from"./app-2d01f232.js";import{S as c}from"./react-select.esm-ac3b7f90.js";const u=c,f=(e,a)=>{if(a){let l=e==null?void 0:e.find(n=>{var i;return n.value===a||(n!=null&&n.options?(i=n.options)==null?void 0:i.find(m=>m.value===a):!1)});return l!=null&&l.options&&(l=l.options.find(n=>n.value===a)),l}return a};function o(e){const a=e.name?e.multiple?e.name+"[]":e.name:void 0,l=f(e.options,e.value);return t("div",{className:"form-group",children:[e.label&&t("label",{className:"col-form-label",htmlFor:e.id,children:[e.label,e.required?d("abbr",{children:"*"}):""]}),d(u,{name:a,id:e.id,className:e.class,isMulti:e.multiple,options:e.options,onChange:e.onChange,placeholder:e.placeholder,value:l||"",isClearable:!0,isDisabled:e.disabled,ref:e.ref})]})}export{o as S};
