export type CarouselProps = {
  children: any;
  accessibility: boolean;
  adaptiveHeight: boolean;
  className: string;
  centerMode: boolean;
  infinite: boolean;
  centerPadding: string;
  customPaging: Function;
  dotsClass: string;
  dots: boolean;
  draggable: boolean;
  easing: string;
  fade: boolean;
  focusOnSelect: boolean;
  slidesToShow: number;
  initialSlide: number;
  lazyLoad: boolean;
  pauseOnDotsHover: boolean;
  pauseOnFocus: boolean;
  pauseOnHover: boolean;
  responsive: any[];
  rtl: boolean;
  slide: string;
  slidesToScroll: number;
  swipeToSlide: boolean;
  swipe: boolean;
  touchThreshold: number;
  useCSS: boolean;
  useTransform: boolean;
  variableWidth: boolean;
  vertical: boolean;
  touchMove: boolean;
  onEdge: Function;
  onInit: Function;
  onLazyLoad: Function;
  onReInit: Function;
  onSwipe: Function;
  speed: number;
  rows: number;
  slidesPerRow: number;
  afterChange: Function;
  appendDots: Function; //Default: dots => <ul>{dots}</ul>
  arrows: boolean;
  asNavFor: boolean;
  autoplay: boolean;
  autoplaySpeed: number;
  beforeChange: Function;
};