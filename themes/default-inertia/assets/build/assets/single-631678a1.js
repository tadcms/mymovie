import{j as e,a as i,d as c}from"./app-ed66fb22.js";import{u as r,_ as a}from"./functions-503419f4.js";import t from"./main-b1530055.js";import"./header-9fdd28e8.js";import"./footer-d822eb15.js";function f({post:l,title:n}){var s;return e(t,{children:e("section",{className:"pb-80",children:e("div",{className:"container",children:i("div",{className:"row",children:[e("div",{className:"col-md-12",children:e("ul",{className:"breadcrumbs bg-light mb-4",children:e("li",{className:"breadcrumbs__item",children:i(c,{href:r("/"),className:"breadcrumbs__url",children:[e("i",{className:"fa fa-home"})," ",a("Home")]})})})}),i("div",{className:"col-md-8",children:[i("div",{className:"wrap__article-detail",children:[i("div",{className:"wrap__article-detail-title",children:[e("h1",{children:l.title}),e("h3",{children:l.description})]}),e("hr",{}),e("div",{className:"wrap__article-detail-info",children:i("ul",{className:"list-inline",children:[i("li",{className:"list-inline-item",children:[e("span",{children:a("by")}),i("a",{href:"#",children:[(s=l.author)==null?void 0:s.name,","]})]}),e("li",{className:"list-inline-item",children:e("span",{className:"text-dark text-capitalize ml-1",children:l.created_at})}),e("li",{className:"list-inline-item",children:e("span",{className:"text-dark text-capitalize",children:a("in")})})]})}),e("div",{className:"wrap__article-detail-image mt-4",children:e("figure",{children:e("img",{src:l.thumbnail,alt:l.title,className:"img-fluid"})})}),i("div",{className:"wrap__article-detail-content",children:[i("div",{className:"total-views",children:[i("div",{className:"total-views-read",children:[l.views,e("span",{children:a("views")})]}),i("ul",{className:"list-inline",children:[i("span",{className:"share",children:[a("share on"),":"]}),e("li",{className:"list-inline-item",children:i("a",{className:"btn btn-social-o facebook",href:"https://www.facebook.com/sharer.php?u={{ url()->current() }}",children:[e("i",{className:"fa fa-facebook-f"}),e("span",{children:"facebook"})]})}),e("li",{className:"list-inline-item",children:i("a",{className:"btn btn-social-o twitter",href:"https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $title }}",children:[e("i",{className:"fa fa-twitter"}),e("span",{children:"twitter"})]})}),e("li",{className:"list-inline-item",children:i("a",{className:"btn btn-social-o telegram",href:"https://t.me/share/url?url={{ url()->current() }}&text={{ $title }}",children:[e("i",{className:"fa fa-telegram"}),e("span",{children:"telegram"})]})}),e("li",{className:"list-inline-item",children:i("a",{className:"btn btn-linkedin-o linkedin",href:"https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}",children:[e("i",{className:"fa fa-linkedin"}),e("span",{children:"linkedin"})]})})]})]}),l.content]})]}),e("div",{className:"blog-tags",children:e("ul",{className:"list-inline",children:e("li",{className:"list-inline-item",children:e("i",{className:"fa fa-tags"})})})}),e("div",{className:"clearfix"})]}),e("div",{className:"col-md-4",children:e("div",{className:"sticky-top"})})]})})})})}export{f as default};